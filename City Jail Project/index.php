<!DOCTYPE html>
<html>

<head>
	<title>My Website</title>
	<style>
		/* Style the navigation bar */
		.navbar {
			background-color: #333;
			overflow: hidden;
		}

		/* Style the links inside the navigation bar */
		.navbar a {
			float: left;
			color: #f2f2f2;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
			font-size: 17px;
		}

		/* Change the color of links on hover */
		.navbar a:hover {
			background-color: #ddd;
			color: black;
		}

		/* Set an active/current link */
		.navbar .active {
			background-color: #4CAF50;
			color: white;
		}
	</style>
</head>

<body>
    <!-- Navigation bar -->
	<div class="navbar">
		<a class="active" href="#">Home</a>
		<a href="page1.html">Page 1</a>
		<a href="page2.html">Page 2</a>
	</div>
    <?php
    // Set database credentials
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

    // Get all values in the "criminals" table
    $sql = "SELECT * FROM criminals";
    $result = $conn->query($sql);

    // Print out all values in the "criminals" table
    if ($result->num_rows > 0) {
        echo "<table>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["criminal_id"] . "</td>";
            echo "<td>" . $row["last_name"] . "</td>";
            echo "<td>" . $row["first_name"] . "</td>";
            echo "<td>" . $row["street"] . "</td>";
            echo "<td>" . $row["city"] . "</td>";
            echo "<td>" . $row["state_in"] . "</td>";
            echo "<td>" . $row["zip"] . "</td>";
            echo "<td>" . $row["phone_nmbr"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    // Close connection
    $conn->close();
    ?>

</body>

</html>