// admin/update-order-status.php
<?php
session_start();
header('Content-Type: application/json');
require_once('../config/db.php');

$data = json_decode(file_get_contents("php://input"), true);
$order_id = $data['order_id'];
$status = $data['status'];

$stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
$stmt->bind_param("si", $status, $order_id);
$stmt->execute();
echo json_encode(["status" => "success", "message" => "Order status updated"]);
?>