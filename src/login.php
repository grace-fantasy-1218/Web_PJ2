<?php
session_start();
header("content-type:text/html;charset=utf8");
$servername ="localhost";
$db_username="root";
$db_password="Grace1218";
$db_name="travel";
$conn=new mysqli($servername,$db_username,$db_password,$db_name);
$name=$_POST['name'];
$pass=$_POST['password'];
$sql="SELECT UserName,Pass From traveluser WHERE (UserName='$name')AND (Pass='$pass')";
$query=mysqli_query($conn,$sql);
$result = $conn->query($sql);
$_SESSION['loggedIn']=1;
if ($result->num_rows > 0){
    $_SESSION['user'] = $name;
    header('location:../index.php');
}else{
    echo'<script>
    alert(\'用户名或密码错误，登录失败！\');
    window.location.href = "login.html";
    </script>';
}?>