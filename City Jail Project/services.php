<!DOCTYPE html>
<html>
<head>
	<title>City Jail Services</title>
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
	<p>The City Jail is a state-of-the-art facility designed to provide a safe and secure environment for inmates. We offer a range of services to help inmates during their stay and prepare them for their return to society.</p>

	<h2>Housing</h2>
	<p>We have separate housing units for male and female inmates, as well as special units for inmates with mental health or medical needs. Our cells are designed to provide a safe and clean environment for inmates, and we provide bedding and basic hygiene items.</p>

	<h2>Food and Nutrition</h2>
	<p>We provide three nutritious meals a day for inmates, prepared by trained culinary professionals. We offer a variety of options, including vegetarian and halal meals, and we can accommodate special dietary needs with a doctor's note.</p>

	<h2>Medical and Mental Health Care</h2>
	<p>We have medical professionals on staff to provide basic health care services to inmates, including medication management and emergency care. We also offer mental health services, including counseling and therapy, for inmates who need it.</p>

	<h2>Recreation and Education</h2>
	<p>We offer a range of recreational and educational programs to help inmates stay engaged and prepare for their return to society. These programs include classes on basic literacy and math, job training and vocational programs, and recreational activities like sports and games.</p>

	<h2>Visitation</h2>
	<p>We offer scheduled visitation hours for inmates to receive visits from family and friends. Visitors must be on the inmate's approved visitor list and must present valid identification to be admitted. We also offer video visitation options for those who cannot visit in person.</p>

	<h2>Legal Services</h2>
	<p>We offer legal services for inmates, including access to a law library and legal resources, as well as assistance with filling out legal forms and preparing for court appearances.</p>

	<h2>Contact Information</h2>
	<p>If you have any questions about the services we offer at the City Jail, please contact us at:</p>
	<p>123 Main Street<br> 
	City, State Zip<br>
	Phone: (123) 456-7890<br>
	Email: city_incarceration@city.gov</p>
</body>
</html>
