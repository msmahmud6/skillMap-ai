<?php
include '../db/db.php';
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../Auth/login.php");
    exit;
}

// Optional: database থেকে আরো fresh data নিতে চাও
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id=:user_id LIMIT 1");
$stmt->execute(['user_id'=>$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$cv_text = $_POST['cv_text'] ?? '';

$stmt = $conn->prepare("SELECT * FROM user_cv WHERE user_id=:id");
$stmt->execute(['id'=>$user_id]);
$exists = $stmt->fetch(PDO::FETCH_ASSOC);

if($exists){
    $stmt = $conn->prepare("UPDATE user_cv SET cv_text=:cv WHERE user_id=:id");
    $stmt->execute(['cv'=>$cv_text, 'id'=>$user_id]);
}else{
    $stmt = $conn->prepare("INSERT INTO user_cv(user_id,cv_text) VALUES(:id,:cv)");
    $stmt->execute(['id'=>$user_id, 'cv'=>$cv_text]);
}

header("Location: update.php");
?>
