<!----------------ESRA ALZORGANI------------>
<!----------------20180107887------
   الصفحة الرئيسية 
    ------>
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
                          <a  class="a" href="home2.php"> HOME</a> 
                          <a  class="a"href="aboutus.html" >ABOUT US</a> 
                          <a  class="a"href="category.php" >CATEGORY</a> 
                          <a  class="a"href="addexpense.php">EXPENSE</a>
                          <a  class="a"href="review.php" >REVIEW</a> 
                          <a  class="a"href="logout.php">LOGOUT</a>
                          
                      </nav> 
                      <?php
                echo 'User name :- '. $_SESSION['username'];
                ?> 
            </header>
            <main>

                <img class="pictures" alt="esra alzorgani" src="../images/BACKG.png" width="800PX">
                <div class="p">
                    <h1><span>Welcome</span></h1>
                    <h2 >Expense Tracker</h2>  
                </div>

            </main>
            <br>
            <br>
            <!--------------------------------footer----------------------------------->
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