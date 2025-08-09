//auth/forgot-password.php
<?php
header('Content-Type: application/json');
require_once('../config/db.php');

$input = json_decode(file_get_contents("php://input"), true);
$email = $input['email'];
$new_password = password_hash($input['new_password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE users SET user_pasword =? WHERE user_email=?");
$stmt->bind_param("ss", $new_password, $email);

if ($stmt->execute) {
    echo json_encodea(["status"=>"success", "message"=>"password reset successful"]);
}
 else {
    echo json_encode(["status"=>"error", "message"=>"failed to reset password"]);
 }
 $stmt->close();
 $conn->close();
 ?>