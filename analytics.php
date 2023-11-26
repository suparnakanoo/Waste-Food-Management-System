<?php
  require("adminPanelConnection.php");
?>
<!DOCTYPE HTML>
<html>
<head> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="analytics.css?v=<?php echo time() ?>"> 
<script>
window.onload = function () {
    <?php
        $sql = "SELECT Hostel_Name, SUM(Waste_Food_Amount) AS Total_Waste 
                FROM food_details 
                GROUP BY Hostel_Name";
        $result = $con->query($sql);

        if ($result && $result->num_rows > 0) {
        $dataPoints = [];
        while ($row = $result->fetch_assoc()) {
            $dataPoints[] = [
                'label' => $row['Hostel_Name'],
                'y' => $row['Total_Waste']
            ];
        }
        
    ?>
        var chart = new CanvasJS.Chart("chartContainer1", {
            animationEnabled: true,
            exportEnabled: true,
            title:{
                text: "Proportion of waste food generated from each hostel"
            },
            subtitles: [{
                text: "kg is used as unit of measurement"
            }],
            data: [{
                type: "pie",
                showInLegend: true,
                legendText: "{label}",
                indexLabelFontSize: 16,
                indexLabel: "{label} - #percent%",
                yValueFormatString: "฿#,##0",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
        <?php
    } else {
        // Handle case where no data is available
        ?>
        console.log("No data available for chart rendering.");
        // Additional error handling or alternative content display can be added here
        <?php
    }
    ?>
    //For Edible food
    <?php
        $sql = "SELECT Hostel_Name, SUM(Edible_Food_Amount) AS Total_Waste 
                FROM food_details 
                GROUP BY Hostel_Name";
        $result = $con->query($sql);

        if ($result && $result->num_rows > 0) {
        $dataPoints = [];
        while ($row = $result->fetch_assoc()) {
            $dataPoints[] = [
                'label' => $row['Hostel_Name'],
                'y' => $row['Total_Waste']
            ];
        }
        
    ?>
        var chart = new CanvasJS.Chart("chartContainer2", {
            animationEnabled: true,
            exportEnabled: true,
            title:{
                text: "Proportion of remaining edible food generated from each hostel"
            },
            subtitles: [{
                text: "kg is used as unit of measurement"
            }],
            data: [{
                type: "pie",
                showInLegend: true,
                legendText: "{label}",
                indexLabelFontSize: 16,
                indexLabel: "{label} - #percent%",
                yValueFormatString: "฿#,##0",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
        <?php
    } else {
        // Handle case where no data is available
        ?>
        console.log("No data available for chart rendering.");
        // Additional error handling or alternative content display can be added here
        <?php
    }
    ?>
}
</script>

</head>
<body>
<h1>Waste Food Management</h1>

<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html">WFMS</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-a active" aria-current="page" href="index.html">Home</a>
          </li>
          <li class="nav-item ">
            <a class="nav-a active" aria-current="page" href="availableFood.php">Available Food</a>
          </li>
          <li class="nav-item">
            <a class="nav-a active" aria-current="page" href="adminLogin.php">Login</a>
          </li>
          <li class="nav-item">
                <a class="nav-a active" aria-current="page" href="analytics.php">Data Visualizer</a>
          </li>
        </ul>
      </div>
    </div>
</nav>
<div style="height: 700px; overflow-y: auto;">
<div id="chartContainer1" style="height: 350px; width: 100%;"></div>
<div id="chartContainer2" style="height: 350px; width: 100%;"></div>
</div>
<!-- <div id="chartContainer" style="height: 370px; width: 100%;"></div> -->
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html> 