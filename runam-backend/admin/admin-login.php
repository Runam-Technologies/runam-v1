// auth/admin-login.php
<?php
session_start();
header('Content-Type: application/json');
require_once('../config/db.php');

$input = json_decode(file_get_contents("php://input"), true);
$email = $input['email'];
$password = $input['password'];

$stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];
                echo json_encode(["status" => "success", "message" => "Admin login successful"]);
} else {
        echo json_encode(["status" => "error", "message" => "Invalid credentials"]);
}
$stmt->close();
$conn->close();
?>
