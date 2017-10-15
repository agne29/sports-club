<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: index.php");
}

include_once 'dbconnect.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
    $asmens_kodas = mysqli_real_escape_string($con, $_POST['asmens_kodas']);
    $vardas = mysqli_real_escape_string($con, $_POST['vardas']);
    $pavarde = mysqli_real_escape_string($con, $_POST['pavarde']);
    $gimimo_data = mysqli_real_escape_string($con, $_POST['gimimo_data']);
    $telefonas = mysqli_real_escape_string($con, $_POST['telefonas']);
    $elektroninis_pastas = mysqli_real_escape_string($con, $_POST['elektroninis_pastas']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $gatve = mysqli_real_escape_string($con, $_POST['gatve']);
    $miestas = mysqli_real_escape_string($con, $_POST['miestas']);


//name can contain only alpha characters and space
    if (!preg_match("/^[a-zA-Z ]+$/", $vardas)) {
        $error = true;
        $vardas_error = "Vardą gali sudaryti tik raidės";
    }
    if (!filter_var($elektroninis_pastas, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $elpastas_error = "Prašome įvesti teisingą el-pašto adresą";
    }
    if (strlen($password) < 6) {
        $error = true;
        $password_error = "Slaptažodį turi sudaryti mažiausiai 6 simboliai";
    }
    if (!$error) {
        if (mysqli_query($con, "INSERT INTO klientai(asmens_kodas,vardas,pavarde,gimimo_data,telefonas,elektroninis_pastas,password,gatve,miestas)
            VALUES('" . $asmens_kodas . "', '" . $vardas . "', '" . $pavarde . "', '" . $gimimo_data . "', '" . $telefonas . "', '" . $elektroninis_pastas . "',
             '" . md5($password) . "', '" . $gatve . "', '" . $miestas . "')")) {
            $successmsg = "Sėkmingai prisiregistravote! <a href='login.php'>Paspauskite, kad prisijungti</a>";
        } else {
            $errormsg = "Įvyko klaida...  Bandykite dar kartą!";
        }
    }
}
?>

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
                        <li><a href="login.php">Prisijungti</a></li>
                        <li class="active"><a href="register.php">Registruotis</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 well">
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
                        <fieldset>
                            <legend>Prisijungti</legend>


                            <div class="form-group">
                                <label for="name">Asmens kodas</label>
                                <input type="text" name="asmens_kodas" placeholder="Įveskite asmens kodą" required value="<?php if ($error) echo $asmens_kodas; ?>" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="name">Vardas</label>
                                <input type="text" name="vardas" placeholder="Vardas" required value="<?php if ($error) echo $vardas; ?>" class="form-control" />
                                <span class="text-danger"><?php if (isset($vardas_error)) echo $vardas_error; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="name">Pavardė</label>
                                <input type="text" name="pavarde" placeholder="Pavardė" required value="<?php if ($error) echo $pavarde; ?>" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="name">Gimimo data</label>
                                <input type="date" name="gimimo_data" placeholder="Gimimo data" required value="<?php if ($error) echo $gimimo_data; ?>" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="name">Telefonas</label>
                                <input type="text" name="telefonas" placeholder="Telefonas" required value="<?php if ($error) echo $telefonas; ?>" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="name">Elektroninis paštas</label>
                                <input type="email" name="elektroninis_pastas" placeholder="El. paštas" required value="<?php if ($error) echo $elektroninis_pastas; ?>" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="name">Slaptažodis</label>
                                <input type="password" name="password" placeholder="Slaptažodis" required class="form-control" />
                                <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="name">Gatvė</label>
                                <input type="text" name="gatve" placeholder="Gatvė" required value="<?php if ($error) echo $gatve; ?>" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="name">Miestas</label>
                                <input type="text" name="miestas" placeholder="Miestas" required value="<?php if ($error) echo $miestas; ?>" class="form-control" />
                            </div>

                            <div class="form-group">
                                <input type="submit" name="signup" value="Registruotis" class="btn btn-primary" />
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
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    Jau mūsų sistemoje? <a href="login.php">Prisijungti</a>
                </div>
            </div>
        </div>
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>