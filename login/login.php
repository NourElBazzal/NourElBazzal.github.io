<?php 
session_start();
require('../db_connect.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $email= $_POST['Email'];
  $password= $_POST['password'];

  // Prevent SQL injection by escaping user inputs (use prepared statements for production)
  $username = $conn->real_escape_string($email);
    
  // Query the user table for the provided username
  $query = "SELECT * FROM users WHERE Email='$email'";
  $result = $conn->query($query);
  
  if ($result->num_rows > 0) {
      // If a user with the provided username is found in the database, We then use the fetch_assoc() method to fetch the data from the first row of the result set as an associative array. This means that we can access the column values by their names. In this case, we retrieve the hashed password value and store it in the variable $hashedPassword.
      $row = $result->fetch_assoc();
      $hashedPassword = $row['Password'];
      $roleId= $row['role_id'];

      // Use password_verify to check if the input password matches the hashed password
      if (password_verify($password, $hashedPassword)) {
          // If the passwords match, set a session variable to indicate successful login
          $_SESSION['user'] = $email;
          $current_user = $_SESSION['user'];
          echo("$current_user");
          if($roleId == 1){
            header("Location: ../Admin/indexAdmin.php");
          }
          else{
            header("Location: ../index.php"); // Redirect to the main page after successful login
          }
          
      } else {
          // If passwords do not match, display an error message
          $message[] = 'Invalid password credentials';
      }
  } else {
      // If the provided username does not exist, display an error message
      $message[] = 'Invalid user credentials';
  }
}

/* If the user is not already authenticated, display the login form, with fields for the username and password.
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
}*/
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign in & Sign up Form</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
  
    .box{
        height: 640px;
      }

    .cursor-pointer{
      cursor: pointer;
    }

    .show_hide_text{
      position: absolute;
      top: 9px;
      right: 4px;
      font-size: 15px;
      color: #cf6f24;
    }
    .message{
      margin:10px 0;
      width: 100%;
      padding: 5px;
      border-radius: 10px;
      text-align: center;
      background-color: #cf6f24;
      color:white;
      font-size: 15px;
    }

    </style>
  </head>
  <body>
  <section class="sub-header">
        <div class="navbar">
            <div class="logoNav"><a href="../index.php"><span style="color:#cf6f24">Empower</span>Ability</a></div>
            <ul class="links">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../About/about.php">About</a></li>
                <li><a href="../Services/services.php">Services</a></li>
                <li><a  href="../GetInvolved/careers.php">Careers</a></li>
                <li><a href="../Explore/explore.php">Explore</a></li>
                <li><a href="../Contact/contact.php">Contact</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
            <a href="#" class="action_btn">Donate Now</a>
            <div class="toggle_btn"><i class="fa-solid fa-bars"></i></div>
        </div>
  </section>
  <div class="dropdown_menu">
  <li><a href="../index.php">Home</a></li>
            <li><a href="../About/about.php">About</a></li>
            <li><a href="../Services/services.php">Services</a></li>
            <li><a  href="../GetInvolved/careers.php">Careers</a></li>
            <li><a href="../Explore/explore.php">Explore</a></li>
            <li><a href="../Contact/contact.php">Contact</a></li>
            <li><a href="login.php">Login</a></li>
            <li> <a href="#" class="action_btn">Donate Now</a></li>
  </div>
    <main>
      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">

            <form class="sign-in-form" method="POST" enctype="multipart/form-data" >
        
              <div class="logo">
                <h4><span style="color:#cf6f24">Empower</span>Ability</h4>
              </div>

              <div class="heading">
                <h2>Welcome Back</h2>
                <h6>Not registred yet?</h6>
                <a href="signup.php" class="toggle" >Sign up</a>
              </div>

              <?php
                    if(isset($message)){
                        foreach($message as $message){
                            echo '<div class="message">'.$message.'</div>';
                        }
                    }
                ?>

              <div class="actual-form">
                <div class="input-wrap">
                  <input type="email" minlength="4" class="input-field" autocomplete="off" name="Email" required />
                  <label>Email</label>
                </div>

                <div class="input-wrap">
                  <div class="password_container">
                  <input type="password" minlength="4" class="input-field" autocomplete="off" name="password" id="password" required/>
                  <label>Password</label>
                  <span class="show_hide_text cursor-pointer" id="show_hide_password">Show</span>
                  </div>
                </div>

                <input type="submit" value="Sign In" class="sign-btn" />

                <p class="text">
                  Forgotten your password or you login details?
                  <a href="#">Get help</a> signing in
                </p>
              </div>
            </form>
          </div>

          <div class="carousel">
            <div class="images-wrapper">
              <img src="images/imageUpdated.png" class="image img-1 show" alt="" />
              <img src="images/image2Updated.png" class="image img-2" alt="" />
              <img src="images/image3Updated.png" class="image img-3" alt="" />
            </div>

            <div class="text-slider">
              <div class="text-wrap">
                <div class="text-group">
                  <h2>Join our community</h2>
                  <h2>Change the world to the better</h2>
                  <h2>Build new friendships</h2>
                </div>
              </div>

              <div class="bullets">
                <span class="active" data-value="1"></span>
                <span data-value="2"></span>
                <span data-value="3"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>


    <!-- Javascript file -->

    <script src="login.js"></script>
    <script>
      /* SHOW PASSWORD */
      const getId=(id)=>document.getElementById(id);
      const getSl=(selector)=>document.querySelector(selector);

      const password=getId("password");
      const show_hide_password=getId("show_hide_password");

      if(password){
          show_hide_password.addEventListener("click",function(){
          if(password.type==="password"){
              password.type="text";
              show_hide_password.innerText="Hide";
          }else{
              password.type="password";
              show_hide_password.innerText="Show";

              }
        })
      }
      
    </script>
  </body>
</html>