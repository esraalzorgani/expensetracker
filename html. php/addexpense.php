<!----------------ESRA ALZORGANI------------>
<!----------------20180107887-----
   صفحة لإضافة مصروف------->
<?php
require_once 'config.php';

session_start();

if (isset($_POST['submit'])){
    $CategoryName = $_POST['CategoryName'];
    $Amount = $_POST['Amount'];
    $Date = $_POST['Date'];
    $PaymentMethod = $_POST['PaymentMethod'];
    $Note = $_POST['Note'];
    $id = $_SESSION['userid'];

   
    $checkQuery = "SELECT *FROM category WHERE category_name = '$CategoryName'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) == 0)
    {
        echo "<p> اسم الفئة غير موجود في قاعدة البيانات.</p>";
        exit();
    }

    $categoryData = mysqli_fetch_assoc($checkResult);
    $_SESSION['category_name'] = $categoryData['category_name'];
    $_SESSION['category_amount'] = $categoryData['Amount'];
    $_SESSION['category_id'] = $categoryData['category_id'];

    try {

        mysqli_begin_transaction($con);

        if ($Amount > $_SESSION['category_amount'])
        {
            echo "<p>المبلغ المدخل أكبر من أو يساوي رصيد الفئة الحالي.</p>";
            exit();
        }
        else
        {
        $categoryID=$_SESSION['category_id'];
        //لإضافة الفئات 
        $query = "INSERT INTO expense (Amount, date, PaymentMethod, Note, category_id, user_id) VALUES ('$Amount', '$Date', '$PaymentMethod', '$Note', '$categoryID',' $id')";
        $result = mysqli_query($con, $query);
        
        if (!$result)
        {
            throw new Exception("تعذر تنفيذ الاستعلام: " . mysqli_error($con));
        }

        $updateQuery = "UPDATE category SET Amount = Amount - '$Amount' WHERE category_id = '{$_SESSION['category_id']}' AND user_id = '$id'";
        $updateResult = mysqli_query($con, $updateQuery);
       }
        if (!$updateResult) {
            throw new Exception("تعذر تحديث رصيد الفئة: " . mysqli_error($con));
        }

        mysqli_commit($con);

        echo "<p>تم تحديث السجل ورصيد الفئة بنجاح.</p>";
 }
    catch (Exception $e)
    {
       
        mysqli_rollback($con);

        echo "<p>حدث خطأ: " . $e->getMessage() . "</p>";
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
            <a  class="a"href="addexpense.php">Expense</a>
            <a class="a" href="logout.php">LOGOUT</a>
        </nav>

        <?php
        echo 'User name :- '. $_SESSION['username'];
        ?> 
    </header>

    <!------------------------------------form------------------------------------------------->

    <main>
        <form method="post" action="">
            <h2 class="log">Add Expense</h2>
            <input type="text" name="CategoryName" placeholder="Category Name " required> <br>
            <input type="text" name="Amount" placeholder="Amount" required> <br>
            <center><input type="date" name="Date" required> <br></center>
            <input type="text" name="PaymentMethod" placeholder="Payment  Method"> <br>
            <input type="text" name="Note" placeholder="Note"> <br>
            <input type="submit" name="submit" value="insert"> <br>

            <center><span><a href="displayexpenses.php">عرض المصاريف </a><span></center>
            <center><span><a href="search.php">البحث</a><span></center>
        
    </main>

    <!-------------------------------------FOOTER----------------------------------------------------->
    <br>
    <br>
    <br>
    <br>
    <div class="footer">
        <footer>
            <div class="social">
                <a href="#"><img src="../images/u-03.png" width="35px"/></a>
                <a href="#"> <img src="../images/u-02.png" width="35px" /></a>
                <a href="#"> <img src="../images/u-01.png" width="35px" /></a>
                <a href="#"><img src="../images/u-04.png" width="35px"/></a>
                <br>
                <p>Email: Esraalzorgani2020@gmail.com</p>
            </div>
            <p class="copyright">Expense Tracker © 2023</p>
        </footer>
    </div>
</body>
</html>