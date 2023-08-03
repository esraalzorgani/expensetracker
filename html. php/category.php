<!----------------ESRA ALZORGANI------------>
<!----------------20180107887-------صفحة لإضافة فئة------->
<?php
require_once 'config.php';

session_start();

if (isset($_POST['submit'])) {
    $Name = $_POST['CategoryName'];
    $Amount = $_POST['Amount'];
    $Note = $_POST['Note'];
    $id = $_SESSION['userid'];

   
    if (empty($Name) || empty($Amount)) {
        echo "<p>الرجاء ملء جميع الحقول المطلوبة.</p>";
    } else {
        
        $query = "SELECT * FROM category WHERE category_name='$Name' AND user_id='$id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<p>الفئة موجودة بالفعل.</p>";
        } else {
            $insert_query = "INSERT INTO category (category_name, Amount, Note, user_id) VALUES ('$Name', '$Amount', '$Note', '$id')";
            $insert_result = mysqli_query($con, $insert_query);

            if (!$insert_result) {
                echo "<p>Unable to execute the query.</p> ";
                echo "<p>" . $insert_query . "</p>";
                die(mysqli_error($con));
            } else {
                echo "<p>تم إضافة الفئة بنجاح.</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Expense Tracker</title>
    <link rel="icon" href="../images/M2.png" type="LOGO">
    <link rel="stylesheet" href="../css/ex.css">
</head>
<body>
    <header>
        <img class="logo" alt="esra alzorgani" src="../images/logoo.png" />
        <nav class="header1">
            <a class="a" href="home2.php"> HOME</a>
            <a class="a" href="category.php">ADD CATEGORY</a>
            <a class="a" href="updateca.php">EDIT CATEGORY</a>
            <a class="a" href="transfer.php">TRANSFER</a>
            <a class="a" href="logout.php">LOGOUT</a>
        </nav>
        <?php
            echo 'User name :- '. $_SESSION['username'];
        ?>
    </header>

    <main>
        <form method="post" action="">
            <h2 class="log">Add Category</h2>
            <input type="text" name="CategoryName" placeholder="Category Name" required> <br>
            <input type="text" name="Amount" placeholder="Amount" required> <br>
            <input type="text" name="Note" placeholder="Note"> <br>
            <input type="submit" name="submit" value="Insert"> <br>
        </form>
    </main>

    <br>
    <br>
    <br>
    <br>
    <div class="footer">
        <footer>
            <div class="social">
                <a href="#"><img src="../images/u-03.png" width="35px"/></a>
                <a href="#"><img src="../images/u-02.png" width="35px"/></a>
                <a href="#"><img src="../images/u-01.png" width="35px"/></a>
                <a href="#"><img src="../images/u-04.png" width="35px"/></a>
                <br>
                <p>Email: Esraalzorgani2020@gmail.com</p>
            </div>
            <p class="copyright">Expense Tracker © 2023</p>
        </footer>
    </div>
</body>
</html>