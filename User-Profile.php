<?php
	session_start();
	if(!isset($_SESSION['username']))
	{
		header("Location: /login.php");
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
	<title>QuID | Account Settings</title>
	<link rel="icon" href="logo-title.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/User-Profile.css">
</head>
<body>
	<div id="main">
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
        <div class="sidebar">
	        <h2>SYSTEM SETTINGS</h2>
		    <div class="settings-section">
		        <h3>ACCOUNT & PROFILE</h3>
		        <ul>
		            <li><a href="#" onclick="showTab('profile')"><i class="fas fa-user"></i> User Profile Settings</a></li>
		        </ul>
		    </div>
		    <div class="settings-section">
		        <h3>PREFERENCES</h3>
		        <ul>
		            <li><a href="#" onclick="showTab('Notification')"><i class="fas fa-bell"></i> Notification Preferences</a></li>
		        </ul>
		    </div>
		    <div class="settings-section">
		        <h3>SUPPORT</h3>
		        <ul>
		            <li><a href="About-us.php#support"><i class="fas fa-question-circle"></i> Help & Support</a></li>
		        </ul>
		    </div>
		    <div class="settings-section">
		        <h3>SESSION</h3>
		        <ul>
		            <li onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Logout</li>
		        </ul>
		    </div>
        </div>


        <div class="main-content">
	        	<!-- User profile settings tab -->
	            <div id="profile" class="tab-content active">
                    <div class="legend-container">
                  <legend>USER PROFILE SETTINGS</legend>
                  <hr>
              </div>
              <p><br>Take control of your account by updating your profile information, changing your security settings, and personalizing your experience.</p>
              <div class="profile-container">
                <div class="profile-settings">
                        <label for="profile-pic">PROFILE PICTURE :</label>
                        <p>Keep your profile picture current.</p>
                        <div class="container-dp">
							<form action="" id="imageForm"  enctype="multipart/form-data" method="post">
                            <input type="file" id="file" name="file" accept="image/*" hidden onchange="previewImage(event)"></form>
                                <div class="img-area" id="imgArea"><img src="data:image/jpeg;base64,<?php echo htmlspecialchars($dp); ?>" alt=""></div>
                            <button class="select-image" onclick="document.getElementById('file').click();">CHANGE PHOTO</button>
							<?php if(!empty($_SESSION['user_dp'])): ?>
                            <button class="remove-photo" onclick="removeImage();">REMOVE PHOTO</button>
							<?php endif; ?>
                        </div>  
						<form id="settingsForm">
						<button type="submit" id="save-changes">SAVE CHANGES</button>
                </div>

						<div class="inputs">
									<label for="information">PERSONAL INFORMATION :</label>
									<p>Ensure your information is current. Edit your email, username, contact number, and password securely here.</p>
									<div class="input-data">
										
									</div>
									<div class="input-data">
										<input type="text"  name="username" placeholder="Change Username">
									</div>
									<div class="input-data">
										<input type="email" id="email" name="email" placeholder="Change Email">
									</div>
									<div class="input-data">
										<input type="password" id="password" name="password" placeholder="Change Password">
									</div>
									<div class="input-data">
										<input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
									</div>
									<div class="Save"> 
									
									</div>
								</form>
								<br><br>
								<div class="delete">
				                	<label for="Delete">ACCOUNT DELETION</label>
				                	<p>Request to delete your account and data.</p>
				                	<button type="button" onclick="deleteAcc()" id="delete-acc"><i class="fa-solid fa-trash"></i>&nbsp;&nbsp;&nbsp;&nbsp;Remove Account</button>
				                </div>
		                	</div>
		                </div>
	            </div>
						<script>
									const sessionData = {
							username: "<?php echo $_SESSION['username']; ?>",
							email: "<?php echo $_SESSION['email']; ?>"
						};

						document.addEventListener('DOMContentLoaded', () => {
							const usernameInput = document.querySelector('input[name="username"]');
							const emailInput = document.querySelector('input[name="email"]');
							const passwordInput = document.querySelector('input[name="password"]');
							const confirmPasswordInput = document.querySelector('input[name="confirm_password"]');
							const form = document.getElementById('settingsForm');

							if (usernameInput) {
								usernameInput.addEventListener('input', function () {
									if (this.value.trim() === sessionData.username) {
										this.setCustomValidity('This username is the same as your current one.');
									} else {
										this.setCustomValidity('');
									}
								});
							}

							if (emailInput) {
								emailInput.addEventListener('input', function () {
									if (this.value.trim() === sessionData.email) {
										this.setCustomValidity('This email is the same as your current one.');
									} else {
										this.setCustomValidity('');
									}
								});
							}

							if (passwordInput) {
								passwordInput.addEventListener('input', function () {
									if (this.value.trim() === '') {
										this.setCustomValidity('Please enter a new password.');
									} else {
										this.setCustomValidity('');
									}
								});
							}

							if (confirmPasswordInput) {
								confirmPasswordInput.addEventListener('input', function () {
									if (this.value.trim() !== passwordInput.value.trim()) {
										this.setCustomValidity('Passwords do not match.');
									} else {
										this.setCustomValidity('');
									}
								});
							}

							form.addEventListener('submit', async function (e) {
								e.preventDefault(); // Prevent default form submission

								const formData = new FormData();
								const username = usernameInput.value.trim();
								const email = emailInput.value.trim();
								const password = passwordInput.value.trim();
								
								const confirmPassword = confirmPasswordInput.value.trim();

								// Add fields only if they are changed
								if (username && username !== sessionData.username) {
									formData.append('username', username);
								}
								if (email && email !== sessionData.email) {
									formData.append('email', email);
								}
								if (password && password === confirmPassword) {
									formData.append('confirm_password', confirmPassword);
									formData.append('password', password);
								} else if (password && confirmPassword == '') {
									alert('Empty confirm Password')
									return
								} else if (password) {
									alert('Wrong confirm Password!')
									return
								}

								// Check if at least one field was added
								if (![...formData.keys()].length) {
									alert('Please change at least one field before saving.');
									return;
								}

								// Send the updated data to the server
								const response = await fetch('resetall.php', {
									method: 'POST',
									body: formData,
								});

								const result = await response.text();
								if (result === 'success') {
									alert('Changes saved successfully!');
									location.reload(); // Reload page to update session data
								} else {
									alert(result);
								}
							});
							
						});

				</script>
       
	            <!-- Notification tab -->

	            <div id="Notification" class="tab-content">
	            	<fieldset>
	            		<div class="legend-container">
	            			<legend>NOTIFICATION PREFERENCES</legend>
        					<hr>
        				</div>
        				<p><br>Manage your profile settings to personalize your experience and keep your information up to date.</p>
						<div class="notification-customize">
						    <div class="notification-item">
						        <div class="left-side">
						            <label for="Email-notif">Email Notifications</label>
						            <p>Receive email notifications for account activity</p>
						        </div>
						        <div class="toggle-container">
						            <input type="checkbox" id="Email-notif">
						            <span class="slider"></span>
						        </div>
						    </div>
						            <hr>
						    
						    <div class="notification-item">
						        <div class="left-side">
						            <label for="Sms">SMS Notifications</label>
						            <p>Receive SMS alerts for account changes.</p>
						        </div>
						        <div class="toggle-container">
						            <input type="checkbox" id="Sms">
						            <span class="slider"></span>
						        </div>
						    </div>
						    <hr>
						    
						    <div class="notification-item">
						        <div class="left-side">
						            <label for="Alerts">Account Activity Alerts</label>
						            <p>Notify me about login activity.</p>
						        </div>
						        <div class="toggle-container">
						            <input type="checkbox" id="Alerts">
						            <span class="slider"></span>
						        </div>

						    </div>
						    <hr>
						    <div class="notification-item">
						        <div class="left-side">
						            <label for="Sound">Sound Alerts</label>
						            <p>Enable sound alerts for notifications.</p>
						        </div>
						        <div class="toggle-container">
						            <input type="checkbox" id="Sound">
						            <span class="slider"></span>
						        </div>
						    </div>
						    <hr>
						</div>
	            	</fieldset>
	            </div>
	            </div>
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

function showTab(tabId) {
    // Remove the 'active' class from all tabs
    var tabs = document.querySelectorAll('.tab-content');
    tabs.forEach(function(tab) {
        tab.classList.remove('active');
    });

    // Add the 'active' class to the selected tab
    var activeTab = document.getElementById(tabId);
    activeTab.classList.add('active');
}

// Changing profile pic
async function previewImage(event) {
    const file = event.target.files[0]; // Get the uploaded file
    if (file) {
		const formData = new FormData(document.getElementById('imageForm'))
            const response = await fetch('updateDp.php', {	method: 'POST',body: formData})
            const result = await response.text();
			alert(result)
        location.reload();
    }
}

// Removing and confirm profile pic
async function removeImage() {
    const confirmation = confirm("Are you sure you want to remove the photo?"); // Confirmation dialog
    if (confirmation) {
		const response = await fetch('deleteDp.php', {	method: 'POST'})
		const result = await response.text();
		alert(result)

        location.reload();
    } else {
        console.log("Image removal canceled"); // Optional log if canceled
    }
}

async function confirmLogout() {
    // Show a confirmation dialog
    const userConfirmed = confirm("Are you sure you want to log out?");
    
    if (userConfirmed) {
        // If the user confirms, proceed with the logout request
		const response = await fetch('logout.php', { method: 'POST' }) // Make a POST request to the logout script

		
		if (response.ok) {
				alert('You have been logged out.');
				window.location.href = '/login.php'; // Redirect to the login page
			} else {
				alert('Logout failed. Please try again.');
			}
    } else {
        // User canceled the logout action
        console.log("Logout canceled by the user.");
    }
}

async function deleteAcc() {
	const confirmation = confirm("Are you sure you want to delete your account? These Cannot be Undo."); // Confirmation dialog
    if (confirmation) {
		const response = await fetch('deleteAcc.php', {	method: 'POST'})
		const result = await response.text();
		alert(result)
        location.reload();
    } else {
        console.log("Account removal canceled"); // Optional log if canceled
    }
}





</script>
</body>
</html>