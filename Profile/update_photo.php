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

// Upload / Update Photo
if(isset($_POST['upload_photo']) && isset($_FILES['profilePhoto'])){
    $file = $_FILES['profilePhoto'];
    $filename = $file['name'];
    $tmpname = $file['tmp_name'];
    $filesize = $file['size'];
    $filetype = $file['type'];

    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png'];

    if(in_array($ext, $allowed)){
        $newName = "user_".$user_id.".".$ext;
        $destination = "../Image/".$newName;
        if(move_uploaded_file($tmpname, $destination)){
            $stmt = $conn->prepare("UPDATE users SET photo=:photo WHERE user_id=:id");
            $stmt->execute(['photo'=>$newName, 'id'=>$user_id]);
        }
    }
    header("Location: update.php");
    exit;
}

// Remove Photo
if(isset($_POST['remove_photo'])){
    // Get existing photo
    $stmt = $conn->prepare("SELECT photo FROM users WHERE user_id=:id");
    $stmt->execute(['id'=>$user_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row && !empty($row['photo'])){
        $file_path = "../Image/".$row['photo'];
        if(file_exists($file_path)){
            unlink($file_path);
        }
    }
    // Reset to NULL
    $stmt = $conn->prepare("UPDATE users SET photo=NULL WHERE user_id=:id");
    $stmt->execute(['id'=>$user_id]);

    header("Location: update.php");
    exit;
}
?>
