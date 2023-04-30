<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

// Check if the user is an admin
$is_admin = isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == true;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>City Jail Website</title>
    <link rel="stylesheet" type="text/css" href="static/css/header-style.css">
    <link rel="stylesheet" type="text/css" href="static/css/index.css">
</head>
<body>
	<!-- Navigation bar -->
	<div class="navbar">
		<a class="active" href="#">City Jail Website</a>
		<a href="officers.php">Officer Lookup</a>
		<a href="criminals.php">Criminal Lookup</a>
        <a class="login" href="login.php">Log In</a>
	</div>

    <img class="banner-image" src="static\images\4569479-landscape-clouds-city-manhattan-sunset-new-york-city.jpg" alt="Banner Image">
		<a href="connect.php">Police Records</a>
		<a href="officers.php">City Courts</a>
		<a href="criminals.php">City Prison</a>
	</div>
	<!-- Main content -->
	<div>
		<h1>Welcome to the City Jail Website</h1>
		<p>Here you can find information about our jail, inmate lookup, visitation hours, and more.</p>
		<p>Please use the navigation bar above to access other city websites.</p>
	</div>

    <!-- Card container -->
    <div class="card-container">
        <!-- Card 1 -->
        <div class="card">
            <img src="static/images/hoa.jpg" alt="Card Image 1">
            <p>Community Impact</p>
            <a href="https://example.com/card-link-1">Read our About!</a>
        </div>
        <!-- Card 2 -->
        <div class="card">
            <img src="static/images/consulting.jpg" alt="Card Image 2">
            <p>Consultations</p>
            <a href="https://example.com/card-link-2">Schedule a visit!</a>
        </div>
        <!-- Card 3 -->
        <div class="card">
            <img src="static/images/budgeting.jpg" alt="Card Image 3">
            <p>Services</p>
            <a href="https://example.com/card-link-3">Contact us!</a>
        </div>
    </div>
</body>
</html>
