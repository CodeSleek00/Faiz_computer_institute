<?php
// admin/modules/add_module.php
// Make sure session handling & admin auth is implemented elsewhere
// This file expects db_connect.php to be available at ../../db_connect.php or adjust path.

session_start();

// Simple admin check (customize as per your auth system)
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // redirect to admin login (change path as needed)
    header("Location: /admin/login.php");
    exit;
}

require_once __DIR__ . '/../../db_connect.php'; // adjust if your folder structure differs

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $module_name = trim($_POST['module_name'] ?? '');
    $slug_input = trim($_POST['slug'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $created_by = $_SESSION['admin_username'] ?? 'admin';

    if ($module_name === '') {
        $errors[] = "Module name is required.";
    }

    // basic slugify function
    function slugify($text) {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        if (empty($text)) {
            return 'module-'.time();
        }
        return $text;
    }

    $slug = $slug_input !== '' ? slugify($slug_input) : slugify($module_name);

    if (empty($errors)) {
        // ensure unique slug: if exists, append timestamp
        $stmt = $conn->prepare("SELECT id FROM modules WHERE slug = ? LIMIT 1");
        $stmt->bind_param("s", $slug);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $slug = $slug . '-' . time();
        }
        $stmt->close();

        // insert into modules
        $insert = $conn->prepare("INSERT INTO modules (module_name, slug, description, created_by) VALUES (?, ?, ?, ?)");
        $insert->bind_param("ssss", $module_name, $slug, $description, $created_by);
        $ok = $insert->execute();

        if ($ok) {
            $module_id = $insert->insert_id;
            $insert->close();

            // insert 4 fixed sections
            $sections = [
                ['videos', 'Videos', 1],
                ['mock_test', 'Mock Tests', 2],
                ['notes', 'Notes', 3],
                ['result', 'Results', 4],
            ];

            $sec_stmt = $conn->prepare("INSERT INTO module_sections (module_id, section_name, display_name, position) VALUES (?, ?, ?, ?)");
            foreach ($sections as $s) {
                $sec_name = $s[0];
                $display = $s[1];
                $pos = $s[2];
                $sec_stmt->bind_param("isss", $module_id, $sec_name, $display, $pos);
                // Note: position is int but bind_param expects string for 's'; adjust types:
                // We'll use correct types:
            }
            $sec_stmt->close();

            // We'll do insertion properly with types:
            $sec_insert = $conn->prepare("INSERT INTO module_sections (module_id, section_name, display_name, position) VALUES (?, ?, ?, ?)");
            foreach ($sections as $s) {
                $sec_insert->bind_param("isss", $module_id, $s[0], $s[1], $s[2]);
                $sec_insert->execute();
            }
            $sec_insert->close();

            $success = "Module <strong>" . htmlspecialchars($module_name) . "</strong> created successfully with default sections.";
        } else {
            $errors[] = "Database error while creating module: " . $conn->error;
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Add Module - Admin</title>
<link rel="stylesheet" href="/assets/css/admin.css"> <!-- optional stylesheet -->
<style>
/* Minimal inline styles so file works standalone */
body { font-family: Inter, Arial, sans-serif; background:#f6f8fb; margin:0; padding:0; }
.container { max-width:900px; margin:30px auto; background:#fff; border-radius:10px; box-shadow:0 6px 18px rgba(0,0,0,0.08); padding:24px; }
h1 { margin:0 0 18px; font-size:20px; }
.form-row { margin-bottom:14px; }
label { display:block; font-weight:600; margin-bottom:6px; }
input[type="text"], textarea { width:100%; padding:10px 12px; border:1px solid #e3e7ee; border-radius:8px; font-size:14px; }
textarea { min-height:120px; resize:vertical; }
button { background:#0ea5a4; color:#fff; padding:10px 16px; border:0; border-radius:8px; cursor:pointer; font-weight:600; }
.alert { padding:10px 14px; border-radius:8px; margin-bottom:12px; }
.alert.error { background:#ffeaea; color:#c53030; border:1px solid #f5c2c2; }
.alert.success { background:#ecfdf5; color:#065f46; border:1px solid #bbf7d0; }
.small { font-size:13px; color:#6b7280; margin-top:6px; }
.row { display:flex; gap:12px; }
.col { flex:1; }
</style>
</head>
<body>
<div class="container">
    <h1>Add New Module</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert error">
            <?php foreach ($errors as $e) { echo "<div>" . htmlspecialchars($e) . "</div>"; } ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert success">
            <?php echo $success; ?><br>
            <a href="manage_modules.php">Go to Manage Modules</a>
        </div>
    <?php endif; ?>

    <form method="post" novalidate>
        <div class="form-row">
            <label for="module_name">Module Name</label>
            <input id="module_name" name="module_name" type="text" placeholder="e.g., O Level - M1R5 Batch" required value="<?php echo isset($_POST['module_name']) ? htmlspecialchars($_POST['module_name']) : ''; ?>">
        </div>

        <div class="form-row">
            <label for="slug">Slug (optional)</label>
            <input id="slug" name="slug" type="text" placeholder="optional-friendly-url" value="<?php echo isset($_POST['slug']) ? htmlspecialchars($_POST['slug']) : ''; ?>">
            <div class="small">If left empty, slug will be generated from module name.</div>
        </div>

        <div class="form-row">
            <label for="description">Description (optional)</label>
            <textarea id="description" name="description"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
        </div>

        <div class="form-row row">
            <div class="col">
                <button type="submit">Create Module</button>
            </div>
            <div class="col" style="display:flex; align-items:center;">
                <a href="manage_modules.php" style="color:#0ea5a4; text-decoration:none; font-weight:600;">Manage Modules</a>
            </div>
        </div>
    </form>

    <hr style="margin:18px 0;">
    <div class="small">Note: After creating module, 4 default sections (Videos, Mock Tests, Notes, Results) will be created automatically.</div>
</div>
</body>
</html>
