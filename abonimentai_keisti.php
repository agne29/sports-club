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
                    <legend>Redaguoti abonementus</legend>
                    <?php abonimentu_redagavimas(); ?>
 
        </div>
    </div>

</div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>



<?php

 function abonimentu_redagavimas() {
include_once 'dbconnect.php';
$error = false;

if (isset($_POST['registruoti'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $data_nuo = mysqli_real_escape_string($con, $_POST['data_nuo']);
    $data_iki = mysqli_real_escape_string($con, $_POST['data_iki']);
    $kaina = mysqli_real_escape_string($con, $_POST['kaina']);
    $tipas = mysqli_real_escape_string($con, $_POST['tipas']);
    $rusis = mysqli_real_escape_string($con, $_POST['rusis']);

    if (!$error) {
        if (mysqli_query($con, "UPDATE abonementai SET data_nuo='" . $data_nuo . "', data_iki='" . $data_iki . "', kaina='" . $kaina . "', tipas='" . $tipas . "', rusis='" . $rusis . "' WHERE id='$id'")) {
            $successmsg = "Sėkmingai paredagavote abonementus! <a href='abonimentu_sarasas.php'>Paspauskite, kad grįžtumėte į abonementų sąrašo langą.</a>";
        } else {
            $errormsg = "Įvyko klaida...  Bandykite dar kartą!";
        }
    }
}

$show = $con->query("SELECT * FROM abonementai");

if (isset($_GET['id'])) {

    $numeris = $_GET['id'];

    $query = "SELECT * FROM abonementai WHERE id='" . $numeris . "'";

    $r = $con->query($query);
    $r = $r->fetch_assoc();
}

echo "
                       <input type='hidden' name='id' required value='" . @$r['id'] . "' class='form-control'/>

                            <div class='form-group'>
                                <label for='name'>Data nuo</label>
                                <input type='date' name='data_nuo' placeholder='Data' value='" . @$r['data_nuo'] . "' class='form-control' />
                            </div

                            <div class='form-group'>
                                <label for='name'>Data iki</label>
                                <input type='date' name='data_iki' placeholder='Data' value='" . @$r['data_iki'] . "' class='form-control' />

                            <div class='form-group'>
                                <label for='name'>Kaina</label>
                                <input type='number' name='kaina' placeholder='Kaina' required value='" . @$r['kaina'] . "' class='form-control' />
                            </div>

                    <div class='form-group'>
                        <label for='tipas'>Tipas</label>
                         <select id='tipas' name='tipas' class='form-control'>
                            <option value='Sezoninis'>Sezoninis</option>
                            <option value='Metinis'>Metinis</option>
                            <option value='Mėnėsio'>Mėnėsio</option>
                            <option value='Pusės metų'>Pusės metų</option>
                         </select>
                    </div>

                    <div class='form-group'>
                        <label for='rusis'>Rūšis</label>
                         <select id='rusis' name='rusis' class='form-control'>
                            <option value='Pagrindinis'>Pagrindinis</option>
                            <option value='Studento'>Studento</option>
                            <option value='Senjoro'>Senjoro</option>
                            <option value='Moksleivio'>Moksleivio</option>
                         </select>
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
                            

    