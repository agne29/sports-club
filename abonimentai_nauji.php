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
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="abonementu_registravimas">
                        <fieldset>
                            <legend>Abonementų registracija</legend>

                            <?php abonementu_registravimas(); ?>

                            </div>
                            </div>

                            </div>
                            <script src="js/jquery.js"></script>
                            <script src="js/bootstrap.min.js"></script>
                            </body>
                            </html>


                            <?php

                            function abonementu_registravimas() {
                                include 'dbconnect.php';

//set validation error flag as false
                                $error = false;
if (isset($_POST['registruoti'])) {
    $data_nuo = mysqli_real_escape_string($con, $_POST['data_nuo']);
    $data_iki = mysqli_real_escape_string($con, $_POST['data_iki']);
    $kaina = mysqli_real_escape_string($con, $_POST['kaina']);
    $tipas = mysqli_real_escape_string($con, $_POST['tipas']);
    $rusis = mysqli_real_escape_string($con, $_POST['rusis']);

    if (!$error) {
        if (mysqli_query($con, "INSERT INTO abonementai(data_nuo, data_iki, kaina, tipas, rusis)
            VALUES('" . $data_nuo . "', '" . $data_iki . "', '" . $kaina . "',
             '" . $tipas . "', '" . $rusis . "')")) {
            $successmsg = "Sėkmingai užregistravote abonementą! <a href='abonimentu_sarasas.php'>Paspauskite, kad grįžtumėte į abonementų sąrašo langą.</a>";
        } else {
            $errormsg = "Įvyko klaida...  Bandykite dar kartą!";
        }
    }
}
 echo "

                            <div class='form-group'>
                                <label for='name'>Data nuo</label>
                                <input type='date' name='data_nuo' placeholder='Data' required value='";
                                if ($error) 
                                    echo $data_nuo;
                                echo "' class='form-control' />
                            </div>   

                             <div class='form-group'>
                                <label for='name'>Data iki</label>
                                <input type='date' name='data_iki' placeholder='Data' required value='";
                                if ($error) 
                                    echo $data_iki;
                                echo "' class='form-control' />
                            </div>                        

                            <div class='form-group'>
                                <label for='name'>Kaina</label>
                                <input type='number' name='kaina' placeholder='Kaina' required value='";
                                if ($error) 
                                    echo $kaina;
                                echo "' class='form-control' />
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
                                echo "</span>";
                            }

                            include 'dbconnect.php';
                            ?>