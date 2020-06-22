<?php
session_start();
$servername ="localhost";
$db_username="root";
$db_password="Grace1218";
$db_name="travel";
$conn=new mysqli($servername,$db_username,$db_password,$db_name);
$user=$_SESSION['user'];
$name=$_FILES["file"]["name"];
$sql="SELECT * FROM upload WHERE (username='$user') AND (ImageSrc='$name')";
$query=mysqli_query($conn,$sql);
$value = $conn->query($sql)->num_rows;
if ((($_FILES["file"]["type"] == "image/gif")
    || ($_FILES["file"]["type"] == "image/jpeg")
    || ($_FILES["file"]["type"] == "image/pjpeg"))
)
{
    if ($_FILES["file"]["error"] <= 0) {
        if (!file_exists("upload/" . $_FILES["file"]["name"])){
            move_uploaded_file($_FILES["file"]["tmp_name"],
                "upload/" . $_FILES["file"]["name"]);
        }
    }
}
if ($_POST['country']=='国家'||$_FILES["file"]["name"]==''){
    echo '信息不完整,点击此处 <a href="upload.php">返回</a> 重试';
}else{
    $country=$_POST['country'];
    $city=$_POST['city'];
    $type=$_POST['type'];
    $des=$_POST['des'];
    $title=$_POST['title'];
    if ($value==0){
        $sql1="INSERT INTO upload(ImageSrc,username,title,description,country,city,content) VALUES ('$name','$user','$title','$des','$country','$city','$type')";
        $query=mysqli_query($conn,$sql1);
        header("location:photos.php");
    }else{
        echo '你已经拥有该图片,点击此处 <a href="photos.php">返回</a> 我的上传，进行修改';
    }
}
?>


