<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="dashboard.css">


</head>
<body>

  <!--  Main Dashboard Content -->
  <div class="main-content mt-lg-0 pt-5 pt-lg-0 p-4">
    <h3 class="fw-bold mb-4 mt-4">Dashboard</h3>

<!--  Profile Overview -->
<div class="card shadow-sm mb-4 border-0">
  <div class="card-body d-flex flex-wrap justify-content-between align-items-start">

    <!--  Left: Profile Image -->
    <div class="text-center flex-fill d-flex justify-content-center mb-3 mb-md-0">
      <img src="profile.jpeg" width="100" class="rounded-circle" alt="Profile">
    </div>

    <!--  Middle: Welcome + Skills -->
    <div class="text-center flex-fill d-flex flex-column align-items-center mb-3 mb-md-0">
      <h5 class="fw-semibold">Welcome back, <span class="text-primary">Hasib Hasan</span></h5>
      <p class="text-muted mb-2">Keep exploring, keep learning, and keep growing.</p>

      <div class="mt-2 d-flex flex-wrap justify-content-center gap-1">
        <span class="badge bg-light text-dark border">Python</span>
        <span class="badge bg-light text-dark border">Django</span>
        <span class="badge bg-light text-dark border">HTML</span>
        <span class="badge bg-light text-dark border">CSS</span>
        <span class="badge bg-light text-dark border">JavaScript</span>
      </div>
    </div>

    <!--  Right: Education Qualification -->
    <div class="text-center flex-fill d-flex flex-column align-items-center">
      <h6 class="fw-semibold mb-1 ">🎓 Education Qualification</h6>
      <p class="text-muted mb-0 small">
        Bachelor of Science in Computer Science & Engineering <br>
        <span class="fw-medium text-dark">Kishoregang University (2020–2024)</span>
      </p>
    </div>

  </div>
</div>






    <!--  Recommended Jobs -->
    <div class="mb-5 ">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="section-title">Recommended Jobs</h5>
        <button class="btn btn-outline-primary btn-sm">View All</button>
      </div>

      <div class="row g-3 equal-row">
        <div class="col-md-6 col-lg-4">
          <div class="card job-card p-3 shadow-sm border-0">
            <div>
              <h6 class="fw-semibold mb-1">Frontend Developer</h6>
              <p class="text-muted small mb-1">Tech Solutions Ltd.</p>
              <span class="badge bg-warning text-dark">HTML</span>
              <span class="badge bg-info text-dark">CSS</span>
              <span class="badge bg-danger">JS</span>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <small class="text-muted">Remote • Full-time</small>
              <button class="btn btn-sm btn-primary">Apply</button>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card job-card p-3 shadow-sm border-0">
            <div>
              <h6 class="fw-semibold mb-1">Backend Developer</h6>
              <p class="text-muted small mb-1">CodeBase Inc.</p>
              <span class="badge bg-success">Python</span>
              <span class="badge bg-dark">Django</span>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <small class="text-muted">Onsite • Full-time</small>
              <button class="btn btn-sm btn-primary">Apply</button>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card job-card p-3 shadow-sm border-0">
            <div>
              <h6 class="fw-semibold mb-1">UI/UX Designer</h6>
              <p class="text-muted small mb-1">Creative Minds</p>
              <span class="badge bg-info text-dark">Figma</span>
              <span class="badge bg-secondary">Design</span>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <small class="text-muted">Remote • Part-time</small>
              <button class="btn btn-sm btn-primary">Apply</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--  Recommended Learning Resources -->
    <div>
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="section-title">Recommended Learning Resources</h5>
        <button class="btn btn-outline-primary btn-sm">View All</button>
      </div>

      <div class="row g-3 equal-row">
        <div class="col-md-6 col-lg-4">
          <div class="card resource-card p-3 shadow-sm border-0">
            <div>
              <div class="img-container">
                <img src="https://img.youtube.com/vi/_uQrJ0TkZlc/maxresdefault.jpg" alt="Python Course">
              </div>
              <h6 class="fw-semibold">Python for Beginners</h6>
              <p class="text-muted small">FreeCodeCamp • 4.5 hrs</p>
            </div>
            <button class="btn btn-sm btn-outline-primary mt-2">Start Learning</button>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card resource-card p-3 shadow-sm border-0">
            <div>
              <div class="img-container">
                <img src="https://img.youtube.com/vi/oHg5SJYRHA0/maxresdefault.jpg" alt="Django Course">
              </div>
              <h6 class="fw-semibold">Django Crash Course</h6>
              <p class="text-muted small">Traversy Media • 2 hrs</p>
            </div>
            <button class="btn btn-sm btn-outline-primary mt-2">Start Learning</button>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card resource-card p-3 shadow-sm border-0">
            <div>
              <div class="img-container">
                <img src="https://img.youtube.com/vi/UB1O30fR-EE/maxresdefault.jpg" alt="HTML CSS Course">
              </div>
              <h6 class="fw-semibold">Responsive Web Design</h6>
              <p class="text-muted small">FreeCodeCamp • 5 hrs</p>
            </div>
            <button class="btn btn-sm btn-outline-primary mt-2">Start Learning</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
