<?php
	session_start();
	if(!isset($_SESSION['username']))
	{
		header("Location: /login.php");
		exit;
	}
  if (!empty($_SESSION['user_dp'])) {
      $dp = base64_encode(($_SESSION['user_dp']));
  } else {
      $imagePath = file_get_contents('images/user.jpg');
      $dp = base64_encode($imagePath);
  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>QuID | About Us</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet"  href="css/About-us.css">
</head>
<body>
	<nav>
		<div class="logo">
			<a href="homepage.php">
				<img src="./images/logo-blue.png" alt="Logo">
			</a>
		</div>
		<div class="nav-links">
		<a href="homepage.php">Home</a>
		<a href="storagepage.php">DIGITAL IDS</a>
		<a href="About-us.php">ABOUT US</a>
		<div class="dropdown">
			<a href="User-Overview.php">
				<img src="data:image/jpeg;base64,<?php echo htmlspecialchars($dp); ?>" alt="Profile Picture" class="profile-pic">
				Profile
			</a>
			<div class="dropdown-content">
				<a href="User-Profile.php"><i class="fa-solid fa-gear"></i>Account Settings</a>
				<a onclick="confirmLogout()"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
			</div>
		  </div>
		</div>
	  </nav>

    <div class="image-container">
    	 <div class="slideshow-container">
	        <img class="slide" src="./images/pic-landing-1d.png" alt="Landing Image">
	        <img class="slide" src="./images/pic-landing-1e.png" alt="Landing Image">
	        <img class="slide" src="./images/pic-landing-1f.png" alt="Landing Image">
    	</div>
    	<h1>ABOUT US</h1>
	    <p>HOME&nbsp; / &nbsp;ABOUT US</p>
    </div>

    <div id="about-us">
		<img src="./images/pic-landing-2.png" alt="Landing Image">
		<div class="about-us-info">
			<h3>About Us</h3>
			<h2>YOUR ID, ALWAYS ACCESSIBLE, ALWAYS SAFE</h2>
			<p>At QuID, we’re redefining how you store and access your IDs, combining secure digital storage with the power of IoT technology. Our platform is designed to make identification safe, easy, and instantly accessible, putting your essential documents at your fingertips. With a focus on security, simplicity, and innovation, QuID brings you peace of mind in a digital-first world.</p>
			<a href="#how-it-works" class="button">See How It Works</a>
		</div>
	</div>

	<div class="Our-team">
		<h2>Meet our <span style="color: #263A69;">Team</span></h2>
		<p><strong>The Brilliant Minds Behind QuID – From Frontend Visionaries to Backend Experts</strong> <br>The QuID team is composed of dedicated students from Don Honorio Ventura State University. <br> This project, developed for academic purposes, aims to create efficient and reliable digital <br>ID storage solutions while ensuring a seamless user experience. </p>
		<div class="team">
			<div class="members">
				<img src="./images/missy.png" alt="missy">
				<h3>Missy Tanheco</h3>
				<p>Main Frontend Programmer</p>
				<p class="team-info">User designed and coded the QuID web pages, <br>focusing on layout and responsiveness.</p>
			</div>
			<div class="members">
				<img src="./images/josh.png" alt="josh">
				<h3>Josh Rodriguez</h3>
				<p>Frontend Programmer</p>
				<p class="team-info">Frontend development and implemented media <br>queries for responsive design in the QuID project.</p>
			</div>
			<div class="members">
				<img src="./images/ally.png" alt="ally">
				<h3>ALlyssa Mujal</h3>
				<p>Frontend Programmer</p>
				<p class="./imagesteam-info">Frontend development and implemented media <br>queries for responsive design in the QuID project.</p>
			</div>
			<div class="members">
				<img src="./imagesdave.png" alt="dave">
				<h3>Dave Sula</h3>
				<p>Frontend Programmer</p>
				<p class="team-info">Frontend development and implemented media <br>queries for responsive design in the QuID project.</p>
			</div>
			<div class="members">
				<img src="./images/stephen.png" alt="stephen">
				<h3>Stephen Ortega</h3>
				<p>Main Backend Programmer</p>
				<p class="team-info">Worked on the login and registration functionality,<br> as well as the user profile, for the QuID project.</p>
			</div>
			<div class="members">
				<img src="./images/gab.png" alt="gab">
				<h3>Gab Ralar</h3>
				<p>Backend Programmer</p>
				<p class="team-info">Worked on the QR code generation for IDs and the <br>audit trail feature in the QuID project.</p>
			</div>
			<div class="members">
				<img src="./images/adrian.png" alt="adrian">
				<h3>Adrian Miclat</h3>
				<p>Backend Programmer</p>
				<p class="team-info">Developed the QR code scanning feature,<br> enabling  users to scan a QR code and <br>be redirected to a webpage displaying the ID.</p>
			</div>
			<div class="members">
				<img src="./images/andrex.png" alt="andrex">
				<h3>Andrex Bulaon</h3>
				<p>Research and development</p>
				<p class="team-info">Responsible for documentation and manuscript.</p>
			</div>
			<div class="members">
				<img src="./images/icon.png" alt="khian">
				<h3>Khian Baldago</h3>
				<p>Research and development</p>
				<p class="team-info">Responsible for documentation and manuscript.</p>
			</div>
		</div>
	</div>


	<div class="goals">
		<h2>Our purpose and goals</h2>
		<p>Innovating to provide you with safe, instant access to your digital identity</p>
		<div class="info">
			<div class="info-inner">
				<div class="mission-container">
					<i class="fa-solid fa-bullseye"></i>
		  			<div class="mission-text">
					    <p class="mission-title">Mission</p>
					    <p class="mission-description"> At QuID, our mission is to provide secure, digital access to your IDs anytime, anywhere. We use technology to make ID management simple, safe, and accessible, ensuring your IDs are as flexible as you are. </p>
		  			</div>
				</div>

				<div class="vision-container">
		  			<i class="fa-solid fa-eye"></i>
		  			<div class="vision-text">
		    			<p class="vision-title">Vision</p>
		    			<p class="vision-description"> Our vision is to create a future where managing and accessing your IDs is easy, secure, and always at your fingertips. </p>
		  			</div>
				</div>

				<div class="core-container">
		  			<i class="fa-solid fa-star"></i>
		  			<div class="core-text">
		    			<p class="core-title">Core</p>
		    			<p class="core-description"> Our services offer secure, seamless access to your IDs, using advanced technology to protect your information while fostering trust and reliability. </p>
		  			</div>
				</div>
			</div>
			<img src="pic-landing-3.png" alt="Landing Image">
		</div>
	</div>

	<div class="parent">
		<div id="how-it-works">
			<h2>How it works?</h2>
			<p>With QuID, managing your identification is simple, secure, and always within reach</p>
			<div class="steps">
				<div class="upload">
					<i class="fa-solid fa-upload"></i>
					<h3>Upload Your ID</h3>
					<p>Easily upload your government IDs or personal identification documents into the QuID platform.</p>
				</div>

				<div class="secure">
					<i class="fa-solid fa-key"></i>
					<h3>Secure Storage</h3>
					<p>Your IDs are securely stored in the cloud, protected by advanced encryption and IoT technology.</p>
				</div>

				<div class="access">
					<i class="fa-solid fa-sliders"></i>
					<h3>Instant Access</h3>
					<p>Access your stored IDs anytime, anywhere, with just a few taps—no need to carry physical copies.</p>
				</div>

				<div class="manage">
					<i class="fa-solid fa-gear"></i>
					<h3>Manage Your Information</h3>
					<p>Edit, update, or delete your stored IDs whenever necessary, all through our easy-to-use dashboard.</p>
				</div>

				<div class="protected">
					<i class="fa-solid fa-lock"></i>
					<h3>Stay Protected</h3>
					<p>QuID ensures your IDs are safe with ongoing security updates and features to protect your data.</p>
				</div>
			</div>
		</div>
	</div>

	<div id="support">
		<div class="side-info">
			<h2>Any questions?</h2>
			<h2>We got you.</h2>
			<p>At QuID, we’re dedicated to supporting you every step of the way. Whether you need help with your account, troubleshooting, or navigating features, our team is here to assist. Your convenience and security are our top priorities.</p>

			<details>
			    <summary>Got more questions? </summary>
			    <textarea id="user-question" placeholder="Ask your question here..."></textarea>
			    <button id="submit-btn">Submit</button>
			</details>
		</div>

		<div class="faqs">
		    <details>
		        <summary>Can I upload both front and back images of my IDs?</summary>
		        <p>Yes, QuID allows you to upload and store both front and back images of your IDs for complete digital documentation.</p>
		    </details>
		    <hr>

		    <details>
		        <summary>What should I do if I encounter issues with QuID?</summary>
		        <p>If you face any issues, our support team is here to help. You can reach out to us through the support section or refer to our help center for guides and FAQs.</p>
		    </details>
		    <hr>

		    <details>
		        <summary>Is QuID free to use?</summary>
		        <p>Yes, QuID offers a free plan with essential features. Premium plans with advanced features may also be available.</p>
		    </details>
		    <hr>

		    <details>
		        <summary>How do I recover my account if I forget my password?</summary>
		        <p>You can use the "Forgot Password" option on the login page to reset your password. Follow the steps, and you’ll regain access to your account securely.</p>
		    </details>
		    <hr>
		</div>
	</div>
</div>

	<footer>
        <div class="footer-container">
          <div class="footer-content-wrapper">
            <div class="footer-content">
              <h3 class="footer-heading"><b>Contact Us</b></h3>
              <p>
                <i class="fas fa-envelope"></i
                ><a href="mailto:quid2024@gmail.com">quid2024@gmail.com</a>
              </p>
              <p>
                <i class="fas fa-phone"></i
                ><a href="+63 (2) 123-4567">+63 (2) 123-4567</a>
              </p>
              <p>
                <i class="fas fa-map-marker-alt"></i
                ><a href="#">567 Street, Manila, Philippines</a>
              </p>
            </div>
            <div class="footer-content">
              <h3 class="footer-heading"><b>What is QuID?</b></h3>
              <ul class="footer-list">
                <li style="color: #006769;">
                  Your go to digital wallet extention.</li>
                <li style="color: #006769;">
                  QuId provides ease of access to your IDs with just one QR code.</li>
                <li style="color: #006769;">
                  A convenient web application to carry all your IDs.
                </li>
              </ul>
            </div>
            <div class="footer-content">
              <h3 class="footer-heading"><b>Follow Us</b></h3>
              <ul class="social-icons">
                <li>
                  <a
                    href="https://web.facebook.com/profile.php?id=61559189196062"
                    target="_blank"
                    rel="noreferrer"
                    ><i class="fab fa-facebook"></i
                  ></a>
                </li>
                <li>
                  <a
                    href="https://twitter.com/login"
                    target="_blank"
                    rel="noreferrer"
                    ><i class="fab fa-twitter"></i
                  ></a>
                </li>
                <li>
                  <a
                    href="https://www.instagram.com/accounts/login/?hl=en"
                    target="_blank"
                    rel="noreferrer"
                    ><i class="fab fa-instagram"></i
                  ></a>
                </li>
                <li>
                  <a
                    href="https://www.linkedin.com/login"
                    target="_blank"
                    rel="noreferrer"
                    ><i class="fab fa-linkedin"></i
                  ></a>
                </li>
              </ul>
            </div>
          </div>
  
          <div class="footer-bottom-bar">
            <p>&copy; 2024 QuID . All rights reserved</p>
          </div>
        </div>
    </footer>

	<script>
	document.getElementById('submit-btn').addEventListener('click', function() {
    const userQuestion = document.getElementById('user-question').value;

    if (userQuestion.trim() !== '') {
        alert('Your question has been submitted!');
        document.getElementById('user-question').value = '';
    } else {
        alert('Please enter your question before submitting.');
    }
	});

	async function confirmLogout() {
    // Show a confirmation dialog
    const userConfirmed = confirm("Are you sure you want to log out?");
    
    if (userConfirmed) {
        // If the user confirms, proceed with the logout request
		const response = await fetch('logout.php', { method: 'POST' }) // Make a POST request to the logout script

		
		if (response.ok) {
				alert('You have been logged out.');
				window.location.href = '/homepage/login.html'; // Redirect to the login page
			} else {
				alert('Logout failed. Please try again.');
			}
    } else {
        // User canceled the logout action
        console.log("Logout canceled by the user.");
    }
}
	</script>

</body>
</html>