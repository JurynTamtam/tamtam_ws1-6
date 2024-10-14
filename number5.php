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
<h2>
	<?php

	$contentTitle = isset($_POST['contentTitle']) ? $_POST['contentTitle'] : '';
	echo $contentTitle;

	?>
</h2>
<input type="text" id="myInput" onkeyup="searchin()" placeholder="Search..." title="Type in something">
<table id="myTable" class="table">
	<thead>
        <h4><br>5. Identify the customers who have not placed any orders.</h4>
		<tr>
            <th onclick="sortTable(1)">Customer ID</th>
			<th onclick="sortTable(1)">Customer Name</th>
		</tr>
	</thead>

	<tbody>
<?php
include 'connect.php';
$sql = "SELECT customers.CustomerID, customers.CustomerName
    FROM customers
    LEFT JOIN orders ON customers.CustomerID = orders.CustomerID
    WHERE orders.OrderID IS NULL";
$all_sql = $con->query($sql);
	while($row = mysqli_fetch_array($all_sql)){
?>
		<tr>
            <td><?php echo $row["CustomerID"]; ?></td> 
			<td><?php echo $row["CustomerName"]; ?></td> 
		</tr>
<?php 
	}
?>
	<tbody>
</table>
</body>
</html>