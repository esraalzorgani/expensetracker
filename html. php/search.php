<!----------------ESRA ALZORGANI------------>
<!----------------20180107887-----صفحة للبحث عن مصروف معين ----->
<?php
require_once 'config.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Expense Tracker</title>
    <link rel="icon" href="../images/M2.png" type="LOGO">
    <link rel="stylesheet" href="../css/ex.css">
    <title>Search</title>
</head>
<body>
<img class="logo" alt="esra alzorgani" src="../images/logoo.png" />
        <nav class="header1">
            <a class="a" href="home2.php">HOME</a>
            <a class="a" href="category.php">ADD CATEGORY</a>
            <a class="a" href="updateca.php">EDIT CATEGORY</a>
            <a class="a" href="transfer.php">TRANSFER</a>
            <a class="a" href="logout.php">LOGOUT</a>
        </nav>
    <form method="post" action="">
        <h2 class="log">Search Expenses</h2>
        <input type="text" name="CategoryName" placeholder="Category Name" required><br>
        <center><input type="date" name="searchDate" placeholder="Enter Date" required></center>
        <input type="submit" name="search" value="Search">
    </form>
    
    <?php
    try {
        if (isset($_POST['search'])) {
            $searchDate = $_POST['searchDate'];
            
            if (!$searchDate) {
                echo '<p>You have not entered search details.<br/>
                Please go back and try again.</p>';
                exit;
            }
           
            $query = "SELECT Amount, date, PaymentMethod FROM expense WHERE date = '$searchDate'";
            $result = $con->query($query);
            
            if (!$result) {
                echo "<p>Unable to execute the query.</p> ";
                die($con->error);
            }
            
            echo "<p>Number of expenses found: " . $result->num_rows . "</p>";
            $rows = $result->num_rows;
            
            for ($j = 0; $j < $rows; ++$j) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                echo "<p>price: " . number_format($row['Amount'], 2) . " LYD</p>";
                echo "<p>date: " . $row['date'] . "</p>";
                echo "<p>payment: " . $row['PaymentMethod'] . "</p>";
            }
            
            $con->close();
        }
    } catch (mysqli_sql_exception $exception) {
        echo 'Transaction Failed!!';
        
        if ($con != null)
            $con->close();
        
        $con = null;
        echo '<br>';
        echo $exception->getMessage();
    }
    ?>
</body>
</html>