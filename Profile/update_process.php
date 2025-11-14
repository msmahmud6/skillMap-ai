<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../Auth/login.php");
    exit;
}

include __DIR__ . '/../db/db.php'; // secure & correct include

$user_id = $_SESSION['user_id'];

// fetch current user data
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id=:user_id LIMIT 1");
$stmt->execute(['user_id'=>$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $edu_level = $_POST['edu_level'];
    $experience_level = $_POST['experience_level'];
    $preferred_track = $_POST['preferred_track'];

    $stmt = $conn->prepare("UPDATE users SET fullname=:fullname, email=:email, phone=:phone, location=:location, edu_level=:edu_level, experience_level=:experience_level, preferred_track=:preferred_track WHERE user_id=:id");
    $stmt->execute([
        'fullname'=>$fullname,
        'email'=>$email,
        'phone'=>$phone,
        'location'=>$location,
        'edu_level'=>$edu_level,
        'experience_level'=>$experience_level,
        'preferred_track'=>$preferred_track,
        'id'=>$user_id
    ]);

    header("Location: update.php");
    exit;
}
?>
