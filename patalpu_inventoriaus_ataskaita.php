<?php
session_start();

function patalpoje_esancio_inventoriaus_ataskaita() {

    include 'dbconnect.php';

    $query = "SELECT * FROM patalpos";
    $show = $con->query($query);


    if (isset($_POST['submit'])) {
        $numeris = $_POST['patalpa'];


        $query = 'SELECT inventorius.tabelio_numeris, inventorius.svoris, inventorius.uzimamas_plotas, inventorius.inventoriaus_tipas, inventorius.gamintojas, inventorius.pagaminimo_data, pirkimai.id, patalpos.numeris from inventorius, pirkimai, patalpos '
                . 'where pirkimai.id = inventorius.fk_pirkimas and patalpos.numeris = inventorius.fk_patalpa and inventorius.fk_patalpa="' . $numeris . '"';
//$result = mysql_query( $query);
        $result = @mysqli_query($con, $query);


        echo "<table class='table table-bordered table-striped table-hover'>
                                <thead>
                                    <tr>
                                        <td colspan=9><strong>Patalpoje, kurios numeris " . $numeris . ", esantis inventorius.</strong></td>
                                    </tr>
                                </thead>";

        echo "<tbody>
                                    <tr>
                                        <th class='text-center'>Tabelio numeris</td>
                                        <th class='text-center'>Inventoriaus tipas</td>
                                        <th class='text-center'>Svoris</td>
                                        <th class='text-center'>Užimamas plotas</td>

                                        <th class='text-center'>Gamintojas</td>
                                        <th class='text-center'>Pagaminimo data</td>
                                        <th class='text-center'>Pirkimo numeris</td>
                                        <th class='text-center'>Patalpa</td>

                                    </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td class='text-center'>" . $row['tabelio_numeris'] . "</td>";
            echo "<td class='text-center'>" . $row['inventoriaus_tipas'] . "</td>";
            echo "<td class='text-center'>" . $row['svoris'] . "</td>";
            echo "<td class='text-center'>" . $row['uzimamas_plotas'] . "</td>";
            echo "<td class='text-center'>" . $row['gamintojas'] . "</td>";
            echo "<td class='text-center'>" . $row['pagaminimo_data'] . "</td>";
            echo "<td class='text-center'>" . $row['id'] . "</td>";
            echo "<td class='text-center'>" . $row['numeris'] . "</td>";

            echo "</tr>";
        }
        echo "</tbody>
                            </table> ";
    }
}

include 'dbconnect.php';

$query = "SELECT * FROM patalpos";
$show = $con->query($query);
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

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="row">

                            <form method="post">
                                <div class="text-center">
                                    <p class="lead section-lead">Patalpai priklausančio inventoriaus ataskaita</p>
                                    <select name="patalpa">
                                        <option value="-1">Pasirinkite patalpos numerį</option>
                                        <?php
                                        while ($row = $show->fetch_assoc()) {
                                            echo "<option value=\"" . $row['numeris'] . "\">" . $row['numeris'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <input type="submit" name="submit" value="Pateikti">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <br>
        <br>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="row">

                            <?php patalpoje_esancio_inventoriaus_ataskaita(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>