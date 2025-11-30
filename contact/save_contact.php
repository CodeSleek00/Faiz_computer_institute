<?php
include 'db_connect.php';

$name     = $_POST['name'] ?? '';
$contact  = $_POST['contact'] ?? '';
$email    = $_POST['email'] ?? '';
$message  = $_POST['message'] ?? '';

if($name == "" || $contact == "" || $email == "" || $message == ""){
    echo "All fields are required!";
    exit;
}

$stmt = $conn->prepare("INSERT INTO contact_form (name, contact, email, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $contact, $email, $message);

if($stmt->execute()){
    echo "Thank you! Your query has been submitted.";
}else{
    echo "Error: Something went wrong!";
}

$stmt->close();
$conn->close();
?>
