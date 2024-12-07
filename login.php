<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		header("Location: /homepage.php");
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>QuID | Log in</title>
	<link rel="stylesheet" href="css/login.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

</head>
<body>
	<div class="container" id="container">
		<!-- Registration Form -->
		<div class="form-container sign-up">
			<form id="registerForm"  action="" method="POST">
				<h1>Create Account</h1>
				<hr>
				<div class="full-name">
					<div class="input-icon">
						<input type="text" id="fname" name="fname" placeholder="First Name" required>
						<i class="fa-solid fa-user"></i>
					</div>
					<div class="input-icon">
						<input type="text" id="lname" name="lname" placeholder="Last Name" required>
						<i class="fa-solid fa-user"></i>
					</div>
				</div>
				<div class="input-icon">
					<input type="text" id="username" name="username" placeholder="Username" required>
					<i class="fa-solid fa-user"></i>
				</div>
				<div class="input-icon">
					<input type="tel" id="phone" name="phone" placeholder="Phone number" required>
					<i class="fa-solid fa-phone"></i>
				</div>
				<div class="input-icon">
					<input type="email"  id="email" name="email" placeholder="Email" required>
					<i class="fa-solid fa-envelope"></i>
				</div>
				<div class="input-icon">
					<input type="password" id="password" name="password" placeholder="Password" minlength="8" required>
					<i class="fa-solid fa-lock"></i>
				</div>
				<div class="input-icon">
					<input type="password" id="confirm-password" placeholder="Confirm Password" minlength="8" required>
					<i class="fa-solid fa-lock" style="color: #263a69;"></i>
				</div>
				<button type="submit">Sign Up</button>
			</form>
		</div>

		<!-- Login Form -->
		<div class="form-container sign-in">
			<form id="loginForm" action="login.php" method="POST">
				<h1>Sign in to QuID</h1>
				<hr>
				<div class="input-icon">
					<input type="email" name="email" placeholder="Email" required>
					<i class="fa-solid fa-envelope"></i>
				</div>
				<div class="input-icon">
					<input type="password" name="password" id="loginpassword" placeholder="Password" required>
					<i class="fa-solid fa-lock"></i>
				</div>
				<a href="recovery.html">Forgot your password?</a>
				<button type="submit">Sign In</button>
				<div class="policy">
					<a href="#">Privacy Policy |</a>
					<a href="#">Terms and Conditions</a>
				</div>
			</form>
		</div>

		<!-- Toggle Panels -->
		<div class="toggle-container">
			<div class="toggle">
				<div class="toggle-panel toggle-left">
					<h2>Welcome back!</h2>
					<p>Log in to access your digital IDs and manage your account securely.</p>
					<button id="login">Sign In</button>
				</div>
				<div class="toggle-panel toggle-right">
					<h2>Let's get you set up.</h2>
					<p>It should only take a couple of minutes to create your account.</p>
					<button id="register">Sign Up</button>
				</div>
			</div>
		</div>
	</div>

	<script>
    // Get references to the elements
    const registerBtn = document.getElementById('register');
    const loginBtn = document.getElementById('login');
    const container = document.getElementById('container');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');

    // Toggle to registration form when "Sign Up" button is clicked
    registerBtn.addEventListener('click', () => {
        container.classList.add("active");
    });

    // Toggle to login form when "Sign In" button is clicked
    loginBtn.addEventListener('click', () => {
        container.classList.remove("active");
    });

    // Validate Philippine phone number format
    const isValidPhoneNumber = (phone) => /^(\+639|09)\d{9}$/.test(phone);

    // Validate email format
    const isValidEmail = (email) =>
        /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email);

    // Handle login form submission
    loginForm.addEventListener('submit', async (event) => {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(loginForm);
        const response = await fetch('loginCheck.php', {
            method: 'POST',
            body: formData
        });
        const result = await response.text();

        if (result === 'success') {
            window.location.href = 'homepage.php'; // Redirect on successful login
        } else if (result === 'not_found') {
            const wantsToRegister = confirm("Account not found. Would you like to create a new account?");
            if (wantsToRegister) {
                container.classList.add("active");
            }
        } else if (result == 'incorrect_password'){
			document.getElementById('loginpassword').setCustomValidity("Incorrect password. Please try again.")
			document.getElementById('loginpassword').reportValidity();
        } else {
			alert(result)
		}
    });

    // Handle registration form submission
    registerForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        const formData = new FormData(registerForm);
        const phone = formData.get("phone");
        const email = formData.get("email");
		if (document.getElementById('password').value != document.getElementById('confirm-password').value) {
            document.getElementById('password').setCustomValidity("NOT SAME PASSWORD !")
			document.getElementById('password').reportValidity();
			return	
		}
			// Client-side validation
        if (!isValidPhoneNumber(phone)) {
            document.getElementById('phone').setCustomValidity("Invalid phone number! Please use a valid Philippine number (e.g., +639123456789 or 09123456789).")
			document.getElementById('phone').reportValidity();
            return;
        }
        if (!isValidEmail(email)) {
            document.getElementById('email').setCustomValidity("Invalid email address! Please enter a valid email.")
			document.getElementById('email').reportValidity();
            return;
        }

        const response = await fetch('register.php', {
            method: 'POST',
            body: formData
        });
        const result = await response.json(); // Assuming the server responds with JSON

        if (result.status === 'success') {
            const wantsToLogin = confirm("Registration successful! Would you like to log in now?");
            if (wantsToLogin) {
                container.classList.remove("active"); // Switch to login form
				registerForm.reset(); // Reset the form
            } 
                
            
        } else if (result.message === 'duplicate_email') {
            document.getElementById('email').setCustomValidity("A user with this email already exists!")
			document.getElementById('email').reportValidity();
		} else if (result.message === 'duplicate_username') {
            document.getElementById('username').setCustomValidity("A user with this username  already exists!")
			document.getElementById('username').reportValidity();
        } else if (result.message === 'invalid_phone') {
            document.getElementById('phone').setCustomValidity("Invalid phone number format.")
			document.getElementById('phone').reportValidity();
        } else if (result.message === 'invalid_email') {
			document.getElementById('email').setCustomValidity('Invalid email format')
			document.getElementById('email').reportValidity();
        } else {
            alert("An error occurred during registration. Please try again.");
        }
    });
	var elements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
        };
    }
	
</script>

</body>
</html>
