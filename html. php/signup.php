<!----------------ESRA ALZORGANI------------>
<!----------------20180107887----صفحة تسجيل مستخدم جديد---->
<?php 
       require_once 'config.php'; 
        $wrong_message = false;
        $wrong_User = false;
        $wrong_LetterDigit =  false;
        $sign_up_fail = true;
        $wrong_Password = false;
        
        function checkUsername()
         {
            
            if( strlen($_POST["username"]) < 10 || strlen($_POST["username"]) > 15 ) 
            return true;
            else 
            return false;
         }

         function checkPassword()
         {
          if( strlen($_POST["password"]) < 10 || strlen($_POST["password"]) > 15 ) 
          return true;
          else 
          return false;
         }

         function checkLetterDigit()
         {
           $count = 0;
           $pass = $_POST['password'];
           for($i = 0 ; $i<strlen($pass) ; $i++)
           {
            if($pass[$i] >= 'A' && $pass[$i] <= 'Z') 
            $count++;
            else if($pass[$i] >= 'a' && $pass[$i] <= 'z') 
            $count++;
            else if($pass[$i] == '+' || $pass[$i] == '_' || $pass[$i] == '/' || $pass[$i] == '$' || $pass[$i] == '*')
            $count++;
            }
            if($count < 3) return true;
            else return false;
          }
          
        if (isset($_POST["submit"]))
        {
            if(checkUsername()) 
              $wrong_User = true;
              else if(checkPassword())
              $wrong_Password = true;
              else if ($_POST["password"] !== $_POST["cpassword"])
                $wrong_message = true;
                else if(checkLetterDigit())
                $wrong_LetterDigit =  true;
                else {
                $username = $_POST["username"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $confirmpassword = $_POST["cpassword"];
                
                $select= "SELECT * FROM user WHERE user_name = '$username' OR u_email = '$email'";
                $duplicate = mysqli_query($con, $select);

                if(mysqli_num_rows($duplicate) > 0)
                {
                  echo '<p class="wrong-login-message" >the username or email is take it try another one.</p>';
                }
                else{
                  if( $password == $confirmpassword )
                    $query = "INSERT INTO user (user_name,u_email, u_password) VALUES('$username','$email','$password')";
                    mysqli_query($con, $query);
                    header("Location: home2.php"); 
        
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
        <header >
            <img class ="logo" alt="esra alzorgani" src="../images/logoo.png" />
                <nav class="header1">
                      <a class="a" href="home.html"> HOME</a> 
                      <a class="a"href="aboutus.html">ABOUT US</a> 
                      <a class="a"href="Reports.html">REPORTS</a>
                  </nav>  
                  <nav>
                  <button  class="button1" type="button"> <a href="login.php">log in</a></button>
                  <button  class="button2" type="button"><a href="signup.php">Sign up</a></button>
                </nav>
        </header>
 <!---------------------------------------form------------------------------------------------->
       <main>
       <?php if ($sign_up_fail){ ?>
        <form method="post" action="" calss="formLOG">
            <h2 class="log">Sign up</h2>
            <input type="text" placeholder="UserName" name="username" required > <br>

            <?php
            if($wrong_User)
            echo '<p" >The user name  must contain at least 10-15 character.</p>';
            ?>
            
            <input type="email" placeholder="Email"  name="email" required >  <br>
            <input type="password" placeholder="Enter password"  name="password" required > <br>
            <input type="password" placeholder="Confirm password" name="cpassword" required > <br>
            <div calss="chek">
            </div>

          <?php
          if ($wrong_Password)
            echo '<p" >The Password must contain at least 10-15 character.</p>';
          ?>

            <?php
          if ($wrong_message)
            echo '<p" >the password is not match tray again.</p>';
          ?>

          <?php
          if ($wrong_LetterDigit)
            echo '<p" >The Password must contain at Charter Letter Or Number.</p>';
          ?>

      
            <input type="checkbox" name="accepts_tos" value="yes" required> I agree to the Terms
            <a href="/html-css-practice-test/">Privacy Policy</a>
            <input type="submit" value="Sign up" name="submit"> <br>
            <div class="line"></div>

            <div>
                <button  class="FCAEBOOK" type="button"> <a href="#">Facebook</a></button>
                <button  class="GOOGLE" type="button"><a href="#">GOOGLE</a></button>
             </div>

        </form>
        
        
      <?php } ?>
      
        <br>
        <br>
        <br>
        <br>
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
    
       </main>

</body>
</html>