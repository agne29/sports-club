<?php
session_start();
include_once 'dbconnect.php';

if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["elektroninis_pastas"]))  
      {  
            if(!isset($_SESSION['shopping3'])){
              $_SESSION['shopping3'] = [];
            }
           $item_array_id = array_column($_SESSION["shopping3"], "id");  
           if(!isset($_SESSION['shopping3'][$_POST["id"]]))  
           {  
                $count = count($_SESSION["shopping3"]);  
                $item_array = array(  
                     'id'             =>     $_POST["id"],  
                     'vyksta_nuo'     =>     $_POST["vyksta_nuo"],  
                     'kaina'          =>     $_POST["kaina"],  
                     'trukme'         =>     $_POST["trukme"],
                     'tipas'          =>     $_POST["tipas"],    
                     'lytis'          =>     $_POST["lytis"],  
                     'rusis'          =>     $_POST["rusis"] 
                );  
                $_SESSION["shopping3"][$_POST["id"]] = $item_array;  
           }  
           else  
           {  
                echo '<script>alert("Jau pridėtas")</script>';  
                echo '<script>window.location="programos.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
                     'id'             =>     $_POST["id"],  
                     'vyksta_nuo'     =>     $_POST["vyksta_nuo"],  
                     'kaina'          =>     $_POST["kaina"],  
                     'trukme'         =>     $_POST["trukme"],
                     'tipas'          =>     $_POST["tipas"],    
                     'lytis'          =>     $_POST["lytis"],  
                     'rusis'          =>     $_POST["rusis"] 
           );  
           $_SESSION["shopping3"][$_POST["id"]] = $item_array;  
      }  
 }  
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
        if(isset($_SESSION['shopping3'])){
         unset($_SESSION["shopping3"][$_GET["id"]]);   
         echo '<script>window.location="programos.php"</script>';
        }
      }  
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
                <span class="sr-only">Toggle navigation</span>
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
                    <li><a href="abonimentas.php">Įsigyk abonementą</a></li>
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

           <br />  
           <div class="container" style="width:700px; position:relative; margin-left: 10px;">  
                <?php 
                $query = "SELECT * FROM programos ORDER BY id ASC";  
                $result = mysqli_query($con, $query);  
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
                ?>  
                <div class="col-md-4">  
                    <form method="post" action="programos.php">  
                          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">  
                               <h4 class="text-info"><?php echo $row["trukme"]; ?></h4> 
                               <h4 class="text-info"><?php echo $row["tipas"]; ?></h4> 
                               <h4 class="text-info"><?php echo $row["lytis"]; ?></h4>
                               <h4 class="text-info"><?php echo $row["rusis"]; ?></h4>   
                               <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">  
                               <input type="hidden" name="tipas" value="<?php echo $row["tipas"]; ?>">  
                               <input type="hidden" name="lytis" value="<?php echo $row["lytis"]; ?>">  
                               <input type="hidden" name="rusis" value="<?php echo $row["rusis"]; ?>">  
                               <input type="hidden" name="trukme" value="<?php echo $row["trukme"]; ?>">  
                               <input type="hidden" name="vyksta_nuo" value="<?php echo $row["vyksta_nuo"]; ?>" />  
                               <input type="hidden" name="kaina" value="<?php echo $row["kaina"]; ?>" />   

                               <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Pridėti" />  
                          </div>  
                     </form>  
                </div>  
                <?php  
                     }  
                }  
                ?>  
                <div style="clear:both"></div>  
                <br />  
                <h3>Užsakymas</h3>  
                <div class="table-responsive" style="width: 150%;">  
                     <table class="table table-bordered" >  
                          <tr>  
                               <th width="20%">Vyksta nuo</th>  
                               <th width="30%">Trukmė</th>   
                               <th width="30%">Tipas</th>  
                               <th width="10%">Lytis</th>  
                               <th width="10%">Rūšis</th>                                
                               <th width="10%">Bendra suma</th>  
                               <th width="10%">Veiksmai</th>  
                          </tr>  
                          <?php   
                               $total = 0;  
                          if(isset($_SESSION["shopping3"]))  
                          {  
                               foreach($_SESSION["shopping3"] as $values)
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $values["vyksta_nuo"]; ?></td>  
                               <td><?php echo $values["trukme"]; ?></td> 
                               <td><?php echo $values["tipas"]; ?></td>  
                               <td><?php echo $values["lytis"]; ?></td> 
                               <td><?php echo $values["rusis"]; ?></td>    
                               <td><?php echo number_format($values["kaina"], 2); ?>€</td>  
                               <td><a href="programos.php?action=delete&id=<?php echo $values["id"]; ?>"><span class="text-danger">Pašalinti</span></a></td>  
                          </tr>  
                          <?php  
                                    $total = $total + ($values["kaina"]);  
                               }  
                          ?>  
    
                          <tr>  
                               <td colspan="3" align="right">Išviso</td>  
                               <td align="right"> <?php echo number_format($total, 2); ?>€</td>  
                                                    
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                     <form action='pardavimai.php'>
                      <input type="hidden" name="total" value="<?php echo $total?>">
                      <input type="hidden" name="tipas" value="Programa">
                      <input type="submit" style="position:relative;" class="btn btn-success" value="Apmokėti"/>            
                    </form>
                </div>  
           </div>  
           <br />

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>