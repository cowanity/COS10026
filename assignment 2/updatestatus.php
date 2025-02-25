
<?php
// Get the order ID from the URL parameter
$order_id = $_GET['order_id'];

// Query the database to get the current order status
$sql = "SELECT order_status FROM orders WHERE order_id = $order_id";
$result = mysqli_query($conn, $sql);
$order = mysqli_fetch_assoc($result);

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Update the order status in the database
  $new_status = $_POST['order_status'];
  $sql = "UPDATE orders SET order_status = '$new_status' WHERE order_id = $order_id";
  mysqli_query($conn, $sql);
  
  // Redirect back to the Manager page
  header('Location: manager.php');
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Update Order Status</title>
</head>
<body>
  <h1>Update Order Status</h1>
  <form method="post">
    <label for="order_status">Current Status: <?= $order['order_status'] ?></label>
    <select name="order_status" id="order_status">
      <option value="pending">Pending</option>
      <option value="fulfilled">Fulfilled</option>
      <option value="paid">Paid</option>
      <option value="archived">Archived</option>
    </select>
    <button type="submit">Update Status</button>
  </form>
</body>
</html>