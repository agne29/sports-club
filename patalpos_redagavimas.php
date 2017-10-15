<?php
session_start();

function patalpos_redagavimas() {
    include_once 'dbconnect.php';

//set validation error flag as false
    $error = false;

//check if form is submitted
    if (isset($_POST['registruoti'])) {
        $numeris = mysqli_real_escape_string($con, $_POST['numeris']);
        $aukstas = mysqli_real_escape_string($con, $_POST['aukstas']);
        $ilgis = mysqli_real_escape_string($con, $_POST['ilgis']);
        $plotis = mysqli_real_escape_string($con, $_POST['plotis']);
        $grindu_danga = mysqli_real_escape_string($con, $_POST['grindu_danga']);
        $tipas = mysqli_real_escape_string($con, $_POST['tipas']);
        $padalinys = mysqli_real_escape_string($con, $_POST['padalinys']);

        if (!$error) {
            if (mysqli_query($con, "UPDATE patalpos SET aukstas='" . $aukstas . "', ilgis='" . $ilgis . "', plotis='" . $plotis . "', grindu_danga='" . $grindu_danga . "', "
                            . " tipas='" . $tipas . "', fk_padalinys='" . $padalinys . "' WHERE numeris='$numeris'")) {
                $successmsg = "Patalpa redaguota sėkmingai! <a href='patalpu_sarasas.php'>Paspauskite, kad grįžtumėte į patalpų sąrašo langą.</a>";
            } else {
                $errormsg = "Įvyko klaida...  Bandykite dar kartą!";
            }
        }
    }

    $show = $con->query("SELECT * FROM padaliniai");

    if (isset($_GET['numeris'])) {

        $nr = $_GET['numeris'];

        $query = "SELECT * FROM patalpos WHERE numeris='" . $nr . "'";

        $r = $con->query($query);
        $r = $r->fetch_assoc();
    }


    echo "   <div class='form-group'>
                                <label for='name'>Numeris</label>
                                <input type='hidden' name='numeris' placeholder='Įveskite patalpos numerį (skaičius)' required value='";
    echo @$r['numeris'];
    echo "' class='form-control' />
                                <input type='number' disabled='disabled' name='numeris' placeholder='Įveskite patalpos numerį (skaičius)' required value='";
    echo @$r['numeris'];
    echo "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Aukštas</label>
                                <input type='number' name='aukstas' placeholder='Aukštas' required value='";
    echo @$r['aukstas'];
    echo "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Ilgis</label>
                                <input type='number' name='ilgis' placeholder='Ilgis (m2)' required value='";
    echo @$r['ilgis'];
    echo "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Plotis</label>
                                <input type='number' name='plotis' placeholder='Plotis (m2)' required value='";
    echo @$r['plotis'];
    echo "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Grindų danga</label>
                                <input type='text' name='grindu_danga' placeholder='Grindų danga' value='";
    echo @$r['grindu_danga'];
    echo "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Tipas</label>
                                <input type='text' name='tipas' placeholder='Tipas' value='";
    echo @$r['tipas'];
    echo "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Padalinys</label>

                                <select name='padalinys' class='form-control'>
                                    <option value='-1'>Pasirinkite padalinį:</option>";

    while ($row = $show->fetch_assoc()) {
        echo "<option value=\"" . $row['numeris'] . "\">" . $row['pavadinimas'] . "</option>";
    }
    echo "
                                </select>
                            </div>

                            <div class='form-group'>
                                <input type='submit' name='registruoti' value='Redaguoti' class='btn btn-primary' />
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
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="patalposforma">
                        <fieldset>
                            <legend>Patalpos redagavimas</legend>

                            <?php patalpos_redagavimas(); ?>

                            </div>
                            </div>

                            </div>
                            <script src="js/jquery.js"></script>
                            <script src="js/bootstrap.min.js"></script>
                            </body>
                            </html>