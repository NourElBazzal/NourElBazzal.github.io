
<?php
// Include the database connection file
require('../db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone= $_POST['phone'];
    $chosenService = $_POST["chosen-service"];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Securely hash the password

    if ($chosenService != -1) {
      // Insert user data into the 'user' table
      $sql = "INSERT INTO users (FullName, Username, Email, Password, PhoneNumber, role_id) VALUES ('$name', '$username', '$email','$password', '$phone', 3)";
      
      if ($conn->query($sql) === TRUE) {
        // Get the user ID of the newly inserted user
        $user_id = $conn->insert_id;
  
        // Insert the selected service into the services_users table
        $sqlInsertService = "INSERT INTO services_users (user_id, service_id) VALUES ('$user_id', '$chosenService')";
  
        if ($conn->query($sqlInsertService) === TRUE) {
          // Redirect to a success page
          echo "Registration successful!";
          header('Location: login.php');
      } else {
          echo "Error: " . $sqlInsertService . "<br>" . $conn->error;
      }
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
  }
}


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
      .filter-select{
          border: none;
          padding: 0.2rem;
          margin-bottom: 30px;
          color: #959595;
      }

    .filter-select:hover{
          background: #f6f8fa;
      }

    .box{
        height: 800px;
      }

    .heading{
        margin-bottom: 20px;
    }

    </style>
  </head>
  <body>
    <header>
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
  </header>
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
           
            <form class="sign-in-form" method="POST" enctype="multipart/form-data">
              <div class="logo">
                <h4><span style="color:rgb(255, 128, 0)">Empower</span>Ability</h4>
              </div>

              <div class="heading">
                <h2>Get Started</h2>
                <h6>Already have an account?</h6>
                <a href="login.php" class="toggle">Sign in</a>
              </div>

              <div class="actual-form">
                <div class="input-wrap">
                  <input type="text" minlength="4" class="input-field" autocomplete="off" name="name" required/>
                  <label>Full Name</label>
                </div>

                <div class="input-wrap">
                  <input type="text" minlength="4" class="input-field" autocomplete="off" name="username" required/>
                  <label>Username</label>
                </div>

                <div class="input-wrap">
                  <input type="number" class="input-field" autocomplete="off" name="phone" required/>
                  <label>Phone Number</label>
                </div>

                <select class="filter-select" name="chosen-service" id="chosen-service">
                <option id="-1">Service you want to donate to</option>
                <?php
                  $query= "SELECT * FROM services";
                  $result= mysqli_query($conn, $query);

                  while($row = mysqli_fetch_array($result)){
                    
                    $id= $row["ServiceID"];
                    $type= $row["Type"];

                     echo "<option value='$id'>$type</option>";                    
                  }
                  
                  ?>
                   </select>

                <div class="input-wrap">
                  <input type="email" class="input-field"  autocomplete="off" name="email" required/>
                  <label>Email</label>
                </div>

                <div class="input-wrap">
                    <input type="password" minlength="4" class="input-field" autocomplete="off" name="password" required/>
                  <label>Password</label>
                </div>

                <input type="submit" value="Sign Up" class="sign-btn" />

                <p class="text">
                  By signing up, I agree to the
                  <a href="#">Terms of Services</a> and
                  <a href="#">Privacy Policy</a>
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

    <script >
        //navigation bar

const toggleBtn= document.querySelector('.toggle_btn')
const toggleBtnIcon= document.querySelector('.toggle_btn i')
const dropDownMenu= document.querySelector('.dropdown_menu')

    toggleBtn.onclick= function(){
        dropDownMenu.classList.toggle('open')
        const isOpen= dropDownMenu.classList.contains('open')

        toggleBtnIcon.classList= isOpen
        ? 'fa-solid fa-xmark'
        : 'fa-solid fa-bars'
    }



const inputs = document.querySelectorAll(".input-field");
const toggle_btn = document.querySelectorAll(".toggle");
const main = document.querySelector("main");
const bullets = document.querySelectorAll(".bullets span");
const images = document.querySelectorAll(".image");

inputs.forEach((inp) => {
  inp.addEventListener("focus", () => {
    inp.classList.add("active");
  });
  inp.addEventListener("blur", () => {
    if (inp.value != "") return;
    inp.classList.remove("active");
  });
});
/*
toggle_btn.forEach((btn) => {
  btn.addEventListener("click", () => {
    main.classList.toggle("sign-up-mode");
  });
});
*/
function moveSlider() {
  let index = this.dataset.value;

  let currentImage = document.querySelector(`.img-${index}`);
  images.forEach((img) => img.classList.remove("show"));
  currentImage.classList.add("show");

  const textSlider = document.querySelector(".text-group");
  textSlider.style.transform = `translateY(${-(index - 1) * 2.2}rem)`;

  bullets.forEach((bull) => bull.classList.remove("active"));
  this.classList.add("active");
}

bullets.forEach((bullet) => {
  bullet.addEventListener("click", moveSlider);
});
    </script>
  </body>
</html>

<?php
mysqli_close($conn);
?>