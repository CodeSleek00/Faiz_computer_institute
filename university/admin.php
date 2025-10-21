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

    $stmt = $conn->prepare("INSERT INTO courses (course_name, description, duration, image, company, home_section) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss",$name,$desc,$duration,$image,$company,$home_section);
    $stmt->execute();
    $course_id = $stmt->insert_id;
    $stmt->close();

    echo "Course added! Now add syllabus & documents.";
}

// Syllabus Add
if(isset($_POST['add_syllabus'])){
    $course_id = $_POST['course_id'];
    $items = $_POST['syllabus_item']; // array

    foreach($items as $item){
        if($item != ''){
            $stmt = $conn->prepare("INSERT INTO course_syllabus (course_id, syllabus_item) VALUES (?, ?)");
            $stmt->bind_param("is", $course_id, $item);
            $stmt->execute();
            $stmt->close();
        }
    }
    echo "Syllabus added!";
}

// Document Upload
if(isset($_POST['add_document'])){
    $course_id = $_POST['course_id'];
    if(isset($_FILES['document']) && $_FILES['document']['name'] != ''){
        $doc_name = $_FILES['document']['name'];
        $doc_path = 'uploads/documents/'.time().'_'.$doc_name;
        move_uploaded_file($_FILES['document']['tmp_name'],$doc_path);

        $stmt = $conn->prepare("INSERT INTO course_documents (course_id, document_name) VALUES (?, ?)");
        $stmt->bind_param("is",$course_id,$doc_name);
        $stmt->execute();
        $stmt->close();

        echo "Document uploaded!";
    }
}

// Fetch courses for syllabus/documents selection
$courses = $conn->query("SELECT id, course_name FROM courses");
?>

<h2>Add University Course</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="course_name" placeholder="Course Name" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <input type="text" name="duration" placeholder="Duration"><br>
    <input type="text" name="company" placeholder="University/Company"><br>
    <select name="home_section">
        <option value="none">None</option>
        <option value="popular">Popular</option>
        <option value="skills">Skills</option>
        <option value="free">Free</option>
    </select><br>
    <input type="file" name="image"><br>
    <button type="submit" name="add_course">Add Course</button>
</form>

<hr>
<h2>Add Syllabus</h2>
<form method="POST">
    <select name="course_id" required>
        <option value="">Select Course</option>
        <?php while($row = $courses->fetch_assoc()){ ?>
            <option value="<?= $row['id'] ?>"><?= $row['course_name'] ?></option>
        <?php } ?>
    </select><br>
    <input type="text" name="syllabus_item[]" placeholder="Syllabus Item 1"><br>
    <input type="text" name="syllabus_item[]" placeholder="Syllabus Item 2"><br>
    <input type="text" name="syllabus_item[]" placeholder="Syllabus Item 3"><br>
    <button type="submit" name="add_syllabus">Add Syllabus</button>
</form>

<hr>
<h2>Upload Document</h2>
<form method="POST" enctype="multipart/form-data">
    <select name="course_id" required>
        <option value="">Select Course</option>
        <?php
        $courses2 = $conn->query("SELECT id, course_name FROM courses");
        while($row = $courses2->fetch_assoc()){ ?>
            <option value="<?= $row['id'] ?>"><?= $row['course_name'] ?></option>
        <?php } ?>
    </select><br>
    <input type="file" name="document" required><br>
    <button type="submit" name="add_document">Upload Document</button>
</form>
