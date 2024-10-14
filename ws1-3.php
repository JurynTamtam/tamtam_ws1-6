<!DOCTYPE html>
<html lang="en">
<head>
  <title>WS_1.3_juryn</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  <button id="n1" type="button" class="btn btn-secondary">Number1</button>
  <button id="n2" type="button" class="btn btn-secondary">Number2</button>
  <button id="n3" type="button" class="btn btn-secondary">Number3</button>
  <button id="n4" type="button" class="btn btn-secondary">Number4</button>
  <button id="n5" type="button" class="btn btn-secondary">Number5</button>
  
  <label for="select">Choose:</label>
  <select id="nums" name="nums">
    <option selected>Select option</option>
    <option value="n1">Number1</option>
    <option value="n2">Number2</option>
    <option value="n3">Number3</option>
    <option value="n4">Number4</option>
    <option value="n5">Number5</option>
  </select>

  <section id="load-here"></section>  
</div>

<script type="text/javascript">
  var but3 = document.getElementById('n1');
  var but4 = document.getElementById('n2');
  var but5 = document.getElementById('n3');
  var but6 = document.getElementById('n4');
  var but7 = document.getElementById('n5');
  var butnums = document.getElementById('nums');


   // Event listener for Products button
   but3.addEventListener('click', function() {
    var contentTitle = "";
    fetch('number1.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: 'contentTitle=' + encodeURIComponent(contentTitle),
    })
    .then(response => response.text())
    .then(data => {
      document.getElementById('load-here').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
  });

  // Event listener for Products button
  but4.addEventListener('click', function() {
    var contentTitle = "";
    fetch('number2.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: 'contentTitle=' + encodeURIComponent(contentTitle),
    })
    .then(response => response.text())
    .then(data => {
      document.getElementById('load-here').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
  });

  // Event listener for Products button
  but5.addEventListener('click', function() {
    var contentTitle = "";
    fetch('number3.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: 'contentTitle=' + encodeURIComponent(contentTitle),
    })
    .then(response => response.text())
    .then(data => {
      document.getElementById('load-here').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
  });

  // Event listener for Products button
  but6.addEventListener('click', function() {
    var contentTitle = "";
    fetch('number4.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: 'contentTitle=' + encodeURIComponent(contentTitle),
    })
    .then(response => response.text())
    .then(data => {
      document.getElementById('load-here').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
  });

    // Event listener for Products button
    but7.addEventListener('click', function() {
    var contentTitle = "";
    fetch('number5.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: 'contentTitle=' + encodeURIComponent(contentTitle),
    })
    .then(response => response.text())
    .then(data => {
      document.getElementById('load-here').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
  });

  // Event listener for the select dropdown
  butnums.addEventListener('change', function() {
    var contentTitle = "";
    var nums = butnums.value;
    var dafile = "";

    // Determine file and title based on selection
    if (nums === "n1") {
      contentTitle = "Number 1";
      dafile = "number1.php";
    } else if (nums === "n2") {
      contentTitle = "Number 2";
      dafile = "number2.php";
    } else if (nums === "n3") {
      contentTitle = "Number 3";
      dafile = "number3.php";
    } else if (nums === "n4") {
      contentTitle = "Number 4";
      dafile = "number4.php";
    } else if (nums === "n5") {
      contentTitle = "Number 5";
      dafile = "number5.php";
    }

    if (dafile !== "") {
      fetch(dafile, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'contentTitle=' + encodeURIComponent(contentTitle),
      })
      .then(response => response.text())
      .then(data => {
        document.getElementById('load-here').innerHTML = data;
      })
      .catch(error => console.error('Error:', error));
    }
  });
</script>


</script>
<script type="text/javascript">

function searchin() {
var searchInput = document.getElementById('myInput');
  var table = document.getElementById('myTable');
  var rows = table.getElementsByTagName('tr');

  searchInput.addEventListener('input', function() {
    var filter = searchInput.value.toLowerCase();

    for (var i = 1; i < rows.length; i++) {
      var row = rows[i];
      var cells = row.getElementsByTagName('td');
      var shouldHide = true;

      for (var j = 0; j < cells.length; j++) {
        var cell = cells[j];
        if (cell.textContent.toLowerCase().indexOf(filter) > -1) {
          shouldHide = false;
          break;
        }
      }

      row.style.display = shouldHide ? 'none' : '';
    }
  });

}


</script>
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
</body>
</html>
