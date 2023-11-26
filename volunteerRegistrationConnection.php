<?php
    
    $con=mysqli_connect("localhost","root","","waste_food_management_system");

    if(mysqli_connect_error())
    {
        echo "Can not connect to database";
    }
    
?>