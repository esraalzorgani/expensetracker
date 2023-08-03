<!----------------ESRA ALZORGANI------------>
<!----------------20180107887---صفحة للخروج من الموقع-->
<?php
session_start();
$_SESSION=[];
session_destroy();
header("location:login.php");
?>