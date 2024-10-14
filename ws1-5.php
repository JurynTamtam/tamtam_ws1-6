<!DOCTYPE html>
<html lang="en">
<head>
  <title>WS_1.5_juryn</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

</head>
<body>
<div class="container">
    <nav> <ul>
            <li><a id="scroll1" class="btn btn-primary">Num 1</a></li>
            <li><a id="scroll2" class="btn btn-primary">Num 2</a></li>
            <li><a id="scroll3" class="btn btn-primary">Num 3</a></li>
            <li><a id="scroll4" class="btn btn-primary">Num 4</a></li>
            <li><a id="scroll5" class="btn btn-primary">Num 5</a></li>
            </ul>
        </nav>
</div>


<div id="d1">

<!-- Existing Table -->
<table id="myTable" class="table">
	<thead>
    <h4><br>1. Retrieve the customer names and contact information of all customers who have placed an order.</h4>
		<nav> <ul>
<li><a id="exportBtn" class="btn btn-success mb-3">Export to Excel</a></li>
</ul>
</nav>
<hr>
<tr>
			<th onclick="sortTable(0)">Customer ID</th>
			<th onclick="sortTable(1)">Customer Name</th>                          
			<th onclick="sortTable(2)">Contact Name</th>
		</tr>
	</thead>

	<tbody>
    <?php
include 'connect.php';
$sql = "SELECT DISTINCT customers.CustomerID, customers.CustomerName, customers.ContactName 
FROM customers 
JOIN orders ON customers.CustomerID = orders.CustomerID";
$all_sql = $con->query($sql);
	while($row = mysqli_fetch_array($all_sql)){
?>
		<tr>
            <td><?php echo $row["CustomerID"]; ?></td>
			<td><?php echo $row["CustomerName"]; ?></td>
			<td><?php echo $row["ContactName"]; ?></td>                          
			
		</tr>
<?php 
	}
?>
    </tbody>
</table>

<script>
    document.getElementById('exportBtn').addEventListener('click', function() {
        var table = document.querySelector('table'); // Select the table to export
        var wb = XLSX.utils.table_to_book(table, {sheet: "Worksheet 1."});
        XLSX.writeFile(wb, "query1.xlsx");
    });
</script>
</div>

<div id="d2">


<table id="myTable" class="table">
	<thead>
    <h4><br>2. List of all customers and its ordered products with its price and quantity from the country Sweden.</h4>
		<!-- Export Button -->
<nav> <ul>
<li><a id="exportBtn" class="btn btn-success mb-3">Export to Excel</a></li>
</ul>
</nav>
<hr>
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
<script>
    document.getElementById('exportBtn').addEventListener('click', function() {
        var table = document.querySelector('table'); // Select the table to export
        var wb = XLSX.utils.table_to_book(table, {sheet: "Worksheet 1.4"});
        XLSX.writeFile(wb, "query2.xlsx");
    });
</script>
</div>

<div id="d3">

<table id="myTable" class="table">
	<thead>
        <h4><br>3. List of all customers that have ordered "Tofu" product.</h4>
		<nav> <ul>
<li><a id="exportBtn" class="btn btn-success mb-3">Export to Excel</a></li>
</ul>
</nav>
<hr>
    <tr>
			<th onclick="sortTable(0)">Customer ID</th>	
			<th onclick="sortTable(0)">Customer Name</th>
			<th onclick="sortTable(1)">Product Order</th>                          
		</tr>
	</thead>

	<tbody>
<?php
include 'connect.php';
$sql = "SELECT customers.CustomerID, customers.CustomerName, products.ProductName
FROM customers
JOIN orders ON customers.CustomerID = orders.CustomerID
JOIN orderdetails ON orders.OrderID = orderdetails.OrderID
JOIN products ON orderdetails.ProductID = products.ProductID
WHERE products.ProductName = 'Tofu'";
$all_sql = $con->query($sql);
	while($row = mysqli_fetch_array($all_sql)){
?>
		<tr>
			<td><?php echo $row["CustomerID"]; ?></td>	
            <td><?php echo $row["CustomerName"]; ?></td>
			<td><?php echo $row["ProductName"]; ?></td>                       
		</tr>
<?php 
	}
?>
	</tbody>
</table>
<script>
    document.getElementById('exportBtn').addEventListener('click', function() {
        var table = document.querySelector('table'); // Select the table to export
        var wb = XLSX.utils.table_to_book(table, {sheet: "Worksheet 1.4"});
        XLSX.writeFile(wb, "query2.xlsx");
    });
</script>
</div>



<div id="d4">


<table id="myTable" class="table">
	<thead>
        <h4><br>4. List of all products ordered by customers from Switzerland.</h4>
		<nav> <ul><li><a id="exportBtn" class="btn btn-success mb-3">Export to Excel</a></li></ul></nav>
<hr>

    <tr>
			<th onclick="sortTable(1)">Product ID</th>  
			<th onclick="sortTable(1)">Product Name</th>                         
		</tr>
	</thead>

	<tbody>
<?php
include 'connect.php';
$sql = "SELECT products.ProductID,  products.ProductName
FROM customers
JOIN orders ON customers.CustomerID = orders.CustomerID
JOIN orderdetails ON orders.OrderID = orderdetails.OrderID
JOIN products ON orderdetails.ProductID = products.ProductID
WHERE customers.Country = 'Switzerland'";
$all_sql = $con->query($sql);
	while($row = mysqli_fetch_array($all_sql)){
?>
		<tr>
			<td><?php echo $row["ProductID"]; ?></td> 
			<td><?php echo $row["ProductName"]; ?></td>                        
		</tr>
<?php 
	}
?>
	</tbody>
</table>
<script>
    document.getElementById('exportBtn').addEventListener('click', function() {
        var table = document.querySelector('table'); // Select the table to export
        var wb = XLSX.utils.table_to_book(table, {sheet: "Worksheet 1.4"});
        XLSX.writeFile(wb, "query2.xlsx");
    });
</script>
</div>

<div id="d5">


<table id="myTable" class="table">
	<thead>
        <h4><br>5. Identify the customers who have not placed any orders.</h4>
		<nav> <ul><li><a id="exportBtn" class="btn btn-success mb-3">Export to Excel</a></li></ul></nav>
<hr>
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

<script>
    document.getElementById('exportBtn').addEventListener('click', function() {
        var table = document.querySelector('table'); // Select the table to export
        var wb = XLSX.utils.table_to_book(table, {sheet: "Worksheet 1.4"});
        XLSX.writeFile(wb, "query2.xlsx");
    });
</script>
</div>


<script>
        document.getElementById('scroll1').addEventListener('click', function () {
            document.getElementById('d1').scrollIntoView({ behavior: 'smooth' });
        });
        document.getElementById('scroll2').addEventListener('click', function () {
            document.getElementById('d2').scrollIntoView({ behavior: 'smooth' });
        });
        document.getElementById('scroll3').addEventListener('click', function () {
            document.getElementById('d3').scrollIntoView({ behavior: 'smooth' });
        });
        document.getElementById('scroll4').addEventListener('click', function () {
            document.getElementById('d4').scrollIntoView({ behavior: 'smooth' });
        });
        document.getElementById('scroll5').addEventListener('click', function () {
            document.getElementById('d5').scrollIntoView({ behavior: 'smooth' });
        });
    </script>
</body>
</html>
