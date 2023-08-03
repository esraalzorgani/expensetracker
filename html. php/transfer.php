<!----------------ESRA ALZORGANI------------>
<!----------------20180107887-----صفحة لتحويل قيم مالية من فئة لأخرى------>
<?php
require_once 'config.php';

session_start();

if (isset($_POST['submit']))
{
   
    mysqli_autocommit($con, FALSE);

    $FromCategory = $_POST['FromCategory'];
    $ToCategory = $_POST['ToCategory'];
    $TransferAmount = $_POST['TransferAmount'];
    $Note = $_POST['Note'];
    $userId = $_SESSION['userid'];

    $queryFrom = "SELECT * FROM category WHERE category_name='$FromCategory' AND user_id='$userId'";
    $queryTo = "SELECT * FROM category WHERE category_name='$ToCategory' AND user_id='$userId'";

    $resultFrom = mysqli_query($con, $queryFrom);
    $resultTo = mysqli_query($con, $queryTo);

    if (mysqli_num_rows($resultFrom) == 0 || mysqli_num_rows($resultTo) == 0) {
        echo "<p>Error selecting categories, please make sure to choose valid categories.</p>";
    } else {
        $rowFrom = mysqli_fetch_assoc($resultFrom);
        $currentBalanceFrom = $rowFrom['Amount'];

        $rowTo = mysqli_fetch_assoc($resultTo);
        $currentBalanceTo = $rowTo['Amount'];

        if ($TransferAmount <= 0 || $TransferAmount > $currentBalanceFrom) {
            echo "<p>Invalid transfer amount.</p>";
        } else {
            $updatedBalanceFrom = $currentBalanceFrom - $TransferAmount;
            $updatedBalanceTo = $currentBalanceTo + $TransferAmount;

            $updateQueryFrom = "UPDATE category SET Amount='$updatedBalanceFrom' WHERE category_name='$FromCategory' AND user_id='$userId'";
            $updateQueryTo = "UPDATE category SET Amount='$updatedBalanceTo' WHERE category_name='$ToCategory' AND user_id='$userId'";

            try {
                mysqli_query($con, $updateQueryFrom);
                mysqli_query($con, $updateQueryTo);

                $date = date("Y-m-d H:i:s"); 
                $insertQuery = "INSERT INTO transfers (user_id, from_category, to_category, transfer_amount, transfer_date, note) 
                                VALUES ('$userId', '$FromCategory', '$ToCategory', '$TransferAmount', '$date', '$Note')";

                mysqli_query($con, $insertQuery);

                mysqli_commit($con);

                echo "<p>Amount successfully transferred from $FromCategory to $ToCategory.</p>";
            } catch (Exception $e) {

                mysqli_rollback($con);

                echo "<p>An error occurred while executing the operation. Please try again later.</p>";
            }
        }
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
            <a class="a" href="home2.php">HOME</a>
            <a class="a" href="category.php">ADD CATEGORY</a>
            <a class="a" href="updateca.php">EDIT CATEGORY</a>
            <a class="a" href="transfer.php">TRANSFER</a>
            <a class="a" href="logout.php">LOGOUT</a>
        </nav>
        <?php
            echo 'User name :- '. $_SESSION['username'];
        ?>
    </header>
    <section>
        <form method="post" action="">
            <h2 class="log">Transfer Amount</h2>
            <label for="FromCategory">From Category:</label>
            <select name="FromCategory" required>
                <?php
                $userId = $_SESSION['userid'];
                $query = "SELECT category_name FROM category WHERE user_id='$userId'";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_assoc($result)){
                    echo "<option value='" . $row['category_name'] . "'>" . $row['category_name'] . "</option>";
                }
                ?>
            </select><br>

            <label for="ToCategory">To Category:</label>
            <select name="ToCategory" required>
                <?php
                mysqli_data_seek($result, 0); 
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['category_name'] . "'>" . $row['category_name'] . "</option>";
                }
                ?>
            </select>
            <br>

            <input type="number" name="TransferAmount" placeholder="Transfer Amount" required><br>
            <input type="text" name="Note" placeholder="Note"><br>
            <input type="submit" name="submit" value="Transfer"><br>
        </form>
    </section>
</body>
</html>