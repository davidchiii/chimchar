<?php
    session_start();
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "jail";

    // Connect to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Define the login form variables
    $username = "";
    $password = "";
    $error_message = "";
    $criminal_id = "";

    // Handle the login form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the username and password from the form
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Check if the username and password are correct
        $sql = "SELECT username, password, permission_type, criminal_id
                FROM users 
                WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Login successful, set the session variable and redirect to the homepage
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            $row = $result->fetch_assoc();
            $_SESSION["is_admin"] = $row["permission_type"];
            $_SESSION["criminal_id"] = $row["criminal_id"];
            header("Location: index.php");
        } else {
            // Login failed, display an error message
            $error_message = "Invalid username or password.";
        }
    }

    // Close the database connection
    $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="static/css/login-style.css">
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo $username; ?>">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?php echo $password; ?>">
        </div>
        <?php if ($error_message != "") { ?>
            <div class="form-group error-message">
                <?php echo $error_message; ?>
            </div>
        <?php } ?>
        <div class="form-group">
            <button type="submit">Login</button>
        </div>
    </form>
</div>

</body>
</html>