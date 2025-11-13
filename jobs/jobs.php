<?php
include '../db/db.php'; // PDO connection

// Pagination setup
$limit = 12;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Filters
$search = $_GET['search'] ?? '';
$type = $_GET['type'] ?? '';
$location = $_GET['location'] ?? '';
$level = $_GET['level'] ?? '';

// Base query
$sql = "SELECT * FROM jobs WHERE 1=1";
$params = [];

// Filters
if ($search) {
    $sql .= " AND (job_title LIKE :search OR company_name LIKE :search OR required_skills LIKE :search)";
    $params[':search'] = "%$search%";
}

if ($type) {
    $sql .= " AND job_type = :type";
    $params[':type'] = $type;
}

if ($location) {
    $sql .= " AND location = :location";
    $params[':location'] = $location;
}

if ($level) {
    $sql .= " AND exp_level = :level";
    $params[':level'] = $level;
}

// Count total jobs for pagination
$countSql = str_replace("SELECT *", "SELECT COUNT(*) as total", $sql);
$stmtCount = $conn->prepare($countSql);
$stmtCount->execute($params);
$totalJobs = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];
$totalPages = ceil($totalJobs / $limit);

// Add pagination
$sql .= " ORDER BY created_at DESC LIMIT :offset, :limit";
$params[':offset'] = $offset;
$params[':limit'] = $limit;

$stmt = $conn->prepare($sql);

// Bind parameters manually for LIMIT and OFFSET (PDO requires INT)
foreach ($params as $key => &$val) {
    if ($key == ':limit' || $key == ':offset') {
        $stmt->bindParam($key, $val, PDO::PARAM_INT);
    } else {
        $stmt->bindParam($key, $val);
    }
}

$stmt->execute();
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Fetch distinct locations from jobs table
$locStmt = $conn->prepare("SELECT DISTINCT location FROM jobs ORDER BY location ASC");
$locStmt->execute();
$locations = $locStmt->fetchAll(PDO::FETCH_COLUMN); // Array of location names

$jobStmt = $conn->prepare("SELECT DISTINCT job_type FROM jobs ORDER BY job_type ASC");
$jobStmt->execute();
$job_types = $jobStmt->fetchAll(PDO::FETCH_COLUMN); // Array of job types

$levels = $conn->prepare("SELECT DISTINCT exp_level FROM jobs ORDER BY exp_level ASC");
$levels->execute();
$exp_levels = $levels->fetchAll(PDO::FETCH_COLUMN); // Array of experience levels

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Opportunities Hub</title>
    <link rel="stylesheet" href="../CSS/jobs.css">
    <style>
        .pagination {
            margin: 20px 0;
            text-align: center;
        }

        .pagination a {
            margin: 0 5px;
            padding: 5px 10px;
            background: #f0f0f0;
            text-decoration: none;
            color: #333;
        }

        .pagination a.active {
            background: #007bff;
            color: #fff;
        }

        .no-results {
            text-align: center;
            margin: 30px 0;
            font-weight: bold;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        /* Make the Filter button match the size of the input/select fields */
        .filter-group.filter-submit {
            justify-content: flex-end;
        }

        .filter-btn {
            background: linear-gradient(135deg, #4f46e5, #3b82f6);
            color: white;
            border: none;
            height: 46px;
            /* Same height as select/input */
            font-size: 1em;
            font-weight: 600;
            border-radius: 10px;
            /* matches select/input */
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 10px rgba(59, 130, 246, 0.2);
            width: 100%;
            /* Make it take the full grid cell width */
        }

        .filter-btn:hover {
            background: linear-gradient(135deg, #4338ca, #2563eb);
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(59, 130, 246, 0.35);
        }

        .filter-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 6px rgba(59, 130, 246, 0.25);
        }
        .no-results {
  text-align: center;
  padding: 80px 20px;
  color: #333;
  font-size: 1.2em;
  font-weight: 600;
  grid-column: 1 / -1;
  background: rgba(255, 255, 255, 0.95);
  border-radius: 20px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
  backdrop-filter: blur(8px);
  animation: fadeIn 0.8s ease-out;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

/* Add a subtle floating animation to the icon */
.no-results .icon {
  font-size: 60px;
  color: #4f46e5;
  margin-bottom: 20px;
  animation: float 3s ease-in-out infinite;
}

.no-results p {
  font-size: 1.3em;
  margin-bottom: 10px;
  color: #111;
}

.no-results span {
  color: #555;
  font-size: 0.95em;
}

/* Floating animation keyframes */
@keyframes float {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-10px);
  }
}

    </style>
</head>

<body style="background: linear-gradient(135deg, #DCECFD 0%, #bedbfaff 100%);">
    <div class="container">
        <div class="filters">
            <form method="GET">
                <div class="filter-grid">
                    <div class="filter-group search-box">
                        <label>Search</label>
                        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search jobs, companies, skills...">
                    </div>
                    <div class="filter-group">
                        <label>Job Type</label>
                        <select name="type">
                            <option value="">All Types</option>
                            <?php foreach ($job_types as $opt): ?>
                                <option value="<?= htmlspecialchars($opt) ?>" <?= $job_types == $opt ? 'selected' : '' ?>><?= htmlspecialchars($opt) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Location</label>
                        <select name="location">
                            <option value="">All Locations</option>
                            <?php foreach ($locations as $opt): ?>
                                <option value="<?= htmlspecialchars($opt) ?>" <?= $location == $opt ? 'selected' : '' ?>><?= htmlspecialchars($opt) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Experience Level</label>
                        <select name="level">
                            <option value="">All Levels</option>
                            <?php foreach ($exp_levels as $opt): ?>
                                <option value="<?= htmlspecialchars($opt) ?>" <?= $exp_levels == $opt ? 'selected' : '' ?>><?= htmlspecialchars($opt) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="filter-group filter-submit">
                        <label style="visibility: hidden;">Filter</label> <!-- Keeps spacing consistent -->
                        <button type="submit" class="filter-btn">Filter</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="jobs-grid">
            <?php if (count($jobs) == 0): ?>
                <div class="no-results">
    <div class="icon">🔍</div>
    <p>No jobs found</p>
    <span>Try adjusting your filters or search keywords.</span>
  </div>
            <?php else: ?>
                <?php foreach ($jobs as $row): ?>
                    <div class="job-card">
                        <div class="job-header">
                            <div class="job-title"><?= htmlspecialchars($row['job_title']) ?></div>
                            <div class="company"><?= htmlspecialchars($row['company_name']) ?></div>
                        </div>
                        <div class="job-meta">
                            <span class="badge location-badge">📍 <?= htmlspecialchars($row['location']) ?></span>
                            <span class="badge type-badge"><?= htmlspecialchars($row['job_type']) ?></span>
                            <span class="badge level-badge"><?= htmlspecialchars($row['exp_level']) ?></span>
                        </div>
                        <div class="skills">
                            <div class="skills-label">Required Skills:</div>
                            <div class="skill-tags">
                                <?php foreach (array_slice(explode(',', $row['required_skills']), 0, 4) as $skill): ?>
                                    <span class="skill-tag"><?= htmlspecialchars(trim($skill)) ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="description"><?= nl2br(htmlspecialchars($row['description'])) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&type=<?= urlencode($type) ?>&location=<?= urlencode($location) ?>&level=<?= urlencode($level) ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>
    </div>
</body>

</html>