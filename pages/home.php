<?php
  include '../Model/connecttion.php';
                $sql = "SELECT Branch, COUNT(Branch) as `Count` FROM `add_employee` GROUP BY `Branch`;";
                $result = $conn->query($sql);
                $arr_postition = "";
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                      $arr_postition .=  "['{$row["Branch"]}', {$row["Count"]}],";          
                    }
                } else {
                    echo "0 results";
                }
                ?>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Payroll Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="../styles/home.css" rel="stylesheet" />
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Position', 'All Positions'],
          <?php echo $arr_postition?>
        ]);

        var options = {
          title: 'Positions'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
</head>

<body>
  <nav class="navbar sticky-top navbar-expand-sm">
    <div class="container-fluid">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="../pages/home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="../pages/addEmployee.php">Add Employee</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="../pages/employeeReport.php">Employee Report</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="../pages/generateSalary.php">Salary Report</a>
        </li>
      </ul>
    </div>
    <!-- <button id="btn_signout" class="button-82-pushable">
      <span class="button-82-shadow"></span>
      <span class="button-82-edge"></span>
      <span class="button-82-front text"> Sign Out </span>
    </button> -->
  </nav>
  <?php
  include '../Model/connecttion.php';
  $sql = "SELECT * FROM  `add_employee` ";
  $result = $conn->query($sql);
  $numberOfRow =  $result->num_rows;
  $sum = "SELECT SUM(basicSalary) AS sum FROM `add_employee`";
  $resultOfSum = $conn->query($sum);
  
  while($row = mysqli_fetch_assoc($resultOfSum)){
    $output = $row['sum'];
  }

  ?>

  <div id="content" style="height: 88%; ">
    <div class="row">
      <div class="col">
        <div class="row"style="margin: auto; width:48%">
          <div class="rounded-con">
            <h4>Total Employees</h4>
            <p>The company has <?php echo $numberOfRow ?> employees in <?php echo date('Y') ?>.</p>
          </div>
          <div class="rounded-con">
            <h4>Total BasicSalary</h4>
            <p>The company has <?php echo $output ?> $ has pay for basic salary </p>
          </div>
        </div>
        <!-- <div class="row-con">
          <div class="rounded-con con-100">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>N.O</th>
                  <th>Department</th>
                  <th>Employee</th>
                  <th>internships</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Web Development</td>
                  <td>25</td>
                  <td>10</td>
                  <td>35</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Mobile Development</td>
                  <td>25</td>
                  <td>10</td>
                  <td>35</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Computer Network</td>
                  <td>25</td>
                  <td>5</td>
                  <td>30</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Desktop Development</td>
                  <td>25</td>
                  <td>5</td>
                  <td>30</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div> -->
        <!-- <div class="row-con">
          <div class="rounded-con con-100">
            <h4>Profit</h4>
            <p>This year</p>
            <p id="profit">$5M</p>
          </div>
          <div class="rounded-con con-100">
            <h4>Expense</h4>
            <p>This year</p>
            <p id="expense">$2M</p>
          </div>
        </div> -->
        <div id="piechart" class="shadow-lg" style="width: 100%; height: 500px; margin: auto"></div>
      </div>
      <!-- <div id="chart" class="rounded-con con-100"></div> -->
      
  
    </div>
  </div>
  
</body>

</html>