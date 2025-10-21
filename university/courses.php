<?php
include '../db/db_connect.php';

// Category filter
$selected_category = isset($_GET['category']) ? $_GET['category'] : 'All';
if($selected_category == 'All'){
    $courses = $conn->query("SELECT * FROM university_courses ORDER BY id DESC");
}else{
    $stmt = $conn->prepare("SELECT * FROM university_courses WHERE category=? ORDER BY id DESC");
    $stmt->bind_param("s", $selected_category);
    $stmt->execute();
    $courses = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>University Courses</title>
<style>
body{font-family:Arial,sans-serif;margin:0;padding:0;background:#f4f4f4;}
.container{max-width:1200px;margin:auto;padding:20px;}
h1{text-align:center;margin-bottom:20px;}
.filter{margin-bottom:20px;text-align:center;}
.filter select{padding:8px 12px;font-size:16px;}
.courses-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:20px;}
.card{background:#fff;border-radius:10px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.1);transition:0.3s;}
.card:hover{transform:translateY(-5px);box-shadow:0 4px 15px rgba(0,0,0,0.2);}
.card img{width:100%;height:150px;object-fit:cover;}
.card-content{padding:15px;}
.card-content h3{margin:0 0 10px;}
.card-content p{margin:5px 0;font-size:14px;color:#555;}
.card-content a{display:inline-block;margin-top:10px;padding:8px 12px;background:#007BFF;color:#fff;text-decoration:none;border-radius:5px;transition:0.3s;}
.card-content a:hover{background:#0056b3;}
</style>
</head>
<body>

<div class="container">
    <h1>University Courses</h1>
    
    <div class="filter">
        <form method="GET">
            <label>Filter by Category:</label>
            <select name="category" onchange="this.form.submit()">
                <option value="All" <?= $selected_category=='All'?'selected':'' ?>>All</option>
                <option value="Graduation" <?= $selected_category=='Graduation'?'selected':'' ?>>Graduation</option>
                <option value="Post Graduation" <?= $selected_category=='Post Graduation'?'selected':'' ?>>Post Graduation</option>
                <option value="Diploma" <?= $selected_category=='Diploma'?'selected':'' ?>>Diploma</option>
            </select>
        </form>
    </div>
    
    <div class="courses-grid">
        <?php if($courses->num_rows > 0){ ?>
            <?php while($c = $courses->fetch_assoc()){ ?>
                <div class="card">
                    <img src="<?= $c['image']? $c['image']:'placeholder.jpg' ?>" alt="<?= htmlspecialchars($c['course_name']) ?>">
                    <div class="card-content">
                        <h3><?= htmlspecialchars($c['course_name']) ?></h3>
                        <p><strong>Duration:</strong> <?= htmlspecialchars($c['duration']) ?></p>
                        <p><strong>Category:</strong> <?= htmlspecialchars($c['category']) ?></p>
                        <a href="view.php?id=<?= $c['id'] ?>">View Details</a>
                    </div>
                </div>
            <?php } ?>
        <?php }else{ ?>
            <p>No courses found in this category.</p>
        <?php } ?>
    </div>
</div>

</body>
</html>
