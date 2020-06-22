<?php
session_start();
unset($_SESSION['user']);
$_SESSION['loggedIn']=0;
header("location:../index.php");