
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <title>Forgot Password</title>
 
</head>
<body>


<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script>
        function findGetParameter(parameterName) {
        var result = null,
            tmp = [];
        location.search
            .substr(1)
            .split("&")
            .forEach(function (item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
            });
        return result;
    }
    const token = decrypt(findGetParameter('token'), 'goldberg')
    function decrypt(ciphertext, secretKey) {
        const bytes = CryptoJS.AES.decrypt(ciphertext, secretKey);
        return bytes.toString(CryptoJS.enc.Utf8);
    }
    createCookie('token', token, '1')
    
function createCookie(name, value, days) {
  var expires;
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toGMTString();
  }
  else {
    expires = "";
  }
  document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
}
</script>
<?php
require_once "database.php";
    
$token = $_COOKIE["token"]; //JS TO PHP VARIABLE
if (!$token) {
    echo "No token found in cookies.";
    exit;
try {
    $stmt = $pdo->prepare("SELECT * FROM usertable WHERE email = ?");
    $stmt->execute([$token]);
    $user = $stmt->fetch();
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <title>User Confirmation</title>
   <style>

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins';
    }

   .title {
      padding: 5%;
      width: 100%;
      color: #263A69;
      text-align: center;
      border-top-left-radius: 3%;
      border-top-right-radius: 3%;
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 5%;
    }

    body, html {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: whitesmoke;
    }

    .input-container {
      margin: auto;
      width: 60%;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      padding-right: 20px;
      padding-left: 20px;
      padding-bottom: 20px;
    }

    .input-field {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #dadce0;
      border-radius: 4px;
    }

    @media only screen and (max-width: 768px) {
    body {
        font-size: 14px;
        background-color: lightgrey;
    }
    .container {
        padding: 10px;
    }
}

@media only screen and (max-width: 480px) {
    body {
        font-size: 12px;
    }
    
    .header {
        font-size: 1.2em;
    }
    
    .container {
        padding: 5px;
    }
}
  </style>
  </style>
</head>
<body>
            <div class="input-container">
            <div class="title"><h1><b>QuID</b></h1></div>
            <form action="" method="POST" id="passwordForm">
            <label for="email">Please enter the New Password:</label>
            <input style="margin-bottom: 10px;" type="password" class="input-field" name="password" id="npass1" minlength="8" placeholder="Password" required>
        <label for="email">Please enter again:</label>
        <input style="margin-bottom: 10px;" type="password" class="input-field" id="npass2" placeholder="Password" minlength="8" required>
            <input style="background-color:#263A69 ; color: white; position: right; padding-right: 7%; padding-left: 7%; padding-top: 5px; padding-bottom: 5px; margin-left: 80%;" type="submit" value="Next">
            </form>
        </div>
        <!-- change the  exsiting password-->
    <script>
    const passwordForm = document.getElementById('passwordForm');
    passwordForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        //confirm enter again if same
        if (document.getElementById('npass1').value != document.getElementById('npass2').value) {
            document.getElementById('npass1').setCustomValidity("NOT SAME PASSWORD !")
            document.getElementById('npass1').reportValidity();
            return	
        }
        const formData = new FormData(passwordForm);
        const response = await fetch('resetpasswordupdate.php', {
            method: 'POST',
            body: formData        
        });
        const result = await response.text();
        //same in database old password
        if (result == 'same-password') {
            document.getElementById('npass1').setCustomValidity("SAME AS OLD PASSWORD!")
			document.getElementById('npass1').reportValidity();
        } else {
            alert('Password Changed! You can now login')
            window.location.href = "/login.php"
        }
    })
    var elements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
        };
    }
    </script>
</body>
</html>
