// user/login.php
<?php
session_start();
header('Content-Type: application/json');
require_once('../config/db.php');
$input = json_decode(file_get_contents("php://input"), true);
$email = $input['email'];
$password = $input['password'];
$stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if ($user && password_verify($password, $user['user_password'])) {
$_SESSION['user_logged_in'] = true;
$_SESSION['user_id'] = $user['id'];
echo json_encode(["status" => "success", "message" => "Login successful"]);
} else {
echo json_encode(["status" => "error", "message" => "Invalid credentials"]);
}
$stmt->close();
$conn->close();
?> 
