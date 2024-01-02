<?php
session_start();

// Include the database connection file
require('../db_connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="service.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .icon-wrapper2{
            margin-right: 10px;
            margin-left: -35px;
            font-size: 18px;
            width: 3.7em;
        }

        .dropdown_menu.open{
            height: 450px;
            position: fixed;
        }

        .action_btn{
            margin-left: 20px;
        }

        .job-profile{
            width: 60px;
            height: 60px;
            margin: 0.5rem;
        }
        
    </style>
</head>
<body>
    <header> 
    <section class="sub-header">
        <div class="navbar">
            <div class="logoNav"><a href="../index.php"><span style="color:#cf6f24">Empower</span>Ability</a></div>
            <ul class="links">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../About/about.php">About</a></li>
                <li><a href="services.php">Services <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown">
                        <li><a  href="#educationSection">Education</a></li>
                        <li><a  href="#healthcareSection">Healthcare</a></li>
                        <li><a  href="#transportationSection">Transportation</a></li>
                        <li><a  href="#employmentSection">Employment</a></li>
                    </ul>
                </li>
                <li><a  href="../GetInvolved/careers.php">Careers</a></li>
                <li><a href="../Explore/explore.php">Explore</a></li>
                <li><a href="../Contact/contact.php">Contact</a></li>
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
                                    <li><a  href="../Profiles/user_profile.php"><i class="fa-solid fa-user"></i>Profile</a></li>
                                <?php }
                                else if($role == 3){?>
                                    <li><a  href="../Profiles/donator_profile.php"><i class="fa-solid fa-user"></i>Profile</a></li>
                               <?php }
                               else if($role == 1){?>
                                <li><a  href="Admin/indexAdmin.php"><i class="fa-solid fa-user"></i>Profile</a></li>
                           <?php }
                            } ?>                              
                        <li><a  href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
                        </ul>
                    </li>  
                <?php
            } else {
                ?>
                <li><a href="../login/login.php">Login</a></li>
                <?php
            }
            ?> 
            </ul>
            <a href="#" class="action_btn">Donate Now</a>
            <div class="toggle_btn"><i class="fa-solid fa-bars"></i></div>
        </div>
    
        <!-- header -->
        
            <h1 class="header-title" > GET INVOLVED <br>IN OUR <span> SERVICES </span> </h1>
        </header>

        <div class="dropdown_menu">
            <li><a href="../index.php">Home</a></li>
            <li><a href="../About/about.php">About</a></li>
            <li><a href="services">Services</a></li>
            <li><a  href="../GetInvolved/careers.php">Careers</a></li>
            <li><a href="../Explore/explore.php">Explore</a></li>
            <li><a href="../Contact/contact.php">Contact</a></li>
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
                        <li><a  href="../Profiles/user_profile.php"><i class="fa-solid fa-user"></i>Profile</a></li>
                      <?php }
                        else if($role == 3){?>
                          <li><a  href="../Profiles/donator_profile.php"><i class="fa-solid fa-user"></i>Profile</a></li>
                              
                   <?php } 
                   }  ?>
                    <li><a  href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
               <?php }else {
               ?>
               <li><a href="../login/login.php">Login</a></li>
               <?php
           }
           ?> 
            <li> <a href="#" class="action_btn">Donate Now</a></li>
    </div>

    <section class="service" id="educationSection" >
        <img src="images/education.png" class="imagePlayer">
        <div class="container">
            <div class="sectionTitle">Education</div>
            <div class="serviceContainer">
                <h3>Education Is Essential For <br /> <strong> BETTER FUTURE </strong></h3>
                <p>Inclusive education for disabled individuals is essential for fostering equality and empowering everyone to reach their full potential. Recent efforts focus on creating accessible learning environments with tailored support, assistive technologies, and specialized teaching methods. This approach aims not only to facilitate academic learning but also to nurture independence, confidence, and a sense of belonging. By embracing inclusivity, society can break down barriers, ensuring that individuals with disabilities have equal access to opportunities and contribute meaningfully to their communities.</p>
            </div>
        </div>
    </section>

    <section class="gallery" id="gallerySection" >
        <div class="container">
            <div class="sectionTitle">Gallery</div>

            <div class="galleryContainer">
                <div class="item">
                    <img src="images/education.png" alt="">
                </div>

                <div class="item">
                    <img src="images/education1.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/education2.jpeg" alt="">
                </div>

                <div class="item">
                    <img src="images/education4.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/education5.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/education66.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/education88.png" alt="">
                </div>

                <div class="item">
                    <img src="images/education7.jpg" alt="">
                </div>
            </div>
        </div>
    </section>


    <section class="service" id="healthcareSection" >
        <img src="images/health.png" class="imagePlayer">
        <div class="container">
            <div class="sectionTitle">Healthcare</div>
            <div class="serviceContainer">
                <h3>Healthcare Equality: Building a Foundation for a <br /> <strong> BETTER FUTURE </strong></h3>
                <p>Ensuring accessible healthcare for disabled individuals is vital for promoting overall well-being and quality of life. Healthcare providers are incorporating accommodations such as accessible facilities, communication aids, and specialized medical equipment. Moreover, there's an emphasis on training healthcare professionals to better understand and cater to the diverse needs of disabled patients. By prioritizing inclusive healthcare practices, society can enhance the health outcomes and overall dignity of individuals with disabilities, fostering a more equitable and compassionate healthcare system.</p>
            </div>
        </div>
    </section>

    <section class="gallery" id="gallerySection" >
        <div class="container">
            <div class="sectionTitle">Gallery</div>

            <div class="galleryContainer">
                <div class="item">
                    <img src="images/healthcare2.png" alt="">
                </div>

                <div class="item">
                    <img src="images/healthcare1.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/healthh.png" alt="">
                </div>

                <div class="item">
                    <img src="images/healthcare3.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/healthcare5.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/healthcare4.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/healthcare7.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/healthcare6.jpg" alt="">
                </div>
            </div>
        </div>
    </section>


    <section class="service" id="transportationSection" >
        <img src="images/transportation.png" class="imagePlayer">
        <div class="container">
            <div class="sectionTitle">Transportation</div>
            <div class="serviceContainer">
                <h3>Accessible Transportation: Paving the Way for a <br /> <strong> BETTER FUTURE </strong></h3>
                <p>Accessible transportation is crucial for the inclusion of individuals with disabilities, providing them with the means to travel independently and engage in various aspects of life. Efforts to incorporate features like ramps, lifts, and designated spaces for wheelchairs aim to make public spaces and vehicles more accommodating. Prioritizing inclusive transportation not only breaks down mobility barriers but also empowers people with disabilities to actively participate in work, education, and social activities, fostering a more connected and equitable community.</p>
            </div>
        </div>
    </section>

    <section class="gallery" id="gallerySection" >
        <div class="container">
            <div class="sectionTitle">Gallery</div>

            <div class="galleryContainer">
                <div class="item">
                    <img src="images/transportation1.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/transportation5.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/transportation6.png" alt="">
                </div>

                <div class="item">
                    <img src="images/transportation.png" alt="">
                </div>

                <div class="item">
                    <img src="images/transportation8.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/transportation7.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/transportation3.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/transportation4.jpg" alt="">
                </div>
            </div>
        </div>
    </section>


    <section class="service" id="employmentSection" >
        <img src="images/employment.png" class="imagePlayer">
        <div class="container">
            <div class="sectionTitle">Employment</div>
            <div class="serviceContainer">
                <h3>Empowering Futures: Inclusive Employment for a <br /><strong> BETTER TOMORROW </strong></h3>
                <p>Inclusive employment is about recognizing the diverse skills of individuals with disabilities. By providing accessible workplaces and embracing adaptive technologies, companies can create an environment where everyone can contribute meaningfully. This not only expands the talent pool but also fosters a more equitable and vibrant society where individuals with disabilities thrive professionally, leading fulfilling and productive lives.</p>
            </div>
        </div>
    </section>

    <section class="gallery" id="gallerySection" >
        <div class="container">
            <div class="sectionTitle">Gallery</div>

            <div class="galleryContainer">
                <div class="item">
                    <img src="images/employment6.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/employment5.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/employment8.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/employment.png" alt="">
                </div>

                <div class="item">
                    <img src="images/employment7.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/employment4.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/employment3.jpg" alt="">
                </div>

                <div class="item">
                    <img src="images/employment2.jpeg" alt="">
                </div>
            </div>
        </div>
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
                        <li class="ulF"><a href="../index.php">Home</a></li>
                        <li class="ulF"><a href="../About/about.php">About</a></li>
                        <li class="ulF"><a href="services">Services</a></li>
                        <li><a  href="../GetInvolved/careers.php">Careers</a></li>
                        <li class="ulF"><a href="../Explore/explore.php">Explore</a></li>
                        <li class="ulF"><a href="../Contact/contact.php">Contact</a></li>
                        
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
        

    <script>
        //navigation ba4

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

  

    </script>
</body>
</html>