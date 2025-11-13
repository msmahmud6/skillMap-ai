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
$id = $_GET['id'] ?? 0;

// Fetch existing skill
$stmt = $conn->prepare("SELECT * FROM skills WHERE id=:id");
$stmt->execute(['id'=>$id]);
$skillData = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$skillData){
    echo "<div class='alert alert-danger m-3'>Skill not found!</div>";
    exit;
}

// Handle form submission
if($_SERVER['REQUEST_METHOD']=='POST'){
    $skill = $_POST['skill'];
    $stmt = $conn->prepare("UPDATE skills SET skill_name=:skill WHERE id=:id");
    $stmt->execute(['skill'=>$skill, 'id'=>$id]);
    header("Location: update.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Skill</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
body {
    background-color: #f0f4f8;
    font-family: 'Inter', sans-serif;
}
.card {
    border-radius: 12px;
    border: none;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}
.card-header {
    background-color: #a2cbf8ff;
    color: #fff;
    font-weight: 600;
    font-size: 1.2rem;
    border-radius: 12px 12px 0 0;
}
.btn-primary-custom {
    background-color: #a2cbf8ff;
    border-color: #a2cbf8ff;
}
.btn-primary-custom:hover {
    background-color: #a2cbf8ff;
}
</style>
</head>
<body>

<div class="container my-5">
    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-header d-flex align-items-center">
            <i class="fa-solid fa-code me-2"></i> Update Skill
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Skill Name</label>
                    <input type="text" name="skill" class="form-control" value="<?= htmlspecialchars($skillData['skill_name']) ?>" required>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-custom"><i class="fa-solid fa-save me-1"></i> Update</button>
                    <a href="update.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
