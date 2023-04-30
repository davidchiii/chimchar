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
    // echo "Criminal ID: " . $criminal_id;
    } else {
    echo "";
    }

    // Get the crimes the criminal has committed from the crimes table
    $sql = "SELECT first_name, last_name, street, city, state_in, zip, phone_nmbr, voff_status, probation_status FROM criminals WHERE criminal_id=$criminal_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="static/css/header-style.css">
    <link rel="stylesheet" type="text/css" href="static/css/officer.css">
    <link rel="stylesheet" type="text/css" href="static/css/profile.css">
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
                <a href="payment.php">Make Payment</a>
                <a class="active" href="criminal_page.php">Profile</a>
            <?php endif; ?>
            <a class="login" href="logout.php">Log Out</a>
        <?php else: ?>
            <a class="login" href="login.php">Log In</a>
        <?php endif; ?>
    </div>

    <div class="profile">
        <img src="static/images/defaultpfp.jpg" alt="Profile Image">
        <h1>User Profile</h1>
        <p><strong>First Name:</strong> <?php echo $row['first_name']; ?></p>
        <p><strong>Last Name:</strong> <?php echo $row['last_name']; ?></p>
        <p><strong>Street:</strong> <?php echo $row['street']; ?></p>
        <p><strong>City:</strong> <?php echo $row['city']; ?></p>
        <p><strong>State:</strong> <?php echo $row['state_in']; ?></p>
        <p><strong>Zip Code:</strong> <?php echo $row['zip']; ?></p>
        <p><strong>Phone Number:</strong> <?php echo $row['phone_nmbr']; ?></p>
    </div>
</body>
</html>