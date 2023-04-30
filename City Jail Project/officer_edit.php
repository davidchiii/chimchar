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

    // Retrieve officer information from the database
    $officer_id = $_SESSION['officer_id'];
    $sql = "SELECT * FROM officer 
            WHERE officer_id = $officer_id";
    $result = $conn->query($sql);

    // Check if form has been submitted
    if(isset($_POST['submit'])) {
        $badge_number = $_POST['badge'];
        $precinct = $_POST['precinct'];
        $phone = $_POST['phone'];
        $status = $_POST['status'];

        // Update officer information in the database
        $sql = "UPDATE officer 
                SET badge = '$badge_number', precinct = '$precinct', phone_num = '$phone', status_val = '$status' 
                WHERE officer_id = $officer_id";

        if ($conn->query($sql) === TRUE) {
            echo "Officer information updated successfully";
            header("Location: officer_page.php");
        } else {
            echo "Error updating officer information: " . $conn->error;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Officer Profile</title>
    <link rel="stylesheet" type="text/css" href="static/css/header-style.css">
    <link rel="stylesheet" type="text/css" href="static/css/officer-profile.css">
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
                <a class="active" href="officer_page.php">Profile</a>
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
        <?php
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
            <form method="post">
            <img src="static/images/officer.jpg" alt="Officer Image">
            <h2 class="name"><?php echo $row["last_name"] . ", " . $row["first_name"]; ?></h2>
            <p class="badge-number"><strong>Badge Number:</strong> <input type="text" value="<?php echo $row['badge']; ?>" name="badge"></p>
            <p class="info"><strong>Precinct:</strong> <input type="text" value="<?php echo $row['precinct']; ?>" name="precinct"></p>
            <p class="info"><strong>Phone:</strong> <input type="text" value="<?php echo $row['phone_num']; ?>" name="phone"></p>
            <p class="info"><strong>Status:</strong>
                <select name="status">
                    <option value="A" <?php if ($row['status_val'] == 'A') echo 'selected="selected"'; ?>>Active</option>
                    <option value="I" <?php if ($row['status_val'] == 'I') echo 'selected="selected"'; ?>>Inactive</option>
                </select>
            </p>
        <?php
            } else {
                echo '<p>No officer found.</p>';
            }

            // Close database connection
            $conn->close();
        ?>
            <div class="submit-container">
                <button class="edit-button" type="submit" name="submit" value="true">Submit Edit</button>
            </div>
        </form>
    </div>
</body>
</html>