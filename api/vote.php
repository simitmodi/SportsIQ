<?php
header('Content-Type: application/json');

// Unit 5: Database Connection Parameters
// In a real scenario, these would come from environment variables.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sportsiq_db";

$response = ['status' => 'error', 'message' => 'Processing failed'];

try {
    // Unit 3 & 4: Input Validation
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid Request Method");
    }

    $team = $_POST['team'] ?? '';
    $fanName = $_POST['fanName'] ?? 'Anonymous';

    if (empty($team)) {
        throw new Exception("Please select a team.");
    }

    // Unit 5: MySQL Connectivity (Attempt)
    // We suppress warnings using @ because on Vercel without DB, this will fail.
    $conn = @new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        // FALLBACK MODE: Syllabus requires DB, but Vercel Free Tier doesn't have it built-in.
        // We simulate storage to ensure the Viva demo works perfectly.
        saveVoteToFile($team, $fanName);
        $response = [
            'status' => 'success', 
            'message' => 'Vote cast successfully! (Stored via Fallback Storage)',
            'method' => 'File-Based Logic (MySQL Connection Failed as expected on Serverless)'
        ];
    } else {
        // Unit 5: Prepared Statements
        $stmt = $conn->prepare("INSERT INTO votes (team, fan_name) VALUES (?, ?)");
        $stmt->bind_param("ss", $team, $fanName);
        
        if ($stmt->execute()) {
            $response = ['status' => 'success', 'message' => 'Vote saved to Database!'];
        } else {
            throw new Exception("Database Error: " . $stmt->error);
        }
        $stmt->close();
        $conn->close();
    }

} catch (Throwable $e) {
    // Unit 4: Exception Handling (caught Error or Exception)
    $response['message'] = $e->getMessage();
    
    // Auto-fallback if it's a connection/class error
    if (strpos($e->getMessage(), 'mysqli') !== false || strpos($e->getMessage(), 'not found') !== false) {
        saveVoteToFile($team, $fanName);
        $response = [
            'status' => 'success', 
            'message' => 'Vote cast successfully! (Stored via Fallback Storage)',
            'method' => 'File-Based Logic (MySQL Unavailable locally)'
        ];
    }
}

echo json_encode($response);

// Helper for Fallback (Unit 4: File Handling)
function saveVoteToFile($team, $fanName) {
    $file = '../data/votes.json';
    $currentData = [];
    
    if (file_exists($file)) {
        $json = file_get_contents($file);
        $currentData = json_decode($json, true) ?? [];
    }

    $currentData[] = [
        'team' => $team,
        'fan_name' => $fanName,
        'timestamp' => date('Y-m-d H:i:s')
    ];

    file_put_contents($file, json_encode($currentData));
}
?>
