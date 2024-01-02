<?php
// Include the database connection file
require('../db_connect.php');

// Check if the search parameter is set
if (isset($_GET['search'])) {
    // Sanitize and escape the search term
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);

    // Construct the query to search for jobs based on the job title or description
    $query = "SELECT * FROM jobs WHERE JobTitle LIKE '%$searchTerm%' OR Description LIKE '%$searchTerm%'";
    $result = mysqli_query($conn, $query);

    // Output the search results as HTML
    while ($row = mysqli_fetch_array($result)) {
        // Customize this part based on your existing job listing structure
        echo '<div class="job-card">';
        echo '<div class="job-name">';
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image_data']) . '" alt="Uploaded Image" height="60px" width="60px" style=" margin: 0.5rem;">';
        echo '<div class="job-detail">';
        echo '<h4>' . $row["companyName"] . '</h4>';
        echo '<h3>' . $row["JobTitle"] . '</h3>';
        echo '<p>' . $row["Description"] . '</p>';
        echo '<p>' . $row["ContactNb"] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '<div class="job-posted">Posted <br>' . $row["Date"] . '</div>';
        echo '</div>';
    }

    // Close the database connection
    mysqli_close($conn);

    // Stop further execution after sending the search results
    exit();
}
?>
