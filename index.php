<!DOCTYPE html>
<html lang="en">
<head>
    <title>WORKSHEETS</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

    <style>
      body {
      background-color: #f5f5f5;
      font-family: 'Times New Roman', Times, serif, sans-serif;
      }

  .header {
    background-color: #032342;
    color: white;
    padding: 15px 0;
  }
      
  /* Modern Header Styling */
  .header h1 {
      font-size: 2.8rem;
      font-weight: 700;
  }

  .header p {
      font-size: 1.2rem;
      margin: 0;
  }

  /* Modern Footer Styling */
  .footer {
      background-color: #1b5fa3;
      color: white;
      text-align: center;
      padding: 20px;
      margin-top: 40px;
      border-radius: 25px 25px 0 0;
      box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
      font-size: 1rem;
      font-weight: 500;
  }

  /* Card and Button Styling */
  .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
     
      padding: 20px;
  }

  .btn {
      font-size: 1rem;
      background-color: #3b536b;
      color: white;
      margin: 10px 0;
      padding: 10px;
      width: 100%;
      border-radius: 10px;
      transition: background-color 0.3s ease;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  }

  .btn:hover {
      background-color:light;
  }

  #load-here {
      min-height: 250px;
  }

  .spinner-border {
      width: 3rem;
      height: 3rem;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
      .header h1 {
          font-size: 2rem;
      }

      .btn {
          font-size: 0.9rem;
      }
  }

    </style>

</head>
<body>

    <!-- Header Section -->
    <div class="header">
    <h2 class="text-center my-2" >Advance Web Development: Back-end</h2>
    <p class="text-center" >Juryn T. Tamtam</p>
    <p class="text-center">BSIT 4</p>
      
    </div>

    <div class="container mt-5">
        <div class="row">
            <!-- Sidebar Worksheet Buttons -->
            <div class="col-md-2">
                <div class="d-grid gap-3">
                    <button id="b1" class="btn">Worksheet 1.1</button>
                    <button id="b2" class="btn">Worksheet 1.3</button>
                    <button id="b3" class="btn">Worksheet 1.4</button>
                    <button id="b4" class="btn">Worksheet 1.5</button>
                </div>
            </div>

            <!-- Content Section -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <section id="load-here" class="mt-3">
                            <h3>Worksheet 1.1 Landing Page</h3>
                            <p>Place a link here to load the page to a new tab (applicable only for worksheet 1.1)</p>
                            <hr>
                            <p><a href="https://bsit3rdyear.org/fourth_year/ws_1-3/tamtam_ws1-3/Tamtam-ws1-1/index.html" target="_blank">Worksheet 1.1</a></p>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

    <!-- Footer Section -->
    <div class="footer">
       <p>Submitted to: Jim-mar Delos Reyes </p>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            var spinner = $('#spinner');
            var errorMessage = $('#error-message');
            var currentWorksheet = '';

            function showSpinner() {
                spinner.show();
            }

            function hideSpinner() {
                spinner.hide();
            }

            function showError(message) {
                errorMessage.text(message).show();
            }

            function hideError() {
                errorMessage.hide();
            }

            // Fetch data using POST request and load it in the page
            function fetchData(dafile, search = '', entries = 5, page = 1) {
                currentWorksheet = dafile; 
                hideError();
                showSpinner();

                $.ajax({
                    url: dafile,
                    type: 'POST',
                    data: { search: search, entries: entries, page: page },
                    success: function(data) {
                        hideSpinner();
                        $('#load-here').html(data);
                    },
                    error: function(error) {
                        hideSpinner();
                        showError('An error occurred');
                    }
                });
            }

            // Event listeners for button clicks to load the respective worksheet PHP file
            $('#b1').on('click', function() {
                fetchData('ws1-1.html');
            });

            $('#b2').on('click', function() {
                fetchData('ws1-3.php');
            });

            $('#b3').on('click', function() {
                fetchData('ws1-4.php');
            });

            $('#b4').on('click', function() {
                fetchData('ws1-5.php');
            });
        });
    </script>
</body>
</html>
