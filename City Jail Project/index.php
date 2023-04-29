<!DOCTYPE html>
<html>
<head>
	<title>City Jail Website</title>
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
		<a class="active" href="#">City Jail Website</a>
		<a href="connect.php">Police Records</a>
		<a href="officers.php">City Courts</a>
		<a href="criminals.php">City Prison</a>
	</div>
	<!-- Main content -->
	<div>
		<h1>Welcome to the City Jail Website</h1>
		<p>Here you can find information about our jail, inmate lookup, visitation hours, and more.</p>
		<p>Please use the navigation bar above to access other city websites.</p>
	</div>
</body>
</html>
