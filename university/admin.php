<?php
include '../db/db_connect.php';

// ----------------- ADD COURSE -----------------
if(isset($_POST['add_course'])){
    $name = $_POST['course_name'];
    $desc = $_POST['description'];
    $duration = $_POST['duration'];
    $company = $_POST['company'];
    $home_section = $_POST['home_section'] ?? 'none';
    $category = $_POST['category'];

    // IMAGE UPLOAD
    $image = '';
    if(isset($_FILES['image']) && $_FILES['image']['name'] != ''){
        $image = '../uploads/'.time().'_'.basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    // INSERT COURSE
    $stmt = $conn->prepare("INSERT INTO university_courses (course_name, description, duration, image, university, home_section, category) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $desc, $duration, $image, $company, $home_section, $category);
    $stmt->execute();
    $course_id = $stmt->insert_id;
    $stmt->close();

    echo "<p style='color:green;'>Course added! Now add syllabus & documents.</p>";
}

// ----------------- ADD SYLLABUS -----------------
if(isset($_POST['add_syllabus'])){
    $course_id = $_POST['course_id'];
    $items = $_POST['syllabus_item']; // array

    foreach($items as $item){
        $item = trim($item);
        if($item != ''){
            $stmt = $conn->prepare("INSERT INTO university_course_syllabus (course_id, syllabus_item) VALUES (?, ?)");
            $stmt->bind_param("is", $course_id, $item);
            $stmt->execute();
            $stmt->close();
        }
    }
    echo "<p style='color:green;'>Syllabus added!</p>";
}

// ----------------- ADD DOCUMENTS -----------------
if(isset($_POST['add_document'])){
    $course_id = $_POST['course_id_doc'];
    if(!empty($_POST['documents'])){
        foreach($_POST['documents'] as $doc){
            $doc = trim($doc);
            if($doc != ""){
                $stmt = $conn->prepare("INSERT INTO university_course_documents (course_id, document_name) VALUES (?, ?)");
                $stmt->bind_param("is", $course_id, $doc);
                $stmt->execute();
                $stmt->close();
            }
        }
        echo "<p style='color:green;'>Documents added!</p>";
    }
}

// FETCH COURSES ONCE
$courses_result = $conn->query("SELECT id, course_name FROM university_courses");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>University Course Management</title>
<style>
body { font-family: Arial, sans-serif; margin: 20px; }
form { margin-bottom: 30px; }
input, select, textarea, button { margin: 5px 0; padding: 8px; width: 100%; max-width: 400px; }
button { width: auto; cursor: pointer; }
hr { margin: 30px 0; }
</style>
</head>
<body>

<h2>Add University Course</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="course_name" placeholder="Course Name" required>
    <textarea name="description" placeholder="Description"></textarea>
    <input type="text" name="duration" placeholder="Duration">
    <input type="text" name="company" placeholder="University/Company">
    <input type="file" name="image">
    <label>Category:</label>
    <select name="category" required>
        <option value="">Select Category</option>
        <option value="Graduation">Graduation</option>
        <option value="Post Graduation">Post Graduation</option>
        <option value="Diploma">Diploma</option>
    </select>
    <button type="submit" name="add_course">Add Course</button>
</form>

<hr>

<h2>Add Syllabus</h2>
<form method="POST">
    <select name="course_id" required>
        <option value="">Select Course</option>
        <?php
        if($courses_result->num_rows > 0){
            $courses_result->data_seek(0);
            while($row = $courses_result->fetch_assoc()){ ?>
                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['course_name']) ?></option>
        <?php }} ?>
    </select>

    <div id="syllabus-items">
        <input type="text" name="syllabus_item[]" placeholder="Syllabus Item 1">
    </div>
    <button type="button" onclick="addSyllabus()">+ Add Syllabus Item</button><br><br>
    <button type="submit" name="add_syllabus">Add Syllabus</button>
</form>

<hr>

<h2>Add Documents</h2>
<form method="POST">
    <select name="course_id_doc" required>
        <option value="">Select Course</option>
        <?php
        if($courses_result->num_rows > 0){
            $courses_result->data_seek(0);
            while($row = $courses_result->fetch_assoc()){ ?>
                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['course_name']) ?></option>
        <?php }} ?>
    </select>

    <div id="documents">
        <input type="text" name="documents[]" placeholder="Document name (e.g., Certificate)">
    </div>
    <button type="button" onclick="addDocument()">+ Add Document</button><br><br>
    <button type="submit" name="add_document">Upload Documents</button>
</form>

<script>
function addSyllabus(){
    const div = document.getElementById('syllabus-items');
    const count = div.querySelectorAll('input').length + 1;
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'syllabus_item[]';
    input.placeholder = 'Syllabus Item ' + count;
    div.appendChild(document.createElement('br'));
    div.appendChild(input);
}

function addDocument(){
    const div = document.getElementById('documents');
    const count = div.querySelectorAll('input').length + 1;
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'documents[]';
    input.placeholder = 'Document ' + count;
    div.appendChild(document.createElement('br'));
    div.appendChild(input);
}
</script>

</body>
</html>
