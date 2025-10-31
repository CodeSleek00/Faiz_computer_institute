<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $plan = mysqli_real_escape_string($conn, $_POST['plan']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $payment_id = mysqli_real_escape_string($conn, $_POST['payment_id']);

    // Find last ID
    $res = mysqli_query($conn, "SELECT id FROM olevel_enrollments ORDER BY id DESC LIMIT 1");
    $last_id = 1000;
    if ($row = mysqli_fetch_assoc($res)) {
        $last_id = 1000 + $row['id'];
    }

    $student_id = "Faiz-Olevel-" . ($last_id + 1);
    $password = $phone;

    $sql = "INSERT INTO olevel_enrollments (student_id, name, email, phone, address, plan_name, amount, payment_status, password)
            VALUES ('$student_id', '$name', '$email', '$phone', '$address', '$plan', '$price', 'Paid', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
