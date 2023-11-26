<?php
require("connection.php");

$toDate=$fromDate="";
$data = [];

if(isset($_POST['submit'])){

  $from=$_POST['from'];
  $fromDate=$from;
  $fromArr=explode("/",$from);
  $from=$fromArr[2].'-'.$fromArr[1].'-'.$fromArr[0];
  $from=$from." 00:00:00";

  $to=$_POST['to'];
  $toDate=$to;
  $toArr=explode("/",$to);
  $to=$toArr[2].'-'.$toArr[1].'-'.$toArr[0];
  $to=$to." 23:59:59";
  $sub_sql=" `Date`>='$from' AND `Date`<='$to'";

  if (!empty($_POST['hostelName'])) {
    $hostelName = $_POST['hostelName'];
    $sub_sql .= " AND `Hostel_Name`='$hostelName'";
  }
  
  $sql = "SELECT * FROM `food_details` WHERE $sub_sql ORDER BY `Date` desc";
  

  $res=mysqli_query($con,$sql);
  if(!$res) {
    die("Query failed: " . mysqli_error($con));
  }
  if(mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
      $data[] = $row;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="availableFood.css?v=<?php echo time() ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    
    <title>Available Food</title>
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
  <div class="search-container">
    <form class="search-form" method="post" >
      <select class="form-select"name="hostelName" id="hostelName" aria-label="Default select example" >
        <option value="">--Select hostel--</option>
        <option value="GH1">GH1</option>
        <option value="GH2">GH2</option>
        <option value="GH3">GH3</option>
        <option value="BH1">BH1</option>
        <option value="BH2">BH2</option>
        <option value="BH3">BH3</option>
        <option value="BH4">BH4</option>
        <option value="BH5">BH5</option>
        <option value="BH6">BH6</option>
        <option value="BH7">BH7</option>
        <option value="BH8">BH8</option>
        <option value="BH9A">BH9A</option>
        <option value="BH9B">BH9B</option>
        <option value="BH9C">BH9C</option>
        <option value="BH9D">BH9D</option>
    </select>

    <span>
      <label for="from">From</label>
      <input type="text" id="from" name="from" value="<?php echo $fromDate?>" autocomplete="off" required >
      <label for="to">to</label>
      <input type="text" id="to" name="to" value="<?php echo $toDate?>" autocomplete="off" required>
 
    </span>
    <button type="submit" name="submit">Search</button>

    </form>
  </div>
  <div class="result">
      <?php if(isset($data) && !empty($data)) : ?>
        <table table table-bordered>
          <thead>
            <tr>
              <th>Hostel Name</th>
              <th>Edible Food Amount</th>
              <th>Waste Food Amount</th>
              <th>Contact Number</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($data as $row) : ?>
              <tr>
                <td><?php echo $row['Hostel_Name']; ?></td>
                <td><?php echo $row['Edible_Food_Amount']; ?></td>
                <td><?php echo $row['Waste_Food_Amount']; ?></td>
                <td><?php echo $row['Contact_Number']; ?></td>
                <td><?php echo $row['Date']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else : ?>
        <p>No results found.</p>
      <?php endif; ?>
    </div>
    <script>
      $( function() {
        var dateFormat = "dd/mm/yy",
          from = $( "#from" )
            .datepicker({
              defaultDate: "+1w",
              changeMonth: true,
              numberOfMonths: 1,
              dateFormat : "dd/mm/yy",
            })
            .on( "change", function() {
              to.datepicker( "option", "minDate", getDate( this ) );
            }),
          to = $( "#to" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat : "dd/mm/yy",
          })
          .on( "change", function() {
            from.datepicker( "option", "maxDate", getDate( this ) );
          });
     
        function getDate( element ) {
          var date;
          try {
            date = $.datepicker.parseDate( dateFormat, element.value );
          } catch( error ) {
            date = null;
          }
     
          return date;
        }
      } );
      </script>
</body>
</html>