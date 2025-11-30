
<?php
include '../contact/db_connect.php';

$id = $_GET['id'] ?? 0;
$data = $conn->query("SELECT * FROM contact_form WHERE id=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Message</title>
    <style>
        body{
            font-family: Arial;
            padding:20px;
            background:#eef2f3;
        }
        .box{
            background:white;
            padding:20px;
            border-radius:10px;
            width:400px;
            margin:auto;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }
        h2{
            color:#007bff;
        }
        p{
            margin:8px 0;
            font-size:16px;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Message Details</h2>

    <p><strong>Name:</strong> <?= $data['name'] ?></p>
    <p><strong>Contact:</strong> <?= $data['contact'] ?></p>
    <p><strong>Email:</strong> <?= $data['email'] ?></p>
    <p><strong>Message:</strong><br><?= nl2br($data['message']) ?></p>
    <p><strong>Date:</strong> <?= $data['created_at'] ?></p>
</div>

</body>
</html>
