<?php
session_start();

// Include the database connection file
require('../db_connect.php');
$current_user = $_SESSION['user'];

$query = "SELECT * FROM users WHERE Email=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $current_user);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$old_pass = $row['Password'];
$user_id= $row['UserID'];

if(isset($_POST['update_profile'])){
    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
    $update_username = mysqli_real_escape_string($conn, $_POST['update_username']);
    $update_phoneNb = mysqli_real_escape_string($conn, $_POST['update_phoneNb']);
    $update_service = mysqli_real_escape_string($conn, $_POST['update_service']);
    $update_disability = mysqli_real_escape_string($conn, $_POST['update_disability']);

    if (isset($_POST['update_service'])) {
      // Check if the user already has a service in the services_users table
      $check_existing_service_query = mysqli_query($conn, "SELECT * FROM services_users WHERE user_id='$user_id'");
      if (mysqli_num_rows($check_existing_service_query) > 0) {
          // If the user has an existing service, update it
          $update_service_query = mysqli_query($conn, "UPDATE services_users SET service_id='$update_service' WHERE user_id='$user_id'");
          if ($update_service_query) {
              echo "";
          } else {
              echo "" . mysqli_error($conn);
          }
      }/*else {
          // If the user doesn't have an existing service, insert a new record
          $insert_service_query = mysqli_query($conn, "INSERT INTO services_users (user_id, service_id) VALUES ('$user_id', '$update_service')");

          if ($insert_service_query) {
            echo "Selected service added successfully!";
        } else {
            echo "Error adding selected service: " . mysqli_error($conn);
        }
    }
}
    if (isset($_POST['update_disability'])) {
      // Get the user ID of the current user
      $select_user_id_query = mysqli_query($conn, "SELECT UserID FROM users WHERE Email='$current_user'");
      $user_id_row = mysqli_fetch_assoc($select_user_id_query);
      $user_id = $user_id_row['UserID'];

      // Check if the user already has a service in the services_users table
      $check_existing_disability_query = mysqli_query($conn, "SELECT * FROM disabilities_users WHERE user_id='$user_id'");
      if (mysqli_num_rows($check_existing_disability_query) > 0) {
          // If the user has an existing service, update it
          $update_disability_query = mysqli_query($conn, "UPDATE disabilities_users SET disability_id='$update_disability' WHERE user_id='$user_id'");
          if ($update_disability_query) {
              echo "Selected disability updated successfully!";
          } else {
              echo "Error updating selected disability: " . mysqli_error($conn);
          }
      } else {
          // If the user doesn't have an existing service, insert a new record
          $insert_disability_query = mysqli_query($conn, "INSERT INTO disabilities_users (user_id, disability_id) VALUES ('$user_id', '$update_disability')");

          if ($insert_disability_query) {
            echo "Selected disability added successfully!";
        } else {
            echo "Error adding selected disability: " . mysqli_error($conn);
        } 
}*/
    mysqli_query($conn, "UPDATE users SET FullName = '$update_name', Email = '$update_email', Username='$update_username', PhoneNumber= '$update_phoneNb' WHERE  Email='$current_user'") or die('query failed');
    
    $update_pass = mysqli_real_escape_string($conn, $_POST['update_pass']);
    $new_pass = mysqli_real_escape_string($conn, ($_POST['new_pass']));
    $confirm_pass = mysqli_real_escape_string($conn, ($_POST['confirm_pass']));
 
    if(!empty($update_pass) && !empty($new_pass) && !empty($confirm_pass)){
       if(!password_verify($update_pass, $old_pass)){
          $message[] = 'old password not matched!';
       }elseif($new_pass != $confirm_pass){
          $message[] = 'confirm password not matched!';
       }else{
            $checkPass = password_hash($confirm_pass, PASSWORD_BCRYPT); // Securely hash the password
          mysqli_query($conn, "UPDATE users SET password = '$checkPass' WHERE Email='$current_user'") or die('query failed');
          $message[] = 'password updated successfully!';
       }
    }
   
    $update_image = $_FILES['update_image']['name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder = 'uploaded_img/'.$update_image;
 
    if(!empty($update_image)){
       if($update_image_size > 2000000){
          $message[] = 'image is too large';
       }else{
          $image_update_query = mysqli_query($conn, "UPDATE users SET image = '$update_image' WHERE Email='$current_user'") or die('query failed');
          if($image_update_query){
             move_uploaded_file($update_image_tmp_name, $update_image_folder);
          }
       }
    }
 }
}
 
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="profileStyle.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      .input-field+ label {
    font-size: 0.75rem;
    top: -2px;
  }

  img{
   height: 150px;
   width: 150px;
   border-radius: 50%;
   object-fit: cover;
}

.update-btn {
  text-align: center;
  padding-top: 1px;
  }

  .sign-in-form span{
  position: relative;
 
}

.filter-select{
          border: none;
          padding: 0.2rem;
          margin-bottom: 30px;
          color: #959595;
      }

    .filter-select:hover{
          background: #f6f8fa;
      }

    .upload{
        width: 125px;
        position: relative;
        margin: auto;
        margin-top: 30px;
    }

    .upload img{
        border-radius: 50%;
        border: 8px solid #DCDCDC;
    }

    .upload .round{
        position: absolute;
        bottom: 0;
        right: 0;
        background: #cf6f24;
        width: 32px;
        height: 32px;
        line-height: 33px;
        text-align: center;
        border-radius: 50%;
        overflow: hidden;
    }

    .upload .round input[type = "file"]{
        position: absolute;
        transform: scale(2);
        opacity: 0;
    }

    input[type=file]::-webkit-file-upload-button{
        cursor: pointer;
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
                <?php
                // Check if the user is logged in
                if (isset($_SESSION['user'])) {
                ?>
                <li><a href=""><i class="fa-solid fa-circle-user icon-wrapper2" ></i><i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown">
                        <li><a  href="user_profile.php"><i class="fa-solid fa-user"></i>Profile</a></li>
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
  </section>
  <div class="dropdown_menu">
  <li><a href="../index.php">Home</a></li>
            <li><a href="../About/about.php">About</a></li>
            <li><a href="../Services/services.php">Services</a></li>
            <li><a  href="../GetInvolved/careers.php">Careers</a></li>
            <li><a href="../Explore/explore.php">Explore</a></li>
            <li><a href="../Contact/contact.php">Contact</a></li>
            <?php
            // Check if the user is logged in
            if (isset($_SESSION['user'])) {
                ?>
                <li><a  href="user_profile.php"><i class="fa-solid fa-user"></i>Profile</a></li>
                <li><a  href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
                <?php
            } else {
                ?>
                <li><a href="../login/login.php">Login</a></li>
                <?php
            }
            ?>
            <li> <a href="#" class="action_btn">Donate Now</a></li>
  </div>

  <main>
      <div class="box">
        <div class="inner-box">
          <?php
          if(isset($message)){
            foreach($message as $message){
                   echo '<div class="message">'.$message.'</div>';
           }           
          }
          ?>
          <div class="forms-wrap update-profile">
        
                <?php
                    $select = mysqli_query($conn, "SELECT * FROM users WHERE Email='$current_user'") or die('query failed');
                    if(mysqli_num_rows($select) > 0){
                        $fetch = mysqli_fetch_assoc($select);
                    }
                ?>
            <form class="sign-in-form" method="POST" enctype="multipart/form-data" >
              <div class="upload">
                <?php
                    if($fetch['image'] == ''){
                        echo '<img src="images/default-avatar.png">';
                    }else{
                        echo '<img src="uploaded_img/'.$fetch['image'].'">';
                    }
                    ?>
                <br>
                <div class="round">
                <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" >
                <i class="fa fa-camera" style="color: #fff" ></i>
                </div>
                </div>
              <div class="actual-form">
                <div class="input-wrap">
                  <input type="text" class="input-field" name="update_name" value="<?php echo $fetch['FullName']; ?>" required />
                  <label>Full Name</label>
                </div>

              <div class="input-wrap">
                  <input type="text"  class="input-field"  name="update_username" value="<?php echo $fetch['Username']; ?>" required />
                  <label>Username</label>
                </div>

                <div class="input-wrap">
                  <input type="email"  class="input-field"  name="update_email" value="<?php echo $fetch['Email']; ?>" required />
                  <label>Email</label>
                </div>

                <div class="input-wrap">
                  <input type="phone"  class="input-field"  name="update_phoneNb"  value="<?php echo $fetch['PhoneNumber']; ?>" required />
                  <label>Phone Number</label>
                </div>

                <select class="filter-select" name="update_service" id="update_service">
                <option>Service you want to benefit from</option>
                <?php
                  $sql = "SELECT * FROM users WHERE Email=?";
                  $stmt = $conn->prepare($sql);
                  $stmt->bind_param("s", $current_user);
                  $stmt->execute();
                  $resultId = $stmt->get_result();

                if ($fetch = $resultId->fetch_assoc()) {
                    $ID = $fetch['UserID'];
                    $sql1 = "SELECT services_users.service_id, services.Type, services_users.user_id, users.FullName FROM services_users JOIN services ON services_users.service_id=services.ServiceID JOIN users ON services_users.user_id=users.UserID WHERE services_users.user_id=?";
                    $stmt1 = $conn->prepare($sql1);
                    $stmt1->bind_param("i", $ID);
                    $stmt1->execute();
                    $result1 = $stmt1->get_result();

                if ($fetch1 = $result1->fetch_assoc()) {
                }

                $query = "SELECT * FROM services";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_array($result)) {
                  $typeS = $fetch1["Type"];
                  $idS = $fetch1["service_id"];
                  $id = $row["ServiceID"];
                  $type = $row["Type"];

                echo "<option value='$id' " . (($update_service == $id) ? 'selected' : '') . ">$type</option>";
                }
              }
              ?>
              </select>
                
                
                <div class="input-wrap">
                    <input type="password" name="update_pass"  class="input-field">
                    <label>Enter Previous Password :</label>
                </div>

                <div class="input-wrap">
                    <input type="password" name="new_pass"  class="input-field">
                    <label>Enter new Password :</label>
                </div>

                <div class="input-wrap">
                    <input type="password" name="confirm_pass"  class="input-field">
                    <label>Confirm New Password :</label>
                </div>


                <button type="submit" class="update-btn" name="update_profile">Save changes</button>

                
              </div>
              
            </form>
           
          </div>
        </div>
      </div>
    </main>

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
</script>

    
</body>
</html>