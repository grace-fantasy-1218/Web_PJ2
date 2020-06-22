<?php
session_start();
$_SESSION['hot3'] = $_GET['hot'];
$_SESSION['chooseType'] = 3;
$_SESSION['chooseType2'] = 3;
header("location:browser.php");