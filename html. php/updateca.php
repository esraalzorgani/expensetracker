<!----------------ESRA ALZORGANI------------>
<!----------------20180107887-----
    صفحة خاصة بإضافة فئات ------->
    <?php
    require_once 'config.php';
    
    session_start();

    if(isset($_POST['submit']))
    {
        $Name=$_POST['CategoryName'];
        $Amount=$_POST['Amount'];
        $Note=$_POST['Note'];
        $id_category=$_POST['CategoryID'];

        $query = " UPDATE category SET  category_name='$Name',Amount=$Amount,Note='$Note' WHERE category_id= $id_category";
        $result= mysqli_query($con, $query);
        if ($result) 
       {
               header('location:category.php');
       }
        else {
           die(mysqli_error($con));
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
                        <a class="a" href="home2.php"> HOME</a>
            <a class="a" href="category.php">ADD CATEGORY</a>
            <a class="a" href="updateca.php">EDIT CATEGORY</a>
            <a class="a" href="transfer.php">TRANSFER</a>
            <a class="a" href="logout.php">LOGOUT</a>
                          </nav>  
                          <?php
                echo 'User name :- '. $_SESSION['username'];
                ?> 
                </header>
        
              <!------------------------------------form------------------------------------------------->
         
               <main>
                <form method="post" action="" >
                    <h2 class="log">Edit Category</h2>
                    <input type="text" name="CategoryID" placeholder="CategoryID"  > <br>
                    <input type="text" name="CategoryName" placeholder="CatregoryName"  > <br>
                    <input type="text" name="Amount" placeholder="Amount"  > <br>
                    <input type="text" name="Note" placeholder="Note"  > <br>
                    <input type="submit"name="submit" value="Edit"> <br>
                    <br>

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