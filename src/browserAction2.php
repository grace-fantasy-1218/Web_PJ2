<?php
session_start();
$_SESSION['hot'] = $_GET['hot'];
$_SESSION['chooseType'] = 3;
$_SESSION['chooseType2'] = 1;
header("location:browser.php");