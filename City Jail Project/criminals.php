<?php
		// Establish database connection
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "jail";

		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Check if search was submitted
		$search_query = "";
		$search_column = "first_name";
		if (isset($_GET['search'])) {
			$search_query = $_GET['search'];
	    	$search_column = $_GET['search_column'];
			// Prepare SQL statement
			$sql = "SELECT criminal_id, last_name, first_name, street, city, state_in, zip, phone_nmbr, voff_status, probation_status FROM criminals WHERE " . $search_column . " 
	    		LIKE '" . $search_query . "%'";
			// Execute SQL statement and get results
		} else {
			$sql = "SELECT * FROM criminals
					WHERE " . $search_column . " 
	    			LIKE '" . $search_query . "'";
		}
		$result = $conn->query($sql);
		// Close database connection
		$conn->close();
	?>

<?php
session_start();

// Check if the user is an admin
$is_admin = isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == "admin";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Criminal Lookup</title>
	<link rel="stylesheet" type="text/css" href="static/css/header-style.css">
    <link rel="stylesheet" type="text/css" href="static/css/criminals.css">
</head>
<body>
    <!-- Navigation bar -->
	<div class="navbar">
		<a href="index.php">City Jail Website</a>
		<a href="officers.php">Officer Lookup</a>
		<a class="active" href="criminals.php">Criminal Lookup</a>
		<?php if(isset($_SESSION['loggedin'])): ?>
            <?php if($is_admin): ?>
                <a href="arrest.php">Enter Arrest</a>
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

	<h1 style=text-align:center>Criminal Search</h1>
	<div class="container">
		<form method="GET">
			<input type='text' name='search' placeholder='Search' value='<?php echo $search_query; ?>'/>
	        <select name='search_column'>
	            <option value='first_name' <?php if ($search_column == 'first_name') echo 'selected'; ?>>First Name</option>
	            <option value='last_name' <?php if ($search_column == 'last_name') echo 'selected'; ?>>Last Name</option>
	        </select>
			<input type="submit" value="Search">
		</form>

		<?php 
			if ($result->num_rows > 0) {
				if ($result->num_rows > 0) {
				echo "<h2 style=text-align:center>Search Results:</h2>";
				echo "<table style=margin-left:auto;margin-right:auto>";
				echo "<tr><th>Criminal ID</th><th>Last Name</th><th>First Name</th><th>Street</th><th>City</th><th>State</th><th>ZIP</th><th>Phone Number</th><th>Voff Status</th><th>Probation Status</th></tr>";
				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row["criminal_id"] . "</td>";
					echo "<td>" . $row["last_name"] . "</td>";
					echo "<td>" . $row["first_name"] . "</td>";
					echo "<td>" . $row["street"] . "</td>";
					echo "<td>" . $row["city"] . "</td>";
					echo "<td>" . $row["state_in"] . "</td>";
					echo "<td>" . $row["zip"] . "</td>";
					echo "<td>" . $row["phone_nmbr"] . "</td>";
					echo "<td>" . $row["voff_status"] . "</td>";
					echo "<td>" . $row["probation_status"] . "</td>";
					echo "</tr>";
				}
				echo "</table>";
				} else {
					echo "<p>No results found.</p>";
				}
			}
		?>
</body>
</html>