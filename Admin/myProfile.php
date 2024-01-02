<?php

session_start();

// Include the database connection file
require('../db_connect.php');

$current_user = $_SESSION['user'];

?>
<!DOCTYPE html>
<html>
<head>
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">-->
    <title>Manage Admins</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styleAdmin.css"/>
    <!--<link rel="stylesheet" href="../Profiles/profileStyle.css" />-->

    <style>
        
        main{
            background: var(--color-background) !important;
            width: 100%;
        }

        .box{
            max-width: 800px;
        }
        .update-btn {
            text-align: center;
            padding-top: 10px;
            }

        /*MYP ROFILE PAGE*/
.box {
  position: relative;
  width: 100%;
  max-width: 1020px;
  height: 800px;
  margin-top: 90px;
  background-color: #fff;
  border-radius: 3.3rem;
  box-shadow: 0 60px 40px -30px rgba(0, 0, 0, 0.27);
  background-color: var( --color-white);
}

.inner-box {
  position: absolute;
  width: 100%;
  height: calc(100% - 4.1rem);
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.forms-wrap {
  position: absolute;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;

}

.sign-in-form {
  max-width: 500px;
  width: 100%;
  margin: 0 auto;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-evenly;
}

.input-wrap {
  position: relative;
  height: 37px;
  margin-bottom: 2rem;
}

.input-field {
  position: absolute;
  width: 100%;
  height: 100%;
  background: none;
  border: none;
  outline: none;
  border-bottom: 1px solid #bbb;
  padding: 0;
  font-size:1rem;
  color: var(--color-dark);
  transition: 0.4s;
}

.profileLabel{
  position: absolute;
  left: 0;
  top: 50%;
  transform: translateY(-50%);
  font-size: 0.95rem !important;
  color: #bbb;
  pointer-events: none;
  transition: 0.4s;
}

.input-field.active {
  border-bottom-color: #151111;
}

.input-field+ label {
  font-size: 0.75rem;
  top: -2px;
}

.update-btn {
  display: inline-block;
  text-decoration: none;
  text-align: center;
  padding-top: 10px;
  width: 100%;
  height: 43px;
  background-color: #151111;
  color: #fff;
  border: none;
  cursor: pointer;
  border-radius: 0.8rem;
  font-size: 0.8rem;
  margin-bottom: 2rem;
  transition: 0.3s;
}

.update-btn:hover {
  background-color:  #cf6f24;
}

.upload{
        width: 125px;
        position: relative;
        margin: auto;
        margin-top: 0;
        margin-bottom: 5px;
    }

    .upload img{
        height: 150px;
        width: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 8px solid #DCDCDC;
    }

@media (max-width: 850px) {
.box {
  height: auto;
  max-width: 550px;
  overflow: hidden;
}

.inner-box {
  position: static;
  transform: none;
  width: revert;
  height: revert;
  padding: 2rem;
}

.forms-wrap {
  position: revert;
  width: 100%;
  height: auto;
}

.sign-in-form  {
  max-width: revert;
  padding: 1.5rem 2.5rem 2rem;
}
}


@media (max-width: 530px) {
main {
  padding: 1rem;
}

.box {
  border-radius: 2rem;
}

.inner-box {
  padding: 1rem;
}

.sign-in-form  {
  padding: 1rem 2rem 1.5rem;
}


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
      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">
            <?php
            $sql = "SELECT * FROM users WHERE Email='$current_user'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){
              $fetch = mysqli_fetch_assoc($result);
            }
          
            ?>
            <form class="sign-in-form" method="POST" enctype="multipart/form-data" >
            <div class="upload">
                <?php
                if($fetch['image'] == ''){
                    echo '<img class="ad_img" src="../Profiles/images/default-avatar.png">';
                 }else{
                    echo '<img class="ad_img" src="uploaded_images/'.$fetch['image'].'">';
                 }
                ?>
                </div>
              <div class="actual-form">
                <div class="input-wrap">
                  <input type="text" class="input-field" name="name" value="<?php echo $fetch['FullName']; ?>" required />
                  <label class="profileLabel" >Full Name</label>
                </div>

              <div class="input-wrap">
                  <input type="text"  class="input-field"  name="username" value="<?php echo $fetch['Username']; ?>" required />
                  <label class="profileLabel">Username</label>
                </div>

                <div class="input-wrap">
                  <input type="email"  class="input-field"  name="email" value="<?php echo $fetch['Email']; ?>" required />
                  <label class="profileLabel">Email</label>
                </div>

                <div class="input-wrap">
                  <input type="number"  class="input-field"  name="phone_number"  value="<?php echo $fetch['PhoneNumber']; ?>" required />
                  <label class="profileLabel">Phone Number</label>
                </div>

                <a href="editMyProfile.php" class="update-btn">Edit Profile</a><br>
              </div>
            </form>
          </div>
        </div>
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