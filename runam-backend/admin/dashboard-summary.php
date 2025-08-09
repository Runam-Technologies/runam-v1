// admin/dashboard-summary.php
<?php
session_start();
header('Content-Type: application/json');
require_once('../config/db.php');

$total_users = $conn->query("SELECT COUNT(*) AS total FROM user")->fetch_assoc()['total'];
$total_orders = $conn->query("SELECT COUNT(*) AS total FROM orders")->fetch_assoc()['total'];
pending = $conn->query("SELECT COUNT(*) AS total FROM orders WHERE status = 'pending'")->fetch_assoc()['total'];
approved = $conn->query("SELECT COUNT(*) AS total FROM orders WHERE status = 'approved'")->fetch_assoc()['total'];
$completed = $conn->query("SELECT COUNT(*) AS total FROM orders WHERE status = 'completed'")->fetch_assoc()['total'];

echo json_encode([
        "status" => "success",
            "data" => compact("total_users", "total_orders", "pending", "approved", "completed")
]);
?>
