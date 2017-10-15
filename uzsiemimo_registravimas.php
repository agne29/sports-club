<?php
session_start();


include_once 'dbconnect.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['registruoti'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $pradzios_laikas = mysqli_real_escape_string($con, $_POST['pradzios_laikas']);
    $pabaigos_laikas = mysqli_real_escape_string($con, $_POST['pabaigos_laikas']);
    $uzsiemimo_tipas = mysqli_real_escape_string($con, $_POST['uzsiemimo_tipas']);
    $patalpa = mysqli_real_escape_string($con, $_POST['patalpa']);
    $treneris = mysqli_real_escape_string($con, $_POST['treneris']);

    if (!$error) {
        if (mysqli_query($con, "INSERT INTO uzsiemimai(id,pradzios_laikas, pabaigos_laikas, uzsiemimo_tipas, fk_patalpa, fk_treneris)
            VALUES('" . $id . "', '" . $pradzios_laikas. "', '" . $pabaigos_laikas . "','" . $uzsiemimo_tipas . "', '" . $patalpa . "', '" . $treneris . "')")) {
            $successmsg = "Sėkmingai užregistravote Užsiėmimą!";
        } else {
            $errormsg = "Įvyko klaida...  Bandykite dar kartą!";
        }
    }
}
$show = $con->query("SELECT * FROM patalpos");
$show1 = $con->query("SELECT * FROM treneriai");
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
                    <legend>Užsiėmimį registracija</legend>


                    <div class="form-group">
                        <label for="name">ID</label>
                        <input type="number" name="id" placeholder="Įveskite užsiėmimų ID" required value="<?php if ($error) echo $id; ?>" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="name">Pradžios laikas</label>
                        <input type="time" name="pradzios_laikas" placeholder="Pradžios laikas" required value="<?php if ($error) echo $pradzios_laikas; ?>" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="name">Pabaigos laikas</label>
                        <input type="time" name="pabaigos_laikas" placeholder="Pabaigos laikas" required value="<?php if ($error) echo $pabaigos_laikas; ?>" class="form-control" />
                    </div>


                    <div class="form-group">
                        <label for="name">Užsiėmimų tipas</label>
                        <input type="text" name="uzsiemimo_tipas" placeholder="Užsiėmimo tipas" required value="<?php if ($error) echo $uzsiemimo_tipas; ?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="name">Patalpa</label>
                        <!--<input type="number" name="padalinys" placeholder="Padalinys" required value="<?php if ($error) echo $padalinys; ?>" class="form-control" />-->
                        <select name="patalpa" class="form-control">
                            <option value="-1">Pasirinkite patalpą:</option>
                            <?php
                            while ($row = $show->fetch_assoc()) {
                                echo "<option value=\"" . $row['numeris'] . "\">" . $row['numeris'] . "</option>";
                            }
                            ?>
                        </select>
                        <div class="form-group">
                            <label for="name">Treneris</label>
                            <!--<input type="number" name="padalinys" placeholder="Padalinys" required value="<?php if ($error) echo $padalinys; ?>" class="form-control" />-->
                            <select name="treneris" class="form-control">
                                <option value="-1">Pasirinkite trenerį:</option>
                                <?php
                                while ($row = $show1->fetch_assoc()) {
                                    echo "<option value=\"" . $row['asmens_kodas'] . "\">" . $row['vardas'] . "</option>";
                                }
                                ?>
                            </select>


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