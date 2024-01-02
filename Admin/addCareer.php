<?php

session_start();

// Include the database connection file
require('../db_connect.php');
$current_user = $_SESSION['user'];

// Check if the form has been submitted
if (isset($_POST['submit']) && isset($_FILES['file'])) {

    $companyName = $_POST['companyName'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $contact = $_POST['contact'];
    $datePosted = $_POST['datePosted'];
     
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExtArray = explode('.', $fileName);
    $fileExt = strtolower(end($fileExtArray));
    $allowed = array('jpg', 'jpeg', 'png', 'gif');

    if ($fileError === 0) {
        $imageData = file_get_contents($fileTmpName);
        $imageData1 = mysqli_real_escape_string($conn, $imageData);

        $insertQuery = "INSERT INTO jobs (companyName, JobTitle, Description, ContactNb, Date, image, image_data) VALUES ('$companyName', '$title', '$description', '$contact', '$datePosted', '$fileName', '$imageData1')";
        if ($conn->query($insertQuery)) {
            echo "<div class='alert alert-success'>New job added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error adding job: " . $conn->error . "</div>";
        }
    }
    else{
        echo "Error adding job:  . $conn->error . ";
    }
}

if (isset($_POST['submitEdit'])) {
    $editCode = $_POST['edit'];
    $update_name = mysqli_real_escape_string($conn, $_POST['editCompanyName']);
    $update_title = mysqli_real_escape_string($conn, $_POST['editTitle']);
    $update_description = mysqli_real_escape_string($conn, $_POST['editDescription']);
    $update_contact = mysqli_real_escape_string($conn, $_POST['editContact']);
    $update_date = mysqli_real_escape_string($conn, $_POST['editDatePosted']);
    
    
    $mysqli_query= "UPDATE jobs SET CompanyName = '$update_name', JobTitle = '$update_title', ContactNb='$update_contact', Description= '$update_description', Date='$update_date' WHERE JobID = '$editCode'";
    if ($conn->query($mysqli_query)) {
        echo "<div class='alert alert-success'>job updated successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating job: " . $conn->error . "</div>";
    }
   /* $update_image = $_FILES['update_image']['name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder = 'jobsImages/'.$update_image;
 
    if(!empty($update_image)){
       if($update_image_size > 2000000){
          $message[] = 'image is too large';
       }else{
          $image_update_query = mysqli_query($conn, "UPDATE jobs SET image = '$update_image' WHERE JobID = '$editCode'") or die('query failed');
          if($image_update_query){
             move_uploaded_file($update_image_tmp_name, $update_image_folder);
          }
       }
    }*/
}




// Query the database to list the available jobs
$listQuery = "SELECT *  FROM jobs";
$result = $conn->query($listQuery);


if (isset($_POST['delete'])) {
    $deleteCode = $_POST['delete_code'];
    // Perform the deletion of the job with the given code
    $deleteQuery = "DELETE FROM jobs WHERE JobID = '$deleteCode'";
    if ($conn->query($deleteQuery)) {
        echo "<div class='alert alert-success'>Job with id '$deleteCode' has been deleted successfully!</div>";
        // Redirect to the same page to refresh the list
        header("Location: addCareer.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error deleting job: " . $conn->error . "</div>";
    }
}

?>

<!-- Rest of the HTML form -->

<!-- HTML Form for adding new majors -->
<!DOCTYPE html>
<html>
<head>
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">-->
    <title>Add New Career</title>
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

        .btn-edit{
            padding: 10px 15px;
            background-color: #35dc35;
            color: var(--color-white);
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-edit:hover {
            background-color: #23c831;
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
    <h2>Add New Career</h2>
    <form method="post" class="add-form" enctype="multipart/form-data" >
        <div class="form-group">
            <label for="companyName">Company Name:</label>
            <input type="text" class="form-control" id="companyName" name="companyName" required>
        </div>

        <div class="form-group">
            <label for="title">Job Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" class="form-control" id="description" name="description" required>
        </div>

        <div class="form-group">
            <label for="contact">Contact:</label>
            <input type="text" class="form-control" id="contact" name="contact" required>
        </div>

        <div class="form-group">
            <label for="datePosted">Date Posted:</label>
            <input type="date" class="form-control" id="datePosted" name="datePosted" required>
        </div>
        <div class="form-group" id="file" >
            <label for="file">Add image of company:</label>
            <input type="file" class="form-control" name="file" id="file" accept="image/*" required>
        </div>

        <br>
        <button type="submit" name="submit" class="button-add">Add Job</button>
    </form>
    <br><br>


    <!-- Display the list of available majors -->
    <h2>List of Available Jobs</h2>
    <table>
       <thead>
        <tr>
            <th>Job ID</th>
            <th>Company Name</th>
            <th>Job Title</th>
            <th>Description</th>
            <th>Contact</th>
            <th>Date Posted</th>
        </tr>
       </thead>
      
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tbody>";
            echo "<tr>";
            echo "<td>" . $row["JobID"] . "</td>";
            echo "<td>" . $row["companyName"] . "</td>";
            echo "<td>" . $row["JobTitle"] . "</td>";
            echo "<td>" . $row["Description"] . "</td>";
            echo "<td>" . $row["ContactNb"] . "</td>";
            echo "<td>" . $row["Date"] . "</td>";
            
            echo "<td><form method='post'><input type='hidden' name='edit_code' value='" . $row['JobID'] . "'><button type='submit' name='edit' class='btn btn-edit'>Edit</button></form></td>";
            echo "<td><form method='post'><input type='hidden' name='delete_code' value='" . $row['JobID'] . "'><button type='submit' name='delete' class='btn btn-danger'>Delete</button></form></td>";
            echo "</tr>";
            echo "</tbody>";
        }
        ?>
      
    </table>
    <br><br><br>
    
    <?php
    if (isset($_POST['edit'])) {
        $editCode = $_POST['edit_code'];
        $select = mysqli_query($conn, "SELECT * FROM jobs WHERE JobID = '$editCode'") or die('query failed');
        if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
        }

    ?>
    <h2>Edit Career</h2>
    <form method="POST" class="add-form" enctype="multipart/form-data" >
        <div class="form-group">
            <label for="editCompanyName">Company Name:</label>
            <input type="text" class="form-control" id="editCompanyName" name="editCompanyName" value="<?php echo $fetch["companyName"]; ?>"required>
        </div>

        <div class="form-group">
            <label for="editTitle">Job Title:</label>
            <input type="text" class="form-control" id="editTitle" name="editTitle" value="<?php echo $fetch["JobTitle"]; ?>" required>
        </div>

        <div class="form-group">
            <label for="editDescription">Description:</label>
            <input type="text" class="form-control" id="editDescription" name="editDescription"  value="<?php echo $fetch["Description"]; ?> " required>
        </div>

        <div class="form-group">
            <label for="editContact">Contact:</label>
            <input type="text" class="form-control" id="editContact" name="editContact" value="<?php echo $fetch["ContactNb"]; ?>" required>
        </div>

        <div class="form-group">
            <label for="editDatePosted">Date Posted:</label>
            <input type="date" class="form-control" id="editDatePosted" name="editDatePosted" value="<?php echo $fetch["Date"]; ?>" required>
        </div>
       
        <button type='submit' name='submitEdit' class='button-add'>Save Changes</button>";
    </form>
    <?php } ?>

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

