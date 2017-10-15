<?php
session_start();
include_once 'dbconnect.php';


$user = $con->query("SELECT * FROM klientai WHERE elektroninis_pastas='{$_SESSION['elektroninis_pastas']}'");
$user = $user->fetch_assoc();
                            $selectname = 'SELECT vardas from klientai';
                            $result = @mysqli_query($con, $selectname);
                            $row = mysqli_fetch_assoc($result);


if(isset($_GET['tipas'])){
  $id = $con->query("SELECT (MAX(id) + 1) as max FROM pardavimai")->fetch_assoc()['max'];
  $con->query("INSERT INTO pardavimai(id, data, tipas) VALUES ('{$id}', CURRENT_DATE, '{$_GET['tipas']}')");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sporto klubo sistema</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" >
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbar1">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (isset($_SESSION['elektroninis_pastas'])) { ?>
                            <li><a href="prekes.php">Prekės</a></li>
                            <li><a href="paslaugos.php">Paslaugos</a></li>
                            <li><a href="programos.php">Programos</a></li>
                            <li><a href="abonimentas.php">Įsigyk abonimentą</a></li>
                            <li><a href="tvarkarastis.php">Tvarkaraštis</a></li>
                            <li><p class="navbar-text">Sveiki, <?php echo $_SESSION['elektroninis_pastas']; ?></p></li>
                            <li><a href="logout.php">Atsijungti</a></li>
                        <?php } else { ?>
                            <li><a href="login.php">Prisijungti</a></li>
                            <li><a href="register.php">Registruotis</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>


        <div style="margin-left: 35%; margin-top: 200px; font-size: 30px; font-weight: bold;">


 

        
                          <?php   
                          if(isset($_SESSION["shopping"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping"] as $values)
                               {
                                $total = $total + ($values["kiekis"] * $values["kaina"]);
                               }  
        
                           }
                          ?>  

                          <?php   
                          if(isset($_SESSION["shopping2"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping2"] as $values)
                               {
                                $total = $values["kaina"];
                               }  
        
                           }
                          ?>  

                          <?php   
                          if(isset($_SESSION["shopping3"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping3"] as $values)
                               {
                                $total = $values["kaina"];
                               }  
  
                           }
                          ?>  

                          <?php   
                          if(isset($_SESSION["shopping4"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping4"] as $values)
                               {
                                $total = $values["kaina"];
                               }  

                           }?>


                        <?php if (isset($_SESSION['elektroninis_pastas'])) { ?>
                            <p class="navbar-text"><?php echo $row['vardas']; ?>, Jūsų užsakymas už <?php echo $total ?>€ sėkmingas!</p>                      
                        <?php } else { ?>
                        <?php } ?>


       </div>

        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>