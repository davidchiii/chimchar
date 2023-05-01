<?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("Location: login.php");
        exit;
    }

    // Check if the user is an admin
    $is_admin = isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == "admin";

    // Check if the user is logged in
    if (!$is_admin) {
        header("Location: logout.php");
        exit;
    }
?>

<?php 
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "jail";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['submit'])) {
    // Get form data
        $first = $_POST['last'];
        $last = $_POST['first'];
        $class = $_POST['class'];
        $date_charged = $_POST['date_c'];
        $hearing_date = $_POST['date_h'];
        $appeal_date = $_POST['date_a'];
        $crime_code = $_POST['crime_code'];
        $due_date = $_POST['date_m'];
        $fine = $_POST['fine'];
        $officer_id = $_SESSION["officer_id"];

        // Insert the new crime record into the crime table
        $sql = "INSERT INTO crime (criminal_id, classification, date_charged, appeal_status, hearing_date, appeal_cutoff_date)
                SELECT criminal_id, '$class', '$date_charged', 'CA', '$hearing_date', '$appeal_date'
                FROM criminals
                WHERE first_name = '$first' AND last_name = '$last'";
        $result = $conn->query($sql);

        if ($result) {
            $crime_id = $conn->insert_id;
            echo "New crime information added successfully";
        } else {
            echo "Error adding crime information: " . $conn->error;
        }

        // Insert the new charge record into the crime_charge table
        $sql = "INSERT INTO crime_charge (crime_id, crime_code, charge_status, fine_amount, court_fee, amount_paid, due_date)
                SELECT crime_id, '$crime_code', 'PD', '$fine', '150', '0', '$due_date'
                FROM crime
                WHERE crime_id = '$crime_id'";
        $result = $conn->query($sql);

        if ($result) {
            echo "New charge information added successfully";
        } else {
            echo "Error adding crime information: " . $conn->error;
        }

        // Insert the new officer record into the crime_officers table
        $sql = "INSERT INTO crime_officers (crime_id, officer_id) 
                SELECT c.crime_id, o.officer_id
                FROM crime c, officer o
                WHERE c.crime_id = '$crime_id' AND o.officer_id = '$officer_id'";
        $result = $conn->query($sql);

        if ($result) {
            echo "New crime_officer information added successfully";
        } else {
            echo "Error adding crime information: " . $conn->error;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Arrest</title>
    <link rel="stylesheet" type="text/css" href="static/css/header-style.css">
    <link rel="stylesheet" type="text/css" href="static/css/arrest-style.css">
</head>
<body>
    <!-- Navigation bar -->
    <div class="navbar">
        <a href="index.php">City Jail Website</a>
        <a href="officers.php">Officer Lookup</a>
        <a href="criminals.php">Criminal Lookup</a>
        <?php if(isset($_SESSION['loggedin'])): ?>
            <?php if($is_admin): ?>
                <a class="active" href="arrest.php">Enter Arrest</a>
                <a href="officer_page.php">Profile</a>
            <?php else: ?>
                <a href="payment.php">Make Payment</a>
                <a href="criminal_page.php">Profile</a>
            <?php endif; ?>
            <a class="login" href="logout.php">Log Out</a>
        <?php else: ?>
            <a class="login" href="login.php">Log In</a>
        <?php endif; ?>
    </div>
    <div class="container">
        <h1>Add Crime Information</h1>
        <form method="post">
            <label for="criminal_id">First Name:</label>
            <input type="text" id="first" name="first">
            <label for="criminal_id">Last Name:</label>
            <input type="text" id="last" name="last">
            <label for="classification">Classification:</label>
            <input type="text" id="class" name="class">
            <label for="crime_code">Crime Code:</label>
            <input type="text" id="crime_code" name="crime_code">
            <label for="date_charged">Date Charged:</label>
            <input type="date" id="date_c" name="date_c">
            <label for="hearing_date">Hearing Date:</label>
            <input type="date" id="date_h" name="date_h">
            <label for="appeal_cutoff_date">Appeal Cutoff Date:</label>
            <input type="date" id="date_a" name="date_a">
            <label for="date_charged">Fine Amount:</label>
            <input type="text" id="fine" name="fine">
            <label for="date_charged">Fine Due Date:</label>
            <input type="date" id="date_m" name="date_m">
            <div class="submit-container">
                <button class="arrest-button" type="submit" name="submit" value="true">Add New Arrest</button>
            </div>
        </form>
    </div>
    <?php
        // Close database connection
        $conn->close();
    ?>
</body>
</html>