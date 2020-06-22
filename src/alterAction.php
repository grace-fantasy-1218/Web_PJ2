<?php
session_start();
$servername = "localhost";
$db_username = "root";
$db_password = "Grace1218";
$db_name = "travel";
$conn = new mysqli($servername, $db_username, $db_password, $db_name);
$user = $_SESSION['user'];
$name = $_FILES["file"]["name"];

if ($name == '') {
    $name = $_SESSION['hh'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $type = $_POST['type'];
    $des = $_POST['des'];
    $title = $_POST['title'];
    mysqli_query($conn, "UPDATE upload SET title='$title'  WHERE (username='$user')AND (ImageSrc='$name')");
    mysqli_query($conn, "UPDATE upload SET description='$des'  WHERE (username='$user')AND (ImageSrc='$name')");
    mysqli_query($conn, "UPDATE upload SET country='$country'  WHERE (username='$user')AND (ImageSrc='$name')");
    mysqli_query($conn, "UPDATE upload SET city='$city'  WHERE (username='$user')AND (ImageSrc='$name')");
    mysqli_query($conn, "UPDATE upload SET picturetype='$type'  WHERE (username='$user')AND (ImageSrc='$name')");
    header("location:photos.php");
} else {
    $country = $_POST['country'];
    $city = $_POST['city'];
    $type = $_POST['type'];
    $des = $_POST['des'];
    $title = $_POST['title'];
    $pre = $_SESSION['hh'];
    mysqli_query($conn, "UPDATE upload SET ImageSrc='$name'  WHERE (username='$user')AND (ImageSrc='$pre')");
    mysqli_query($conn, "UPDATE upload SET title='$title'  WHERE (username='$user')AND (ImageSrc='$name')");
    mysqli_query($conn, "UPDATE upload SET title='$title'  WHERE (username='$user')AND (ImageSrc='$name')");
    mysqli_query($conn, "UPDATE upload SET description='$des'  WHERE (username='$user')AND (ImageSrc='$name')");
    mysqli_query($conn, "UPDATE upload SET country='$country'  WHERE (username='$user')AND (ImageSrc='$name')");
    mysqli_query($conn, "UPDATE upload SET city='$city'  WHERE (username='$user')AND (ImageSrc='$name')");
    mysqli_query($conn, "UPDATE upload SET picturetype='$type'  WHERE (username='$user')AND (ImageSrc='$name')");
    header("location:photos.php");
}