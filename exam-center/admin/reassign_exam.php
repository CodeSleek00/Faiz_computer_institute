<?php
require 'db_connect.php';

// ✅ Validate & sanitize exam_id
$exam_id = isset($_GET['exam_id']) ? intval($_GET['exam_id']) : 0;
if ($exam_id <= 0) {
    die("⚠ Invalid exam ID.");
}

// ✅ Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// ✅ Fetch students (filter only O-Level enrollments if needed)
$students = $conn->query("SELECT student_id, name FROM students ORDER BY name ASC");

// ✅ Fetch batches
$batches = $conn->query("SELECT batch_id, batch_name FROM batches ORDER BY batch_name ASC");

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['assign_type'] ?? '';
    $assignments_made = 0;

    try {
        // ✅ Remove all previous assignments for this exam
        $stmtDel = $conn->prepare("DELETE FROM exam_assignments WHERE exam_id = ?");
        $stmtDel->bind_param("i", $exam_id);
        $stmtDel->execute();

        if ($type === 'student' && !empty($_POST['student_ids'])) {
            $stmt = $conn->prepare("INSERT INTO exam_assignments (exam_id, student_id) VALUES (?, ?)");
            foreach ($_POST['student_ids'] as $sid) {
                $sid = intval($sid);
                if ($sid > 0) {
                    $stmt->bind_param("ii", $exam_id, $sid);
                    $stmt->execute();
                    $assignments_made++;
                }
            }
        } elseif ($type === 'batch' && !empty($_POST['batch_ids'])) {
            // ✅ Batch-based assignment (expands to all students in batch)
            foreach ($_POST['batch_ids'] as $bid) {
                $bid = intval($bid);
                if ($bid > 0) {
                    $conn->query("
                        INSERT INTO exam_assignments (exam_id, student_id)
                        SELECT $exam_id, student_id FROM students WHERE batch_id = $bid
                    ");
                    $assignments_made += $conn->affected_rows;
                }
            }
        } elseif ($type === 'all') {
            $conn->query("INSERT INTO exam_assignments (exam_id, student_id) SELECT $exam_id, student_id FROM students");
            $assignments_made = $conn->affected_rows;
        }

        $message = "✅ Successfully reassigned exam to <b>$assignments_made</b> students.";
    } catch (Exception $e) {
        $message = "❌ Error: " . htmlspecialchars($e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Re-Assign Exam</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f3f4f6; padding: 20px; }
        .form-box { background: white; padding: 25px; border-radius: 12px; max-width: 750px; margin: auto; box-shadow: 0 6px 14px rgba(0,0,0,0.08); }
        h2 { text-align: center; color: #4f46e5; margin-bottom: 20px; }
        label { font-weight: 600; margin-top: 20px; display: block; }
        select, input[type="text"] { width: 100%; padding: 10px; margin-top: 5px; border-radius: 6px; border: 1px solid #ccc; }
        .btn { margin-top: 25px; padding: 10px 20px; background: #4f46e5; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; }
        .btn:hover { background: #4338ca; }
        #studentList, #batchList { max-height: 250px; overflow-y: auto; margin-top: 10px; padding: 10px; border: 1px solid #ddd; border-radius: 6px; background: #f9fafb; }
        #studentList div, #batchList div { margin-bottom: 8px; padding: 5px; border-radius: 4px; transition: 0.2s; }
        #studentList div:hover, #batchList div:hover { background: #eef2ff; }
        .message { background: #dcfce7; color: #166534; border: 1px solid #86efac; padding: 10px 15px; border-radius: 6px; margin-bottom: 15px; text-align: center; }
        .error { background: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; }
        .select-all { margin-bottom: 10px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>♻ Re-Assign Exam</h2>

        <?php if (!empty($message)): ?>
            <div class="<?= strpos($message, 'Error') !== false ? 'error' : 'message' ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <label>Select Assignment Type:</label>
            <select name="assign_type" id="assignType" onchange="toggleSection(this.value)" required>
                <option value="">--Select--</option>
                <option value="student">Specific Students</option>
                <option value="batch">Batch</option>
                <option value="all">All Students</option>
            </select>

            <!-- ✅ Students Section -->
            <div id="students" style="display:none;">
                <label>Search Students:</label>
                <input type="text" id="studentSearch" placeholder="Type to search..." onkeyup="filterList('studentSearch', 'studentList')">
                <div class="select-all">
                    <input type="checkbox" id="selectAllStudents" onclick="toggleAllCheckboxes('studentList', this.checked)">
                    <label for="selectAllStudents">Select All Students</label>
                </div>
                <div id="studentList">
                    <?php while ($s = $students->fetch_assoc()): ?>
                        <div>
                            <input type="checkbox" name="student_ids[]" value="<?= htmlspecialchars($s['student_id']) ?>">
                            <?= htmlspecialchars($s['name']) ?> (ID: <?= htmlspecialchars($s['student_id']) ?>)
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <!-- ✅ Batches Section -->
            <div id="batches" style="display:none;">
                <label>Search Batches:</label>
                <input type="text" id="batchSearch" placeholder="Type to search..." onkeyup="filterList('batchSearch', 'batchList')">
                <div class="select-all">
                    <input type="checkbox" id="selectAllBatches" onclick="toggleAllCheckboxes('batchList', this.checked)">
                    <label for="selectAllBatches">Select All Batches</label>
                </div>
                <div id="batchList">
                    <?php mysqli_data_seek($batches, 0); while ($b = $batches->fetch_assoc()): ?>
                        <div>
                            <input type="checkbox" name="batch_ids[]" value="<?= htmlspecialchars($b['batch_id']) ?>">
                            <?= htmlspecialchars($b['batch_name']) ?> (ID: <?= htmlspecialchars($b['batch_id']) ?>)
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <button type="submit" class="btn">✅ Save & Assign</button>
        </form>
    </div>

    <script>
        function toggleSection(type) {
            document.getElementById('students').style.display = (type === 'student') ? 'block' : 'none';
            document.getElementById('batches').style.display = (type === 'batch') ? 'block' : 'none';
        }

        function filterList(searchInputId, listContainerId) {
            const input = document.getElementById(searchInputId).value.toLowerCase();
            const items = document.getElementById(listContainerId).querySelectorAll('div');
            items.forEach(item => {
                item.style.display = item.textContent.toLowerCase().includes(input) ? '' : 'none';
            });
        }

        function toggleAllCheckboxes(containerId, checked) {
            document.querySelectorAll(`#${containerId} input[type="checkbox"]`).forEach(cb => cb.checked = checked);
        }
    </script>
</body>
</html>
<?php $conn->close(); ?>
