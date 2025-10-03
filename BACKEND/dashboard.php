<?php
// dashboard.php
include 'db.php';
// Database connection
$host = 'localhost';
$db   = 'sports_app';
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
  $date = $_POST['date'];
  $notes = $_POST['notes'];
  $user_id = 1; // Replace with session-based user ID

  $stmt = $conn->prepare("INSERT INTO workouts (sport, duration, date, notes) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("isis", $sport, $duration, $date, $notes);
  $stmt->execute();
  $stmt->close();
  echo json_encode(["success" => true]);
  exit;
}

// Fetch workouts
fetch('C:\Users\admin\OneDrive\Desktop\SPORT\BACKEND\dashboard.php', { method: 'POST', headers: { 'Content-Type': 'application/json' } })
  .then(response => response.json())
  .then(data => {
    const tableBody = document.getElementById('workoutTable');
    tableBody.innerHTML = '';
    data.forEach(workout => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${workout.sport}</td>
        <td>${workout.duration} mins</td>
        <td>${workout.notes}</td>
        <td>${new Date(workout.date).toLocaleDateString()}</td>
      `;
      tableBody.appendChild(row);
    });
  });