
// admin/orders.php
<?php
session_start();
header('Content-Type: application/json');
require_once('../config/db.php');

$result = $conn->query("SELECT * FROM orders ORDER BY id DESC");
$orders = [];
while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
}
echo json_encode(["status" => "success", "orders" => $orders]);
?>