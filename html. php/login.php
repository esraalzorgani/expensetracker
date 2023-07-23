
<?php 

require_once 'config.php';

session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <title> Expense Tracker </title>
        <link rel="icon" href="../images/M2.png" type="LOGO">
        <link rel="stylesheet" href="../css/ex.css">
    </head>
<body>
        <header >
            <img class ="logo" alt="esra alzorgani" src="../images/logoo.png" />
                <nav class="header1">
                      <a  class="a" href="home.html"> HOME</a> 
                      <a  class="a"href="aboutus.html" >ABOUT US</a> 
                      <a  class="a"href="Reports.html">REPORTS</a>
                  </nav>  
                  <nav >
                  <button  class="button1" type="button"> <a href="login.html">log in</a></button>
                  <button  class="button2" type="button"><a href="signup.html">Sign up</a></button>
                </nav>
        </header>
        

      <!--------------------------------------------form------------------------------------------------->
 
      <main>
        <form method="post" action="" calss="form">
            <h2 class="log">Log in</h2>
            <input type="text" name="userName" placeholder="userName" required > <br>
            <input type="password" name ="password" placeholder="Password" required>  <br>
           
      <?php
        if(isset($_POST['submit']))
        {
          $user_n = $_POST['userName'];
          $passwordd = $_POST['password'];
          $select = "SELECT * FROM user WHERE user_name = '$user_n' AND u_password = '$passwordd'";
          $query=  mysqli_query($con, $select);
          if(mysqli_num_rows($query) > 0 )
             {
                $row = mysqli_fetch_assoc($query);
                if($row["user_name"]===$user_n && $row["u_password"]===$passwordd)
                {
                  
                  $_SESSION['username'] = $row['user_name'];
                  $_SESSION['userid'] = $row['user_id'];
                  header("Location: home2.php"); 
                }
              }
              else
              { echo "Failed To login! please try again";}
        }
          ?>
                           
             <a href="#" class="forget-pass">Forget password?</a>
            <input type="submit"name="submit" value="Log in"> <br>
<br>
            <span> Don't have an account? <a href="signup.php" >Signup</a></span>
             <div class="line"></div>
             <div>
                <button  class="FCAEBOOK" type="button"> <a href="login.html">Facebook</a></button>
                <button  class="GOOGLE" type="button"><a href="signup.html">GOOGLE</a></button>
             </div>
        </form>
    </main>
       <!-------------------------------------FOOTER----------------------------------------------------->
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
                    <p>Email:Esraalzorgani2020@gmail.com</p>
                </div>
                <p class="copyright">Expense Tracker © 2023</p>
            </footer>
    </div>
</body>
</html>