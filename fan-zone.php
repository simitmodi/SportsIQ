<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportsIQ - Fan Zone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top glass-card mx-3 mt-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Sports<span class="text-danger">IQ</span></a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Analytics</a></li>
                    <li class="nav-item"><a class="nav-link active" href="fan-zone.php">Fan Zone</a></li>
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

    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center mb-5">
                <h1 class="fw-bold">Fan Interaction Zone</h1>
                <p class="text-muted">Predict outcomes, vote for your favorite players, and win virtual badges!</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Unit 2: Forms & Validation -->
                <div class="glass-card p-4">
                    <h3 class="mb-4">Match Prediction: WHO WILL WIN?</h3>
                    <div class="card bg-transparent border-0 mb-3">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-3">Arsenal vs Liverpool</h5>
                            <form id="voteForm" action="api/vote.php" method="POST">
                                <div class="btn-group w-100 mb-3" role="group">
                                    <input type="radio" class="btn-check" name="team" id="team1" value="Arsenal" required>
                                    <label class="btn btn-outline-danger" for="team1">Arsenal</label>

                                    <input type="radio" class="btn-check" name="team" id="draw" value="Draw">
                                    <label class="btn btn-outline-light" for="draw">Draw</label>

                                    <input type="radio" class="btn-check" name="team" id="team2" value="Liverpool">
                                    <label class="btn btn-outline-primary" for="team2">Liverpool</label>
                                </div>
                                
                                <div class="mb-3 text-start">
                                    <label for="fanName" class="form-label">Your Name (Optional)</label>
                                    <input type="text" class="form-control bg-dark text-light border-secondary" id="fanName" name="fanName" placeholder="Enter nickname">
                                </div>

                                <button type="submit" class="btn btn-success w-100 rounded-pill">Submit Prediction</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="glass-card p-4 mt-4 mt-lg-0">
                    <h4 class="mb-3">Live Poll Results</h4>
                    <!-- Unit 6: AJAX Content Load -->
                    <div id="poll-results">
                        <div class="mb-2">
                            <div class="d-flex justify-content-between">
                                <span>Arsenal</span>
                                <span>45%</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-danger" style="width: 45%"></div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="d-flex justify-content-between">
                                <span>Liverpool</span>
                                <span>35%</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-primary" style="width: 35%"></div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="d-flex justify-content-between">
                                <span>Draw</span>
                                <span>20%</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-light" style="width: 20%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Unit 3: JS Event Handling for Form -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#voteForm').on('submit', function(e) {
                e.preventDefault();
                // Unit 6: AJAX Post
                $.ajax({
                    url: 'api/vote.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert(response.message); // Unit 3: Alert
                        // In real app, update results here
                    },
                    error: function() {
                        alert("Error submitting vote.");
                    }
                });
            });
        });
    </script>
</body>
</html>
