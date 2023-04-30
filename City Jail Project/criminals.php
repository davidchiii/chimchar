<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Officer Lookup</title>
	<link rel="stylesheet" type="text/css" href="static/css/header-style.css">
    <link rel="stylesheet" type="text/css" href="static/css/officer.css">
</head>
<body>
    <!-- Navigation bar -->
	<div class="navbar">
		<a href="#">City Jail Website</a>
		<a href="officers.php">Officer Lookup</a>
		<a class="active" href="criminals.php">Criminal Lookup</a>
	</div>

	<h1>Criminal Search</h1>
	<form method="GET">
		<label for="search">Search Name:</label>
		<input type="text" name="search" id="search">
		<input type="submit" value="Search">
	</form>

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
		if (isset($_GET['search'])) {
			$search = $_GET['search'];

			// Prepare SQL statement
			$sql = "SELECT criminal_id, last_name, first_name, street, city, state_in, zip, phone_nmbr, voff_status, probation_status FROM criminals WHERE first_name LIKE '%" . $search . "%'";
			// Execute SQL statement and get results
			$result = $conn->query($sql);

			// Output search results
			if ($result->num_rows > 0) {
				if ($result->num_rows > 0) {
				echo "<h2>Search Results:</h2>";
				echo "<table>";
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
	}

		// Close database connection
		$conn->close();
	?>
</body>
</html>