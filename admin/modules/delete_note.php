<?php
require '../../db_connect.php';
session_start();

$id = $_GET['id'];
$module = $_GET['module'];
$file = $_GET['file'];

$path = "../../uploads/modules/$module/notes/$file";
if (file_exists($path)) {
    unlink($path);
}

$conn->query("DELETE FROM module_notes WHERE note_id='$id'");

header("Location: manage_notes.php");
exit;
?>
