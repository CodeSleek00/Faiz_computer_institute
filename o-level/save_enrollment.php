<?php
require 'db_connect.php';
header('Content-Type: application/json');

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$address = $_POST['address'] ?? '';
$course = $_POST['course_name'] ?? '';
$price = $_POST['price'] ?? 0;

if(!$name || !$email || !$phone || !$address || !$course){
  echo json_encode(['status'=>'error','message'=>'All fields are required']);
  exit;
}

// get last id
$res = $conn->query("SELECT id FROM olevel_enrollments ORDER BY id DESC LIMIT 1");
$next = ($res->num_rows > 0) ? ($res->fetch_assoc()['id'] + 1) : 1001;

$enrollment_id = "FAIZ-OLEVELMOD-" . $next;

// insert
$stmt = $conn->prepare("INSERT INTO olevel_enrollments (enrollment_id, name, email, phone, address, course_name) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss", $enrollment_id, $name, $email, $phone, $address, $course);
if($stmt->execute()){
  echo json_encode([
    'status'=>'success',
    'enrollment_id'=>$enrollment_id,
    'name'=>$name,
    'course_name'=>$course,
    'price'=>$price
  ]);
} else {
  echo json_encode(['status'=>'error','message'=>'Database error']);
}
?>
