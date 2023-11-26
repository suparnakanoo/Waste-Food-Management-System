
<?php
require("connection.php");

require __DIR__ ."/vendor/autoload.php";

try {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
} catch (\Dotenv\Exception\InvalidPathException $e) {

    // Handle invalid path exception (e.g., if the .env file doesn't exist)
    echo "Error: " . $e->getMessage();

}

use Twilio\Rest\Client;


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $hostelName = $_POST['HostelName'] ?? '';
    $edibleFoodAmount = $_POST['EdibleFoodAmount'] ?? '';
    $wasteFoodAmount = $_POST['WasteFoodAmount'] ?? '';
    $contactNumber = $_POST['ContactNumber'] ?? '';

    // Construct a readable message
    $message = "Hostel: $hostelName\n" .
               "Edible Food Amount: $edibleFoodAmount\n" .
               "Waste Food Amount: $wasteFoodAmount\n" .
               "Contact Number: $contactNumber";



//Selecting phone  numbers from database

$sql = "SELECT volunteer_phone FROM volunteer_details"; 
$result = mysqli_query($con, $sql);

// Store phone numbers in an array
$phoneNumbers = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $phoneNumbers[] = $row["volunteer_phone"]; 
    }
}
   
//Twilio setup
// Your Account SID and Auth Token from console.twilio.com

try {
    $sid = getenv('TWILIO_AUTH_SID');
    $token = getenv('TWILIO_AUTH_TOKEN');

    if ($sid === false || $token === false) {
        throw new Exception('Error fetching Twilio credentials from environment variables');
    }

} catch (Exception $e) {

    // Handle exceptions related to accessing environment variables
    echo "Error: " . $e->getMessage();
}



$twilio_number= "+14158702111";

try{
$client = new Twilio\Rest\Client($sid, $token);
// Use the Client to make requests to the Twilio REST API
    foreach ($phoneNumbers as $phoneNumber) 
    {
        $client->messages->create(
            $phoneNumber,
            [
                'from' => $twilio_number,
                'body' => $message
            ]
        );
        
    }
}catch (Exception $e) {

    $errorMessage = $e->getMessage();
    session_start();
    $_SESSION['twilio_error'] ="Error occurred while sending the SMS. Please retry".$errorMessage ;
    // header("Location: adminPanel.php");
    exit();
}

    //inserting to database
    $query="INSERT INTO `waste_food_management_system`.`food_details`(`Hostel_Name`, `Edible_Food_Amount`, `Waste_Food_Amount`, `Contact_Number`,`Date`) VALUES ('$hostelName','$edibleFoodAmount','$wasteFoodAmount','$contactNumber',current_timestamp())";
         mysqli_query($con, $query);
    header("Location: adminPanel.php");
}

?>