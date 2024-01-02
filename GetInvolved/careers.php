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
    <link rel="stylesheet" href="careers.css">
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
                <li><a href="../Services/services.php">Services</a></li>
                <li><a  href="careers.php">Careers</a></li>
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
        
            <h1 class="header-title" > FIND YOUR <br> <span> PERFECT JOB </span> <br> EASILY</h1>
        </header>

        <div class="dropdown_menu">
            <li><a href="../index.php">Home</a></li>
            <li><a href="../About/about.php">About</a></li>
            <li><a href="../Services/services.php">Services</a></li>
            <li><a href="careers.php">Careers</a></li>
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

        <!--Job Listing code-->
        <div class="search-wrapper">
            <div class="search-box">
                <div class="search-card">
                    <input class="search-input" type="text" placeholder="Job title or keywords">
                    <button class="search-button" >Search</button>
                </div>
            </div>
        </div>

        <!-- JOB LISTING -->
        <section class="job-list" id="jobs">
             <!-- Add this code after the search input -->
             <div class="search-results" id="searchResults"></div>
        <?php
             $query= "SELECT * FROM jobs";
             $result= mysqli_query($conn, $query);

             while($row = mysqli_fetch_array($result)){?>
                    <div class="job-card">
                    <div class="job-name">
                   
                    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image_data']) . '" alt="Uploaded Image" height="60px" width="60px" style=" margin: 0.5rem;" >'; ?>
                   
                    <div class="job-detail">
                    
                    <?php
                            $companyName= $row["companyName"];
                            $title= $row["JobTitle"];
                            $description= $row["Description"];
                            $contact= $row["ContactNb"];
                            $date= $row["Date"];
                           

                        echo"<h4>$companyName</h4>";
                        echo"<h3>$title</h3>";
                        echo"<p>$description</p>";
                        echo"<p>$contact</p>";     
                        ?><br>  
                              
                    </div>
                </div>
                <div class="job-posted">
                    Posted <br> <?php echo"$date"; ?>
                </div>
            </div>
            <?php } ?>
            <!--<button class="job-more">More List</button>-->
        </section>

        <?php
        // ... (your existing PHP code)

        if (isset($_GET['search'])) {
            $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
            $query = "SELECT * FROM jobs WHERE JobTitle LIKE '%$searchTerm%' OR Description LIKE '%$searchTerm%'";
            $result = mysqli_query($conn, $query);

        // Output the search results
            while ($row = mysqli_fetch_array($result)) {
                echo '<div class="job-card">';
                echo '<div class="job-name">';
                   
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image_data']) . '" alt="Uploaded Image" height="60px" width="60px" style=" margin: 0.5rem;" >'; 
                   
                echo '<div class="job-detail">';
                    
                            $companyName= $row["companyName"];
                            $title= $row["JobTitle"];
                            $description= $row["Description"];
                            $contact= $row["ContactNb"];
                            $date= $row["Date"];
                           

                        echo"<h4>$companyName</h4>";
                        echo"<h3>$title</h3>";
                        echo"<p>$description</p>";
                        echo"<p>$contact</p>";     
                         
                              
                   echo '</div>';
                echo '</div>';
                echo '<div class="job-posted">';?>
                    Posted <br> <?php echo"$date"; ?>
                <?php echo '</div>';
            echo '</div>';
            } 

            exit(); // Stop further execution after sending the search results
        }
        ?>


        <a href="../Contact/contact.php" class="hero-btn">Hiring? Contact Us to post your offering</a>

        <!--join-->

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
                        <li class="ulF"><a href="../Services/services.php">Services</a></li>
                        <li class="ulF"><a href="careers.php">Careers</a></li>
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

    document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector(".search-input");
    const searchResults = document.getElementById("searchResults");

    searchInput.addEventListener("input", function () {
        const searchTerm = searchInput.value.trim();

        if (searchTerm.length === 0) {
            searchResults.innerHTML = ""; // Clear the search results if the input is empty
            return;
        }

        // Make an AJAX request to fetch search results
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "search.php?search=" + encodeURIComponent(searchTerm), true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Update the search results container with the received HTML
                searchResults.innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    });
});

  

    </script>
</body>
</html>