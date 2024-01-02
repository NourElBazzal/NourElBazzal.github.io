<?php
session_start();

// Include the database connection file
require('../db_connect.php');

if(isset($_POST['submit_post']) && isset($_FILES['file'])){
  $current_user = $_SESSION['user'];
  $select_user_id_query = mysqli_query($conn, "SELECT UserID FROM users WHERE Email='$current_user'");
  $user_id_row = mysqli_fetch_assoc($select_user_id_query);
  $user_id = $user_id_row['UserID'];

  $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExtArray = explode('.', $fileName);
    $fileExt = strtolower(end($fileExtArray));
    $allowed = array('jpg', 'jpeg', 'png', 'gif');

  $reviewContent= mysqli_real_escape_string($conn, $_POST['reviewContent']);

  if ($fileError === 0) {
    $imageData = file_get_contents($fileTmpName);
    $imageData = mysqli_real_escape_string($conn, $imageData);
    $insert_review_query = mysqli_query($conn, "INSERT INTO posts (Description,user_id,postImage,image_data ) VALUES ('$reviewContent', '$user_id', '$fileName', '$imageData')");

          if ($insert_review_query) {
           
        } else {
            echo "Error adding post: " . mysqli_error($conn);
        }
  }
  
}

// Check if the form is submitted
if(isset($_POST['submitComment'])){
    // Get the values from the form
    $postID = $_POST['post_id'];
    $commentContent = mysqli_real_escape_string($conn, $_POST['commentPosted']);

    if (isset($_SESSION['user'])) {
        $current_user = $_SESSION['user'];
    $select_user_id_query = mysqli_query($conn, "SELECT UserID FROM users WHERE Email='$current_user'");
    $user_id_row = mysqli_fetch_assoc($select_user_id_query);
    $userID = $user_id_row['UserID'];
   
    // Insert the comment into the comments table
    $insertCommentQuery = "INSERT INTO comments (post_id, commentUser_id, comment) VALUES ('$postID', '$userID', '$commentContent')";
    $result = mysqli_query($conn, $insertCommentQuery);

    if($result) {
        $update_comment_count_query = mysqli_query($conn, "UPDATE posts SET comment_count = comment_count + 1 WHERE PostID = '$postID'");
            if ($update_comment_count_query) {
                echo "";
            } else {
                echo "Error updating like count: " . mysqli_error($conn);
        }
        // You can optionally redirect or refresh the page after successful comment submission
        // header("Location: explore.php");
    } else {
        echo "Error adding comment: " . mysqli_error($conn);
    }
} else {
    // Handle the case where the user is not logged in (redirect, display an error, etc.)
    exit("User is not logged in");
}
}

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
    <link rel="stylesheet" href="explore.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include jQuery for AJAX functionality -->
    <style>
        .icon-wrapper2{
            margin-right: 10px;
            margin-left: -35px;
            font-size: 18px;
            width: 4em;
        }

        .dropdown_menu.open{
            height: 450px;
            position: fixed;
        }

        .action_btn{
            background-color: #cf6f24;
            margin-left: 20px;
        }


        .posts .add-comment .right-side button{
            background-color: white;
            font-size: 18px;
            border: none;
        }

@media(max-width: 850px){
    .posts{
        width: 100%;
        
}

.popup-container {
    width: 100%;
}

#reviewPopup form {
    width: 100%;
}
}

.comments-container {
    display: none;
    width: 100%;
    height: 100%;
    margin: auto;
    background-color: white;
    z-index: 1;
}

.openComments {
    width: 100%;
    height: 100%;
    background-color: white;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    display: flex; /* Add this property to enable flex layout */
    flex-direction: column; /* Display children in a column */
    justify-content: space-between; /* Space evenly between children */
}

.openComments .close {
    font-size: 30px;
    cursor: pointer;
    align-self: flex-end; /* Align the close button to the end (right) of the container */
}

.openComments p{
    margin:5px 0; /* Remove default margin for the <p> element */
}

#check{
    display: none;
}

.icons{
    display: inline-flex;
    cursor: pointer;
}

#check:checked~.icons #filled{
    display: block;
}

#check:checked~.icons #unfilled{
    display: none;
}

.icons #filled{
    display: none;
}

.fa-solid{
    color: red;
    font-size: 22px;
    margin-right: 10px;
}

.fa-regular{
    color: #00051f;
    font-size: 22px;
}


</style>
</head>
<body>
        <div class="navbar">
            <div class="logoNav"><a href="../index.php"><span style="color:#cf6f24">Empower</span>Ability</a></div>
            <ul class="links">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../About/about.php">About</a></li>
                <li><a href="../Services/services.php">Services</a></li>
                <li><a  href="../GetInvolved/careers.php">Careers</a></li>
                <li><a href="explore.php">Explore</a></li>
                <li><a href="../Contact/contact.php">Contact</a></li>
                <?php
            // Check if the user is logged in
            if (isset($_SESSION['user'])) {
                ?>
                <li><a href=""><i class="fa-solid fa-circle-user icon-wrapper2" style=" color: #fff" ></i><i class="fa fa-caret-down"></i></a>
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
                                    <li><a  href="../Profiles/user_profile.php"><i class="fa-solid fa-user" style=" color: #fff"></i>Profile</a></li>
                                <?php }
                                else if($role == 3){?>
                                    <li><a  href="../Profiles/donator_profile.php"><i class="fa-solid fa-user" style=" color: #fff"></i>Profile</a></li>
                               <?php }
                               else if($role == 1){?>
                                <li><a  href="Admin/indexAdmin.php"><i class="fa-solid fa-user " style=" color: #fff"></i>Profile</a></li>
                           <?php }
                            } ?>                              
                        <li><a  href="../logout.php"><i class="fa-solid fa-right-from-bracket" style=" color: #fff"></i>Logout</a></li>
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
            <div class="toggle_btn"><i class="fa-solid fa-bars" style=" color: #fff"></i></div>
        </div>
   
    <div class="dropdown_menu">
            <li><a href="../index.php">Home</a></li>
            <li><a href="../About/about.php">About</a></li>
            <li><a href="../Services/services.php">Services</a></li>
            <li><a href="../GetInvolved/careers.php">Careers</a></li>
            <li><a href="explore.php">Explore</a></li>
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
                        <li><a  href="../Profiles/user_profile.php"><i class="fa-solid fa-user" style=" color: #04062b"></i>Profile</a></li>
                      <?php }
                        else if($role == 3){?>
                          <li><a  href="../Profiles/donator_profile.php"><i class="fa-solid fa-user" style=" color: #04062b"></i>Profile</a></li>
                              
                   <?php } 
                   else if($role == 1){?>
                    <li><a  href="Admin/indexAdmin.php"><i class="fa-solid fa-user" style=" color: #04062b"></i>Profile</a></li>
               <?php }
                   }  ?>
                    <li><a  href="../logout.php"><i class="fa-solid fa-right-from-bracket" style=" color: #04062b"></i>Logout</a></li>
               <?php }else {
               ?>
               <li><a href="../login/login.php">Login</a></li>
               <?php
           }
           ?>
            <li> <a href="#" class="action_btn">Donate Now</a></li>
    </div>

    <!-- START OF EXPLORE SECTION -->
    
    <section class="explore" >
    <?php
           
           $sql = "SELECT posts.PostID, posts.like_count, posts.comment_count, posts.postImage, posts.image_data, posts.Description, posts.user_id, users.UserID, users.FullName, users.image FROM posts INNER JOIN users ON posts.user_id=users.UserID;";
           $result1 = mysqli_query($conn, $sql);
           while($row = mysqli_fetch_assoc($result1)){ 
                $name= $row["FullName"];
                $caption= $row["Description"];
                $postImage= $row["postImage"];
                $likes= $row["like_count"];
                $comments= $row["comment_count"];
                $postid= $row["PostID"];
                            ?>
        <div class="posts">
            <div class="post-title">
                <div class="post-left">
                <div class="image">
                <?php 
                if($row['image'] == ''){
                    echo '<img src="../Profiles/images/default-avatar.png" width="32" height="32">';
                }else{
                    echo '<img src="../Profiles/uploaded_img/'.$row['image'].'" width="32" height="32">';
                }?>
                </div>
                <div class="details">
                    <?php echo "<p>$name</p>" ?>
                </div>
                </div>

            </div>

            <div class="post-content">
                   <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image_data']) . '" alt="Uploaded Image" height="600" width="600">'; ?>
            </div>
            
                <?php
                if (isset($_SESSION['user'])) {
                    $current_user = $_SESSION['user'];
                    $query = "SELECT role_id, UserID FROM users WHERE Email='$current_user'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                    // If a user with the provided username is found in the database, We then use the fetch_assoc() method to fetch the data from the first row of the result set as an associative array. This means that we can access the column values by their names. In this case, we retrieve the hashed password value and store it in the variable $hashedPassword.
                    $row1 = $result->fetch_assoc();
                    $role = $row1['role_id'];
                    $userID = $row1['UserID'];
                    if($role == 2 || $role == 3){?>
                    <div class="post-footer">
                    <div class="like-share-comment">
                        <li><a href="#" class="likeButton" data-post-id="<?php echo $row['PostID']; ?>"><i class="fa-regular fa-heart"  id="likedHeart" style=" color: #00051f" ></i></a></li>
                    </div>
                    </div>
                <?php } ?>    
                <?php } ?>
                <?php } ?>
               
            <div class="post-footer-content">
                <?php echo"<p>$likes likes</p>" ?>
                <?php echo "<p>$name<span>$caption</span> </p>" ?>
                <div class="viewComments" id="viewComments" ><?php echo "<p>View all $comments comments</p>" ?></div>
                
                <div class="comments-container commentsPopup">
                    <div class="openComments">
                    <span class="close closeComments">&times;</span>
                    <?php
                        $sql="SELECT comments.comment, comments.commentUser_id, comments.post_id, users.UserID, users.FullName, posts.PostID FROM comments JOIN users ON comments.commentUser_id=users.UserID JOIN posts ON comments.post_id= posts.PostID WHERE posts.PostID= $postid;"; 
                        $resultC= mysqli_query($conn, $sql);

                        while($rowC = mysqli_fetch_array($resultC)){
                            $userName= $rowC["FullName"];
                            $userComment= $rowC["comment"];

                        echo "<p>$userName<span>$userComment</span></p>";  
                        
                        }
                    ?>
                    </div>
                </div>
                <p class="posting-time">23 HOURS AGO</p>
            </div>

            <?php
                if (isset($_SESSION['user'])) {
                    $current_user = $_SESSION['user'];
                    $query = "SELECT * FROM users WHERE Email='$current_user'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        // If a user with the provided username is found in the database, We then use the fetch_assoc() method to fetch the data from the first row of the result set as an associative array. This means that we can access the column values by their names. In this case, we retrieve the hashed password value and store it in the variable $hashedPassword.
                        $row1 = $result->fetch_assoc();
                        $id= $row1['UserID'];
                        $role = $row1['role_id'];
                        if($role == 2 || $role == 3){?>
                        <form action="" method="POST" class="comment-form" enctype="multipart/form-data">
                            <div class="add-comment">
                                <div class="left-side">
                                    <i class="far fa-smile-beam"></i>
                                        <input type="hidden" name="post_id" value="<?php echo $row['PostID']; ?>">
                                        <input type="text" placeholder="Add a comment..." id="commentPosted" name="commentPosted">
                                </div>
                            <div class="right-side">
                                <button type="submit" class="submitComment" name='submitComment' id="submitComment" data-post-id="<?php echo $row['PostID']; ?>">Post</button>
                            </div>
                            </div>
                        </form>
                        <?php } ?>    
                    <?php } ?>
            <?php } ?>
            </div>
            
        <?php } ?>
    </section>

    <div class="add-post">
    <?php
    if (isset($_SESSION['user'])) {
        $current_user = $_SESSION['user'];
        $query = "SELECT role_id FROM users WHERE Email='$current_user'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            // If a user with the provided username is found in the database, We then use the fetch_assoc() method to fetch the data from the first row of the result set as an associative array. This means that we can access the column values by their names. In this case, we retrieve the hashed password value and store it in the variable $hashedPassword.
            $row = $result->fetch_assoc();
            $role = $row['role_id'];
            if($role == 2){?>
                <li><a href=""><i class="fa-solid fa-square-plus"  style=" color: #00051f; " id="openReviewPopup"></i></a></li>
            <?php } ?>    
        <?php } ?>
    <?php } ?>
    </div>

     <!-- Review Popup -->
     <div id="reviewPopup" class="popup-container">
        <div class="popup">
            <span class="close" id="closeReviewPopup">&times;</span>
            
            <form id="reviewForm" class="" method="POST" action="" enctype="multipart/form-data">
                <div class="">
                    <h2>Create a new post</h2>
                    <input type="file" name="file" id="file" accept="image/*" required>
                    <textarea name="reviewContent" class="input-field" rows="4" placeholder="Add a caption to your post.." required></textarea>
                    <button type="submit" class="submit-btn" name="submit_post">Add post</button>
                </div>
            </form>
        </div>
    </div>
    
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

    // JavaScript to handle like button clicks using AJAX
    $(document).ready(function () {
            $(".likeButton").click(function (e) {
                e.preventDefault();

                var postID = $(this).data('post-id');
                var likeButton = $(this);

                $.ajax({
                    type: 'POST',
                    url: 'like_post.php', 
                    data: { post_id: postID },
                    success: function (response) {
                        // Handle the response from the server 
                        console.log(response);
                        if (response === 'Like added successfully!') {
                            // Toggle the class for heart icon
                            likeButton.toggleClass('fa-solid fa-heart');
                        } else if (response ==='Like removed successfully!') {
                            likeButton.toggleClass('fa-regular fa-heart');
                            
                        } else if (response === 'already_liked') {
                            // Optionally, inform the user that they have already liked the post
                            console.log('You have already liked this post.');
                        } else {
                            console.error('Error:', response);
                        }
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
            });
        });

        
    // Script for post popup
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

    // Script for review popup
    document.addEventListener('DOMContentLoaded', function () {
        // Open the review popup
    document.querySelectorAll('.viewComments').forEach(function (commentLink) {
        commentLink.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default form submission
            const commentsPopup = this.closest('.posts').querySelector('.commentsPopup');
            commentsPopup.style.display = 'flex';
        });
    });

    // Close the review popup
    document.querySelectorAll('.closeComments').forEach(function (closeBtn) {
        closeBtn.addEventListener('click', function () {
            this.closest('.commentsPopup').style.display = 'none';
        });
    });
    });

    </script>
</body>
</html>