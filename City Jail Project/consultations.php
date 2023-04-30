<!DOCTYPE html>
<html>
<head>
	<title>City Jail Consultations</title>
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
	<h1>Welcome to City Jail Consultations</h1>
	<p>If you or a loved one has been arrested and is currently in the city jail, we understand that this can be a difficult and stressful time. That's why we offer jail consultations to help you navigate the legal system and understand your rights.</p>

	<h2>What is a Jail Consultation?</h2>
	<p>A jail consultation is a meeting with a legal professional who can provide guidance and support during your time in jail. We can help you understand your charges, explore your legal options, and connect you with resources to help you through the process.</p>

	<h2>How does it work?</h2>
	<p>To schedule a jail consultation, simply contact us by phone or email. We will arrange a time to meet with you at the jail, either in person or via video conference. During the consultation, we will discuss your situation and provide you with advice and support. We can also connect you with other professionals, such as bail bondsmen or mental health counselors, if needed.</p>

	<h2>Why choose us?</h2>
	<ul>
		<li>Experienced legal professionals with a deep understanding of the criminal justice system</li>
		<li>Compassionate and personalized approach to each case</li>
		<li>Affordable rates and flexible payment options</li>
		<li>24/7 availability for emergency consultations</li>
	</ul>

	<h2>Contact Information</h2>
	<p>If you need a jail consultation, please contact us at:</p>
	<p>123 Main Street<br> 
	City, State Zip<br>
	Phone: (123) 456-7890<br>
	Email: city_incarceration@city.gov</p>
</body>
</html>
