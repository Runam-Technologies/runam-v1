
// user/order-history.php
<?php
session_start();
header('Content-Type: application/json');
require_once('../config/db.php');

if (!isset($_SESSION['user_logged_in'])) {
        echo json_encode(["status" => "error", "message" => "Unauthorized"]);
           
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM orders WHERE user_id = $user_id ORDER BY id DESC");
$orders = [];
while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
}

echo json_encode(["status" => "success", "orders" => $orders]);
?>

