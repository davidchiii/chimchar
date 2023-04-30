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
	$search_column = "first_name";
	if (isset($_GET['search'])) {
	    $search_query = $_GET['search'];
	    $search_column = $_GET['search_column'];
	    $sql = "SELECT * FROM officer
	    		WHERE " . $search_column . " 
	    		LIKE '" . $search_query . "%'";
	} else {
	    $sql = "SELECT * FROM officer";
	}
	$result = $conn->query($sql);

	$conn->close();
?>

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
	<div class='container'>
	    <form method='get'>
	        <input type='text' name='search' placeholder='Search' value='<?php echo $search_query; ?>'/>
	        <select name='search_column'>
	            <option value='first_name' <?php if ($search_column == 'first_name') echo 'selected'; ?>>First Name</option>
	            <option value='last_name' <?php if ($search_column == 'last_name') echo 'selected'; ?>>Last Name</option>
	            <option value='badge' <?php if ($search_column == 'badge') echo 'selected'; ?>>Badge Number</option>
	            <option value='precinct' <?php if ($search_column == 'precinct') echo 'selected'; ?>>Precinct</option>
	        </select>
	        <input type='submit' value='Search'/>
	    </form>

	    <?php
		    if ($result->num_rows > 0) {
		        // Output the officer information in a table
		        echo "<table class='officer-table'>";
		        echo "<tr><th>Badge#</th><th>Name</th><th>Precinct</th><th>Phone Number</th></tr>";

			    while($row = $result->fetch_assoc()) {
			        echo "<tr><td>" . $row["badge"] . 
			        	"</td><td>" . $row["last_name"] . 
			        	", " . $row["first_name"] . 
			        	"</td><td>" . $row["precinct"] . 
			        	"</td><td>" . $row["phone_num"] . "</td></tr>";
			    }

		        echo "</table>";
		    } else {
		        echo "0 results";
		    }
	    ?>
	</div>
</body>
</html>