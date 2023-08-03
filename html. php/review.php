<!----------------ESRA ALZORGANI------------>
<!----------------20180107887-----صفحة للتقيم----->
<?php
require_once 'config.php';
session_start();

if (isset($_POST['submit'])) {
    $id = $_SESSION['userid'];

    $checkQuery = "SELECT * FROM review WHERE user_id = '$id'";
    $checkResult = mysqli_query($con, $checkQuery);
    
    if ($checkResult) {
        $count = mysqli_num_rows($checkResult);
        if ($count > 0) {
            echo "You have already rated the website. You cannot rate again.";
        } else {
            $rating = $_POST['rating'];
            $comment = $_POST['comment'];

            if ($rating < 0 || $rating > 5) {
                echo "Invalid rating. The rating should be between 0 and 5.";
            } else {
                $insertQuery = "INSERT INTO review (rating, comment, user_id) VALUES ('$rating', '$comment', '$id')";
                $insertResult = mysqli_query($con, $insertQuery);

                if ($insertResult) {
                    echo "Rating added successfully.";
                } else {
                    echo "An error occurred while saving the rating. Please try again.";
                }
            }
        }
    } else {
        echo "An error occurred while checking previous ratings. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title> Expense Tracker </title>
    <link rel="icon" href="../images/M2.png" type="LOGO">
    <link rel="stylesheet" href="../css/ex.css">
</head>
<body>
<header>
    <img class="logo" alt="esra alzorgani" src="../images/logoo.png" />
    <nav class="header1">
        <a class="a" href="home2.php"> HOME</a> 
        <a class="a" href="aboutus.html">ABOUT US</a> 
        <a class="a" href="category.php">CATEGORY</a> 
        <a class="a" href="Reports.html">REPORTS</a>
        <a class="a" href="addexpense.php">Expense</a>
        <a class="a" href="logout.php">LOGOUT</a>
    </nav>

    <?php
    echo 'User name :- '. $_SESSION['username'];
    ?> 
</header>
<form method="post" action="">
    <h2 class="log">Rate the Website</h2>
    <br>
    <label for="rating">Rating (from 0 to 5):</label>
    <input type="number" name="rating" min="0" max="5" required><br>

    <label for="comment">Comment:</label><br>
    <textarea name="comment" rows="4" cols="50" ></textarea><br>

    <input type="submit" name="submit" value="Submit Rating">
</form>

</body>
</html>