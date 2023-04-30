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
		<a href="index.php">City Jail Website</a>
		<a class="active" href="officers.php">Officer Lookup</a>
		<a href="criminals.php">Criminal Lookup</a>
	</div>
	<h1>Officer information:</h1>
	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "jail";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$search_query = "";
		if (isset($_GET['search'])) {
		    $search_query = $_GET['search'];
		    $sql = "SELECT * FROM officer 
		    		WHERE first_name 
		    		LIKE '%" . $search_query . "%'";
		} else {
		    $sql = "SELECT * FROM officer";
		}
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0){
			echo "<form method='get'>";
		    echo "<input type='text' name='search' placeholder='Search by name' value='" . $search_query . "'/>";
		    echo "<input type='submit' value='Search'/>";
		    echo "</form>";

		    echo "<table>";
		    echo "<tr><th>Badge#</th><th>Name</th><th>Precinct</th><th>Phone Number</th></tr>";

		    while($row = $result->fetch_assoc()) {
		        echo "<tr><td>" . $row["badge"] . "</td><td>" . $row["last_name"] . ", " . $row["first_name"] . "</td><td>" . $row["precinct"] . "</td><td>" . $row["phone_num"] . "</td></tr>";
		    }

    		echo "</table>";
		} else {
		    echo "0 results";
		}
	?>
</body>
</html>