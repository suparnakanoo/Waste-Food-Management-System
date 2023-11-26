<?php
    require("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="volunteerRegistration.css?v=<?php echo time() ?>">
    <title>Volunteer Registration</title>
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
    <div class="volunteer-registration">
        
        <form method="POST">
            <div class="input-field">
            <input id="name" type="text" placeholder="" name="name" autocomplete="off" required>
            <span></span>
                <label for="name" class="form-label">Enter your name:</label>
                
            </div>

            <div class="input-field">
            <input id="phone" type="text" placeholder="" name="phone" autocomplete="off" required>
            <span></span>
                <label for="phone" class="form-label">Enter your phone number(with +91):</label>
                
            </div>
            <div class="input-field-link">
               <a href="adminLogin.php">Go back to Admin Login</a>
            </div>
            <button type="submit" name="submit">Submit</button>

        
        </form>
    </div>
    <?php
        if(isset($_POST['submit'])){
            $volunteerName=$_POST['name'];
            $volunteerPhone=$_POST['phone'];
            
            $query="INSERT INTO `waste_food_management_system`.`volunteer_details`(`volunteer_name`, `volunteer_phone`) VALUES ('$volunteerName','$volunteerPhone')";
           mysqli_query($con, $query);
        }
    ?>
        
</body>
</html>