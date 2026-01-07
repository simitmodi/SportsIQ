
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportsIQ - Analytics Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Reuse Navbar (Should be an include, but keeping simple for now) -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top glass-card mx-3 mt-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-graph-up-arrow text-primary me-2"></i>Sports<span class="text-danger">IQ</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="dashboard.php">Analytics</a></li>
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

    <div class="container mt-5 pt-5">
        <h1 class="mb-4">Team Performance Analytics</h1>
        
        <!-- Unit 2: Tables & CSS -->
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="glass-card p-4">
                    <!-- Football Standings -->
                    <div id="football-standings" class="sport-section">
                        <h4 class="mb-3 text-warning"><i class="bi bi-circle me-2"></i>Premier League (Football)</h4>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover table-borderless align-middle">
                                <thead>
                                    <tr class="border-bottom border-secondary">
                                        <th>Pos</th><th>Team</th><th>P</th><th>W</th><th>D</th><th>L</th><th>Pts</th><th>Form</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $football = [
                                        ['pos'=>1, 'team'=>'Liverpool', 'p'=>20, 'w'=>15, 'd'=>4, 'l'=>1, 'pts'=>49, 'form'=>['W','W','D','W','W']],
                                        ['pos'=>2, 'team'=>'Man City', 'p'=>20, 'w'=>14, 'd'=>3, 'l'=>3, 'pts'=>45, 'form'=>['W','L','W','W','D']],
                                        ['pos'=>3, 'team'=>'Arsenal', 'p'=>20, 'w'=>13, 'd'=>5, 'l'=>2, 'pts'=>44, 'form'=>['D','W','W','L','W']],
                                    ];
                                    foreach($football as $row): ?>
                                    <tr>
                                        <td><?= $row['pos'] ?></td>
                                        <td><div class="d-flex align-items-center"><div class="bg-secondary rounded-circle me-2" style="width:24px;height:24px;"></div><?= $row['team'] ?></div></td>
                                        <td><?= $row['p'] ?></td><td><?= $row['w'] ?></td><td><?= $row['d'] ?></td><td><?= $row['l'] ?></td>
                                        <td class="fw-bold text-primary"><?= $row['pts'] ?></td>
                                        <td><?php foreach($row['form'] as $f): ?><span class="badge rounded-pill bg-<?= $f=='W'?'success':($f=='D'?'warning':'danger') ?> me-1"><?= $f ?></span><?php endforeach; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Basketball Standings -->
                    <div id="basketball-standings" class="sport-section mt-4">
                        <h4 class="mb-3 text-warning"><i class="bi bi-circle me-2"></i>NBA Standings (Basketball)</h4>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover table-borderless align-middle">
                                <thead>
                                    <tr class="border-bottom border-secondary">
                                        <th>Pos</th><th>Team</th><th>W</th><th>L</th><th>PCT</th><th>Streak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $basketball = [
                                        ['pos'=>1, 'team'=>'Celtics', 'w'=>32, 'l'=>10, 'pct'=>'.762', 'str'=>'W4'],
                                        ['pos'=>2, 'team'=>'Bucks', 'w'=>29, 'l'=>13, 'pct'=>'.690', 'str'=>'L1'],
                                        ['pos'=>3, 'team'=>'Nuggets', 'w'=>28, 'l'=>14, 'pct'=>'.667', 'str'=>'W2'],
                                    ];
                                    foreach($basketball as $row): ?>
                                    <tr>
                                        <td><?= $row['pos'] ?></td>
                                        <td><div class="d-flex align-items-center"><div class="bg-secondary rounded-circle me-2" style="width:24px;height:24px;"></div><?= $row['team'] ?></div></td>
                                        <td><?= $row['w'] ?></td><td><?= $row['l'] ?></td>
                                        <td class="fw-bold text-primary"><?= $row['pct'] ?></td>
                                        <td><span class="badge bg-<?= $row['str'][0]=='W'?'success':'danger'?>"><?= $row['str'] ?></span></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Cricket Standings -->
                    <div id="cricket-standings" class="sport-section mt-4">
                        <h4 class="mb-3 text-warning"><i class="bi bi-circle me-2"></i>BBL Points Table (Cricket)</h4>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover table-borderless align-middle">
                                <thead>
                                    <tr class="border-bottom border-secondary">
                                        <th>Pos</th><th>Team</th><th>M</th><th>W</th><th>L</th><th>NRR</th><th>Pts</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cricket = [
                                        ['pos'=>1, 'team'=>'Sydney Sixers', 'm'=>10, 'w'=>7, 'l'=>1, 'nrr'=>'+0.890', 'pts'=>15],
                                        ['pos'=>2, 'team'=>'Perth Scorchers', 'm'=>10, 'w'=>6, 'l'=>2, 'nrr'=>'+0.650', 'pts'=>14],
                                        ['pos'=>3, 'team'=>'Brisbane Heat', 'm'=>9, 'w'=>6, 'l'=>3, 'nrr'=>'+0.210', 'pts'=>12],
                                    ];
                                    foreach($cricket as $row): ?>
                                    <tr>
                                        <td><?= $row['pos'] ?></td>
                                        <td><div class="d-flex align-items-center"><div class="bg-secondary rounded-circle me-2" style="width:24px;height:24px;"></div><?= $row['team'] ?></div></td>
                                        <td><?= $row['m'] ?></td><td><?= $row['w'] ?></td><td><?= $row['l'] ?></td>
                                        <td><?= $row['nrr'] ?></td>
                                        <td class="fw-bold text-primary"><?= $row['pts'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="glass-card p-4 h-100">
                    <h4 class="mb-3"><i class="bi bi-pie-chart me-2"></i>Performance Mix</h4>
                    <!-- CSS implementation of a chart for zero-framework logic -->
                    <div class="d-flex justify-content-center align-items-center my-5 position-relative">
                        <div style="
                            width: 200px; 
                            height: 200px; 
                            border-radius: 50%; 
                            background: conic-gradient(
                                var(--accent-blue) 0% 60%, 
                                var(--accent-red) 60% 85%, 
                                #475569 85% 100%
                            );
                            position: relative;
                        "></div>
                        <div class="position-absolute bg-dark rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 140px; height: 140px; top: 50%; left: 50%; transform: translate(-50%, -50%); box-shadow: inset 0 0 20px rgba(0,0,0,0.5); background-color: #1e293b !important;">
                            <div class="text-center">
                                <span class="d-block text-muted small">Top Scorer</span>
                                <strong>Haaland</strong>
                            </div>
                        </div>
                    </div>
                    <ul class="list-unstyled mt-4">
                        <li class="mb-2"><span class="badge bg-primary me-2">●</span>Wins (60%)</li>
                        <li class="mb-2"><span class="badge bg-danger me-2">●</span>Losses (25%)</li>
                        <li class="mb-2"><span class="badge bg-secondary me-2">●</span>Draws (15%)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
