<?php
session_start();
$servername ="localhost";
$db_username="root";
$db_password="Grace1218";
$db_name="travel";
$conn=new mysqli($servername,$db_username,$db_password,$db_name);
$user=$_SESSION["user"];

$sql="SELECT * From traveluser WHERE UserName='$user'";
$query=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($query);
$idss = $_GET['ids'];

$sql1 = "DELETE FROM travelimagefavor WHERE ImageID = '$idss' ";
mysqli_query($conn,$sql1);
header("location:favor.php");