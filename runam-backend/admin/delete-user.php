// admin/delete-user.php
<?php
session_start();
header('Content-Type: application/json');
require_once('../config/db.php');

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
echo json_encode(["status" => "success", "message" => "User deleted"]);
?>
