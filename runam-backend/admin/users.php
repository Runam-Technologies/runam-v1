
// admin/users.php
<?php
session_start();
header('Content-Type: application/json');
require_once('../config/db.php');

$result = $conn->query("SELECT id, user_fullname, user_email, user_phone, user_location FROM user");
$users = [];
while ($row = $result->fetch_assoc()) {
        $users[] = $row;
}
echo json_encode(["status" => "success", "users" => $users]);
?>