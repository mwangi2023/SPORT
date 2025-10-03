<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT userid, fullName, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      echo json_encode([
        "success" => true,
        "user" => [
          "userid" => $user['userid'],
          "name" => $user['fullName'],
          "email" => $email
        ]
      ]);
    } else {
      echo json_encode(["success" => false, "error" => "Invalid password"]);
    }
  } else {
    echo json_encode(["success" => false, "error" => "User not found"]);
  }

  $stmt->close();
}
?>