<?php
// dashboard.php
include 'db.php';
// Database connection
$host = 'localhost';
$db   = 'sports_tracker';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle workout submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $sport = $_POST['sport'];
  $duration = $_POST['duration'];
  $notes = $_POST['notes'];
  $user_id = 1; // Replace with session-based user ID

  $stmt = $conn->prepare("INSERT INTO workouts (user_id, sport, duration, notes) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("isis", $user_id, $sport, $duration, $notes);
  $stmt->execute();
  $stmt->close();
  echo json_encode(["success" => true]);
  exit;
}

// Fetch workouts
$result = $conn->query("SELECT date, sport, duration, notes FROM workouts WHERE user_id = 1 ORDER BY date DESC LIMIT 10");
$workouts = [];
while ($row = $result->fetch_assoc()) {
  $workouts[] = $row;
}
echo json_encode($workouts);
?>