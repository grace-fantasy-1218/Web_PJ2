<?php
session_start();
$_SESSION['hot2'] = $_GET['hot'];
$_SESSION['chooseType'] = 3;
$_SESSION['chooseType2'] = 2;
header("location:browser.php");