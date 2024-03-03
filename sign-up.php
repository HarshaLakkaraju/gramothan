<?php
session_start(); // Start session

$error = "";

// Check if user is already logged in
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php"); // Redirect to dashboard
    exit();
}

// Check if signup form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate input fields
    $errors = array();

    if (empty($name)) {
        $errors['name'] = 'Name is required';
    }

    if (empty($mobile)) {
        $errors['mobile'] = 'Mobile number is required';
    } elseif (!preg_match('/^\d{10}$/', $mobile)) {
        $errors['mobile'] = 'Mobile number should contain 10 digits';
    }

    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }

    if (empty($username)) {
        $errors['username'] = 'Username is required';
    } elseif (strlen($username) < 5) {
        $errors['username'] = 'Username should be at least 5 characters';
    }

    if (empty($password)) {
        $errors['password'] = 'Password is required';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Password should be at least 8 characters';
    }

    // If there are no validation errors, proceed with signup
    if (empty($errors)) {
        // Add user to database
        // Redirect to login page
        header("Location: login.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

/* Add a background color when the inputs get focus */
input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #474e5d;
  padding-top: 50px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}
 
/* The Close Button (x) */
.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}

.close:hover,
.close:focus {
  color: #f44336;
  cursor: pointer;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}

</style>

<body>
  <form method="post">

    <div class="container">
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>

      <label for="name"><b>Name</b></label>
      <input type="text" placeholder="Enter Full name" name="name" required 
        value= "<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
        <?php if (isset($errors['name'])) { ?>
            <div><?php echo $errors['name']; ?></div>
        <?php } ?><br><br>

      <label for="mobile"><b>Mobile No</b></label>
      <input type="tel" placeholder="Enter Mobile number" name="mobile" required
        value="<?php echo isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile']) : ''; ?>">
        <?php if (isset($errors['mobile'])) { ?>
            <div><?php echo $errors['mobile']; ?></div>
        <?php } ?><br><br>
      

      <label for="email"><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="email" required
      value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
        <?php if (isset($errors['email'])) { ?>
            <div><?php echo $errors['email']; ?></div>
        <?php } ?><br><br>


      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="Enter User name" name="username" required
        value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
        <?php if (isset($errors['username'])) { ?>
            <div><?php echo $errors['username']; ?></div>
        <?php } ?><br><br>

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required
        value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>">
        <?php if (isset($errors['password'])) { ?>
            <div><?php echo $errors['password']; ?></div>
        <?php } ?><br><br>

      <label for="psw-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
      
      <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
      </label>

      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Sign Up</button>
      </div>
    </div>
    <?php

    if ($username === 'myusername' && $password === 'mypassword') {
        $_SESSION['username'] = $username; // Set session variable
        header("Location: home.php"); // Redirect to home page
        exit();
    } else {
        $error = 'Invalid username or password';
    }

?>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>