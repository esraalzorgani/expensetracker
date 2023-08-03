<!----------------ESRA ALZORGANI------------>
<!----------------20180107887-----
   صفحة لتعديل المصاريف الكلية------->
<?php
require_once 'config.php';
session_start();

if (isset($_POST['submit'])) {
    $CategoryName = $_POST['CategoryName'];
    $Amount = $_POST['Amount'];
    $Date = $_POST['Date'];
    $PaymentMethod = $_POST['PaymentMethod'];
    $Note = $_POST['Note'];
    $id = $_SESSION['userid'];

   
    if (isset($_GET['id'])) {
        $id_category = $_GET['id'];

        
        $query = "UPDATE expense SET category_id='$CategoryName', Amount='$Amount', date='$Date', PaymentMethod='$PaymentMethod', Note='$Note' WHERE expense_id='$id_category' AND user_id='$id'";
        $result = mysqli_query($con, $query);

        if ($result){
            header('location: displayexpenses.php');
            exit();
        } else {
            die(mysqli_error($con));
        }
    } else {
        
        header('location: displayexpenses.php');
        exit();
    }
}


if (isset($_GET['id']))
{
    $id_category = $_GET['id'];
    $user_id = $_SESSION['userid'];

    $sql = "SELECT * FROM expense WHERE expense_id='$id_category' AND user_id='$user_id'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        header('location: displayexpenses.php');
        exit();
    }
} else {
    header('location: displayexpenses.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Expense Tracker - تعديل المصروف</title>
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
            <a  class="a"href="addexpense.php">EXPENSE</a>
            <a  class="a"href="displayexpenses.php">SHOW EXPENSE</a>
            <a  class="a"href="search.php"> EXPENSE RESEARCH</a>
            <a class="a" href="logout.php">LOGOUT</a>
        </nav>

        <?php
            echo 'User name :- '. $_SESSION['username'];
        ?>
    </header>

    <main>
        <form method="post" action="">
            <h2 class="log">Edit Expense</h2>
            <input type="text" name="CategoryName" placeholder="Category Name" value="<?php echo $row['category_id']; ?>" required> <br>
            <input type="text" name="Amount" placeholder="Amount" value="<?php echo $row['Amount']; ?>" required> <br>
            <input type="date" name="Date" value="<?php echo $row['date']; ?>" required> <br>
            <input type="text" name="PaymentMethod" placeholder="Payment Method" value="<?php echo $row['PaymentMethod']; ?>"> <br>
            <input type="text" name="Note" placeholder="Note" value="<?php echo $row['Note']; ?>"> <br>
            <input type="submit" name="submit" value="Edit">
            <center><span><a href="displayexpenses.php">الرجوع للمصاريف</a></span></center>
        </form>
    </main>

    <br>
    <br>
    <br>
    <br>
    <div class="footer">
        <footer>
            <div class="social">
                <a href="#"><img  src="../images/u-03.png" width="35px"/></a>
                <a href="#"> <img  src="../images/u-02.png" width="35px" /></a>
                <a href="#"> <img  src="../images/u-01.png" width="35px" /></a>
                <a href="#"><img  src="../images/u-04.png" width="35px"/></a>
                <br>
                <p>Email: Esraalzorgani2020@gmail.com</p>
            </div>
            <p class="copyright">Expense Tracker © 2023</p>
        </footer>
    </div>
</body>
</html>