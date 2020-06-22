<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>图片详情</title>
    <link rel="stylesheet"  type="text/css" href="../css/nav.css" media="all">
    <link rel="stylesheet"  type="text/css" href="../css/details.css" media="all">
</head>
<body>
    <header>
        <h1>Travel Images</h1>
        <nav>
            <a href="../index.php" id="home" autofocus><p>首页</p></a>
            <a href="browser.php" autofocus><p>浏览</p></a>
            <a href="search.php" autofocus><p>搜索</p></a>
            <div class="box">
                <a id="login_out" href=" <?php if (empty($_SESSION['user'])){echo 'src/login.html';}?>">登录</a>
                <ul class="box-ul">
                    <?php
                    session_start();
                    $_SESSION['c2']=0;
                    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                        echo "
                    <li><a href=\"upload.php\"><img src=\"../images/myAccount/upload.jpg\">上传</a></li>
                    <li><a href=\"photos.php\"><img src=\"../images/myAccount/photos.jpg\">我的照片</a></li>
                    <li><a href=\"favor.php\"><img src=\"../images/myAccount/favor.jpg\">我的收藏</a></li>
                    <li><a href='logout.php'>登出</a></div></li>
                </ul>
            </div>";
                        echo '<script type="text/javascript">
                document.getElementById("login_out").innerText="个人中心";
                document.getElementById("login_out").href = "#"</script>';
                    }
                    ?>
        </nav>
    </header>

    <?php
    error_reporting(0);//不看notice的报错提醒

    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        $_SESSION['src']=$_GET['imageSrc'];
        $servername ="localhost";
        $db_username="root";
        $db_password="Grace1218";
        $db_name="travel";
        $conn=new mysqli($servername,$db_username,$db_password,$db_name);
        $user=$_SESSION["user"];
        $sql="SELECT total From traveluser WHERE UserName='$user'";
        $query=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($query);

        $imageSrc = $_GET['imageSrc'];
        $sql = "SELECT ImageID From travelimage WHERE (PATH ='$imageSrc')";
        $query = mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($query);
        $UID = $row["UID"];
        echo $UID;
        $sql1="SELECT UID,ImageID From travelimagefavor WHERE (UID='$UID') AND (ImageID='$imageSrc')";
        $query1=mysqli_query($conn,$sql1);
        $result = $conn->query($sql1);
        if ($result->num_rows > 0){
            $_SESSION['collect']=1;}
    }
         $imageSrc = $_GET['imageSrc'];
    ?>

    <form method="post" action="collect.php?UID='.$UID.'& imageSrc = '.$imageSrc.'">
    <div id="main">
        <table>
            <td id="leftPicture">
                <img img src="../<?php echo $_GET['src']?>">
                <p>——<?php if (empty($_GET["author"])){echo 'none';}else{echo $_GET["author"];}?></p>
            </td>
            <td id="rightDescription">
                <h2><?php if (empty($_GET["name"])){echo 'none';}else{echo $_GET["name"];}?></h2>
            <p id="location">坐标：<?php if (empty($_GET["countryname"])){echo '';}else{echo $_GET["countryname"];}?>
                <?php if (empty($_GET["cc1"])){echo 'none';}else{echo $_GET["cc1"];}?> | 主题：<?php echo $_GET["cn"];?></p>
            <p id="details">
                <?php echo $_GET["des"];?>
                <br><br><br>
                <div><div>
                        <?php
                        echo '<p>已收藏&emsp;12 </p>';
                        ?>
                        <?php
                        if ($_SESSION['collect']==''){
                            echo '<p><img src="../images/heart.jpg"><input type="submit" id="lovedOnes" value="未收藏" >';
                        }
                        else if ($_SESSION['collect']==1) {
                            echo '<p><img src="../images/heart.jpg"><input type="submit" id="lovedOnes" value="已收藏" >';
                        }
                        ?>

                </div></div>
        </td>
        </table>
    </div>
    </form>

    <footer>
        <p>© Copyright by GraceShao | 沪ICP备19302010066</p>
        <p>意见箱</p>
        <p>联系我们</p>
        <p>加入我们</p>          
    </footer>
</body>
</html>