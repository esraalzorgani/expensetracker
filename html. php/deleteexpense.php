<!----------------ESRA ALZORGANI------------>
<!----------------20180107887-----
   صفحة لحذف مصروف------->
<?php
require_once 'config.php';
session_start();


if (isset($_GET['id'])) {
    $expense_id = $_GET['id'];
    $user_id = $_SESSION['userid'];

   
    $query = "DELETE FROM expense WHERE expense_id='$expense_id' AND user_id='$user_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        
        header('location: displayexpenses.php');
        exit();
    } else {
        die(mysqli_error($con));
    }
} else {
   
    header('location: displayexpenses.php');
    exit();
}
?>