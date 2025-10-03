<?php
include 'db.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
file_put_contents("log.txt", json_encode($_POST));
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $full_name = $_POST['fullName'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO users (fullName, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $full_name, $email, $password);

  if ($stmt->execute()) {
    echo json_encode(["success" => true]);
  } else {
    echo json_encode(["success" => false, "error" => $conn->error]);
  }

  $stmt->close();
}else {
  http_response_code(405);
  echo "Method Not Allowed";
}
?>