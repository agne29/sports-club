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
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="inventoriaus_redagavimas">
                        <fieldset>
                            <legend>Inventoriaus redagavimas</legend>

                            <?php inventoriaus_redagavimas(); ?>

                            </div>
                            </div>

                            </div>

                            <script src="js/jquery.js"></script>
                            <script src="js/bootstrap.min.js"></script>
                            </body>
                            </html>



                            <?php

                            function inventoriaus_redagavimas() {
                                include 'dbconnect.php';
                                $error = false;


                                if (isset($_POST['registruoti_inventoriu'])) {
                                    $tabelio_numeris = mysqli_real_escape_string($con, $_POST['tabelio_numeris']);
                                    $svoris = mysqli_real_escape_string($con, $_POST['svoris']);
                                    $uzimamas_plotas = mysqli_real_escape_string($con, $_POST['uzimamas_plotas']);
                                    $inventoriaus_tipas = mysqli_real_escape_string($con, $_POST['inventoriaus_tipas']);
                                    $gamintojas = mysqli_real_escape_string($con, $_POST['gamintojas']);
                                    $pagaminimo_data = mysqli_real_escape_string($con, $_POST['pagaminimo_data']);
                                    $pirkimas = mysqli_real_escape_string($con, $_POST['pirkimas']);
                                    $patalpa = mysqli_real_escape_string($con, $_POST['patalpa']);

                                    if (!$error) {
                                        if (mysqli_query($con, "UPDATE inventorius SET svoris='" . $svoris . "', uzimamas_plotas='" . $uzimamas_plotas . "', inventoriaus_tipas='" . $inventoriaus_tipas . "', pagaminimo_data='" . $pagaminimo_data . "', "
                                                        . " fk_pirkimas='" . $pirkimas . "', fk_patalpa='" . $patalpa . "' WHERE tabelio_numeris='$tabelio_numeris'")) {
                                            echo "Sėkmingai paredagavote inventorių! <a href='inventoriaus_sarasas.php'>Paspauskite, kad grįžtumėte į inventoriaus sąrašo langą.</a>";
                                        } else {
                                            echo "Įvyko klaida...  Bandykite dar kartą!";
                                        }
                                    }
                                }



                                //set validation error flag as false
                                $error = false;
                                $show = $con->query("SELECT * FROM imones");
                                $show2 = $con->query("SELECT * FROM buhalteriai");
                                $show3 = $con->query("SELECT * FROM pirkimai");
                                $show4 = $con->query("SELECT * FROM patalpos");
                                $show5 = $con->query("SELECT * FROM inventorius");

                                if (isset($_GET['tabelio_numeris'])) {

                                    $numeris = $_GET['tabelio_numeris'];

                                    $query = "SELECT * FROM inventorius WHERE tabelio_numeris='" . $numeris . "'";

                                    $r = $con->query($query);
                                    $r = $r->fetch_assoc();
                                }


                                echo "
                            <div class='form-group'>
                                <label for='name'>Tabelio numeris</label>
                                 <input type='hidden' name='tabelio_numeris' placeholder='Įveskite inventoriaus tabelio numerį' required value='" . @$r['tabelio_numeris'] . "' class='form-control' />
                            
                                <input type='text' disabled='disabled' name='tabelio_numeris' placeholder='Įveskite inventoriaus tabelio numerį' required value='" . @$r['tabelio_numeris'] . "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Svoris</label>
                                <input type='number' name='svoris' placeholder='Svoris' value='" . @$r['svoris'] . "' class='form-control' />

                            </div>

                            <div class='form-group'>
                                <label for='name'>Užimamas plotas (kv. m)</label>
                                <input type='number' name='uzimamas_plotas' placeholder='Plotas' value='" . @$r['uzimamas_plotas'] . "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Inventoriaus tipas</label>
                                <input type='text' name='inventoriaus_tipas' placeholder='Tipas' value='" . @$r['inventoriaus_tipas'] . "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Gamintojas</label>
                                <input type='text' name='gamintojas' placeholder='Inventoriaus gamintojas' required value='" . @$r['gamintojas'] . "' class='form-control' />
                            </div>
                            <div class='form-group'>
                                <label for='name'>Pagaminimo data</label>
                                <input type='date' name='pagaminimo_data' placeholder='Data' required value='" . @$r['pagaminimo_data'] . "' class='form-control' />
                            </div>
                            <div class='form-group'>
                                <label for='name'>Pirkimas</label>

                                <select name='pirkimas' class='form-control'>
                                    <option value='-1'>Nurodykite pirkimo, kuriuo buvo nupirktas inventorius, numerį:</option>";

                                while ($row = $show3->fetch_assoc()) {
                                    echo "<option value=\"" . $row['id'] . "\">" . $row['id'] . "</option>";
                                }

                                echo "</select>
                            </div>
                            <div class='form-group'>
                                <label for='name'>Patalpa</label>

                                <select name='patalpa' class='form-control'>
                                    <option value='-1'>Nurodykite patalpą, kuriai priskiriamas inventorius:</option>";

                                while ($row = $show4->fetch_assoc()) {
                                    echo "<option value=\"" . $row['numeris'] . "\">" . $row['numeris'] . "</option>";
                                }

                                echo "</select>
                            </div>



                            <div class='form-group'>
                                <input type='submit' name='registruoti_inventoriu' value='Redaguoti' class='btn btn-primary' />
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