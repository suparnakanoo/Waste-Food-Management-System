<?php
    session_start();
    if(!isset($_SESSION['AdminLoginId'])){
        header("location: adminLogin.php");
    }
    
    if (isset($_SESSION['twilio_error'])) {
    $error_message = $_SESSION['twilio_error'];
    unset($_SESSION['twilio_error']); // Remove the error message from the session
    echo "<script>alert('$error_message');</script>";
    }

    if(isset($_POST['Logout']))
    {
        session_destroy();
        header("location: adminLogin.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminPanel.css?v=<?php echo time() ?>">
    <title>Admin Panel</title>
</head>
<body>
    <h1>Waste Food Management System</h1>
    <div class="header">
    <h3>WELCOME TO ADMIN PANEL - <?php echo $_SESSION['AdminLoginId']?></h3>
    <form method="POST">
        <button name="Logout">LOG OUT</button>
    </form>
    </div>

    <div class="food-details-form">
        
        <form method="POST" action="adminPanelSms.php">
            <div class="input-field">
            <!-- <input id="HostelName" type="text" placeholder="" name="HostelName" required>
            <span></span>
                <label for="HostelName" class="form-label">Enter the name of the hostel:</label>
                 -->
                 <select class="form-select"name="HostelName" id="HostelName" aria-label="Default select example" >
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
            </div>

            <div class="input-field">
            <input id="EdibleFoodAmount" type="text" placeholder="" name="EdibleFoodAmount" autocomplete="off" required>
            <span></span>
                <label for="EdibleFoodAmount" class="form-label">Enter the amount of the edible food(in kg):</label>
                
            </div>

            <div class="input-field">
            <input id="WasteFoodAmount" type="text" placeholder="" name="WasteFoodAmount" autocomplete="off" required>
            <span></span>
                <label for="WasteFoodAmount" class="form-label">Enter the amount of the waste food(in kg):</label>
                
            </div>

            <div class="input-field">
            <input id="ContactNumber" type="text" placeholder="" name="ContactNumber" autocomplete="off" required>
            <span></span>
                <label for="ContactNumber" class="form-label">Enter your Contact Number:</label>
                
            </div>

            <button type="submit" name="submit">Submit</button>

        
        </form>
    </div>

</body>
</html>