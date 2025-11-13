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

// ===== Fetch single interest for editing =====
if(!isset($_GET['edit_id'])){
    header("Location: update_interest.php"); // edit_id না থাকলে listing page-এ ফেরত
    exit;
}

$edit_id = $_GET['edit_id'];
$stmt = $conn->prepare("SELECT * FROM career_interests WHERE id=:id AND user_id=:user_id");
$stmt->execute(['id'=>$edit_id, 'user_id'=>$user_id]);
$editData = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$editData){
    echo "<div class='alert alert-danger m-3'>Career Interest not found!</div>";
    exit;
}

// ===== Handle form submission =====
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_interest'])){
    $stmt = $conn->prepare("UPDATE career_interests 
                            SET role_title=:role_title, field=:field, focus_area=:focus_area, goal=:goal
                            WHERE id=:id AND user_id=:user_id");
    $stmt->execute([
        'role_title'=>$_POST['title'],
        'field'=>$_POST['field'],
        'focus_area'=>$_POST['focus_area'],
        'goal'=>$_POST['goal'],
        'id'=>$edit_id,
        'user_id'=>$user_id
    ]);
    header("Location: update.php"); // update হয়ে গেলে listing page-এ ফেরত
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Career Interest</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
body { background-color:#F8FAFC; font-family:'Inter',sans-serif; }
.card { border-radius:10px; border:1px solid #DCECFD; box-shadow:0 4px 10px rgba(37,99,235,0.1); background:#fff; }
.card-header { background-color:#DCECFD; color:#2563EB; font-weight:600; font-size:1.1rem; border-bottom:2px solid #2563EB; }
.btn-primary-custom { background-color:#2563EB; border-color:#2563EB; color:white; }
.btn-primary-custom:hover { background-color:#1E40AF; }
.form-control { border-radius:6px; }
</style>
</head>
<body>

<div class="container mt-4">

<!-- Edit Career Interest Card -->
<div class="card mb-4">
    <div class="card-header"><i class="fa-solid fa-lightbulb"></i> Edit Career Interest</div>
    <div class="card-body">
        <form method="post">
            <div class="row g-2">
                <div class="col-md-3">
                    <input type="text" name="title" class="form-control" placeholder="Role / Title" value="<?= htmlspecialchars($editData['role_title']) ?>" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="field" class="form-control" placeholder="Field / Domain" value="<?= htmlspecialchars($editData['field']) ?>" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="focus_area" class="form-control" placeholder="Focus Area" value="<?= htmlspecialchars($editData['focus_area']) ?>" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="goal" class="form-control" placeholder="Career Goal" value="<?= htmlspecialchars($editData['goal']) ?>" required>
                </div>
            </div>
            <div class="mt-3 d-flex gap-2">
                <button type="submit" name="update_interest" class="btn btn-primary-custom">
                    <i class="fa-solid fa-save me-1"></i> Update
                </button>
                <a href="update.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
