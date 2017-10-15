<?php
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: index.php");
}

include_once 'dbconnect.php';

//check if form is submitted
if (isset($_POST['login'])) {

    $password = mysqli_real_escape_string($con, $_POST['password']);
    $elektroninis_pastas = mysqli_real_escape_string($con, $_POST['elektroninis_pastas']);

    $result = mysqli_query($con, "SELECT * FROM klientai WHERE elektroninis_pastas = '" . $elektroninis_pastas . "' and password = '" . md5($password) . "'");

    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['elektroninis_pastas'] = $row['elektroninis_pastas'];
        $_SESSION['password'] = $row['password']; // cia tai uzprikolinai, patiko xd ziek
        header("Location: index.php");
    } else {
        $errormsg = "Nurodytas neteisingas el. paštas arba slaptažodis!";
    }
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
                <!-- add header -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- menu items -->
                <div class="collapse navbar-collapse" id="navbar1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="login.php">Prisijungti</a></li>
                        <li><a href="register.php">Registruotis</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 well">
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
                        <fieldset>
                            <legend>Prisijungimas</legend>

                            <div class="form-group">
                                <label for="name">Elektroninis paštas</label>
                                <input type="text" name="elektroninis_pastas" placeholder="Elektroninis paštas" required class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="name">Slaptažodis</label>
                                <input type="password" name="password" placeholder="Slaptažodis" required class="form-control" />
                            </div>

                            <div class="form-group">
                                <input type="submit" name="login" value="Prisijungti" class="btn btn-primary" />
                            </div>
                        </fieldset>
                    </form>
                    <span class="text-danger"><?php
                        if (isset($errormsg)) {
                            echo $errormsg;
                        }
                        ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    Naujas vartotojas? <a href="register.php">Registracija</a>
                </br>
                    Administratorius?  <a href="adminlogin.php">Prisijunk</a>
                </br>
                    Buhalteris? <a href="buhlogin.php">Prisijunk</a>
                </div>
            </div>
        </div>

        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>