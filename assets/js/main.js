// Unit 3: Event Handling & Functions
$(document).ready(function () {
  console.log("SportsIQ Initialized");

  // Load Live Matches on startup (Unit 6: AJAX)
  fetchLiveMatches();

  // Unit 6: Asynchronous polling
  setInterval(fetchLiveMatches, 60000); // Update every minute

    // Filter Logic (Unit 3/6)
    $('.dropdown-item[data-sport]').on('click', function(e) {
        e.preventDefault();
        
        // Remove active class from siblings
        $('.dropdown-item[data-sport]').removeClass('active');
        $(this).addClass('active');

        const sport = $(this).data('sport');
        console.log("Filtering by sport: " + sport);
        
        // Check if we are on Dashboard or Live Page
        if ($('.sport-section').length > 0) {
            // Dashboard Section Filtering
            if (sport === 'all') {
                $('.sport-section').show();
            } else {
                $('.sport-section').hide();
                $('#' + sport + '-standings').show();
            }
        } else {
            // Live Page AJAX Fetch
            fetchLiveMatches(sport);
        }
    });

    // Event Delegation (Unit 3)
    $(document).on("click", ".btn-details", function () {
        const matchId = $(this).data("id");
        console.log("Unit 3: Function called with argument ID: " + matchId);
    
        // Visual feedback instead of blocking alert
        const btn = $(this);
        const originalText = btn.text().trim();
        
        // Simple state toggle simulation
        btn.text("Loading...").addClass("btn-secondary").removeClass("btn-outline-primary");
        
        setTimeout(() => {
            btn.text(originalText).addClass("btn-outline-primary").removeClass("btn-secondary");
            console.log("Mock data loaded for " + matchId);
        }, 500);
        // Future: Load details modal
    });
});

function fetchLiveMatches(sport = 'all') {
    // Unit 6: AJAX Request
    $.ajax({
        url: 'api/proxy.php?action=live_scores&sport=' + sport + '&_t=' + new Date().getTime(),
        method: 'GET',
        dataType: 'json',
        beforeSend: function () {
             $('#match-container').css('opacity', '0.5'); // Visual feedback
        },
        success: function (response) {
            console.log("Data received:", response);
            renderMatches(response.data);
            $('#match-container').css('opacity', '1');
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
            $('#match-container').html(
                '<div class="alert alert-danger">Failed to load live data (Unit 4 Exception Handling).</div>'
            );
            $('#match-container').css('opacity', '1');
        },
    });
}

// Unit 3: Dynamic UI Updates & DOM Manipulation
function renderMatches(matches) {
  const container = $("#match-container");
  container.empty();

  if (!matches || matches.length === 0) {
    container.html(
      '<p class="text-center text-muted">No live matches currently.</p>'
    );
     updateHeroCard(null); // Clear hero
    return;
  }
   
  // Update Hero Card with the first match (most relevant)
  updateHeroCard(matches[0]);

  matches.forEach((match) => {
    // Unit 3: Template Literal & DOM Insertion
    const cardHtml = `
            <div class="col-md-6 col-lg-4">
                <div class="glass-card p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge ${
                          match.status === "LIVE" ? "bg-danger" : "bg-secondary"
                        }">
                            ${
                              match.status === "LIVE"
                                ? '<span class="live-indicator"></span>LIVE'
                                : match.status
                            }
                        </span>
                        <small class="text-secondary">${match.league}</small>
                    </div>
                    <div class="d-flex justify-content-between align-items-center my-3">
                        <div class="text-center w-25">
                            <span class="d-block fw-bold fs-5">${
                              match.home_team_score
                            }</span>
                            <small>${match.home_team}</small>
                        </div>
                        <div class="test-muted px-2">VS</div>
                        <div class="text-center w-25">
                            <span class="d-block fw-bold fs-5">${
                              match.away_team_score
                            }</span>
                            <small>${match.away_team}</small>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-sm btn-outline-primary w-100 btn-details" data-id="${
                          match.id
                        }">
                            Match Stats
                        </button>
                    </div>
                </div>
            </div>
        `;
    container.append(cardHtml);
  });
}

function updateHeroCard(match) {
    if (!match) {
        $('#hero-league').text('No Active Game');
        $('#hero-home-team').text('--');
        $('#hero-away-team').text('--');
        $('#hero-home-score').text('-');
        $('#hero-away-score').text('-');
        $('#hero-status-badge').text('Offline').removeClass('bg-danger').addClass('bg-secondary');
        return;
    }

    $('#hero-league').text(match.league);
    // Abbreviate if too long
    const homeName = match.home_team.length > 15 ? match.home_team.substring(0, 3).toUpperCase() : match.home_team;
    const awayName = match.away_team.length > 15 ? match.away_team.substring(0, 3).toUpperCase() : match.away_team;

    $('#hero-home-team').text(homeName);
    $('#hero-away-team').text(awayName);
    $('#hero-home-score').text(match.home_team_score);
    $('#hero-away-score').text(match.away_team_score);
    
    // Status Badge Logic
    const isLive = match.status === 'LIVE' || match.status === 'in';
    const badgeText = isLive ? 'LIVE' : match.status;
    const badgeClass = isLive ? 'bg-danger' : 'bg-secondary';
    
    $('#hero-status-badge').text(badgeText).removeClass('bg-danger bg-secondary').addClass(badgeClass);
    $('#hero-time').text(match.time);
    
    // Simple visual progress bar simulation
    $('#hero-progress').css('width', '100%');
}
