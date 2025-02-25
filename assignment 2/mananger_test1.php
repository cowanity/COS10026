<!DOCTYPE html>

<?php
//connecting to database
$servername = "localhost";
$username = "username";
$pwd = "password";
$dbname = "myDB";

$conn = @mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT orders.order_number, orders.order_date, products.product_name, products.product_cost, customers.first_name, customers.last_name, orders.order_status 
        FROM orders
        JOIN customers ON orders.customer_id = customers.customer_id
        JOIN order_items ON orders.order_number = order_items.order_number
        JOIN products ON order_items.product_id = products.product_id";

$result = $conn->query($sql);
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    <title>Manager Order Report and Order Update Page</title>
</head>
<body>
    <h1>Manager Order Report and Order Update Page</h1>
    <form action="manager.php" method="post">
      <label for="query">Select a query:</label>
      <select name="query">
        <option value="all">All orders</option>
        <option value="customer">Orders for a customer</option>
        <option value="product">Orders for a particular product</option>
        <option value="pending">Orders that are pending</option>
        <option value="cost">Orders sorted by total cost</option>
      </select>
      <input type="submit" value="Submit">
    </form>


<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  // Get the selected query type
  $query_type = $_GET['query_type'];

  // Construct the SQL query based on the selected query type
  $sql_query = '';
  switch ($query_type) {
    case 'all_orders':
      $sql_query = 'SELECT * FROM orders';
      break;
    case 'customer_orders':
      // Assume the customer name is provided in the URL query string
      $customer_name = $_GET['customer_name'];
      $sql_query = "SELECT * FROM orders WHERE customer_name LIKE '%$customer_name%'";
      break;
    case 'product_orders':
      // Assume the product name is provided in the URL query string
      $product_name = $_GET['product_name'];
      $sql_query = "SELECT * FROM orders WHERE product_name LIKE '%$product_name%'";
      break;
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

  // Execute the SQL query and retrieve the results as an array of associative arrays
  $results = mysqli_query($db_connection, $sql_query);
  $orders = mysqli_fetch_all($results, MYSQLI_ASSOC);
}
?>