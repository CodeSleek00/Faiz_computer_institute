<?php
include 'db_connect.php';
session_start();

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
    $password = $phone; // password same as phone (as you want)

    $sql = "INSERT INTO olevel_enrollments (student_id, name, email, phone, address, plan_name, amount, payment_status, payment_id, password)
            VALUES ('$student_id', '$name', '$email', '$phone', '$address', '$plan', '$price', 'Paid', '$payment_id', '$password')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['enroll_success'] = [
            'student_id' => $student_id,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'plan' => $plan,
            'amount' => $price,
            'payment_id' => $payment_id,
            'password' => $password
        ];
        echo "success";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
