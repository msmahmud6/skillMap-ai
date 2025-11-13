<?php
session_start();
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

// ===== Delete Skill =====
if(isset($_GET['id'])){ // এখানে $_GET['id'] ব্যবহার করতে হবে, কারণ URL এ id পাঠানো হয়েছে
    $stmt = $conn->prepare("DELETE FROM skills WHERE id=:id AND user_id=:user_id");
    $stmt->execute([
        'id' => $_GET['id'],
        'user_id' => $user_id
    ]);
    header("Location: update.php"); // Delete হয়ে গেলে main page এ redirect
    exit;
} else {
    echo "No skill ID specified!";
}
?>
