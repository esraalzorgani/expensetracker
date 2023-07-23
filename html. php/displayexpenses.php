<!----------------ESRA ALZORGANI------------>
<!----------------20180107887-----
   صفحة لعرض------->
<?php
require_once 'config.php';
session_start();


$sql = "SELECT expense.*, category.category_name 
        FROM expense 
        INNER JOIN category ON expense.category_id = category.category_id 
        WHERE expense.user_id = '{$_SESSION['userid']}'";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Expense Tracker - عرض المصاريف</title>
    <link rel="icon" href="../images/M2.png" type="LOGO">
    <link rel="stylesheet" href="../css/ex.css">
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
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

    <h1>قائمة المصروفات</h1>
    <table>
        <tr>
            <th>اسم الفئة</th>
            <th>المبلغ</th>
            <th>التاريخ</th>
            <th>طريقة الدفع</th>
            <th>ملاحظة</th>
            <th>تعديل</th>
            <th>حذف</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["category_name"] . "</td>"; 
                echo "<td>" . $row["Amount"] . "</td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["PaymentMethod"] . "</td>";
                echo "<td>" . $row["Note"] . "</td>";
                echo "<td><a href='editexpense.php?id=" . $row["expense_id"] . "'>تعديل</a></td>";
                echo "<td><a href='deleteexpense.php?id=" . $row["expense_id"] . "'>حذف</a></td>"; 
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>لا توجد بيانات لعرضها</td></tr>";
        }
        ?>
    </table>
    
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