<?php
session_start();

$Catago = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `catagorymain` WHERE"));
$_SESSION['CATA_ID'] = $Catago['id'];
$_SESSION['CATA_NAME'] = $Catago['name'];

?>