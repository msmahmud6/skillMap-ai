<?php
include '../db/db.php'; // PDO connection

// Pagination setup
$limit = 12;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Filters
$search = $_GET['search'] ?? '';
$platform = $_GET['platform'] ?? '';
$skill = $_GET['skill'] ?? '';
$cost = $_GET['cost'] ?? '';

// Base query
$sql = "SELECT * FROM courses WHERE 1=1";
$params = [];

// Filters
if ($search) {
    $sql .= " AND (course_title LIKE :search OR platform LIKE :search OR related_skills LIKE :search)";
    $params[':search'] = "%$search%";
}

if ($platform) {
    $sql .= " AND platform = :platform";
    $params[':platform'] = $platform;
}

if ($skill) {
    $sql .= " AND related_skills LIKE :skill";
    $params[':skill'] = "%$skill%";
}

if ($cost) {
    $sql .= " AND cost_type = :cost";
    $params[':cost'] = $cost;
}

// Count total resources for pagination
$countSql = str_replace("SELECT *", "SELECT COUNT(*) as total", $sql);
$stmtCount = $conn->prepare($countSql);
$stmtCount->execute($params);
$totalResources = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];
$totalPages = ceil($totalResources / $limit);

// Add pagination
$sql .= " ORDER BY course_id DESC LIMIT :offset, :limit";
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
$resources = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch distinct platforms
$platStmt = $conn->prepare("SELECT DISTINCT platform FROM courses ORDER BY platform ASC");
$platStmt->execute();
$platforms = $platStmt->fetchAll(PDO::FETCH_COLUMN);

// Fetch distinct skills (we'll need to parse comma-separated values)
$skillStmt = $conn->prepare("SELECT DISTINCT related_skills FROM courses");
$skillStmt->execute();
$allSkills = [];
foreach ($skillStmt->fetchAll(PDO::FETCH_COLUMN) as $skillStr) {
    $skills = array_map('trim', explode(',', $skillStr));
    $allSkills = array_merge($allSkills, $skills);
}
$allSkills = array_unique($allSkills);
sort($allSkills);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Learning Resources Hub</title>
    <link rel="stylesheet" href="../CSS/courses.css">
    <style>
        .pagination {
            margin: 20px 0;
            text-align: center;
        }

        .pagination a {
            margin: 0 5px;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            color: #333;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .pagination a:hover {
            background: #76b852;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(118, 184, 82, 0.3);
        }

        .pagination a.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
        }

        .filter-group.filter-submit {
            justify-content: flex-end;
        }

        .filter-btn {
            background: linear-gradient(135deg, #4f46e5, #3b82f6);
            color: white;
            border: none;
            height: 46px;
            font-size: 1em;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 10px rgba(59, 130, 246, 0.2);
            width: 100%;
        }

        .filter-btn:hover {
            background: linear-gradient(135deg, #4338ca, #2563eb);
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(59, 130, 246, 0.35);
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

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>Learning Resources</h1>
            <p class="subtitle">Discover courses and tutorials to boost your skills</p>
        </header>

        <div class="filters">
            <form method="GET">
                <div class="filter-grid">
                    <div class="filter-group search-box">
                        <label>Search</label>
                        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search courses, platforms, skills...">
                    </div>
                    <div class="filter-group">
                        <label>Platform</label>
                        <select name="platform">
                            <option value="">All Platforms</option>
                            <?php foreach ($platforms as $opt): ?>
                                <option value="<?= htmlspecialchars($opt) ?>" <?= $platform == $opt ? 'selected' : '' ?>><?= htmlspecialchars($opt) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- <div class="filter-group">
                        <label>Skill</label>
                        <select name="skill">
                            <option value="">All Skills</option>
                            <?php foreach ($allSkills as $opt): ?>
                                <option value="<?= htmlspecialchars($opt) ?>" <?= $skill == $opt ? 'selected' : '' ?>><?= htmlspecialchars($opt) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div> -->
                    <div class="filter-group">
                        <label>Cost</label>
                        <select name="cost">
                            <option value="">All</option>
                            <option value="Free" <?= $cost == 'Free' ? 'selected' : '' ?>>Free</option>
                            <option value="Paid" <?= $cost == 'Paid' ? 'selected' : '' ?>>Paid</option>
                        </select>
                    </div>
                    <div class="filter-group filter-submit">
                        <label style="visibility: hidden;">Filter</label>
                        <button type="submit" class="filter-btn">Filter</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="resources-grid">
            <?php if (count($resources) == 0): ?>
                <div class="no-results">
                    <div class="icon">🔍</div>
                    <p>No resources found</p>
                    <span>Try adjusting your filters or search keywords.</span>
                </div>
            <?php else: ?>
                <?php foreach ($resources as $row): ?>
                    <div class="resource-card">
                        <div class="resource-header">
                            <div class="resource-title"><?= htmlspecialchars($row['course_title']) ?></div>
                            <div class="platform-name"><?= htmlspecialchars($row['platform']) ?></div>
                        </div>
                        <div class="resource-meta">
                            <span class="badge cost-badge <?= strtolower($row['cost_type']) ?>">
                                <?= $row['cost_type'] == 'Free' ? '🎉' : '💳' ?> <?= htmlspecialchars($row['cost_type']) ?>
                            </span>
                        </div>
                        <div class="skills">
                            <div class="skills-label">Related Skills:</div>
                            <div class="skill-tags">
                                <?php foreach (array_slice(array_map('trim', explode(',', $row['related_skills'])), 0, 5) as $skill): ?>
                                    <span class="skill-tag"><?= htmlspecialchars($skill) ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <a href="<?= htmlspecialchars($row['course_url']) ?>" target="_blank" class="visit-btn">
                            Visit Course →
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&platform=<?= urlencode($platform) ?>&cost=<?= urlencode($cost) ?>" 
                       class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>