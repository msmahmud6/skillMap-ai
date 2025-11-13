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

// ===== Career Interests Update Handling =====
if(isset($_POST['update_interest'])){
    $id = $_POST['id'];
    $role_title = $_POST['title'];
    $field = $_POST['field'];
    $focus_area = $_POST['focus_area'];
    $goal = $_POST['goal'];

    $stmt = $conn->prepare("UPDATE career_interests 
                            SET role_title=:role_title, field=:field, focus_area=:focus_area, goal=:goal 
                            WHERE id=:id");
    $stmt->execute([
        'role_title'=>$role_title,
        'field'=>$field,
        'focus_area'=>$focus_area,
        'goal'=>$goal,
        'id'=>$id
    ]);
    header("Location: update_interest.php");
    exit;
}

// ===== Career Interests Insert Handling =====
if(isset($_POST['add_interest'])){
    $role_title = $_POST['title'];
    $field = $_POST['field'];
    $focus_area = $_POST['focus_area'];
    $goal = $_POST['goal'];

    $stmt = $conn->prepare("INSERT INTO career_interests(user_id, role_title, field, focus_area, goal) 
                            VALUES(:user_id, :role_title, :field, :focus_area, :goal)");
    $stmt->execute([
        'user_id'=>$user_id,
        'role_title'=>$role_title,
        'field'=>$field,
        'focus_area'=>$focus_area,
        'goal'=>$goal
    ]);
    header("Location: update.php");
    exit;
}

// ===== Fetch existing career interests =====
$stmt = $conn->prepare("SELECT * FROM career_interests WHERE user_id=:user_id");
$stmt->execute(['user_id'=>$user_id]);
$interests = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ===== For editing, fetch single interest =====
$editData = null;
if(isset($_GET['edit_id'])){
    $stmt = $conn->prepare("SELECT * FROM career_interests WHERE id=:id");
    $stmt->execute(['id'=>$_GET['edit_id']]);
    $editData = $stmt->fetch(PDO::FETCH_ASSOC);
}

// ===== Delete handling =====
if(isset($_GET['delete_id'])){
    $stmt = $conn->prepare("DELETE FROM career_interests WHERE id=:id");
    $stmt->execute(['id'=>$_GET['delete_id']]);
    header("Location: update.php");
    exit;
}
?>


