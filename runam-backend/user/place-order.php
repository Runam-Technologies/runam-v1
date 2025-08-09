// user/place-order.php
<?php
session_start();
header('Content-Type: application/json');
require_once('../config/db.php');
if (!isset($_SESSION['user_logged_in'])) {
echo json_encode(["status" => "error", "message" => "Unauthorized"]);
exit;
}
$input = json_decode(file_get_contents("php://input"), true);
$order_description = $input['order_description'];
$pickup_location = $input['pickup_location'];
$delivery_location = $input['delivery_location'];
$preferred_time_of_delivery = $input['preferred_time_of_delivery'];
$order_status = "pending";
$user_id = "2";
$stmt = $conn->prepare("INSERT INTO orders (user_id, order_description, pickup_location, delivery_location, preferred_time_of_delivery, order_status) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssss", $user_id, $order_description, $pickup_location, $delivery_location, $preferred_time_of_delivery, $order_status);
$stmt->execute();
echo json_encode(["status" => "success", "message" => "Order placed"]);
?>