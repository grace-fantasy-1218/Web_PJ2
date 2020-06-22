<?php
session_start();
$servername ="localhost";
$db_username="root";
$db_password="Grace1218";
$db_name="travel";
$conn=new mysqli($servername,$db_username,$db_password,$db_name);

$UID = $_GET["UID"];

header("location:favor.php");