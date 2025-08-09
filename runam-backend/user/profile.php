// user/profile.php
<?php
session_start();
header('Content-Type: application/json');
require_once('../config/db.php');
if (!isset($_SESSION['user_logged_in'])) {
echo json_encode(["status" => "error", "message" => "Unauthorized"]);
exit;
}
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT user_fullname, user_email, user_location, user_phone
FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
echo json_encode(["status" => "success", "profile" => $user]);
?>
