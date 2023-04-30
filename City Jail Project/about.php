<!DOCTYPE html>
<html>
<head>
	<title>City Jail Information</title>
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
        <a href="officers.php">Officer Lookup</a>
        <a href="criminals.php">Criminal Lookup</a>
        <?php if(isset($_SESSION['loggedin'])): ?>
            <?php if($is_admin): ?>
                <a href="arrest.php">Enter Arrest</a>
                <a href="officer_page.php">Profile</a>
            <?php else: ?>
                <a href="payment.php">Make Payment</a>
                <a class="active" href="criminal_page.php">Profile</a>
            <?php endif; ?>
            <a class="login" href="logout.php">Log Out</a>
        <?php else: ?>
            <a class="login" href="login.php">Log In</a>
        <?php endif; ?>
    </div>
	<h1>Welcome to the City Jail</h1>
	<p>The City Jail is a state-of-the-art facility designed to house prisoners who are awaiting trial or have been sentenced to serve time for a variety of crimes. Our facility is located in the heart of downtown, making it easily accessible to visitors and loved ones who wish to visit inmates.</p>

	<h2>Facility Features</h2>
	<ul>
		<li>24-hour surveillance</li>
		<li>Secure, controlled access to inmate areas</li>
		<li>Separate housing units for male and female inmates</li>
		<li>Medical facilities and mental health services available on-site</li>
		<li>Recreational areas for inmates to exercise and socialize</li>
	</ul>

	<h2>Visitation Information</h2>
	<p>Visitation hours are available seven days a week, with restrictions based on the inmate's housing unit and classification level. Visitors must bring valid identification and be on the inmate's approved visitation list. Contact the jail for more information on visitation hours and requirements.</p>

	<h2>Rehabilitation and Reentry Programs</h2>
	<p>The City Jail offers a range of rehabilitation and reentry programs for inmates, including drug and alcohol counseling, education and job training, and counseling services. Our goal is to help inmates successfully reintegrate into society and become productive members of their communities.</p>

	<h2>Contact Information</h2>
	<p>If you have any questions or concerns about the City Jail, please contact us at:</p>
	<p>123 Main Street<br> 
	City, State Zip<br>
	Phone: (123) 456-7890<br>
	Email: city_incarceration@city.gov</p>
</body>
</html>
