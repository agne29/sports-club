<?php

session_start();

function inventoriaus_istrynimas() {
    include_once 'dbconnect.php';

    $tabelio_numeris = $_GET['tabelio_numeris']; // $id is now defined
// or assuming your column is indeed an int
// $id = (int)$_GET['id'];

    mysqli_query($con, "DELETE FROM inventorius WHERE tabelio_numeris='" . $tabelio_numeris . "'");
    header("Location: inventoriaus_sarasas.php");
}

inventoriaus_istrynimas();
?>