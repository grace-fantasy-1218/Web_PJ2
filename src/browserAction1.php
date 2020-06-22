<?php
session_start();
$_SESSION['chooseType'] = 2;
$_SESSION['bThing'] = $_POST['bThing'];
header("location: browser.php");