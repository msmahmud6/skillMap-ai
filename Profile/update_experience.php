<?php

include '../db/db.php'; // PDO connection
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

if(isset($_POST['title']) && !empty($_POST['title'])) {
    $title = $_POST['title'];
    $organization = $_POST['organization'] ?? null;
    $from_month = $_POST['from_date'] ?? null; // 'YYYY-MM' from input[type=month]
    $to_month   = $_POST['to_date'] ?? null;

    // Convert to YYYY-MM-DD (default 01)
    $start_date = $from_month ? $from_month . '-01' : null;
    $end_date   = $to_month ? $to_month . '-01' : null;

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO experiences (user_id, title, organization, start_date, end_date) 
                            VALUES (:uid, :title, :org, :start, :end)");

    try {
        $stmt->execute([
            'uid' => $user_id,
            'title' => $title,
            'org' => $organization,
            'start' => $start_date,
            'end' => $end_date
        ]);
        $_SESSION['exp_success'] = "Experience added successfully!";
    } catch(PDOException $e) {
        $_SESSION['exp_error'] = "Error: " . $e->getMessage();
    }
}

header("Location: update.php"); // Redirect back to profile update page
exit();
