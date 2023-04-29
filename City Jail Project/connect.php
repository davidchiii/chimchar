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

// Get all tables in the database
$tables = array();
$result = $conn->query("SHOW TABLES");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tables[] = $row["Tables_in_" . $dbname];
    }
}

// Print out all tables in the database
echo "Tables in database $dbname:\n";
foreach ($tables as $table) {
    echo "$table\n";
}

// Close connection
$conn->close();
?>