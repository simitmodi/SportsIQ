<?php
// Unit 4: PHP Syntax & Integration (Starting Session)
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Unit 2: Meta Tags, Responsive Viewport -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportsIQ - Live Analytics</title>
    
    <!-- Bootstrap 5 CDN (Unit 2 Frameworks) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Unit 1: Navigation Design -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top glass-card mx-3 mt-3 py-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="bi bi-graph-up-arrow text-primary me-2"></i>Sports<span class="text-danger">IQ</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Analytics</a></li>
                    <li class="nav-item"><a class="nav-link" href="fan-zone.php">Fan Zone</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-info" href="#" id="sportsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-trophy me-1"></i>Sports
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark glass-card border-0" aria-labelledby="sportsDropdown">
                            <li><a class="dropdown-item active" href="#" data-sport="all">All Sports</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" data-sport="football"><i class="bi bi-circle me-2"></i>Football</a></li>
                            <li><a class="dropdown-item" href="#" data-sport="cricket"><i class="bi bi-circle me-2"></i>Cricket</a></li>
                            <li><a class="dropdown-item" href="#" data-sport="basketball"><i class="bi bi-circle me-2"></i>Basketball</a></li>
                            <li><a class="dropdown-item" href="#" data-sport="tennis"><i class="bi bi-circle me-2"></i>Tennis</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section (Unit 2: CSS Positioning) -->
    <section class="container mt-5 pt-5">
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-6 text-center text-lg-start z-1">
                <h1 class="display-3 fw-bold mb-4">
                    Real-Time <span class="text-gradient">Sports Data</span><br>
                    At Your Fingertips
                </h1>
                <p class="lead text-secondary mb-4">
                    Track live scores, analyze team performance, and predict outcomes with our advanced analytics dashboard.
                </p>
                <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                    <a href="dashboard.php" class="btn btn-primary btn-lg rounded-pill px-4">
                        <i class="bi bi-speedometer2 me-2"></i>View Dashboard
                    </a>
                    <a href="#live-scores" class="btn btn-outline-light btn-lg rounded-pill px-4 glass-card border-0">
                        <i class="bi bi-play-circle me-2"></i>Live Matches
                    </a>
                </div>
            </div>
            <!-- Dynamic Element Placeholder -->
            <div class="col-lg-6 d-none d-lg-block position-relative">
                <div class="glass-card p-4 position-absolute top-50 start-50 translate-middle w-75" style="transform: translate(-50%, -50%) rotate(-5deg);">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-danger"><span class="live-indicator"></span><span id="hero-status-badge">LIVE</span></span>
                        <span class="text-muted small" id="hero-league">Loading...</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-center">
                            <h4 class="mb-0" id="hero-home-team">--</h4>
                            <small class="text-muted">Home</small>
                        </div>
                        <div class="display-5 fw-bold"><span id="hero-home-score">-</span> - <span id="hero-away-score">-</span></div>
                        <div class="text-center">
                            <h4 class="mb-0" id="hero-away-team">--</h4>
                            <small class="text-muted">Away</small>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 4px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" id="hero-progress"></div>
                    </div>
                    <div class="text-center mt-2 small text-muted" id="hero-time">Connecting...</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Live Matches Section (Unit 3: Dynamic UI) -->
    <section id="live-matches" class="container py-5">
        <h2 class="mb-4"><i class="bi bi-broadcast text-danger me-2"></i>Live Now</h2>
        <div class="row g-4" id="match-container">
            <!-- Content loaded via AJAX (Unit 6) -->
            <div class="col-12 text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 text-muted">Fetching live data...</p>
            </div>
        </div>
    </section>

    <!-- Unit 3: JavaScript Files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery (Required by Syllabus) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
