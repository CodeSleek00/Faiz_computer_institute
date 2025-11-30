<?php
include '../contact/db_connect.php';
$result = $conn->query("SELECT * FROM contact_form ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Messages</title>
    <style>
        body{
            font-family: Arial;
            background:#f1f1f1;
            padding:20px;
        }
        table{
            width:100%;
            border-collapse: collapse;
            background:white;
        }
        th, td{
            padding:12px;
            border:1px solid #ccc;
            text-align:left;
        }
        th{
            background:#007bff;
            color:white;
        }
        .btn{
            padding:6px 12px;
            background:#28a745;
            color:white;
            border-radius:4px;
            text-decoration:none;
        }
        .btn:hover{
            background:#1e7e34;
        }
    </style>
</head>
<body>

<h2>All Contact Messages</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Contact</th>
        <th>Email</th>
        <th>View</th>
    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['contact'] ?></td>
            <td><?= $row['email'] ?></td>
            <td>
                <a href="view_contact.php?id=<?= $row['id'] ?>" class="btn">View Details</a>
            </td>
        </tr>
    <?php } ?>

</table>

</body>
</html>
