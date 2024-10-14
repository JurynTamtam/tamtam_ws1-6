<!DOCTYPE html>
<html>
<head>
<title>WS_1.4_juryn</title>
	  <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

</head>
<style>
        body {
          font-family: 'Times New Roman', Times, serif, sans-serif;
            background-color: #f3f4f6;
           
            color: #333;
            
            font-family: 'Times New Roman', Times, serif, sans-serif;

        }

        .container {
            margin-top: 0px;
        }

        h3 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1rem;
        }

        a {
            font-size: 1.2rem;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        hr {
            margin: 10px 0;
        }
    </style>
<body>


<div class="container mt-3">
<h2>Top Customers with Highest Ordered Products</h2>
<?php

include 'connect.php';
 
//-----------------------------------------------------------------------------------------  
  // SQL query to get top 10 customers with the highest ordered products
  $sqlCustomers = "SELECT CustomerName, COUNT(orders.CustomerID) AS noOfOrders 
  FROM customers 
  INNER JOIN orders ON customers.CustomerID = orders.CustomerID 
  GROUP BY customers.CustomerID 
  ORDER BY noOfOrders DESC 
  LIMIT 10";

$resultCustomers = $con->query($sqlCustomers);

// Initialize arrays to hold data for the chart
$customerNames = [];
$noOfOrders = [];
$barColors = []; // Array to hold colors for each bar

// Function to generate a random color
function randomColor() {
return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

// Check if results are returned
if ($resultCustomers->num_rows > 0) {
// Start the customer table
echo "<table class='table table-bordered'>";
echo "<thead>";
echo "<tr>";
echo "<th>Customer Name</th>";
echo "<th>No. of Orders</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

// Fetch and display each row
while ($row = $resultCustomers->fetch_assoc()) {
echo "<tr>";
echo "<td>" . htmlspecialchars($row['CustomerName']) . "</td>";
echo "<td>" . htmlspecialchars($row['noOfOrders']) . "</td>";
echo "</tr>";

// Store the data for the chart
$customerNames[] = $row['CustomerName'];
$noOfOrders[] = $row['noOfOrders'];
$barColors[] = randomColor(); // Assign a random color for each bar
}

// End the customer table
echo "</tbody>";
echo "</table>";
} else {
echo "<p>No results found.</p>";
}

// Canvas element for Customer Chart
echo "<canvas id='topCustomersChart' width='400' height='200'></canvas>";

// SQL query to get top 10 products with the most orders
$sqlProducts = "SELECT p.productID, p.productname, COUNT(od.orderID) AS total_orders
 FROM products p
 JOIN orderdetails od ON p.productID = od.productID
 JOIN orders o ON od.orderID = o.orderID
 GROUP BY p.productID, p.productname
 ORDER BY total_orders DESC
 LIMIT 10";

$resultProducts = $con->query($sqlProducts);

// Initialize arrays to hold data for the products chart
$productNames = [];
$totalOrders = [];
$productBarColors = []; // Array to hold colors for each product bar

// Check if results are returned
if ($resultProducts->num_rows > 0) {
// Start the product table
echo "<h2 class='mt-5'>Top 10 Products with Most Orders</h2>";
echo "<table class='table table-bordered'>";
echo "<thead>";
echo "<tr>";
echo "<th>Product ID</th>";
echo "<th>Product Name</th>";
echo "<th>Total Orders</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

// Fetch product data for chart and table
while ($row = $resultProducts->fetch_assoc()) {
echo "<tr>";
echo "<td>" . htmlspecialchars($row['productID']) . "</td>";
echo "<td>" . htmlspecialchars($row['productname']) . "</td>";
echo "<td>" . htmlspecialchars($row['total_orders']) . "</td>";
echo "</tr>";

// Store product data for the chart
$productNames[] = $row['productname'];
$totalOrders[] = $row['total_orders'];
$productBarColors[] = randomColor(); // Assign a random color for each product bar
}

// End the product table
echo "</tbody>";
echo "</table>";
} else {
echo "<p>No product results found.</p>";
}

// Canvas element for Product Chart
echo "<canvas id='myBarChart' width='400' height='200' class='mt-5'></canvas>";

// SQL query to get the percentage of orders per year
$sqlPercentage = "SELECT  
     YEAR(OrderDate) AS year,
     COUNT(OrderID) AS total_orders,
     (COUNT(OrderID) / (SELECT COUNT(*) FROM orders) * 100) AS order_percentage
   FROM 
     orders
   GROUP BY 
     YEAR(OrderDate)
   ORDER BY 
     year";

$resultPercentage = $con->query($sqlPercentage);

// Initialize arrays to hold data for the percentage chart
$years = [];
$orderPercentages = [];
$orderBarColors = []; // Array to hold colors for each percentage bar

// Check if results are returned
if ($resultPercentage->num_rows > 0) {
// Start the order percentage table
echo "<h2 class='mt-5'>Order Percentage Per Year</h2>";
echo "<table class='table table-bordered'>";
echo "<thead>";
echo "<tr>";
echo "<th>Year</th>";
echo "<th>Total Orders</th>";
echo "<th>Order Percentage</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

// Fetch data for the chart
while ($row = $resultPercentage->fetch_assoc()) {
$years[] = $row['year'];
$orderPercentages[] = $row['order_percentage'];
$orderBarColors[] = randomColor(); // Assign a random color for each bar

// Display order percentage data
echo "<tr>";
echo "<td>" . htmlspecialchars($row['year']) . "</td>";
echo "<td>" . htmlspecialchars($row['total_orders']) . "</td>";
echo "<td>" . htmlspecialchars(number_format($row['order_percentage'], 2)) . "%</td>";
echo "</tr>";
}

// End the order percentage table
echo "</tbody>";
echo "</table>";
} else {
echo "<p>No results found for order percentages.</p>";
}

// Canvas element for Order Percentage Chart
echo "<canvas id='orderPercentageChart' width='400' height='200' class='mt-5'></canvas>";

// Close the database connection
$con->close();
?>

<script>
// Prepare data for the pie chart (top customers)
const customerNames = <?php echo json_encode($customerNames); ?>;
const noOfOrders = <?php echo json_encode($noOfOrders); ?>;
const barColors = <?php echo json_encode($barColors); ?>; // Send colors to JavaScript

// Create the pie chart for top customers
const ctxCustomers = document.getElementById('topCustomersChart').getContext('2d');
const myCustomersPieChart = new Chart(ctxCustomers, {
  type: 'bar', // Change chart type to 'pie'
  data: {
    labels: customerNames, // x-axis labels will be customer names
    datasets: [{
      label: 'Number of Orders',
      data: noOfOrders, // y-axis data for number of orders
      backgroundColor: barColors, // Use the array of colors for the pie slices
      borderColor: '#ffffff', // Optional: white border between slices
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        display: true,
        position: 'top',
      },
      title: {
        display: true,
        text: 'Top Customers with Highest Ordered Products (Pie Chart)'
      }
    }
  }
});


// Prepare data for the pie chart (top products)
const productNames = <?php echo json_encode($productNames); ?>;
const totalOrders = <?php echo json_encode($totalOrders); ?>;
const productBarColors = <?php echo json_encode($productBarColors); ?>; // Send colors to JavaScript

// Create the pie chart for top products
const ctxProducts = document.getElementById('myBarChart').getContext('2d');
const myProductsPieChart = new Chart(ctxProducts, {
  type: 'bar', // Change chart type to 'pie'
  data: {
    labels: productNames, // x-axis labels will be product names
    datasets: [{
      label: 'Total Orders',
      data: totalOrders, // y-axis data for total orders
      backgroundColor: productBarColors, // Use the array of colors for the pie slices
      borderColor: '#ffffff', // Optional: white border between slices
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        display: true,
        position: 'top',
      },
      title: {
        display: true,
        text: 'Top 10 Products with Most Orders (Pie Chart)'
      }
    }
  }
});


// Prepare data for the pie chart (order percentages)
const years = <?php echo json_encode($years); ?>;
const orderPercentages = <?php echo json_encode($orderPercentages); ?>;
const orderBarColors = <?php echo json_encode($orderBarColors); ?>; // Send colors to JavaScript

// Create the pie chart
const ctxOrders = document.getElementById('orderPercentageChart').getContext('2d');
const myOrderPercentagePieChart = new Chart(ctxOrders, {
  type: 'pie', // Change chart type to 'pie'
  data: {
    labels: years, // Labels will show the years
    datasets: [{
      label: 'Order Percentage (%)',
      data: orderPercentages, // y-axis data
      backgroundColor: orderBarColors, // Use the array of colors for the slices
      borderColor: '#ffffff', // Optional: white border between slices
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        display: true,
        position: 'top',
      },
      title: {
        display: true,
        text: 'Order Percentage Per Year (Pie Chart)'
      }
    }
  }
});

</script>
</div>
</body>
</html>