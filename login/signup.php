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


    .hero-btn{
        display: inline-block;
        text-decoration: none;
        color: #151111;
        border: 1px solid  #151111;
        border-radius: 10px;
        padding: 10px 20px;
        font-size: 13px;
        background: transparent;
        position: relative;
        cursor: pointer;
    }

    .hero-btn:hover{
        color: #fff;
        border: 1px solid #032030;
        background-color: #032030;
        transition: 1s;
    }

    .heading {
        margin-top: -60px;
        margin-bottom: -50px;
  }

  @media (max-width: 530px){
 

  .heading{
    margin-top: 0;
    margin-bottom: 0;
  }
}
  
@media (max-width: 850px){

 
  .heading{
    margin-top: 0;
    margin-bottom: 0;
  }
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
                <li><a href="../login/login.php">Login</a></li>
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
           
            <form class="sign-in-form" method="POST" enctype="multipart/form-data">
              <div class="logo">
                <h4><span style="color:#cf6f24">Empower</span>Ability</h4>
              </div>

              <div class="heading">
                <h2>Get Started</h2>
                <h6>Already have an account?</h6>
                <a href="login.php" class="toggle">Sign in</a>
              </div>


              <div class="content">
            <h2>Thank you for choosing to sign up with us!</h2><br>
             <p>We're thrilled to welcome you to our community and look forward to providing you with a great experience on our website!</p>
            </div>


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

            <a href="signup_member.php" class="hero-btn">Click here to join us as a member</a><br>
            <a href="signup_donator.php" class="hero-btn">Click here to join is as a donator</a>
            <br><br>

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
  </body>
</html>