<?php
session_start();

function padalinio_redagavimas() {
    include_once 'dbconnect.php';

//set validation error flag as false
    $error = false;

//check if form is submitted
    if (isset($_POST['registruoti_padalini'])) {
        $numeris = mysqli_real_escape_string($con, $_POST['numeris']);
        $pavadinimas = mysqli_real_escape_string($con, $_POST['pavadinimas']);
        $adresas = mysqli_real_escape_string($con, $_POST['adresas']);
        $telefonas = mysqli_real_escape_string($con, $_POST['telefonas']);
        $elektroninis_pastas = mysqli_real_escape_string($con, $_POST['elektroninis_pastas']);
        $faksas = mysqli_real_escape_string($con, $_POST['faksas']);
        $pasto_kodas = mysqli_real_escape_string($con, $_POST['pasto_kodas']);
        $miestas = mysqli_real_escape_string($con, $_POST['miestas']);


        if (!filter_var($elektroninis_pastas, FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $elpastas_error = "Prašome įvesti teisingą el-pašto adresą";
        }

        if (!$error) {
            if (mysqli_query($con, "UPDATE padaliniai SET pavadinimas='" . $pavadinimas . "', adresas='" . $adresas . "', telefonas='" . $telefonas . "', elektroninis_pastas='" . $elektroninis_pastas . "', "
                            . " faksas='" . $faksas . "', pasto_kodas='" . $pasto_kodas . "', miestas='" . $miestas . "' WHERE numeris='$numeris'")) {
                $successmsg = "Padalinys redaguotas sėkmingai! <a href='padaliniu_sarasas.php'>Paspauskite, kad grįžtumėte į padalinių sąrašo langą.</a>";
            } else {
                $errormsg = "Įvyko klaida...  Bandykite dar kartą!";
            }
        }
    }

    if (isset($_GET['numeris'])) {

        $nr = $_GET['numeris'];

        $query = "SELECT * FROM padaliniai WHERE numeris='" . $nr . "'";

        $r = $con->query($query);
        $r = $r->fetch_assoc();
    }

    echo "
     <div class='form-group'>
                                <label for='name'>Numeris</label>
                                <input type='hidden' name='numeris' placeholder='Įveskite padalinio numerį (skaičius)' required value='";
    echo @$r['numeris'];
    echo "' class='form-control' />
                                <input type='number' disabled='disabled' name='numeris' placeholder='Įveskite padalinio numerį (skaičius)' required value='";
    echo @$r['numeris'];
    echo "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Pavadinimas</label>
                                <input type='text' name='pavadinimas' placeholder='Pavadinimas' required value='";
    echo @$r['pavadinimas'];
    echo "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Adresas</label>
                                <input type='text' name='adresas' placeholder='Adresas' required value='";
    echo @$r['adresas'];
    echo "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Telefonas</label>
                                <input type='text' name='telefonas' placeholder='Telefonas' required value='";
    echo @$r['telefonas'];
    echo "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Elektroninis paštas</label>
                                <input type='email' name='elektroninis_pastas' placeholder='El. paštas' required value='";
    echo @$r['elektroninis_pastas'];
    echo "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Faksas</label>
                                <input type='text' name='faksas' placeholder='Faksas' required value='";
    echo @$r['faksas'];
    echo"' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Pašto kodas</label>
                                <input type='text' name='pasto_kodas' placeholder='Pašto kodas' required value='";
    echo @$r['pasto_kodas'];
    echo "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Miestas</label>
                                <input type='text' name='miestas' placeholder='Miestas' required value='";
    echo @$r['miestas'];
    echo "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <input type='submit' name='registruoti_padalini' value='Redaguoti' class='btn btn-primary' />
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
    echo "</span>";
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
                                    <li><a href="uzsiemimu_sarasas.php">Užsiėmimų sąrašas</a></li>
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
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="padalinioforma">
                        <fieldset>
                            <legend>Padalinio redagavimas</legend>

                            <?php padalinio_redagavimas(); ?>

                            </div>
                            </div>

                            </div>
                            <script src="js/jquery.js"></script>
                            <script src="js/bootstrap.min.js"></script>
                            </body>
                            </html>