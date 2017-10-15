<?php
session_start();
include_once 'dbconnect.php';

if (isset($_POST['delete'])) {

    $id = mysqli_real_escape_string($con, $_POST['id']);

    mysqli_query($con, "DELETE FROM paslaugos WHERE id='" . $id . "'");
}
?>
<!DOCTYPE html>
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
                            <li><a href="abonimentu_sarasas.php">Abonementai</a></li>
                            <li><a href="pardavimu_ataskaita.php">Pardavimų ataskaita</a></li>
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

                        <p class="lead section-lead">Sporto klubo paslaugos</p>
                        <div class="row">

                            <?php
                            $query = 'SELECT paslaugos.id, paslaugos.kaina, paslaugos.isigijama_nuo, paslaugos.isigijama_iki, paslaugos.tipas from paslaugos';
//$result = mysql_query( $query);
                            $result = @mysqli_query($con, $query);


                            echo "<table class='table table-bordered table-striped table-hover'>
                                <thead>
                                    <tr>
                                        <td colspan=9><a href='paslaugos_nauji.php'>Registruoti paslaugą</a></td>
                                    </tr>
                                </thead>";

                            echo "<tbody>
                                    <tr>
                                        <th class='text-center'>ID</td>
                                        <th class='text-center'>Kaina</td>
                                        <th class='text-center'>Įsigijama nuo</td>
                                        <th class='text-center'>Įsigijama iki</td>
                                        <th class='text-center'>Tipas</td>
                                        <th class='text-center'>&nbsp;</td>
                                    </tr>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td class='text-center'>" . $row['id'] . "</td>";
                                echo "<td class='text-center'>" . $row['kaina'] . "</td>";
                                echo "<td class='text-center'>" . $row['isigijama_nuo'] . "</td>";
                                echo "<td class='text-center'>" . $row['isigijama_iki'] . "</td>";
                                echo "<td class='text-center'>" . $row['tipas'] . "</td>";

                                echo "<td class='text-center'><a href=\"paslaugos_keisti.php?id=" . $row['id'] . " \" name='edit' value='Redaguoti'>Redaguoti</a>&nbsp;&nbsp;&nbsp;";
                                echo " <a href=\"paslaugos_trinti.php?id=" . $row['id'] . " \" name='delete' value='Šalinti'>Ištrinti</a>" . "</td>
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