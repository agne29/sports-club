<?php
session_start();
include_once 'dbconnect.php';
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


<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <p class="lead section-lead">Sporto klubo klientai</p>
                <div class="row">

                    <?php
                    /*$query = 'SELECT klientai.asmens_kodas, klientai.vardas, klientai.pavarde, klientai.gimimo_data, klientai.telefonas from klientai where klientai.asmens_kodas = klientai.fk_klientai';
                    //$result = mysql_query( $query);
                    $result = @mysqli_query($con, $query);*/
                    $query = 'SELECT * from klientai';
                    //$result = mysql_query( $query);
                    $result = @mysqli_query($con, $query);



                    echo "<table class='table table-bordered table-striped table-hover'>
                                <thead>
                                    <tr>
                                        <td colspan=7><a href='registernew.php'>Registruoti naują klientą</a><br>

                                    </tr>
                                </thead>";

                    echo "<tbody>
                                    <tr>
                                        <th class='text-center'>Asmens kodas</td>
                                        <th class='text-center'>Vardas</td>
                                        <th class='text-center'>Pavardė</td>
                                        <th class='text-center'>Gimimo data</td>
                                        <th class='text-center'>Telefonas</td>
                                        <th class='text-center'>Elektroninis paštas</td>
                                        <th class='text-center'>&nbsp;</td>
                                    </tr>";
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td class='text-center'>" . $row['asmens_kodas'] . "</td>";
                        echo "<td class='text-center'>" . $row['vardas'] . "td>";
                        echo "<td class='text-center'>" . $row['pavarde'] . "</td>";
                        echo "<td class='text-center'>" . $row['gimimo_data'] . "</td>";
                        echo "<td class='text-center'>" . $row['telefonas'] . "</td>";
                        echo "<td class='text-center'>" . $row['elektroninis_pastas'] . "</td>";
                        echo "<td class='text-center'><a href='#'>Redaguoti</a></td>
                            </tr>";
                    }
                    echo "</tbody>
                            </table> ";
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>