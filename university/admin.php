<?php
include '../db/db_connect.php';

// Course Add
if(isset($_POST['add_course'])){
    $name = $_POST['course_name'];
    $desc = $_POST['description'];
    $duration = $_POST['duration'];
    $company = $_POST['company'];
    $home_section = $_POST['home_section'] ?? 'none';

    // image upload
    $image = '';
    if(isset($_FILES['image']) && $_FILES['image']['name'] != ''){
        $image = 'uploads/'.time().'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    $stmt = $conn->prepare("INSERT INTO university_courses (course_name, description, duration, image, university, home_section) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss",$name,$desc,$duration,$image,$company,$home_section);
    $stmt->execute();
    $course_id = $stmt->insert_id;
    $stmt->close();

    echo "<p style='color:green;'>Course added! Now add syllabus & documents.</p>";
}

// Syllabus Add
if(isset($_POST['add_syllabus'])){
    $course_id = $_POST['course_id'];
    $items = $_POST['syllabus_item']; // array

    foreach($items as $item){
        if($item != ''){
            $stmt = $conn->prepare("INSERT INTO university_course_syllabus (course_id, syllabus_item) VALUES (?, ?)");
            $stmt->bind_param("is", $course_id, $item);
            $stmt->execute();
            $stmt->close();
        }
    }
    echo "<p style='color:green;'>Syllabus added!</p>";
}

// Document Add
if(isset($_POST['add_document'])){
    $course_id = $_POST['course_id_doc'];
    if(!empty($_POST['documents'])){
        foreach($_POST['documents'] as $doc){
            if(trim($doc) != ""){
                $stmt = $conn->prepare("INSERT INTO university_course_documents (course_id, document_name) VALUES (?, ?)");
                $stmt->bind_param("is", $course_id, $doc);
                $stmt->execute();
                $stmt->close();
            }
        }
        echo "<p style='color:green;'>Documents added!</p>";
    }
}

// Fetch courses for syllabus/documents selection
$courses = $conn->query("SELECT id, course_name FROM university_courses");
?>

<h2>Add University Course</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="course_name" placeholder="Course Name" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <input type="text" name="duration" placeholder="Duration"><br>
    <input type="text" name="company" placeholder="University/Company"><br>

    <br>
    <input type="file" name="image"><br>
    <button type="submit" name="add_course">Add Course</button>
</form>

<hr>
<hr>
<h2>Add Syllabus</h2>
<form method="POST">
    <select name="course_id" required>
        <option value="">Select Course</option>
        <?php
        $courses3 = $conn->query("SELECT id, course_name FROM university_courses");
        while($row = $courses3->fetch_assoc()){ ?>
            <option value="<?= $row['id'] ?>"><?= $row['course_name'] ?></option>
        <?php } ?>
    </select><br>

    <div id="syllabus-items">
        <input type="text" name="syllabus_item[]" placeholder="Syllabus Item 1">
    </div>
    <button type="button" onclick="addSyllabus()">+ Add Syllabus Item</button><br><br>
    <button type="submit" name="add_syllabus">Add Syllabus</button>
</form>

<script>

</script>


<hr>
<h2>Add Documents</h2>
<form method="POST">
    <select name="course_id_doc" required>
        <option value="">Select Course</option>
        <?php
        $courses2 = $conn->query("SELECT id, course_name FROM university_courses");
        while($row = $courses2->fetch_assoc()){ ?>
            <option value="<?= $row['id'] ?>"><?= $row['course_name'] ?></option>
        <?php } ?>
    </select><br>
    <div id="documents">
        <input type="text" name="documents[]" placeholder="Document name (e.g., Certificate)">
    </div>
    <button type="button" class="add-btn" onclick="addDocument()">+ Add Document</button><br><br>
    <button type="submit" name="add_document">Upload Documents</button>
</form>

<script>
function addDocument(){
    const div = document.getElementById('documents');
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'documents[]';
    input.placeholder = 'Document name';
    div.appendChild(document.createElement('br'));
    div.appendChild(input);
}
function addSyllabus(){
    const div = document.getElementById('syllabus-items');
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'syllabus_item[]';
    input.placeholder = 'Syllabus Item';
    div.appendChild(document.createElement('br'));
    div.appendChild(input);
}
</script>
