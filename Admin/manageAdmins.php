<?php

session_start();

// Include the database connection file
require('../db_connect.php');
$current_user = $_SESSION['user'];
// Check if the form has been submitted
if (isset($_POST['submit'])) {
    $Fname = $_POST['Fname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Securely hash the password
   
        $insertQuery = "INSERT INTO users(FullName, Username, Email, Password, PhoneNumber, role_id) VALUES ('$Fname', '$username', '$email','$password','$phone', 1)";
        if ($conn->query($insertQuery)) {
            echo "<div class='alert alert-success'>New job added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error adding job: " . $conn->error . "</div>";
        }

    }


// Query the database to list the available majors
$listQuery = "SELECT *  FROM users WHERE role_id=1";
$result = $conn->query($listQuery);


if (isset($_POST['delete'])) {
    $deleteCode = $_POST['delete_code'];
    // Perform the deletion of the admin with the given code
    $deleteQuery = "DELETE FROM users WHERE UserID = '$deleteCode'";
    if ($conn->query($deleteQuery)) {
        echo "<div class='alert alert-success'>Admin with id '$deleteCode' has been deleted successfully!</div>";
        // Redirect to the same page to refresh the list
        header("Location: manageAdmins.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error deleting admin: " . $conn->error . "</div>";
    }
}


?>

<!-- Rest of the HTML form -->

<!-- HTML Form for adding new majors -->
<!DOCTYPE html>
<html>
<head>
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">-->
    <title>Manage Admins</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styleAdmin.css"/>

    <style>
        main{
            margin-top: 7rem;
            width: 100%;
        }

        .add-form{
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: var(--color-dark);
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid var(--color-dark-variant);
            border-radius: 4px;
            box-sizing: border-box;
           background-color: var( --color-white);
        }
       

        .button-add  {
            padding: 10px 15px;
            background-color: var(--color-info-dark);
            color: var(--color-white);
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button-add:hover {
            background-color: var(--color-primary);
        }

        table {
            background: var(--color-white);
            width: 100%;
            border-radius: 2rem;
            padding: 1.8rem;
            text-align: center;
            box-shadow: 0 2rem 3rem var( --color-light);
            transition: all 300ms ease;;
        }

        table:hover{
            box-shadow: none;
        }

        table th{
            font-size: 17px;
            height: 5rem;
            border-bottom: 1px solid var( --color-light);
        }

        table tbody td{
            padding: 15px 15px;
            font-size: 13px;
            height: 5rem;
            border-bottom: 1px solid var( --color-light);
            color: var(--color-dark-variant);
        }

        table tbody tr:last-child td{
            border: none;
        }

        .btn-danger {
            padding: 10px 15px;
            background-color: #dc3545;
            color: var(--color-white);
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
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
    <main>
   
    <h2>Add New Admin</h2>
    <form method="post" class="add-form" >
        <div class="form-group">
            <label for="Fname">Full Name:</label>
            <input type="text" class="form-control" id="Fname" name="Fname" required>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" minlength="4" class="form-control" id="password" name="password" required/>  
        </div>

        <br>
        <button type="submit" name="submit" class="button-add">Add Admin</button>
    </form>
    <br><br>


    <!-- Display the list of available majors -->
    <h2>List of Admins</h2>
    <table>
       <thead>
        <tr>
            <th>Admin ID</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone Number</th>
        </tr>
       </thead>
      
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tbody>";
            echo "<tr>";
            echo "<td>" . $row["UserID"] . "</td>";
            echo "<td>" . $row["FullName"] . "</td>";
            echo "<td>" . $row["Username"] . "</td>";
            echo "<td>" . $row["Email"] . "</td>";
            echo "<td>" . $row["PhoneNumber"] . "</td>";

            echo "<td><form method='post'><input type='hidden' name='delete_code' value='" . $row['UserID'] . "'><button type='submit' name='delete' class='btn btn-danger'>Delete</button></form></td>";
            echo "</tr>";
            echo "</tbody>";
        }
        ?>
      
    </table>

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
                        <p>Hey, <?php
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

            <script src="./index.js"></script>

    
</body>
</html>