<?php
    require("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="adminLogin.css?v=<?php echo time() ?>">
    <title>Admin Login Page</title>
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
    <div class="login-form">
        <h2>Admin Login Panel</h2>
        <form method="POST">
            <div class="input-field">
                <!-- <i class="fas fa-user"></i> -->
              <input id="AdminName"type="text" placeholder="" name="AdminName" required >
              <span></span>
                <label for="AdminName" class="form-label">Enter user name</label>
                
            </div>

            <div class="input-field">
                <!-- <i class="fas fa-lock"></i> -->
              <input id="AdminPassword"type="password" placeholder="" name="AdminPassword" required>
              <span></span>
                <label for="AdminPassword" class="form-label">Enter password</label>
                
            </div>
            <div class="input-field-link">
               <a href="volunteerRegistration.php">Or register yourself as a volunteer</a>
            </div>
            <button type="submit" name="Login">Login</button>

        
        </form>
    </div>

    <?php
        if(isset($_POST['Login'])){
            $query="SELECT * FROM `admin_login` WHERE `Admin_Name`='$_POST[AdminName]' AND `Admin_Password`='$_POST[AdminPassword]'";
            $result=mysqli_query($con,$query);
            if(mysqli_num_rows($result)==1)
            {
                session_start();
                $_SESSION['AdminLoginId']=$_POST['AdminName'];
                header("location: adminPanel.php");
            }
            else
            {
                echo"<script>alert('Incorrect Password');</script>";
            }
        }
    ?>
</body>
</html>