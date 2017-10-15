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
                    <legend>Redaguoti prekes</legend>
                    <?php prekiu_redagavimas(); ?>
 
        </div>
    </div>

</div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>


<?php

 function prekiu_redagavimas() {
include_once 'dbconnect.php';
$error = false;

if (isset($_POST['registruoti'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $rusis = mysqli_real_escape_string($con, $_POST['rusis']);
    $pavadinimas = mysqli_real_escape_string($con, $_POST['pavadinimas']);
    $gamintojas = mysqli_real_escape_string($con, $_POST['gamintojas']);
    $pagaminta = mysqli_real_escape_string($con, $_POST['pagaminta']);
    $galioja_iki = mysqli_real_escape_string($con, $_POST['galioja_iki']);
    $pristatyta = mysqli_real_escape_string($con, $_POST['pristatyta']);
    $kiekis = mysqli_real_escape_string($con, $_POST['kiekis']);
    $kaina = mysqli_real_escape_string($con, $_POST['kaina']);
    $tipas = mysqli_real_escape_string($con, $_POST['tipas']);
    $pav = mysqli_real_escape_string($con, $_POST['pav']);

    if (!$error) {
        if (mysqli_query($con, "UPDATE prekes SET rusis='" . $rusis . "', pavadinimas='" . $pavadinimas . "', pagaminta='" . $pagaminta . "', galioja_iki='" . $galioja_iki . "', pristatyta='" . $pristatyta .  "', kiekis='" . $kiekis .  "', kaina='" . $kaina . "', tipas='" . $tipas . "', pav='" . $pav . "' WHERE id='$id'")) {
            $successmsg = "Sėkmingai paredagavote prekes! <a href='prekiu_sarasas.php'>Paspauskite, kad grįžtumėte į prekių sąrašo langą.</a>";
        } else {
            $errormsg = "Įvyko klaida...  Bandykite dar kartą!";
        }
    }
}

$show = $con->query("SELECT * FROM prekes");

if (isset($_GET['id'])) {

    $numeris = $_GET['id'];

    $query = "SELECT * FROM prekes WHERE id='" . $numeris . "'";

    $r = $con->query($query);
    $r = $r->fetch_assoc();
}

echo "
                       <input type='hidden' name='id' required value='" . @$r['id'] . "' class='form-control'/>

                            <div class='form-group'>
                                <label for='name'>Rūšis</label>
                                <input type='text' name='rusis' placeholder='Rūšis' required value='" . @$r['rusis'] . "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Pavadinimas</label>
                                <input type='text' name='pavadinimas' placeholder='Pavadinimas' value='" . @$r['pavadinimas'] . "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Gamintojas</label>
                                <input type='text' name='gamintojas' placeholder='Gamintojas' value='" . @$r['gamintojas'] . "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Pagaminta</label>
                                <input type='date' name='pagaminta' placeholder='Data' value='" . @$r['pagaminta'] . "' class='form-control' />
                            </div

                            <div class='form-group'>
                                <label for='name'>Galioja iki</label>
                                <input type='date' name='galioja_iki' placeholder='Data' value='" . @$r['galioja_iki'] . "' class='form-control' />


                            <div class='form-group'>
                                <label for='name'>Pristatyta</label>
                                <input type='date' name='pristatyta' placeholder='Data' value='" . @$r['pristatyta'] . "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Kiekis</label>
                                <input type='number' name='kiekis' placeholder='Kiekis' required value='" . @$r['kiekis'] . "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Kaina</label>
                                <input type='number' name='kaina' placeholder='Kaina' required value='" . @$r['kaina'] . "' class='form-control' />
                            </div>

                    <div class='form-group'>
                        <label for='tipas'>Tipas</label>
                         <select id='tipas' name='tipas' class='form-control'>
                            <option value='Sporto papildai'>Sporto papildai</option>
                            <option value='Maistas'>Maistas</option>
                            <option value='Gėrimai'>Gėrimai</option>
                            <option value='Maisto papildai'>Maisto papildai</option>
                            <option value='Užkandžiai'>Užkandžiai</option>
                         </select>
                    </div>
                            <div class='form-group'>
                                <label for='name'>Paveikslėlis</label>
                                <input type='text' name='pav' placeholder='Paveikslėlis' required value='" . @$r['pav'] . "' class='form-control' />
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