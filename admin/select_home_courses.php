<?php include '../db/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Select Homepage Courses</title>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #f5f6fa;
    margin: 0;
    padding: 0;
}
.container {
    max-width: 900px;
    background: #fff;
    padding: 30px;
    margin: 40px auto;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
h2 { text-align: center; margin-bottom: 25px; }
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}
th {
    background: #007bff;
    color: white;
}
select {
    padding: 6px;
    border-radius: 6px;
    border: 1px solid #ccc;
}
button {
    margin-top: 20px;
    background: #28a745;
    border: none;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    cursor: pointer;
}
button:hover { background: #218838; }
</style>
</head>
<body>
<div class="container">
    <h2>🏠 Select Courses for Homepage Sections</h2>
    <form method="POST">
        <table>
            <tr>
                <th>ID</th>
                <th>Course Name</th>
                <th>Company</th>
                <th>Homepage Section</th>
            </tr>
            <?php
            $res = $conn->query("SELECT * FROM courses ORDER BY id DESC");
            while($r = $res->fetch_assoc()){
                echo "<tr>
                    <td>{$r['id']}</td>
                    <td>{$r['course_name']}</td>
                    <td>{$r['company']}</td>
                    <td>
                        <select name='section[{$r['id']}]'>
                            <option value='none' ".($r['home_section']=='none'?'selected':'').">None</option>
                            <option value='popular' ".($r['home_section']=='popular'?'selected':'').">Popular</option>
                            <option value='skills' ".($r['home_section']=='skills'?'selected':'').">Skill Development</option>
                            <option value='free' ".($r['home_section']=='free'?'selected':'').">Free Courses</option>
                        </select>
                    </td>
                </tr>";
            }
            ?>
        </table>
        <button type="submit" name="save">💾 Save Changes</button>
    </form>
</div>
</body>
</html>

<?php
if(isset($_POST['save'])){
    foreach($_POST['section'] as $id=>$section){
        $conn->query("UPDATE courses SET home_section='$section' WHERE id=$id");
    }
    echo "<script>alert('Homepage sections updated successfully!'); location.reload();</script>";
}
?>
