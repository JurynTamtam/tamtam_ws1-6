<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<body>
<h2>
	<?php

	$contentTitle = isset($_POST['contentTitle']) ? $_POST['contentTitle'] : '';
	echo $contentTitle;

	?>
</h2>
<input type="text" id="myInput" onkeyup="searchin()" placeholder="Search..." title="Type in something">
<table id="myTable" class="table">
	<thead>
    <h4><br>2. List of all customers and its ordered products with its price and quantity from the country Sweden.</h4>
		<tr>
            <th onclick="sortTable(0)">Customer Name</th>
			<th onclick="sortTable(1)">Product Name</th>                          
			<th onclick="sortTable(2)">Quantity</th>
            <th onclick="sortTable(2)">Price</th>
		</tr>
	</thead>

	<tbody>
<?php
include 'connect.php';
$sql = "SELECT customers.CustomerName, products.ProductName, orderdetails.Quantity, products.Price
FROM customers
JOIN orders ON customers.CustomerID = orders.CustomerID
JOIN orderdetails ON orders.OrderID = orderdetails.OrderID
JOIN products ON orderdetails.ProductID = products.ProductID
WHERE customers.Country = 'Sweden'";
$all_sql = $con->query($sql);
	while($row = mysqli_fetch_array($all_sql)){
?>
		<tr>
        	<td><?php echo $row["CustomerName"]; ?></td>
			<td><?php echo $row["ProductName"]; ?></td>
			<td><?php echo $row["Quantity"]; ?></td>  
            <td><?php echo $row["Price"]; ?></td>    
		</tr>
<?php 
	}
?>
	</tbody>
</table>
</body>
</html>
