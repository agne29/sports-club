<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>User Registration Script</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" >
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" >
    </head>
    <body>

        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <!-- add header -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- menu items -->
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
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="pirkimo_ir_inventoriaus_registravimas">
                        <fieldset>
                            <legend>Pirkimo registracija</legend>

                            <?php pirkimo_ir_inventoriaus_registravimas(); ?>

                            </div>
                            </div>

                            </div>
                            <script src="js/jquery.js"></script>
                            <script src="js/bootstrap.min.js"></script>
                            </body>
                            </html>


                            <?php

                            function pirkimo_ir_inventoriaus_registravimas() {
                                include 'dbconnect.php';

//set validation error flag as false
                                $error = false;

//check if form is submitted
                                if (isset($_POST['registruoti_pirkima'])) {

                                    $data = mysqli_real_escape_string($con, $_POST['data']);
                                    $suma = mysqli_real_escape_string($con, $_POST['suma']);
                                    $imone = mysqli_real_escape_string($con, $_POST['imone']);
                                    $buhalteris = mysqli_real_escape_string($con, $_POST['buhalteris']);

                                    if (!$error) {
                                        if (mysqli_query($con, "INSERT INTO pirkimai(data,suma,fk_imone,fk_buhalteris)
            VALUES('" . $data . "', '" . $suma . "', '" . $imone . "', '" . $buhalteris . "')")) {
                                            $successmsg = "Sėkmingai užregistravote pirkimą! Toliau registruokite nupirktą inventorių.";
                                        } else {
                                            $errormsg = "Įvyko klaida...  Bandykite dar kartą!";
                                        }
                                    }
                                }

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
                                        if (mysqli_query($con, "INSERT INTO inventorius(tabelio_numeris,svoris,uzimamas_plotas,inventoriaus_tipas,gamintojas,pagaminimo_data,fk_pirkimas,fk_patalpa)
            VALUES('" . $tabelio_numeris . "', '" . $svoris . "', '" . $uzimamas_plotas . "', '" . $inventoriaus_tipas . "', '" . $gamintojas . "', '" . $pagaminimo_data . "', '" . $pirkimas . "', '" . $patalpa . "')")) {
                                            $successmsg = "Sėkmingai užregistravote inventorių! <a href='inventoriaus_sarasas.php'>Paspauskite, kad grįžtumėte į inventoriaus sąrašo langą.</a>";
                                        } else {
                                            $errormsg = "Įvyko klaida...  Bandykite dar kartą!";
                                        }
                                    }
                                }

                                $show = $con->query("SELECT * FROM imones");
                                $show2 = $con->query("SELECT * FROM buhalteriai");
                                $show3 = $con->query("SELECT * FROM pirkimai");
                                $show4 = $con->query("SELECT * FROM patalpos");



                                echo "<div class = 'form-group'>
                            <label for = 'name'>Data</label>
                            <input type = 'date' name = 'data' placeholder = 'Data' required value = '";
                                if ($error)
                                    echo $data;
                                echo"' class = 'form-control' />

                            </div>

                            <div class = 'form-group'>
                            <label for = 'name'>Suma</label>
                            <input type = 'number' step = 'any' name = 'suma' placeholder = 'Suma' required value = '";
                                if ($error)
                                    echo $suma;
                                echo "' class = 'form-control' />
                            </div>

                            <div class = 'form-group'>
                            <label for = 'name'>Įmonė, iš kurios perkamas inventorius</label>
                            <select name = 'imone' class = 'form-control'>
                            <option value = '-1'>Pasirinkite įmonę:</option>";

                                while ($row = $show->fetch_assoc()) {
                                    echo "<option value = \"" . $row['id'] . "\">" . $row['pavadinimas'] . "</option>";
                                }
                                echo "
                                </select>
                            </div>

                            <div class='form-group'>
                                <label for='name'>Buhalteris</label>

                                <select name='buhalteris' class='form-control'>
                                    <option value='-1'>Pasirinkite buhalterį, kuriam priskiriama sąskaitą:</option>";

                                while ($row = $show2->fetch_assoc()) {
                                    echo "<option value=\"" . $row['tabelio_numeris'] . "\">" . $row['vardas'] . " " . $row['pavarde'] . "</option>";
                                }
                                echo "
                                </select>
                            </div>

                            <div class='form-group'>
                                <input type='submit' name='registruoti_pirkima' value='Registruoti' class='btn btn-primary' />
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
                                echo "</span>
                </div>
            </div>

        </div>

        <div class='container'>
            <div class='row'>
                <div class='col-md-4 col-md-offset-4 well'>
                    <form role='form' action='";
                                echo $_SERVER['PHP_SELF'];
                                echo "' method='post' name='inventoriausforma'>
                        <fieldset>
                            <legend>Nupirkto inventoriaus registracija</legend>


                            <div class='form-group'>
                                <label for='name'>Tabelio numeris</label>
                                <input type='text' name='tabelio_numeris' placeholder='Įveskite inventoriaus tabelio numerį' required value='";
                                if ($error)
                                    echo $tabelio_numeris;
                                echo "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Svoris</label>
                                <input type='number' name='svoris' placeholder='Svoris' value='";
                                if ($error)
                                    echo $svoris;
                                echo "' class='form-control' />

                            </div>

                            <div class='form-group'>
                                <label for='name'>Užimamas plotas (kv. m)</label>
                                <input type='number' name='uzimamas_plotas' placeholder='Plotas' value='";
                                if ($error)
                                    echo $uzimamas_plotas;
                                echo "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Inventoriaus tipas</label>
                                <input type='text' name='inventoriaus_tipas' placeholder='Tipas' value='";
                                if ($error)
                                    echo $inventoriaus_tipas;
                                echo "' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='name'>Gamintojas</label>
                                <input type='text' name='gamintojas' placeholder='Inventoriaus gamintojas' required value='";
                                if ($error)
                                    echo $gamintojas;
                                echo "' class='form-control' />
                            </div>
                            <div class='form-group'>
                                <label for='name'>Pagaminimo data</label>
                                <input type='date' name='pagaminimo_data' placeholder='Data' required value='";
                                if ($error)
                                    echo $pagaminimo_data;
                                echo "' class='form-control' />
                            </div>
                            <div class='form-group'>
                                <label for='name'>Pirkimas</label>

                                <select name='pirkimas' class='form-control'>
                                    <option value='-1'>Nurodykite pirkimo, kuriuo buvo nupirktas inventorius, numerį:</option>";

                                while ($row = $show3->fetch_assoc()) {
                                    echo "<option value=\"" . $row['id'] . "\">" . $row['id'] . "</option>";
                                }
                                echo "
                                </select>
                            </div>
                            <div class='form-group'>
                                <label for='name'>Patalpa</label>

                                <select name='patalpa' class='form-control'>
                                    <option value='-1'>Nurodykite patalpą, kuriai priskiriamas inventorius:</option>";

                                while ($row = $show4->fetch_assoc()) {
                                    echo "<option value=\"" . $row['numeris'] . "\">" . $row['numeris'] . "</option>";
                                }

                                echo "   </select>
                            </div>

                            <div class='form-group'>
                                <input type='submit' name='registruoti_inventoriu' value='Registruoti' class='btn btn-primary' />
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

                            include 'dbconnect.php';
                            ?>