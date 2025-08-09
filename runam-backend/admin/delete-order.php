// admin/delete-order.php
<?php
session_start();
header('Content-Type: application/json');
require_once('../config/db.php');

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
echo json_encode(["status" => "success", "message" => "Order deleted"]);
?>