<?php

session_start();

// Include the database connection file
require('../db_connect.php');
$current_user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styleAdmin.css"/>
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <h2><span class="danger" style="color:rgb(255, 128, 0)">Empower</span>Ability</h2>
                </div>
            
                <div class="close" id="close-btn">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>

            <div class="sidebar">
                <a href="indexAdmin.php" class="active">
                    <i class="fa-solid fa-table-columns" style="color: #7d8da1;"></i>
                    <h3>Dashboard</h3>
                </a>
                <a href="manageAdmins.php">
                    <i class="fa-solid fa-user" style="color: #7d8da1;"></i>
                    <h3>Admins</h3>
                </a>
                <a href="manageMembers.php">
                    <i class="fa-solid fa-user" style="color: #7d8da1;"></i>
                    <h3>Members</h3>
                </a>
                <a href="manageDonators.php">
                    <i class="fa-solid fa-user" style="color: #7d8da1;"></i>
                    <h3>Donators</h3>
                </a>
                <a href="addService.php">
                    <i class="fa-solid fa-newspaper" style="color: #7d8da1;"></i>
                    <h3>Services</h3>
                </a>
                <a href="addCareer.php">
                    <i class="fa-solid fa-briefcase" style="color: #7d8da1;"></i>
                    <h3>Job Offerings</h3>
                </a>
                <a href="myProfile.php">
                    <i class="fa-solid fa-address-card" style="color: #7d8da1;"></i>
                    <h3>My Profile</h3>
                </a>
                <a href="adminLogout.php">
                    <i class="fa-solid fa-right-from-bracket" style="color: #7d8da1;"></i>
                    <h3>Logout</h3>
                </a>
            </div>

        </aside>

        <!------------END OF ASIDE------------>
        <main>
            <h1>Dashboard</h1>

            <div class="date">
                <input type="date">
            </div>

            <div class="insights">
                <div class="members">
                    <i class="fa-solid fa-chart-column"></i>
                    <div class="middle">
                        <div class="left">
                            <h3>Total members</h3>
                            <?php
                                $listQuery = "SELECT COUNT(*) FROM users WHERE role_id=2;";
                                $result = $conn->query($listQuery);
                                $row = mysqli_fetch_array($result);
                                $size = $row['COUNT(*)'];
                                echo"<h1>$size</h1>"; 
                            ?>   
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>70%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 hours</small>
                </div>
                <!--END OF MEMBERS-->

                <div class="donators">
                    <i class="fa-solid fa-chart-line"></i>
                    <div class="middle">
                        <div class="left">
                            <h3>Total donators</h3>
                            <?php
                                $listQuery = "SELECT COUNT(*) FROM users WHERE role_id=3;";
                                $result = $conn->query($listQuery);
                                $row = mysqli_fetch_array($result);
                                $size = $row['COUNT(*)'];
                                echo"<h1>$size</h1>"; 
                            ?>   
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 hours</small>
                </div>
                <!--END OF DONATORS-->

                <div class="jobs">
                    <i class="fa-solid fa-chart-gantt"></i>
                    <div class="middle">
                        <div class="left">
                            <h3>Total job offerings</h3>
                            <?php
                                $listQuery = "SELECT COUNT(*) FROM jobs;";
                                $result = $conn->query($listQuery);
                                $row = mysqli_fetch_array($result);
                                $size = $row['COUNT(*)'];
                                echo"<h1>$size</h1>"; 
                            ?>   
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38'  cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>60%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 hours</small>
                </div>
                <!--END OF JOBS-->
            </div>
            <!--END OF INSIGHTS-->
            <div class="recent-donations">
                <h2>Recent Donations</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Donator Name</th>
                            <th>Donator ID</th>
                            <th>Amount</th>
                            <th>Specified Service</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hala Choumane</td>
                            <td>1994</td>
                            <td>500$</td>
                            <td>NULL</td>
                        </tr>
                        <tr>
                            <td>Nour Chams</td>
                            <td>1995</td>
                            <td>300$</td>
                            <td>Education</td>
                        </tr>
                        <tr>
                            <td>Kamal Barhoum</td>
                            <td>1996</td>
                            <td>50$</td>
                            <td>NULL</td>
                        </tr>
                        <tr>
                            <td>Layal Noura</td>
                            <td>1997</td>
                            <td>150$</td>
                            <td>Transportation</td>
                        </tr>
                        <tr>
                            <td>Samir Kdouh</td>
                            <td>1998</td>
                            <td>30$</td>
                            <td>NULL</td>
                        </tr>
                        <tr>
                            <td>Samar Faraj</td>
                            <td>1999</td>
                            <td>500$</td>
                            <td>NULL</td>
                        </tr>
                        <tr>
                            <td>Sahar Samaha</td>
                            <td>2000</td>
                            <td>300$</td>
                            <td>Education</td>
                        </tr>
                    </tbody>
                </table>
                <a href="#">Show ALL</a>
            </div>
        </main>
        <!--END OF MAIN-->
        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="theme-toggler">
                    <i class="fas fa-sun active"></i>
                    <i class="fas fa-moon"></i>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Hey, 
                        <?php
                            $listQuery = "SELECT FullName FROM users WHERE Email='$current_user';";
                            $result = $conn->query($listQuery);
                            $row = mysqli_fetch_array($result);
                            $name= $row['FullName'];
                            echo"<b>$name</b>"; 
                        ?>   
                        </p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <?php
                        $select = mysqli_query($conn, "SELECT * FROM users WHERE Email='$current_user'") or die('query failed');
                        if(mysqli_num_rows($select) > 0){
                            $fetch = mysqli_fetch_assoc($select);
                        }
                    ?>
                    <div class="profile-photo">
                    <?php
                            if($fetch['image'] == ''){
                                echo '<img src="../Profiles/images/default-avatar.png">';
                            }else{
                                echo '<img src="uploaded_images/'.$fetch['image'].'">';
                            }
                            if(isset($message)){
                                foreach($message as $message){
                                echo '<div class="message">'.$message.'</div>';
                        }           
                    }
                    ?>
                    </div>
                </div>
            </div>
            <!--END OF TOP-->
            <div class="recent-updates">
                <h2>Recent Updates</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./images/admin2.jpg">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b> created a new post.</p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./images/admin3.png">
                        </div>
                        <div class="message">
                            <p><b>Laura Simpson</b> created a new post.</p>
                            <small class="text-muted">3 Minutes Ago</small>
                        </div>
                    </div>
                
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./images/admin1.png">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson</b> created a new post.</p>
                            <small class="text-muted">4 Minutes Ago</small>
                        </div>
                    </div>
                </div>
            </div>
            <!--END OF RECENT UPDATES-->
            <div class="new-members">
                <h2>New Members</h2>
                <div class="members">
                    <div class="member">
                        <div class="profile-photo">
                            <img src="./images/admin2.jpg">
                        </div>
                        <div class="message">
                            <p><b>Michael Tyson</b></p>
                        </div>
                    </div>
                    <div class="member">
                        <div class="profile-photo">
                            <img src="./images/admin3.png">
                        </div>
                        <div class="message">
                            <p><b>Sandy Choukair</b></p>
                        </div>
                    </div>
                    <div class="member">
                        <div class="profile-photo">
                            <img src="./images/admin4.jpg">
                        </div>
                        <div class="message">
                            <p><b>Sally Skaf</b></p>
                        </div>
                    </div>
                    <div class="member">
                        <div class="profile-photo">
                            <img src="./images/admin2.jpg">
                        </div>
                        <div class="message">
                            <p><b>Elie Saab</b></p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <script src="./index.js"></script>
</body>
</html>