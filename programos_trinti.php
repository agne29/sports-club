<?php

session_start();
include_once 'dbconnect.php';

$id = $_GET['id']; // $id is now defined
// or assuming your column is indeed an int
// $id = (int)$_GET['id'];

mysqli_query($con, "DELETE FROM programos WHERE id='" . $id . "'");
header("Location: programu_sarasas.php");
?>