<?php include '../db/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Course</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            padding: 30px;
        }
        .container {
            background: white;
            border-radius: 12px;
            padding: 25px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 6px 0 15px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        label { font-weight: bold; }
        button {
            background: #2b8a3e;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover { background: #256f33; }
        .add-btn {
            background: #007bff;
            padding: 6px 12px;
            margin-top: 5px;
        }
        .add-btn:hover { background: #0056b3; }
    </style>
</head>
<body>
<div class="container">
    <h2>Add New Course</h2>
    <form action="save_course.php" method="POST" enctype="multipart/form-data">
        
        <label>Course Name:</label>
        <input type="text" name="course_name" required>

        <label>Description:</label>
        <textarea name="description" rows="4" placeholder="Enter brief course description..." required></textarea>

        <label>Duration:</label>
        <input type="text" name="duration" placeholder="e.g., 3 Months">

        <label>Company Name:</label>
        <input type="text" name="company" placeholder="e.g., Google, Microsoft">

        <label>Total Exams:</label>
        <input type="number" name="total_exams" value="0">

        <label>Image:</label>
        <input type="file" name="image">

        <h3>Documents</h3>
        <div id="documents">
            <input type="text" name="documents[]" placeholder="Document name (e.g., Certificate)">
        </div>
        <button type="button" class="add-btn" onclick="addDocument()">+ Add Document</button>

        <h3>Syllabus</h3>
        <div id="syllabus">
            <input type="text" name="syllabus[]" placeholder="Syllabus topic">
        </div>
        <button type="button" class="add-btn" onclick="addSyllabus()">+ Add Syllabus</button>

        <br><br>
        <button type="submit" name="submit">Save Course</button>
    </form>
</div>

<script>
function addDocument() {
    document.getElementById('documents').insertAdjacentHTML('beforeend', 
        '<input type="text" name="documents[]" placeholder="Document name">'
    );
}
function addSyllabus() {
    document.getElementById('syllabus').insertAdjacentHTML('beforeend', 
        '<input type="text" name="syllabus[]" placeholder="Syllabus topic">'
    );
}
</script>
</body>
</html>
