<?php
session_start();
require 'db_connect.php';

$student_id = trim($_POST['student_id'] ?? '');
$password   = $_POST['password'] ?? '';

if(!$student_id || !$password){
  header("Location: login.php?error=1"); exit;
}

$stmt = $conn->prepare("SELECT id,name,password_hash,must_change_password FROM olevel_enrollments WHERE student_id=? LIMIT 1");
$stmt->bind_param("s",$student_id);
$stmt->execute();
$res = $stmt->get_result();

if($res->num_rows == 0){
  header("Location: login.php?error=1"); exit;
}

$user = $res->fetch_assoc();
$stmt->close();

if(!isset($user['password_hash']) || !password_verify($password, $user['password_hash'])){
  header("Location: login.php?error=1"); exit;
}

// successful login
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['student_id'] = $student_id;

if($user['must_change_password']){
  // redirect to change password page (implement below) or show prompt
  header("Location: change_password.php?first_time=1");
  exit;
}

header("Location: portal.php");
exit;
