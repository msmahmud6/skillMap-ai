<?php
include '../db/db.php';
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../Auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// URL থেকে delete_id নেওয়া (id নয়!)
if (isset($_GET['delete_id'])) {
    $id = (int) $_GET['delete_id'];

    // নিরাপত্তার জন্য নিশ্চিত হও যে এই interest ওই logged-in user এরই
    $stmt = $conn->prepare("DELETE FROM career_interests WHERE id=:id AND user_id=:user_id");
    $stmt->execute([
        'id' => $id,
        'user_id' => $user_id
    ]);
}

header("Location: update.php");
exit;
?>
