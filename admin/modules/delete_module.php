<?php
require '../../db_connect.php';
session_start();

$id = $_GET['id'];

// Delete module
$conn->query("DELETE FROM modules WHERE module_id = '$id'");

// Also delete from assignments
$conn->query("DELETE FROM module_assignments WHERE module_id = '$id'");

header("Location: manage_modules.php");
exit;
?>
 