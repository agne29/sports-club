<?php
session_start();
include_once 'dbconnect.php';
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

                    <li><a href="prekiu_sarasas.php">Prekės</a></li>
                    <li><a href="paslaugu_sarasas.php">Paslaugos</a></li>
                    <li><a href="programu_sarasas.php">Programos</a></li>
                    <li><a href="abonimentu_sarasas.php">Abonimentai</a></li>
                    <li><a href="inventoriaus_sarasas.php">Inventorius</a></li>
                    <li><a href="patalpu_sarasas.php">Patalpos</a></li>
                    <li><a href="padaliniu_sarasas.php">Padaliniai</a></li>
                    <li><a href="uzsiemimo_registravimas.php">Užsiėmimai</a></li>
                    <li><a href="imones_registravimas.php">Įmonės registravimas</a></li>
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

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>