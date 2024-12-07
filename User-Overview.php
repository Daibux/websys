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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="css/User-Overview.css">
    <title></title>
</head>
<body> <!-- Lahat ng andito (inputs, images etc), placeholder lang lahat para alam nyo kung papaano yung layout nya :) -->
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

    <div class="container">
        <div class="side-profile">
            <img src="data:image/jpeg;base64,<?php echo htmlspecialchars($dp); ?>" alt="Profile Picture" class="profile-pic">
            <h2><?php echo $_SESSION['username'] ?></h2>
        </div>
        <div class="profile-info">
            <h2>My Profile</h2>
            <div class="form-row">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" id="fname" value="John" readonly >
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" id="lname" value="Doe" readonly>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" id="phone" value="555-237-2384" readonly>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" id="email" value="JohnDoe@m" readonly>
                </div>
            </div>
            

    <a href="storagepage.php" class="upload-btn">Upload New ID</a>
    <!-- View Activity Log Button --> 
    <button id="view-audit-trail" class="open-modal-btn">View Activity Log</button>

    <!-- Modal Container -->
    <div id="modal-container" class="modal" style="display: none;">
        <div class="modal-content">
            <span id="modal-close" class="close">&times;</span>
            <!-- Audit trail data will be dynamically injected here -->
            <div id="modal-body"></div>
        </div>
    </div>
            <div class="container-bottom"></div>
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
      document.getElementById('email').value = "<?php echo htmlspecialchars($_SESSION['email']); ?>";
      document.getElementById('phone').value = "<?php echo htmlspecialchars($_SESSION['phone']); ?>";
      document.getElementById('fname').value = "<?php echo htmlspecialchars($_SESSION['fname']); ?>";
      document.getElementById('lname').value = "<?php echo htmlspecialchars($_SESSION['lname']); ?>";
      document.getElementById('view-audit-trail').onclick = function () {
        console.log('Fetching audit trail...');
        fetch('audit.php') // Fetch the activity log
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                document.getElementById('modal-body').innerHTML = data; // Populate modal with data
                document.getElementById('modal-container').style.display = 'flex'; // Show modal
                console.log('Audit trail loaded successfully');
            })
            .catch(error => {
                console.error('Error fetching audit trail:', error);
                document.getElementById('modal-body').innerHTML = 'Unable to load audit log. Please try again later.';
                document.getElementById('modal-container').style.display = 'flex'; // Show modal with error
            });
      }

        // Close modal when clicking the close button
            document.getElementById('modal-close').addEventListener('click', function () {
            document.getElementById('modal-container').style.display = 'none';
            console.log('Modal closed');
        });

        // Close modal when clicking outside of the modal content
        window.addEventListener('click', function (event) {
            const modalContainer = document.getElementById('modal-container');
            if (event.target === modalContainer) {
                modalContainer.style.display = 'none';
                console.log('Modal closed via outside click');
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