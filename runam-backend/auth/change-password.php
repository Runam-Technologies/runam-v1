
// auth/change-password.php
<?php
session_start();
header('Content-Type: application/json');
require_once('../config/db.php');

if (!isset($_SESSION['user_logged_in'])) {
    echo json_encode(["status" => "error", "message" => "Unauthorized"]);
    exit;
}

$input = json_decode(file_get_contents("php://input"), true);
$current = $input['current_password'];
$new = password_hash($input['new_password'], PASSWORD_DEFAULT);
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT user_password FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (password_verify($current, $user['user_password'])) {
        $update = $conn->prepare("UPDATE users SET user_password = ? WHERE id = ?");
        $update->bind_param("si", $new, $user_id);
        $update->execute();
        echo json_encode(["status" => "success", "message" => "Password changed"]);
} else {
            echo json_encode(["status" => "error", "message" => "Incorrect current password"]);
}
?>