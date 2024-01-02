<?php
session_start();

// Include the database connection file
require('../db_connect.php');

if (isset($_POST['post_id']) && isset($_SESSION['user'])) {
    $postID = $_POST['post_id'];
    $currentUser = $_SESSION['user'];
    // Check if the user has already liked the post
    $userIDQuery = mysqli_query($conn, "SELECT UserID FROM users WHERE Email='$currentUser'");
    $userIDRow = mysqli_fetch_assoc($userIDQuery);
    $userID = $userIDRow['UserID'];

    $checkLikedQuery = mysqli_query($conn, "SELECT * FROM likedposts WHERE post_id=$postID AND likedUser_id=$userID");

    if (mysqli_num_rows($checkLikedQuery) == 0) {
        // User hasn't liked the post, insert the like into the database
        $insertLikeQuery = mysqli_query($conn, "INSERT INTO likedposts (post_id, likedUser_id) VALUES ($postID, $userID)");
        //$insertLikeQuery = mysqli_query($conn, "DELETE FROM likedposts (post_id, likedUser_id) VALUES ($postID, $userID)");

        if ($insertLikeQuery) {
            $update_like_count_query = mysqli_query($conn, "UPDATE posts SET like_count = like_count + 1 WHERE PostID = '$postID'");
            //$update_like_count_query = mysqli_query($conn, "UPDATE posts SET like_count = like_count - 1 WHERE PostID = '$postID'");
            if ($update_like_count_query) {
                echo "Like added successfully!";
            } else {
                echo "Error updating like count: " . mysqli_error($conn);
        }
        } else {
            echo 'error';
        }
    } else {
         // User has already liked the post, remove the like from the database
         $deleteLikeQuery = mysqli_query($conn, "DELETE FROM likedposts WHERE post_id=$postID AND likedUser_id=$userID");

         if ($deleteLikeQuery) {
             $update_like_count_query = mysqli_query($conn, "UPDATE posts SET like_count = like_count - 1 WHERE PostID = '$postID'");
             if ($update_like_count_query) {
                 echo "Like removed successfully!";
             } else {
                 echo "Error updating like count: " . mysqli_error($conn);
             }
         } else {
             echo 'error';
         }
    }
} else {
    echo 'error';
}
?>