<?php
	session_start();
	if(!isset($_SESSION['username']))
	{
		header("Location: login.php");
		exit;
	}
  if (!empty($_SESSION['user_dp'])) {
    $dp = $_SESSION['user_dp'];

  } else {
      $imagePath = file_get_contents('images/user.jpg');
      $dp = base64_encode($imagePath);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>QuID Home</title>
    <link rel="stylesheet" href="css/homepage.css">
</head>
<body>
  <header>
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
  </header>

  <section id="homepage" class="content">
    <div class="overlay">
      <h2 style="color: white;">ID at your fingertips:<br>
      Fast, Easy, Secure Identification Anytime, Anywhere.</h2>
      <p>Introducing QuID (Quick Identification)—a secure, user-friendly platform that digitally stores and manages all your government IDs.<br> 
      Experience quick identification and seamless verification, giving you the convenience and security of having your essential documents<br>
      at your fingertips.</p>
      <a href="storagepage.php"><button style="margin-top: 20px;padding-left: 45px; padding-right: 45px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); color: white; background-color: #263A69; border-radius: 20px; height: 50px; border: none; font-size: 100%;"><b><i class="fa-solid fa-qrcode"></i> Get your QR here.</b></button>
      </a> </div>
  </section>
   
  <section class="box-container">
    <div class="box" id="box1">
    <div class="circle"><p><i class="fa-solid fa-database" style="font-size: 200%; text-align: center;"></i></p></div>
      <h3><u>Secure Digital Storage</u></h3>
      <p style="text-align: justify;"><br>Safeguard all your government-issued IDs in one centralized location, providing enhanced privacy compared
      to conventional screenshots or images.</p>
    </div>

    <div class="box" id="box2">
    <div class="circle"><p><i class="fa-solid fa-globe" style="font-size: 200%; text-align: center;"></i></p></div>
      <h3><u>Remote Access and Control</u></h3>
      <p style="text-align: justify;"><br>Recover your account on a new device, remotely lock or erase your digital IDs,
      and display a custom message on the lost phone for recovery.</p>
    </div>

    <div class="box" id="box3">
    <div class="circle"><p><i class="fa-solid fa-network-wired" style="font-size: 175%; text-align: center;"></i></p></div>
      <h3><u>Cross-Platform Compatibility</u></h3>
      <p style="text-align: justify;"><br>Seamlessly integrate your stored IDs for verification purposes across multiple platforms and applications, including Gcash, Paymaya, and others.</p>
    </div>
  </section>

  <h1 id="dashboard" class="dashboard-heading" style="text-align: center;">Welcome to your Dashboard, <span id="username">User</span>!</h1> <!-- mag change ung user to whatever his/her name is -->
  <div class="grid-container">
    <div class="grid-item">
      <a href="User-Overview.php"><button><i class="fa-solid fa-user"></i><br>Profile</button></a>
    </div>

    <div class="grid-item">
      <a href="User-Profile.php"><button><i class="fa-solid fa-gear"></i><br>Account Settings</button></a>
    </div>

    <div class="grid-item">
      <a href="storagepage.php"><button><i class="fa-solid fa-id-card"></i><br>Digital ID</button></a>
    </div>

    <div class="grid-item">
      <a href="User-Overview.php"><button><i class="fa-solid fa-clock-rotate-left"></i><br>Activities</button></a>
    </div>

    <div class="grid-item">
      <a onclick="confirmLogout()" id="logout"><button><i class="fa-solid fa-right-from-bracket"></i><br>Log Out</button></a>
    </div>
  </div>

  <footer>
    <div class="footer-container">
      <div class="footer-content-wrapper">
        <div class="footer-content">
          <h3 class="footer-heading"><b>Contact Us</b></h3>
          <p><i class="fas fa-envelope"></i><a href="mailto:quid2024@gmail.com">quid2024@gmail.com</a></p>
          <p><i class="fas fa-phone"></i><a href="+63 (2) 123-4567">+63 (2) 123-4567</a></p>
          <p><i class="fas fa-map-marker-alt"></i><a href="#">567 Street, Manila, Philippines</a></p>
        </div>
        <div class="footer-content">
          <h3 class="footer-heading"><b>What is QuID?</b></h3>
          <ul class="footer-list">
            <li style="color: #006769;">Your go to digital wallet extention.</li>
            <li style="color: #006769;">QuId provides ease of access to your IDs with just one QR code.</li>
            <li style="color: #006769;">A convenient web application to carry all your IDs.</li>
          </ul>
        </div>
        <div class="footer-content">
          <h3 class="footer-heading"><b>Follow Us</b></h3>
          <ul class="social-icons">
            <li><a href="https://web.facebook.com/profile.php?id=61559189196062" target="_blank" rel="noreferrer"><i class="fab fa-facebook"></i></a></li>
            <li><a href="https://twitter.com/login" target="_blank" rel="noreferrer"><i class="fab fa-twitter"></i></a></li>
            <li><a href="https://www.instagram.com/accounts/login/?hl=en" target="_blank" rel="noreferrer"><i class="fab fa-instagram"></i></a></li>
            <li><a href="https://www.linkedin.com/login" target="_blank" rel="noreferrer"><i class="fab fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom-bar">
        <p>&copy; 2024 QuID . All rights reserved</p>
      </div>
    </div>
  </footer>

  <script>
 async function confirmLogout() {
    // Show a confirmation dialog
    const userConfirmed = confirm("Are you sure you want to log out?");
    
    if (userConfirmed) {
        // If the user confirms, proceed with the logout request
		const response = await fetch('logout.php', { method: 'POST' }) // Make a POST request to the logout script

		
		if (response.ok) {
				alert('You have been logged out.');
				window.location.href = '/homepage/login.php'; // Redirect to the login page
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

