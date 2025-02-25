<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    <title>Manager Order Report and Order Update Page</title>
</head>
<body>
    <h1>Manager Order Report and Order Update Page</h1>

    <!-- order form -->
    <form action="manager.php" method="post">
      <label for="query_type">Select a query:</label>
      <select name="query_type">
        <option value="all_orders">All orders</option>
        <option value="customer_orders">Orders for a customer</option>
        <option value="product_orders">Orders for a particular product</option>
        <option value="pending_orders">Orders that are pending</option>
        <option value="cost_orders">Orders sorted by total cost</option>
      </select>
      <input type="submit" value="Submit">
    </form>

<?php
//connecting to database
$host = "feenix-mariadb.swin.edu.au";
$user = "s104225904";
$pwd = "200304";
$sql_db = "myDB";

$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// initialize $orders variable
    $orders = [];

// check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the selected query type
  $query_type = $_POST['query_type'];

  // construct the SQL query based on the selected query type
  $sql_query = '';
  switch ($query_type) {
    case 'all_orders':
      $sql_query = 'SELECT * FROM orders';
      break;
    case 'customer_orders':

      // assume the customer name
      $customer_name = $_POST['customer_name'];
      $sql_query = "SELECT * FROM orders WHERE customer_name LIKE '%$customer_name%'";
      break;

      case 'product_orders':

    $Option = $_POST['Product'];
    $sql_query = "SELECT * FROM orders WHERE product_name LIKE '%$Product%'";

    case 'product_orders':

      // assume the product name 
      $Quantity = $_POST['Quantity'];
      $sql_query = "SELECT * FROM orders WHERE product_name LIKE '%$Quantity%'";
      break;

	  case 'product_orders':

	  $Option = $_POST['Option'];
	  $sql_query = "SELECT * FROM orders WHERE product_name LIKE '%$Option%'";

    case 'product_orders':

    $Option = $_POST['num_week'];
    $sql_query = "SELECT * FROM orders WHERE product_name LIKE '%$num_week%'";

    
    case 'pending_orders':
      $sql_query = 'SELECT * FROM orders WHERE order_status = "pending"';
      break;
    case 'cost_orders':
      $sql_query = 'SELECT * FROM orders ORDER BY total_cost DESC';
      break;
    default:
      echo 'Invalid query type';
      exit;
  }
}
  $order_id = $_GET['order_id'];

// Query the database to get the current order status
$sql = "SELECT order_status FROM orders WHERE order_id = '$order_id'";
$result = mysqli_query($conn, $sql);
$order = mysqli_fetch_assoc($result);

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Update the order status in the database
  $new_status = $_POST['order_status'];
  $sql = "UPDATE orders SET order_status = '$new_status' WHERE order_id = '$order_id'";
  mysqli_query($conn, $sql);
	
  $results = mysqli_query($conn, $sql_query);
  $orders = mysqli_fetch_all($results, MYSQLI_ASSOC);

  $order_id = $_GET['order_id'];

  // Verify that the order is still pending (i.e. it can be cancelled)
  $order_status = $db->query("SELECT order_status FROM orders WHERE order_id = '$order_id'")->fetchColumn();
  if ($order_status != 'pending') {
  // If the order is not pending, redirect back to the manager page
  header("Location: manager.php");
  exit;
  }

  // Delete the order from the database
  $sql->query("DELETE FROM orders WHERE order_id = '$order_id'");
}
?>

<!-- order table -->
    <table>
      <thead>
        <tr>
          <th>Order number</th>
          <th>Order date</th>
          <th>Product</th>
          <th>Option</th>
          <th>Product details</th>
          <th>Customer name</th>
          <th>Order status</th>
          <th>Update status</th>
          <th>Cancel order</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($orders as $order): ?>
          <tr>
            <td><?= $order['order_number'] ?></td>
            <td><?= $order['order_date'] ?></td>
            <td><?= $order['Product'] ?></td>
            <td><?= $order['Option'] ?></td>
            <td><?= $order['Quantity'] ?> (<?= $order['num_week'] ?>)</td>
            <td><?= $order['customer_first_name'] ?> <?= $order['customer_last_name'] ?></td>
            <td><form method="post">
            <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
            <select name="order_status" id="order_status" onchange="this.form.submit()">
              <option value="pending" <?= $order['order_status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
              <option value="fulfilled" <?= $order['order_status'] === 'fulfilled' ? 'selected' : '' ?>>Fulfilled</option>
              <option value="paid" <?= $order['order_status'] === 'paid' ? 'selected' : '' ?>>Paid</option>
              <option value="archived" <?= $order['order_status'] === 'archived' ? 'selected' : '' ?>>Archived</option>
            </select>
          </form></td>
            <th bgcolor="#1CFF00"><button name="update_order" value="<?= $order['order_id'] ?>" type="submit" style="color: #288C05">Update Status</button></th>
            <?php if ($order['order_status'] === 'pending'): ?>
            <th bgcolor="#FF0004"><button name="cancel_order" value="<?= $order['order_id'] ?>" type="submit" style="color: #FF0004">Cancel Order</button></th>
            <?php else: ?>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>


</body>
</html>
