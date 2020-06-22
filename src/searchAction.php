<?php
session_start();
$_SESSION['search_title'] = $_POST['search_title'];
$_SESSION['search_des'] = $_POST['search_des'];
header("location:search.php");