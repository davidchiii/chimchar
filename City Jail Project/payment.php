<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

// Check if the user is an admin
$is_admin = isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == "admin";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jail";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['criminal_id'])) {
  $criminal_id = $_SESSION['criminal_id'];
//   echo "Criminal ID: " . $criminal_id;
} else {
  echo "";
}

// Get the crimes the criminal has committed from the crimes table
$sql = "SELECT crime_id FROM crime WHERE criminal_id=$criminal_id";

$total_charge = 0;
$court_fee = 0;
$amount_paid = 0;
$fine_amount = 0;
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
  $crime_id = $row["crime_id"];
  $sql = "SELECT fine_amount, court_fee, amount_paid FROM crime_charge WHERE crime_id=$crime_id";
  $charge_result = $conn->query($sql);
  $charge_row = $charge_result->fetch_assoc();

  $court_fee = $charge_row["court_fee"];
  $amount_paid = $charge_row["amount_paid"]; 
  $fine_amount = $charge_row["fine_amount"];

  $total_charge += $charge_row["fine_amount"];
  $total_charge -= $charge_row["amount_paid"];
  $total_charge += $charge_row["court_fee"];
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment</title>
    <link rel="stylesheet" type="text/css" href="static/css/header-style.css">
    <link rel="stylesheet" type="text/css" href="static/css/officer.css">
</head>
<body>
    <!-- Navigation bar -->
    <div class="navbar">
        <a href="index.php">City Jail Website</a>
        <a href="officers.php">Officer Lookup</a>
        <a href="criminals.php">Criminal Lookup</a>
        <?php if(isset($_SESSION['loggedin'])): ?>
            <?php if($is_admin): ?>
                <a href="arrest.php">Enter Arrest</a>
                <a href="officer_page.php">Profile</a>
            <?php else: ?>
                <a class="active" href="payment.php">Make Payment</a>
                <a href="criminal_page.php">Profile</a>
            <?php endif; ?>
            <a class="login" href="logout.php">Log Out</a>
        <?php else: ?>
            <a class="login" href="login.php">Log In</a>
        <?php endif; ?>
    </div>
    <?php
        $full_name = "";
        // echo "<h1>$criminal_id</h1>";
        $sql = "SELECT first_name, last_name FROM criminals WHERE criminal_id=$criminal_id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        echo "<h1>Criminal Charges for:</h1>";
        echo "<h2>$row[first_name] $row[last_name]</h2>";
        echo "<p>Amount Owed: $" . number_format($fine_amount, 2)."</p>";
        echo "<p>Court Fee: $". number_format($court_fee, 2)."</p>";
        echo "<p>Amount Paid: $" . number_format($amount_paid, 2)."</p>";
        echo "<p>Total Charge Left: $" . number_format($total_charge, 2) . "</p>";
    ?>
    


</body>
</html>