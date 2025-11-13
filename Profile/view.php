<?php
include '../db/db.php';
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../Auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// ===== Fetch user info =====
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id=:id");
$stmt->execute(['id'=>$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// ===== Fetch skills =====
$stmt = $conn->prepare("SELECT * FROM skills WHERE user_id=:id");
$stmt->execute(['id'=>$user_id]);
$skills = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ===== Fetch experiences =====
$stmt = $conn->prepare("SELECT * FROM experiences WHERE user_id=:id ORDER BY start_date DESC");
$stmt->execute(['id'=>$user_id]);
$experiences = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ===== Fetch career interests =====
$stmt = $conn->prepare("SELECT * FROM career_interests WHERE user_id=:id ORDER BY id DESC");
$stmt->execute(['id'=>$user_id]);
$interests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Profile</title>
<link rel="stylesheet" href="../CSS/profile.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"/>
<style>
.fixed-sidebar { position: sticky; top: 20px; padding:15px; border:1px solid #DCECFD; border-radius:10px; background:#fff; }
.profile-photo img { width:100px; height:100px; object-fit:cover; border-radius:50%; }
.skill-badge { display:inline-block; padding:5px 10px; background:#DCECFD; color:#2563EB; border-radius:6px; margin:2px; }
.faculty-attributes { margin-bottom:50px; }
.career-item { padding:15px; border:1px solid #DCECFD; border-radius:10px; background:#fff; box-shadow:0 2px 6px rgba(37,99,235,0.1); margin-top:15px; }
body { background-color: #F8FAFC; }
.navbar-brand { font-weight: 600; }
.footer { background:#2563EB; color:#fff; text-align:center; padding:15px 0; margin-top:30px; border-radius:10px; }
.colorlib-bubbles { position:absolute; top:0; left:0; width:100%; height:100%; z-index:-1; overflow:hidden; }
.colorlib-bubbles li { position:absolute; list-style:none; display:block; width:40px; height:40px; background:rgba(37,99,235,0.2); bottom:-160px; animation:bubble 25s infinite; border-radius:50%; }
@keyframes bubble { 0% { transform: translateY(0) rotate(0deg); opacity:1; } 100% { transform: translateY(-700px) rotate(360deg); opacity:0; } }
</style>
</head>
<body>

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
  <div class="container">
    <a class="navbar-brand text-primary" href="#">SkillMap-AI</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarProfile" aria-controls="navbarProfile" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarProfile">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link active" href="../dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="../jobs/jobs.php">Jobs</a></li>
        <li class="nav-item"><a class="nav-link" href="../courses/courses.php">Resources</a></li>
       
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-primary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= htmlspecialchars($user['fullname']) ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="update.php">Edit Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="../Auth/logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div style="height:70px;"></div>
<!-- Navbar End -->

<!-- Bubbles background -->
<ul class="colorlib-bubbles">
  <li></li><li></li><li></li><li></li><li></li>
  <li></li><li></li><li></li><li></li><li></li>
</ul>

<div class="container" style="margin-top:10px;">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3" id="faculty-image-bio">
            <div class="fixed-sidebar text-center " style="m">
                <div class="profile-photo">
                    <img src="../Image/<?= htmlspecialchars($user['profile_photo']) ?>" alt="">
                </div>
                <h3 id="faculty-name">
                    <a href="#" style="text-decoration: none; color: inherit;"><?= htmlspecialchars($user['fullname']) ?></a>
                </h3>
                <div style="margin-top:10px; display:flex; flex-direction:column; gap:6px; font-size:0.95rem; color:#374151;">
                    <div style="display:flex; align-items:center; gap:8px;">
                        <i class="fa-regular fa-envelope" style="color:#2563EB;"></i>
                        <span><?= htmlspecialchars($user['email']) ?></span>
                    </div>
                    <div style="display:flex; align-items:center; gap:8px;">
                        <i class="fa-solid fa-mobile-screen" style="color:#2563EB;"></i>
                        <span><?= htmlspecialchars($user['phone']) ?></span>
                    </div>
                    <div style="display:flex; align-items:center; gap:8px;">
                        <i class="fa-solid fa-location-dot" style="color:#2563EB;"></i>
                        <span><?= htmlspecialchars($user['location']) ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9" id="faculty-details">
            <div style="margin-left:20px; margin-top:20px; display:flex; align-items:center;">
                <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-bottom:30px; flex:1;">
                    <li class="nav-item"><a class="nav-link active" href="#faculty-academic-experience">Skills</a></li>
                    <li class="nav-item"><a class="nav-link" href="#faculty-experience">Experiences</a></li>
                    <li class="nav-item"><a class="nav-link" href="#faculty-awards">Career Interests</a></li>
                </ul>
               
            </div>

            <div class="tab-content" id="nav-tabContent" style="margin-left:20px;">
                <!-- Skills Section -->
                <div id="faculty-academic-experience" class="faculty-attributes" style="scroll-margin-top:110px;">
                    <div style="border-bottom:1px solid #2563EB; box-shadow:-5px 0px #2563EB;">
                        <h3 style="margin-left:8px;">Skills</h3>
                    </div>
                    <div class="skills-list" style="padding:10px;">
                        <?php foreach($skills as $skill): ?>
                            <span class="skill-badge"><?= htmlspecialchars($skill['skill_name']) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Experiences Section -->
                <div id="faculty-experience" class="faculty-attributes" style="margin-top:70px; scroll-margin-top:110px;">
                    <div style="border-bottom:1px solid #2563EB; box-shadow:-5px 0px #2563EB;">
                        <h3 style="margin-left:8px;">Experiences</h3>
                    </div>
                    <table class="table table-striped" style="margin-top:15px;">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Organization</th>
                                <th>From Date</th>
                                <th>To Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($experiences as $exp): 
                                $start = $exp['start_date'] ? date("M Y", strtotime($exp['start_date'])) : '-';
                                $end = $exp['end_date'] ? date("M Y", strtotime($exp['end_date'])) : '-';
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($exp['title']) ?></td>
                                <td><?= htmlspecialchars($exp['organization']) ?></td>
                                <td><?= $start ?></td>
                                <td><?= $end ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Career Interests Section -->
                <div id="faculty-awards" class="faculty-attributes" style="margin-top:70px; scroll-margin-top:110px;">
                    <div style="border-bottom:1px solid #2563EB; box-shadow:-5px 0px #2563EB;">
                        <h3 style="margin-left:8px; color:#1E3A8A;">Career Interests</h3>
                    </div>
                    <?php foreach($interests as $int): ?>
                    <div class="career-item">
                        <h5 style="color:#2563EB; margin:0 0 5px 0;"><?= htmlspecialchars($int['role_title']) ?></h5>
                        <p style="margin:0;"><strong>Field / Domain:</strong> <?= htmlspecialchars($int['field']) ?></p>
                        <p style="margin:0;"><strong>Focus Area:</strong> <?= htmlspecialchars($int['focus_area']) ?></p>
                        <p style="margin:0;"><strong>Career Goal:</strong> <?= htmlspecialchars($int['goal']) ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer" style="background-color:abdcffff">
    &copy; <?= date('Y') ?> SkillMap-AI. All Rights Reserved.
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
