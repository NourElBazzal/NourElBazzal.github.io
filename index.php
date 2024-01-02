<?php
session_start();

// Include the database connection file
require('db_connect.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css" />
    
    <script src="https://unpkg.com/scrollreveal"></script>
    <!--Swiper JS-->
    <script src="js/swiper-bundle.min.js"></script>
    <!--Swiper jd-->
    <link rel="stylesheet" href="CSS/swiper-bundle.min.css">
    <title>Document</title>

    <style>
        .icon-wrapper2{
            margin-right: 10px;
            margin-left: -35px;
            font-size: 18px;
            width: 3.5em;
        }

        .icon-wrapper{
            background-color: #cf6f24;
        }

        .dropdown_menu.open{
            height: 450px;
            position: fixed;
        }

        .action_btn{
            background-color: #cf6f24;
            margin-left: 20px;
        }
        .testimonial-col {
            margin: 10px;
        }
        
    </style>
</head>

<body>
<header>
<section class="header">   
    <div class="navbar">
        <div class="logo"><a href="#"><span style="color:#cf6f24">Empower</span>Ability</a></div>
        <ul class="links">
                <li><a href="index.php">Home</a></li>
                <li><a href="About/about.php">About</a></li>
                <li><a href="Services/services.php">Services</a></li>
                <li><a  href="GetInvolved/careers.php">Careers</a></li>
                <li><a href="Explore/explore.php">Explore</a></li>
                <li><a href="Contact/contact.php">Contact</a></li>
                
                <?php
            // Check if the user is logged in
            if (isset($_SESSION['user'])) {
                ?>
                <li><a href=""><i class="fa-solid fa-circle-user icon-wrapper2" ></i><i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown">
                        <?php
                            $current_user = $_SESSION['user'];
                            $query = "SELECT role_id FROM users WHERE Email='$current_user'";
                            $result = $conn->query($query);
                            if ($result->num_rows > 0) {
                                // If a user with the provided username is found in the database, We then use the fetch_assoc() method to fetch the data from the first row of the result set as an associative array. This means that we can access the column values by their names. In this case, we retrieve the hashed password value and store it in the variable $hashedPassword.
                                $row = $result->fetch_assoc();
                                $role = $row['role_id'];
                                if($role == 2){?>
                                    <li><a  href="Profiles/user_profile.php"><i class="fa-solid fa-user"></i>Profile</a></li>
                                <?php }
                                else if($role == 3){?>
                                    <li><a  href="Profiles/donator_profile.php"><i class="fa-solid fa-user"></i>Profile</a></li>
                               <?php }
                                else if($role == 1){?>
                                    <li><a  href="Admin/indexAdmin.php"><i class="fa-solid fa-user"></i>Profile</a></li>
                               <?php }
                            } ?>                              
                        <li><a  href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
                    </ul>
                </li>  
                <?php
            } else {
                ?>
                <li><a href="login/login.php">Login</a></li>
                <?php
            }
            ?>
        </ul>
        <a href="#" class="action_btn">Donate Now</a>
        <div class="toggle_btn"><i class="fa-solid fa-bars"></i></div>
    </div>
</section>
</header>

<div class="slideshow-container">
    <div class="mySlides fade">
        <img src="sliders/slider1.jpg" style="filter: brightness(30%);">
        <div class="text-box text-box1">
            <h1>Let's Empower Positive Change For all</h1>
            <span></span>
            <p>Together, we strive to break down barriers, foster inclusivity, and inspire a future where everyone can reach their full potential, irrespective of their abilities. Join us in this transformative journey, as we work hand in hand to build a more inclusive and empowering world.</p>
        </div>
    </div>

    <div class="mySlides fade">
        <img src="sliders/gettyimages-523157876-sm.jpg" style="filter: brightness(20%);">
        <div class="text-box text-box2">
            <h1>Let's Drive Change For More Accessible World</h1>
            <span></span>
            <p>Our commitment to advocate for universal access, ensuring that every individual can enjoy a barrier-free, inclusive environment. Join us in this vital endeavor to make our world more welcoming and equitable for all.</p>
        </div>
    </div>

    <div class="mySlides fade">
        <img src="sliders/slider3.jpg" style="filter: brightness(20%);">
        <div class="text-box text-box3">
            <h1>Together, we can break down barriers and build bridges</h1>
            <span></span>
            <p>Our collaborative spirit to eliminate obstacles that hinder progress while fostering connections that unite people from all walks of life. Join us in this journey of inclusivity and unity.</p>
        </div>
    </div>

    <div class="mySlides fade">
        <img src="sliders/slider9.jpg" style="filter:brightness(20%)">
        <div class="text-box text-box4">
            <h1>Your potential is limitless, and so is your impact</h1>
            <span></span>
            <p>A reminder that every individual, regardless of their abilities, has the power to create meaningful, far-reaching change in the world. Your influence knows no bounds.</p>
        </div>
    </div>

</div>

<div class="dropdown_menu">
    <li><a href="index.php">Home</a></li>
        <li><a href="About/about.php">About</a></li>
        <li><a href="Services/services.php">Services</a></li>
        <li><a href="GetInvolved/careers.php">Careers</a></li>
        <li><a href="Explore/explore.php">Explore</a></li>
        <li><a href="Contact/contact.php">Contact</a></li>
        <?php
            // Check if the user is logged in
            if (isset($_SESSION['user'])) {
                 $current_user = $_SESSION['user'];
                 $query = "SELECT role_id FROM users WHERE Email='$current_user'";
                 $result = $conn->query($query);
                 if ($result->num_rows > 0) {
                    // If a user with the provided username is found in the database, We then use the fetch_assoc() method to fetch the data from the first row of the result set as an associative array. This means that we can access the column values by their names. In this case, we retrieve the hashed password value and store it in the variable $hashedPassword.
                     $row = $result->fetch_assoc();
                     $role = $row['role_id'];
                     if($role == 2){?>
                         <li><a  href="Profiles/user_profile.php"><i class="fa-solid fa-user"></i>Profile</a></li>
                       <?php }
                         else if($role == 3){?>
                           <li><a  href="Profiles/donator_profile.php"><i class="fa-solid fa-user"></i>Profile</a></li>
                               
                    <?php } 
                    }  ?>
                     <li><a  href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
                <?php }else {
                ?>
                <li><a href="login/login.php">Login</a></li>
                <?php
            }
            ?>
       
        <li> <a href="#" class="action_btn">Donate Now</a></li>
</div>

    <section class="sec-02">
            <h5 class="section-title">Learn More What We Do <br> And Get Involved</h5>
            <div class="row">
                <div class="column">
                    <div class="card1">
                        <div class="icon-wrapper"> <i class="fas fa-school"></i> </div>
                        <h3>Education</h3>
                        <p>Develops the skills and capabalities of very young children, school-goers and tertiary students.</p>
                        <button class="button">Learn More</button>
                    </div>
                </div>

                <div class="column">
                    <div class="card1">
                        <div class="icon-wrapper"> <i class="fas fa-heartbeat"></i> </div>
                        <h3>Healthcare</h3>
                        <p>Many healthcare services are available and provided by doctors, specialists and therapists.</p>
                        <button class="button">Learn More</button>
                    </div>
                </div>
                
                <div class="column">
                    <div class="card1">
                        <div class="icon-wrapper"> <i class="fas fa-taxi"></i> </div>
                        <h3>Transportation</h3>
                        <p>Services for transporting disabled people are available from a wide variety of organizations.</p>
                        <button class="button">Learn More</button>
                    </div>
                </div>

                <div class="column">
                    <div class="card1">
                        <div class="icon-wrapper"><i class="fas fa-briefcase"></i> </div>
                        <h3>Employment</h3>
                        <p>We help our members get employed based on their creativity and motivation.</p>
                        <button class="button">Learn More</button>
                    </div>
                </div>
            </div>

    </section>

    <!----------- testimonials ------------>
    <section class="testimonials">
        <center><h3 class="section-title" style="z-index: -1;">Testimonials</h3></center>
        <div class="rowTest">
            <?php
            $sql = "SELECT reviews.ReviewID, reviews.ReviewComment, users.FullName, users.image FROM reviews INNER JOIN users ON reviews.user_id=users.UserID; ";
            $result1 = mysqli_query($conn, $sql);
            
            while($row = mysqli_fetch_array($result1)){?>
            <div class="testimonial-col">
                <?php 
                if($row['image'] == ''){
                    echo '<img src="Profiles/images/default-avatar.png">';
                }else{
                    echo '<img src="Profiles/uploaded_img/'.$row['image'].'">';
                }?>
                <div>
                    <?php
                     $review=$row['ReviewComment']; 
                     $name=$row['FullName'];

                    echo"<p>$review</p>";
                    echo"<h3>$name</h3>";
                    ?>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    
                </div>
            </div><?php } ?>  
        </div>
    </section>

    <!-- --- Call to Action --- -->

    <section class="cta">
        <h1>Join Us For Our Various Services<br>In Lebanon</h1>
        <a href="Contact/contact.php" class="hero-btn">CONTACT US</a>
    </section>

<section class="sec-footer">
<footer>
    <div class="footer-container">
    <div class="rowF">
        <div class="colF colF1">
            <p class="footerLogo"><span style="color:#cf6f24">Empower</span>Ability</p>
            <p>Our Mission Is To Create A More Inclusive And Accessible World For Individuals With Disabilities. Join us to become a member of our community! </p>
            <a href="login/login.php"><button class="button">Sign up</button></a>
        </div>
        <div class="colF">
            <h3>Contact <div class="underline"><span></span></div></h3>
            <p class="email-id">empowerability@hotmail.com</p>
            <h4>+961-70 063744</h4>
        </div>
        <div class="colF">
            <h3>Useful Links <div class="underline"><span></span></div></h3>
            <ul>
                <li class="ulF"><a href="index.php">Home</a></li>
                <li class="ulF"><a href="About/about.php">About</a></li>
                <li><a href="Services/services.php">Services</a></li>
                <li class="ulF"><a href="GetInvolved/careers.php">Careers</a></li>
                <li class="ulF"><a href="Explore/explore.php">Explore</a></li>
                <li class="ulF"><a href="Contact/contact.php">Contact</a></li>
                
            </ul>
        </div>
        <div class="colF">
            <h3>Follow us <div class="underline"><span></span></div></h3>
            <div class="social-icons">
                <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                <a href=""></a><i class="fa-brands fa-whatsapp"></i></a>
                <a href=""></a><i class="fa-brands fa-instagram"></i></a>
            </div>

        </div>
    </div>
    <hr>
    <p class="copyright">EmpowerAbility © 2023 - All Rights Reserved</p>
</div>
</footer>
</section>
<script src="script.js"></script>
  
</body>
</html>