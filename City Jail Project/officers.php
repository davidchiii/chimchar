<?php
session_start();

// Check if the user is an admin
$is_admin = isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == "admin";
?>

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

	// Delete officer row
	if ($is_admin && isset($_GET['delete'])) {
		$id = $_GET['delete'];
		$sql = "DELETE * FROM officer WHERE id=$id";
		$result = $conn->query($sql);
		if ($result) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}

	//Get officer table
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
<<<<<<< HEAD
	<h1>Officer information</h1>
=======
	<h1 style=text-align:center>Officer information:</h1>
>>>>>>> 50c585ef4078b21187112d85148b73a829c4cf9b
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
			        	"</td><td>" . $row["phone_num"] . "</td>";
			        if ($is_admin) {
                    echo "<td>
                            <form method='post'>
                                <input type='hidden' name='delete_badge' value='" . $row["badge"] . "'>
                                <input type='submit' name='delete_officer' value='Delete'>
                            </form>
                      	</td>";
	                }
	                echo "</tr>";
			    }

		        echo "</table>";
		    } else {
		        echo "0 results";
		    }
	    ?>
	</div>
</body>
</html>