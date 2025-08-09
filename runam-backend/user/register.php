// user/register.php
<?php
header('Content-Type: application/json');
require_once('../config/db.php');

$input = json_decode(file_get_contents("php://input"), true);
if (empty($input['full_name']) || empty($input['location']) || empty($input['phone']) ||
empty($input['email']) || empty($input['password'])) {
echo json_encode(["status" => "error", "message" => "All fields are required"]);
exit;
}
$full_name = $input['full_name'];
$location = $input['location'];
$phone = $input['phone'];
$email = $input['email'];
$password = password_hash($input['password'], PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (user_fullname, user_location, user_phone,
user_email, user_password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $full_name, $location, $phone, $email, $password);
$stmt->execute();
if ($stmt->affected_rows > 0) {
echo json_encode(["status" => "success", "message" => "User registered successfully"]);
} else {
echo json_encode(["status" => "error", "message" => "Registration failed"]);
}
$stmt->close();
$conn->close();
?>