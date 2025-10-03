<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $full_name = $_POST['fullName'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO users (fullName, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $fullName, $email, $password);

  if ($stmt->execute()) {
    echo json_encode(["success" => true]);
  } else {
    echo json_encode(["success" => false, "error" => $conn->error]);
  }

  $stmt->close();
}
?>