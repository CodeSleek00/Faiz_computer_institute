<?php
require 'db_connect.php';

// Function to handle file upload
function saveUploadedFile($file, $targetDir = 'uploads') {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) return null;

    if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $safeName = uniqid('file_', true) . '.' . $ext;
    $target = $targetDir . '/' . $safeName;

    if (move_uploaded_file($file['tmp_name'], $target)) {
        return [
            'path' => $target,
            'original' => $file['name']
        ];
    }
    return null;
}

try {
    $pdo->beginTransaction();

    // Collect main course data
    $title = $_POST['title'] ?? '';
    $duration = $_POST['duration'] ?? '';
    $company_id = !empty($_POST['company_id']) ? intval($_POST['company_id']) : null;
    $total_exams = isset($_POST['total_exams']) ? intval($_POST['total_exams']) : 0;

    // Upload course image
    $imagePath = null;
    if (!empty($_FILES['course_image']['name'])) {
        $uploaded = saveUploadedFile($_FILES['course_image'], 'uploads/course_images');
        if ($uploaded) $imagePath = $uploaded['path'];
    }

    // Insert main course record
    $stmt = $pdo->prepare("INSERT INTO courses (title, duration, image, company_id, total_exams)
                           VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $duration, $imagePath, $company_id, $total_exams]);
    $courseId = $pdo->lastInsertId();

    // =============== Syllabus ===============
    if (!empty($_POST['syllabus_title'])) {
        $titles = $_POST['syllabus_title'];
        $descs = $_POST['syllabus_desc'] ?? array_fill(0, count($titles), '');
        foreach ($titles as $i => $t) {
            $desc = $descs[$i] ?? '';
            $stmt = $pdo->prepare("INSERT INTO course_syllabus (course_id, title, description, position)
                                   VALUES (?, ?, ?, ?)");
            $stmt->execute([$courseId, $t, $desc, $i + 1]);
        }
    }

    // =============== Documents ===============
    if (!empty($_FILES['documents']['name'][0])) {
        $fileCount = count($_FILES['documents']['name']);
        for ($i = 0; $i < $fileCount; $i++) {
            $file = [
                'name' => $_FILES['documents']['name'][$i],
                'type' => $_FILES['documents']['type'][$i],
                'tmp_name' => $_FILES['documents']['tmp_name'][$i],
                'error' => $_FILES['documents']['error'][$i],
                'size' => $_FILES['documents']['size'][$i],
            ];

            if ($file['error'] !== UPLOAD_ERR_OK) continue;

            $uploaded = saveUploadedFile($file, 'uploads/course_docs');
            if ($uploaded) {
                $stmt = $pdo->prepare("INSERT INTO course_documents (course_id, filename, original_name)
                                       VALUES (?, ?, ?)");
                $stmt->execute([$courseId, $uploaded['path'], $uploaded['original']]);
            }
        }
    }

    // =============== Fee Groups & Items ===============
    if (!empty($_POST['fee_group_name'])) {
        $groups = $_POST['fee_group_name'];
        $totals = $_POST['fee_group_total'];

        foreach ($groups as $i => $groupName) {
            $totalAmount = floatval($totals[$i] ?? 0);
            $stmt = $pdo->prepare("INSERT INTO course_fee_groups (course_id, group_name, total_amount)
                                   VALUES (?, ?, ?)");
            $stmt->execute([$courseId, $groupName, $totalAmount]);
            $feeGroupId = $pdo->lastInsertId();

            // Handle inner fee items (if added)
            $index = $i + 1;
            $itemNames = $_POST["fee_item_name_{$index}"] ?? [];
            $itemAmounts = $_POST["fee_item_amount_{$index}"] ?? [];

            if (!empty($itemNames)) {
                foreach ($itemNames as $j => $itemName) {
                    $amount = floatval($itemAmounts[$j] ?? 0);
                    if (trim($itemName) === '' && $amount <= 0) continue;

                    $stmt = $pdo->prepare("INSERT INTO course_fee_items (fee_group_id, item_name, amount)
                                           VALUES (?, ?, ?)");
                    $stmt->execute([$feeGroupId, $itemName, $amount]);
                }
            }
        }
    }

    $pdo->commit();

    echo "<h2 style='font-family:Arial; color:green;'>✅ Course saved successfully!</h2>";
    echo "<p>Course ID: <b>{$courseId}</b></p>";
    echo "<a href='add_course.php'>Add another course</a>";

} catch (Exception $e) {
    $pdo->rollBack();
    echo "<h2 style='color:red;'>❌ Error saving course:</h2>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
}
