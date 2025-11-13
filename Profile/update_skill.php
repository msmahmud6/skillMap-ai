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

// ===== Insert Skill =====
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['skill'])){
    $skill = $_POST['skill'];

    $stmt = $conn->prepare("INSERT INTO skills(user_id, skill_name) VALUES(:user_id, :skill)");
    $stmt->execute([
        'user_id' => $user_id,
        'skill' => $skill
    ]);

    header("Location: update.php");
    exit;
}


?>
