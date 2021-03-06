<?php session_start(); ?>
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
                            <li><a href="abonimentu_sarasas.php">Abonementai</a></li>
                            <li><a href="pardavimu_ataskaita.php">Pardavimų ataskaita</a></li>
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
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="inventoriausforma">
                <fieldset>
                    <legend>Redaguoti paslaugas</legend>
                    <?php paslaugu_redagavimas(); ?>
 
        </div>
    </div>

</div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>


<?php

 function paslaugu_redagavimas() {
include_once 'dbconnect.php';
$error = false;

if (isset($_POST['registruoti'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $kaina = mysqli_real_escape_string($con, $_POST['kaina']);
    $isigijama_nuo = mysqli_real_escape_string($con, $_POST['isigijama_nuo']);
    $isigijama_iki = mysqli_real_escape_string($con, $_POST['isigijama_iki']);
    $tipas = mysqli_real_escape_string($con, $_POST['tipas']);

    if (!$error) {
        if (mysqli_query($con, "UPDATE paslaugos SET kaina='" . $kaina . "', isigijama_nuo='" . $isigijama_nuo . "', isigijama_iki='" . $isigijama_iki . "', tipas='" . $tipas . "' WHERE id='$id'")) {
            $successmsg = "Sėkmingai paredagavote paslaugas! <a href='paslaugu_sarasas.php'>Paspauskite, kad grįžtumėte į paslaugų sąrašo langą.</a>";
        } else {
            $errormsg = "Įvyko klaida...  Bandykite dar kartą!";
        }
    }
}

$show = $con->query("SELECT * FROM paslaugos");

if (isset($_GET['id'])) {

    $numeris = $_GET['id'];

    $query = "SELECT * FROM paslaugos WHERE id='" . $numeris . "'";

    $r = $con->query($query);
    $r = $r->fetch_assoc();
}
echo "
                       <input type='hidden' name='id' required value='" . @$r['id'] . "' class='form-control'/>

                            <div class='form-group'>
                                <label for='name'>Kaina</label>
                                <input type='number' name='kaina' placeholder='Kaina' required value='" . @$r['kaina'] . "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Įsigijama nuo</label>
                                <input type='date' name='isigijama_nuo' placeholder='Data' value='" . @$r['isigijama_nuo'] . "' class='form-control' />
                            </div

                            <div class='form-group'>
                                <label for='name'>Įsigijama iki</label>
                                <input type='date' name='isigijama_iki' placeholder='Data' value='" . @$r['isigijama_iki'] . "' class='form-control' />

                             <div class='form-group'>
                                <label for='name'>Tipas</label>
                                <input type='text' name='tipas' placeholder='Tipas' required value='" . @$r['tipas'] . "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                 <input type='submit' name='registruoti' value='Registruoti' class='btn btn-primary' />
                            </div>
                        </fieldset>
                    </form>

                    <span class='text-success'>";
                                if (isset($successmsg)) {
                                    echo $successmsg;
                                }
                                echo "</span>
                    <span class='text-danger'>";
                                if (isset($errormsg)) {
                                    echo $errormsg;
                                }
                                "</span>";
                            }
                            ?>