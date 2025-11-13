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

// Fetch experience data
$stmt = $conn->prepare("SELECT * FROM experiences WHERE id=:id");
$stmt->execute(['id'=>$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$data){
    echo "<div class='alert alert-danger m-3'>Experience not found!</div>";
    exit;
}

// Convert DATE to YYYY-MM for <input type="month">
$from_month = date('Y-m', strtotime($data['start_date']));
$to_month = date('Y-m', strtotime($data['end_date']));

// Handle form submission
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $stmt = $conn->prepare("UPDATE experiences 
        SET title=:title, organization=:organization, start_date=:start_date, end_date=:end_date 
        WHERE id=:id");
    $stmt->execute([
        'title'=>$_POST['title'],
        'organization'=>$_POST['organization'],
        'start_date'=>$_POST['from_date'].'-01', // Add day for DATE column
        'end_date'=>$_POST['to_date'].'-01',
        'id'=>$id
    ]);
    header("Location: update.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Experience</title>
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
    .form-label {
        font-weight: 500;
    }
    .btn-primary-custom {
        background-color: #a2cbf8ff;
        border-color: #DCECFD;
    }
    .btn-primary-custom:hover {
        background-color: #a2cbf8ff;
    }
</style>
</head>
<body>

<div class="container my-5">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <i class="fa-solid fa-briefcase me-2"></i> Update Experience
        </div>
        <div class="card-body">
            <form method="post">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($data['title']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Organization</label>
                        <input type="text" name="organization" class="form-control" value="<?= htmlspecialchars($data['organization']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">From</label>
                        <input type="month" name="from_date" class="form-control" value="<?= $from_month ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">To</label>
                        <input type="month" name="to_date" class="form-control" value="<?= $to_month ?>" required>
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
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
