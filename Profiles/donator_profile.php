<?php
session_start();

// Include the database connection file
require('../db_connect.php');
$current_user = $_SESSION['user'];


if(isset($_POST['submit_review'])){
  $select_user_id_query = mysqli_query($conn, "SELECT UserID FROM users WHERE Email='$current_user'");
  $user_id_row = mysqli_fetch_assoc($select_user_id_query);
  $user_id = $user_id_row['UserID'];

  $reviewContent= mysqli_real_escape_string($conn, $_POST['reviewContent']);

  $insert_review_query = mysqli_query($conn, "INSERT INTO reviews (ReviewComment,user_id) VALUES ('$reviewContent', '$user_id')");

          if ($insert_review_query) {
            echo "Review added successfully!";
        } else {
            echo "Error adding review: " . mysqli_error($conn);
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
   margin-left: 40%;
   margin-bottom: -100px;
}

@media (max-width: 850px) {


  img{
    margin-left: 30%;
    margin-bottom: 0;
 }
}

@media (max-width: 530px) {
  img{
    margin-left: 30%;
    margin-bottom: 0;
 }
  
}

.update-btn {
  text-align: center;
  padding-top: 10px;
  }

  .popup-container {
    display: none;
    position: absolute;
    width: 500px;
    height: 500px;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 1;
}

.popup {
    height: 500px;
    width: 500px;
    background-color: rgba(16, 17, 52, 0.5);
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    text-align: center;
}

.popup h2{
  font-size: 14px;
  color: #fff;
}

.popup .close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    cursor: pointer;
}

/* Style for review form fields */
#reviewPopup form {
    background-color: white;
    width: 100%;
    height: 400px;
    display: flex;
    justify-content: flex-start;
    padding-top: 40px;
}



#reviewPopup form textarea {
    color: black;
    width:300px;
    height: 300px;
    resize: none;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 5px;
    position: relative;
}

#reviewPopup form .submit-btn {
    display: inline-block;
    text-decoration: none;
    text-align: center;
    padding-top: 10px;
    width: 100%;
    height: 43px;
    background-color: #151111;
    margin-bottom: -200px;
    color: #fff;
    border: none;
    cursor: pointer;
    border-radius: 0.8rem;
    font-size: 0.8rem;
    transition: 0.3s;
}

#reviewPopup form .submit-btn:hover {
    background-color:  #cf6f24;
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
                        <li><a  href="donator_profile.php"><i class="fa-solid fa-user"></i>Profile</a></li>
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
                <li><a  href="donator_profile.php"><i class="fa-solid fa-user"></i>Profile</a></li>
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
          <div class="forms-wrap">
            <?php
            $sql = "SELECT * FROM users WHERE Email='$current_user'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){
              $fetch = mysqli_fetch_assoc($result);
            }

            if($fetch['image'] == ''){
              echo '<img src="images/default-avatar.png">';
           }else{
              echo '<img src="uploaded_img/'.$fetch['image'].'">';
           }
          
            ?>
            <form class="sign-in-form" method="POST" enctype="multipart/form-data" >

              <div class="actual-form">
                <div class="input-wrap">
                  <input type="text" class="input-field" name="name" value="<?php echo $fetch['FullName']; ?>" required />
                  <label>Full Name</label>
                </div>

              <div class="input-wrap">
                  <input type="text"  class="input-field"  name="username" value="<?php echo $fetch['Username']; ?>" required />
                  <label>Username</label>
                </div>

                <div class="input-wrap">
                  <input type="email"  class="input-field"  name="email" value="<?php echo $fetch['Email']; ?>" required />
                  <label>Email</label>
                </div>

                <div class="input-wrap">
                  <input type="number"  class="input-field"  name="phone_number"  value="<?php echo $fetch['PhoneNumber']; ?>" required />
                  <label>Phone Number</label>
                </div>


          <?php
           $sql = "SELECT * FROM users WHERE Email='$current_user'";
           $result = mysqli_query($conn, $sql);

           if(mysqli_num_rows($result) > 0){
             $fetch = mysqli_fetch_assoc($result);
           }
           $id=$fetch['UserID'];

            $sql = "SELECT services_users.service_id, services.Type, services_users.user_id, users.FullName FROM services_users JOIN services ON services_users.service_id=services.ServiceID JOIN users ON services_users.user_id=users.UserID WHERE services_users.user_id=$id;";
            $result1 = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result1) > 0){
              $fetch1 = mysqli_fetch_assoc($result1);
            }         
            ?>

                <div class="input-wrap">
                  <input type="text"  class="input-field"  name="service"  value="<?php echo $fetch1['Type']; ?>" required />
                  <label>Service chosen:</label>
                </div>

                <button id="openReviewPopup" class="update-btn" style="margin-bottom: 5px;">Add Review</button>
                <a href="edit_donator_profile.php" class="update-btn">Edit Profile</a><br>

              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Review Popup -->
    <div id="reviewPopup" class="popup-container">
        <div class="popup">
            <span class="close" id="closeReviewPopup">&times;</span>
            <form id="reviewForm" class="" method="POST" action="">
                <div class="">
                    <textarea name="reviewContent" class="input-field" rows="4" placeholder="Describe your experience.." required></textarea>
                </div>
                <button type="submit" class="submit-btn" name="submit_review">Submit Review</button>
            </form>
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


    document.addEventListener('DOMContentLoaded', function () {
        // Open the review popup
        document.getElementById('openReviewPopup').addEventListener('click', function () {
            event.preventDefault(); // Prevent the default form submission
            document.getElementById('reviewPopup').style.display = 'flex';
        });

        // Close the review popup
        document.getElementById('closeReviewPopup').addEventListener('click', function () {
            document.getElementById('reviewPopup').style.display = 'none';
        });

        // Close the review popup if the background is clicked
        window.addEventListener('click', function (event) {
            if (event.target === document.getElementById('reviewPopup')) {
                document.getElementById('reviewPopup').style.display = 'none';
            }
        });
    });


</script>

    
</body>
</html>