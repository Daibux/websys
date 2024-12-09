<?php
	session_start();
	if($_SESSION['username'] == '')
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
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/storagepage.css">
    <title>QuID - ID Storage</title>

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
        
    <main >
        <section class="form-section">
            <h2>Store Your ID</h2>
            <hr width="40%" color="#838DB1" size="3">
    
            <form id="idForm" action="" method="POST" enctype="multipart/form-data">
                <label for="idType">ID Type:</label>
                <select id="idType" name="idType" required>
                    <option value="" disabled selected>Select ID Type</option>
                    <option value="Student ID">Student ID</option>
                    <option value="National ID">National ID</option>
                    <option value="Passport">Passport</option>
                    <option value="Employee ID">Employee ID</option>
                    <option value="Driver's License">Driver's License</option>
                    <option value="Other ID">Other ID</option>

                </select>

                <label for="idNumber">ID Number:</label>
                <input type="text" id="idNumber" name="idNumber" placeholder="Enter ID Number" required>

                <label for="frontIdImage">Upload Front ID Image:</label>
                <input type="file" id="frontIdImage" name="frontIdImage" accept="image/*" required style="display: none;">
                <div class="img-area select-image-front" data-img="">
                    <i class="fa-solid fa-plus"></i>
                    <h3>Add Front ID</h3>
                </div>

                <label for="backIdImage">Upload Back ID Image:</label>
                <input type="file" id="backIdImage" name="backIdImage" accept="image/*" required style="display: none;">
                <div class="img-area select-image-back" data-img="">
                    <i class="fa-solid fa-plus"></i>
                    <h3>Add Back ID</h3>
                </div>

                <button type="submit">Save ID</button>
            </form>
        </section>

        <section class="display-section">
            <h2>Stored IDs</h2>
            <hr width="40%" color="#838DB1" size="3">
            <div class="select-id-section">
                <label for="idDropdown">Select Stored IDs:</label>
                <select id="idDropdown">
                    <!-- <option value="">Select ID</option> -->
                </select>
            </div>
            <div id="idContainer" class="no-id">
            </div>
            <div style="margin-top: auto; width: 50%; align-self: flex-end; display: flex; justify-content: flex-end">
            <button  id="delete-id" style="background-color: red;" ><i class="fa-solid fa-trash"></i> Remove ID</button>
            </div>
<!-- // delete id /button -->
</section>
      </form> 
    </main>

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
        const frontSelectImage = document.querySelector('.select-image-front');
        const backSelectImage = document.querySelector('.select-image-back');
        const frontInputFile = document.querySelector('#frontIdImage');
        const backInputFile = document.querySelector('#backIdImage');
        const frontImgArea = document.querySelector('.select-image-front');
        const backImgArea = document.querySelector('.select-image-back');
		const idForm = document.getElementById('idForm');

        // Trigger file input when img-area is clicked
        frontSelectImage.addEventListener('click', function () {
            frontInputFile.click();
        });

       frontInputFile.addEventListener('change', function () {
            const image = this.files[0];
            if (image && image.size < 2000000) {
                const reader = new FileReader();
                    reader.onload = () => {
                    frontImgArea.innerHTML = ''; // Clear previous content
                    const img = document.createElement('img');
                    img.src = reader.result;
                    frontImgArea.appendChild(img);
                    frontImgArea.classList.add('active');
                    frontImgArea.dataset.img = image.name;
                };
                reader.readAsDataURL(image);
            } else {
                alert("Front ID image size must be less than 2MB.");
            }
        });

        // Back ID image click to upload
        backSelectImage.addEventListener('click', function () {
            backInputFile.click();
        });

        backInputFile.addEventListener('change', function () {
            const image = this.files[0];
            if (image && image.size < 2000000) {
                const reader = new FileReader();
                reader.onload = () => {
                    backImgArea.innerHTML = ''; // Clear previous content
                    const img = document.createElement('img');
                    img.src = reader.result;
                    backImgArea.appendChild(img);
                    backImgArea.classList.add('active');
                    backImgArea.dataset.img = image.name;
                };
                reader.readAsDataURL(image);
            } else {
                alert("Back ID image size must be less than 2MB.");
            }
        });
        var qrData;
        // Save ID and add details to the display section
        idForm.addEventListener('submit', async (event) => {
            event.preventDefault();
	
            const formData = new FormData(idForm);
            const response = await fetch('qr.php', {
              method: 'POST',
              body: formData
             if (response.ok) {
                  // Reset the form inputs
                  idForm.reset();
                  console.log('Form submitted and reset successfully.');
              } else {
                  console.error('Failed to submit the form.');
              }
              });
            qrData = await response.text();
            if (qrData == 'duplicate_id_type') {
              alert('Duplicate Id Type')
              return
            } else {
              location.reload();
            }
       
            
            
            
                  // const idType = document.getElementById('idType').value;
                  // const idNumber = document.getElementById('idNumber').value;
                  // const frontIdImage = document.getElementById('frontIdImage').files[0];
                  // const backIdImage = document.getElementById('backIdImage').files[0];
                  
            if (!idType || !idNumber || !frontIdImage || !backIdImage) {
                alert("Please fill out all fields.");
                return;
            }

            // Load both images before displaying
            // const frontReader = new FileReader();
            // const backReader = new FileReader();

            //     frontReader.onload = function(e) {
            //         const frontImageSrc = e.target.result;

            //     backReader.onload = function(e) {
            //         const backImageSrc = e.target.result;   
            //         addToDropdown(idType, idNumber, frontImageSrc, backImageSrc);
            //     };

            //     backReader.readAsDataURL(backIdImage);
            // };
            //     frontReader.readAsDataURL(frontIdImage);

        });
        var qrDatas;
        qrDataUpdate()
        function qrDataUpdate() {
            const idDropdown = document.getElementById('idDropdown');
            fetch('qr_data.php') // Adjust the path to your PHP script
            .then(response => response.json()) // Parse the JSON response
            .then(data => {
                qrDatas = data; 
                
                qrDatas.forEach(element => {
                const newOption = document.createElement('option');
                console.log(element);
                
                newOption.value = element.id_number;
                newOption.textContent = element.id_type + " - " + element.id_number;
                idDropdown.appendChild(newOption);
                const idContainer = document.getElementById('idContainer');
                idContainer.classList.remove('no-id');
                
                const qrCodeURL = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(qrDatas[0].qr_data)}&size=200x200`;
                idContainer.innerHTML = `
                    <img src="${qrCodeURL}" alt="QR Code " />
                `;
                
              });
              if (qrDatas.length == 0) {
                  idContainer.innerHTML = `
                    <p>Insert an Id to display a qr code</p>
                `;
                }
            })
        }
        // Event listener for dropdown selection
        //     function addToDropdown(idType, idNumber, frontImageSrc, backImageSrc) {
        //     const idDropdown = document.getElementById('idDropdown');
        //     const newOption = document.createElement('option');

        //     newOption.value = `${idType}_${idNumber}`;
        //     newOption.textContent = `${idType} - ${idNumber}`;
        //     newOption.dataset.frontImage = frontImageSrc;
        //     newOption.dataset.backImage = backImageSrc;

        //     idDropdown.appendChild(newOption);

        //     // Update the container message
        //     const idContainer = document.getElementById('idContainer');
        //     idContainer.classList.remove('no-id');
        // }
        document.getElementById('delete-id').addEventListener('click', async (event) => {
            event.preventDefault();
            const userConfirmed = window.confirm("Are you sure you want to delete this ID?");
    if (!userConfirmed) {
        // If the user cancels, exit the function
        return;
            }
    const selectElement = document.getElementById('idDropdown');
    const selectedIndex = selectElement.selectedIndex; // Get the selected index
    const selectedOption = selectElement.options[selectedIndex]; // Get the selected option

    console.log("Selected Index:", selectedIndex);
    console.log("Selected Option Text:", selectedOption.textContent);
    console.log("Selected Option Value:", selectedOption.value);

    // Extract id_type if the text is in the format "id_type - id_number"
    const selectedText = selectedOption.textContent;
    const idType = selectedText.split(" - ")[0]; // Get the part before " - "



            const data = {
              id_type: idType,
              id_number: selectedOption.value,

            }
            const formData = new FormData();
            const response = await fetch('deleteId.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            result = await response.text();
            if (result == 'record_deleted') {
              alert('Id has been deleted')
              location.reload();
              return
            } 
          })
        document.getElementById('idDropdown').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            var qrCodeURL;
            if (selectedOption.value) {
                // const frontImageSrc = selectedOption.dataset.frontImage;
                // const backImageSrc = selectedOption.dataset.backImage;
                qrCodeURL = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(qrDatas[this.selectedIndex].qr_data)}&size=200x200`;
                console.log(qrDatas[this.selectedIndex].qr_data);
                
                // Update the `idContainer` with the QR code
                const idContainer = document.getElementById('idContainer');
                idContainer.innerHTML = `
                    <img src="${qrCodeURL}" alt="QR Code for ${selectedOption.textContent}" />
                `;
            } else {
                const idContainer = document.getElementById('idContainer');
                idContainer.innerHTML = "<p>Select a Student ID to scan</p>";
                //save qr -> db
                // read db -> array -> option ng dropdown
                //when option is changed palitan ung qr based on qrdata from array
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
				window.location.href = '/login.php'; // Redirect to the login page
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
