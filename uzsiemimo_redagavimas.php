<?php
session_start();


include_once 'dbconnect.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_GET['registruoti'])) {
    $asmens_kodas = mysqli_real_escape_string($con, $_GET['asmens_kodas']);
    $vardas = mysqli_real_escape_string($con, $_GET['vardas']);
    $pavarde = mysqli_real_escape_string($con, $_GET['pavarde']);
    $telefono_numeris = mysqli_real_escape_string($con, $_GET['telefono_numeris']);
    $elektroninis_pastas = mysqli_real_escape_string($con, $_GET['elektroninis_pastas']);
    $tabelio_nr = mysqli_real_escape_string($con, $_GET['tabelio_nr']);

    if (!$error) {
        if (mysqli_query($con, "UPDATE treneriai SET (asmens_kodas, vardas, pavarde,telefono_numeris,elektroninis_pastas,tabelio_nr)
            VALUES('" . $asmens_kodas . "', '" . $vardas . "', '" . $pavarde . "','" . $telefono_numeris . "', '" . $elektroninis_pastas . "', '" . $tabelio_nr . "')")) {
            $successmsg = "Sėkmingai atnaujonote trenerį!";
        } else {
            $errormsg = "Įvyko klaida...  Bandykite dar kartą!";
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
                <?php if (isset($_SESSION['elektroninis_pastas1'])) { ?>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="">Prekių valdymas<span class="caret"</span></a>
                        <ul class="dropdown-menu">
                            <li><a href="prekiu_sarasas.php">Prekės</a></li>
                            <li><a href="paslaugu_sarasas.php">Paslaugos</a></li>
                            <li><a href="programu_sarasas.php">Programos</a></li>
                            <li><a href="abonimentu_sarasas.php">Abonimentai</a></li>
                        </ul>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="">Resursų valdymas<span class="caret"</span></a>
                        <ul class="dropdown-menu">
                            <li><a href="inventoriaus_sarasas.php">Inventorius</a></li>
                            <li><a href="patalpu_sarasas.php">Patalpos</a></li>
                            <li><a href="padaliniu_sarasas.php">Padaliniai</a></li>
                            <li><a href="imones_registravimas.php">Įmonės registravimas</a></li>
                        </ul>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="">Užimtumo valdymas<span class="caret"</span></a>
                        <ul class="dropdown-menu">
                            <li><a href="uzsiemimo_registravimas.php">Užsiėmimų regsitracija</a></li>
                            <li><a href="treneriu_sarasas.php">Treneriai</a></li>

                        </ul>

                    <li><a href="klientu_sarasas.php">Klientų sąrašas</a></li>

                    <li><p class="navbar-text">Sveiki, <?php echo $_SESSION['elektroninis_pastas1']; ?></p></li>
                    <li><a href="logout.php">Atsijungti</a></li>
                <?php } else { ?>
                    <li><a href="login.php">Prisijungti</a></li>
                    <li><a href="register.php">Registruotis</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="patalposforma">
                <fieldset>
                    <legend>Trenerio informacija</legend>


                    <div class="form-group">
                        <label for="name">Asmens kodas</label>
                        <input type="number" name="asmens_kodas" placeholder="Įveskite trenrių asmens kodą" required value="<?php if ($error) echo $asmens_kodas; ?>" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="name">Vardas</label>
                        <input type="text" name="vardas" placeholder="Vardas" required value="<?php if ($error) echo $vardas; ?>" class="form-control" />
                        <span class="text-danger"><?php if (isset($vardas_error)) echo $vardas_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Pavardė </label>
                        <input type="text" name="pavarde" placeholder="Pavardė" required value="<?php if ($error) echo $pavarde; ?>" class="form-control" />
                    </div>


                    <div class="form-group">
                        <label for="name">Telefonas</label>
                        <input type="text" name="telefono_numeris" placeholder="Telefonas" required value="<?php if ($error) echo $telefono_numeris; ?>" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="name">Elektroninis paštas</label>
                        <input type="email" name="elektroninis_pastas" placeholder="El. paštas" required value="<?php if ($error) echo $elektroninis_pastas; ?>" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="name">Tabelio nr</label>
                        <input type="text" name="tabelio_nr" placeholder="Tabelio nr" required value="<?php if ($error) echo $tabelio_nr; ?>" class="form-control" />
                    </div>

                    <div class="form-group">
                        <input type="submit" name="registruoti" value="Registruotis" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
                    <span class="text-success"><?php
                        if (isset($successmsg)) {
                            echo $successmsg;
                        }
                        ?></span>
                    <span class="text-danger"><?php
                        if (isset($errormsg)) {
                            echo $errormsg;
                        }
                        ?></span>
        </div>
    </div>

</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>