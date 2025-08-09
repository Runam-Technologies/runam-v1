// user/update-profile.php
<?php
session_start();
header('Content-Type: application/json');
require_once('../config/db.php');
if (!isset($_SESSION['user_logged_in'])) {
echo json_encode(["status" => "error", "message" => "Unauthorized"]);
exit;
}
$input = json_decode(file_get_contents("php://input"), true);
$fullname = $input['full_name'];
$location = $input['location'];
$phone = $input['phone'];
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("UPDATE users SET user_fullname = ?, user_location = ?, user_phone
= ? WHERE id = ?");
$stmt->bind_param("sssi", $fullname, $location, $phone, $user_id);
$stmt->execute();
echo json_encode(["status" => "success", "message" => "Profile updated"]);
?>