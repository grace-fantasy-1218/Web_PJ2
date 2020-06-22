<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>我的照片</title>
    <link rel="stylesheet"  type="text/css" href="../css/nav.css" media="all">
    <link rel="stylesheet"  type="text/css" href="../css/favor.css" media="all">
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
                    error_reporting(0);
                    session_start();
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

    <div>
        <div id="main">
            <h2 id="small_title">我的照片</h2>
            <?php
            error_reporting(0);//不看notice的报错提醒
            $servername ="localhost";
            $db_username="root";
            $db_password="Grace1218";
            $db_name="travel";
            $conn=new mysqli($servername,$db_username,$db_password,$db_name);
            $user=$_SESSION["user"];
            $sql="SELECT * From upload WHERE username='$user'";
            $query=mysqli_query($conn,$sql);
            $value = $conn->query($sql)->num_rows;

            if ($value == 0){
                echo '<p style="position: absolute;top: 400px;left: 620px">你还没有照片，快去添加吧！</p>';
            }else{
                if (!isset($_GET['page'])){
                    $_GET['page']=1;
                }
                if ($_GET['page'] == 1) {
                    $l = 1;
                } else if ($_GET['page'] == 2) {
                    $l = 5;
                } else if ($_GET['page'] == 3) {
                    $l = 9;
                } else if ($_GET['page'] == 4) {
                    $l = 13;
                } else if ($_GET['page'] == 5) {
                    $l = 17;
                }
                $rs = array();
                $ps = array();
                $ts = array();
                $ds = array();
                $nams = array();//作家
                $cs = array();//国家
                $cns = array();//内容
                $ccs = array();//城市
                for ($i = 0; $i < $value; $i++) {
                    $j = $i + $l - 1;
                    $sql0 = "SELECT * FROM upload WHERE UID='$UID'  limit  $j,1";
                    $query=mysqli_query($conn,$sql0);
                    $row=mysqli_fetch_assoc($query);
                    $h="../images/small/".$row["PATH"];
                    $t=$row["Title"];
                    $d=$row["Description"];
                    $n=$row["UID"]-1;
                    $imageID = $row["ImageID"];
                    $country=$row["Country_RegionCodeISO"];
                    $cc=$row["CityCode"];
                    $content = $row["Content"];
                    $sql3="SELECT Country_RegionName,Continent From geocountries_regions WHERE (ISO='$country')";
                    $sql2="SELECT UserName FROM traveluser order by UID limit $n,1";
                    $query2=mysqli_query($conn,$sql2);
                    $row2=mysqli_fetch_assoc($query2);
                    $query3=mysqli_query($conn,$sql3);
                    $row3=mysqli_fetch_assoc($query3);
                    $continent=$row3["Continent"];
                    $sql4="SELECT ContinentName From geocontinents WHERE (ContinentCode='$continent')";
                    $query4=mysqli_query($conn,$sql4);
                    $row4=mysqli_fetch_assoc($query4);
                    $continentname=$row4["ContinentName"];
                    if (!empty("$cc")){
                        $sql0="SELECT AsciiName From geocities WHERE (GeoNameID='$cc')";
                        $query0=mysqli_query($conn,$sql0);
                        $row0=mysqli_fetch_assoc($query0);
                        $ccn=$row0["AsciiName"];
                    }else{
                        $ccn='';
                    }
                    $Country=$row3["Country_RegionName"];
                    $nam=$row2["UserName"];
                    $ids[$i] = $imageID;
                    $rs[$i] = $row["PATH"];
                    $ps[$i] = $h;
                    $ts[$i] = $t;
                    $ds[$i] = $d;
                    $nam[$i] = $nam;
                    $cs[$i] = $Country;
                    $cns[$i] = $content;
                    $ccs[$i] = $ccn;
                }
                ?>
                <?php
                echo'<div class="part">
                    <table class="pics">
                    <td rowspan="2">
                        <a href="details.php?imageSrc='.$rs[($_GET['page'] - 1) * 4].'&src='.$ps[($_GET['page'] - 1) * 4].'&name='.$ts[($_GET['page'] - 1) * 4].'&des='.$ds[($_GET['page'] - 1) * 4].'&author='.$nams[($_GET['page'] - 1) * 4].'&countryname='.$cs[($_GET['page'] - 1) * 4].'&cn='.$cns[($_GET['page'] - 1) * 4].'&cc1='.$ccs[($_GET['page'] - 1) * 4].'">
                        <img src="'.$ps[($_GET['page'] - 1) * 4].'""></a> </td>
                    <td>
                        <p> <strong>  ' . $ts[($_GET['page'] - 1) * 4] . ' </strong><br><br>
                       ' . $ds[($_GET['page'] - 1) * 4] . '</p>
                    </td>
                    <td>
                    <a href="alter.php?ids='.$ids[($_GET['page'] - 1) * 4].'" id="修改" class="隐藏"><p>修改</p></a>
                    <a href="delete.php?ids='.$ids[($_GET['page'] - 1) * 4].'" id="删除" class="隐藏"><p>删除</p></a>
                    </td>
                </table>
                <table class="pics">
                    <td rowspan="2">
                        <a href="details.php?imageSrc='.$rs[($_GET['page'] - 1) * 4 + 1].'&src='.$ps[($_GET['page'] - 1) * 4 + 1].'&name='.$ts[($_GET['page'] - 1) * 4 + 1].'&des='.$ds[($_GET['page'] - 1) * 4 + 1].'&author='.$nams[($_GET['page'] - 1) * 4 + 1].'&countryname='.$cs[($_GET['page'] - 1) * 4 + 1].'&cn='.$cns[($_GET['page'] - 1) * 4 + 1].'&cc1='.$ccs[($_GET['page'] - 1) * 4 + 1].'">
                        <img src="'.$ps[($_GET['page'] - 1) * 4 + 1].'""></a> </td>
                    <td>
                        <p> <strong>  ' . $ts[($_GET['page'] - 1) * 4 + 1] . ' </strong><br><br>
                       ' . $ds[($_GET['page'] - 1) * 4 + 1] . '</p>
                    </td>
                    <td>
                    <a href="alter.php?ids='.$ids[($_GET['page'] - 1) * 4 + 1].'" id="修改" class="隐藏"><p>修改</p></a>
                    <a href="delete.php?ids='.$ids[($_GET['page'] - 1) * 4 + 1].'" id="删除" class="隐藏"><p>删除</p></a>
                    </td>
                </table>
                <table class="pics">
                    <td rowspan="2">
                        <a href="details.php?imageSrc='.$rs[($_GET['page'] - 1) * 4 + 2].'&src='.$ps[($_GET['page'] - 1) * 4 + 2].'&name='.$ts[($_GET['page'] - 1) * 4 + 2].'&des='.$ds[($_GET['page'] - 1) * 4 + 2].'&author='.$nams[($_GET['page'] - 1) * 4 + 2].'&countryname='.$cs[($_GET['page'] - 1) * 4 + 2].'&cn='.$cns[($_GET['page'] - 1) * 4 + 2].'&cc1='.$ccs[($_GET['page'] - 1) * 4 + 2].'">
                        <img src="'.$ps[($_GET['page'] - 1) * 4 + 2].'""></a> </td>
                    <td>
                        <p> <strong>  ' . $ts[($_GET['page'] - 1) * 4 + 2] . ' </strong><br><br>
                       ' . $ds[($_GET['page'] - 1) * 4 + 2] . '</p>
                    </td>
                    <td>
                    <a href="alter.php?ids='.$ids[($_GET['page'] - 1) * 4 + 2].'" id="修改" class="隐藏"><p>修改</p></a>
                    <a href="delete.php?ids='.$ids[($_GET['page'] - 1) * 4 + 2].'" id="删除" class="隐藏"><p>删除</p></a>
                    </td>
                </table>
                <table class="pics">
                    <td rowspan="2">
                        <a href="details.php?imageSrc='.$rs[($_GET['page'] - 1) * 4 + 3].'&src='.$ps[($_GET['page'] - 1) * 4 + 3].'&name='.$ts[($_GET['page'] - 1) * 4 + 3].'&des='.$ds[($_GET['page'] - 1) * 4 + 3].'&author='.$nams[($_GET['page'] - 1) * 4 + 3].'&countryname='.$cs[($_GET['page'] - 1) * 4 + 3].'&cn='.$cns[($_GET['page'] - 1) * 4 + 3].'&cc1='.$ccs[($_GET['page'] - 1) * 4 + 3].'">
                        <img src="'.$ps[($_GET['page'] - 1) * 4 + 3].'""></a> </td>
                    <td>
                        <p> <strong>  ' . $ts[($_GET['page'] - 1) * 4 + 3] . ' </strong><br><br>
                       ' . $ds[($_GET['page'] - 1) * 4 + 3] . '</p>
                    </td>
                    <td>
                    <a href="alter.php?ids='.$ids[($_GET['page'] - 1) * 4 + 3].'" id="修改" class="隐藏"><p>修改</p></a>
                    <a href="delete.php?ids='.$ids[($_GET['page'] - 1) * 4 + 3].'" id="删除" class="隐藏"><p>删除</p></a>
                    </td>
                </table>';}
            ?>

<?php
        echo'<ul id="page_count">';
            if (!isset($_GET['page'])){
            $_GET['page']=1;
            }
            if ($_GET['page']==1){
            echo '<li><a href="?page=1" class="k"><<</a></li>
            <li><a href="?page=1" class="kk">1</a></li>
            <li><a href="?page=2" class="k">2</a></li>
            <li><a href="?page=3" class="k">3</a></li>
            <li><a href="?page=4" class="k">4</a></li>
            <li><a href="?page=5" class="k">5</a></li>
            <li><a href="?page=5" class="k">>></a></li>';
            }else{
            if ($_GET['page']==2){
            echo '<li><a href="?page=1" class="k"><<</a></li>
            <li><a href="?page=1" class="k">1</a></li>
            <li><a href="?page=2" class="kk">2</a></li>
            <li><a href="?page=3" class="k">3</a></li>
            <li><a href="?page=4" class="k">4</a></li>
            <li><a href="?page=5" class="k">5</a></li>
            <li><a href="?page=5" class="k">>></a></li>';
            }else{
            if ($_GET['page']==3){
            echo '<li><a href="?page=1" class="k"><<</a></li>
            <li><a href="?page=1" class="k">1</a></li>
            <li><a href="?page=2" class="k" >2</a></li>
            <li><a href="?page=3" class="kk">3</a></li>
            <li><a href="?page=4" class="k">4</a></li>
            <li><a href="?page=5" class="k">5</a></li>
            <li><a href="?page=5" class="k">>></a></li>';
            }else{
            if ($_GET['page']==4){
            echo '<li><a href="?page=1" class="k"><<</a></li>
            <li><a href="?page=1" class="k">1</a></li>
            <li><a href="?page=2" class="k">2</a></li>
            <li><a href="?page=3" class="k">3</a></li>
            <li><a href="?page=4" class="kk">4</a></li>
            <li><a href="?page=5" class="k">5</a></li>
            <li><a href="?page=5" class="k">>></a></li>';
            }else{
            if ($_GET['page']==5){
            echo '<li><a href="?page=1" class="k"><<</a></li>
            <li><a href="?page=1" class="k">1</a></li>
            <li><a href="?page=2" class="k">2</a></li>
            <li><a href="?page=3" class="k">3</a></li>
            <li><a href="?page=4" class="k">4</a></li>
            <li><a href="?page=5" class="kk">5</a></li>
            <li><a href="?page=5" class="k">>></a></li>';
            }
            }
            }
            }
            }
?>
    </div>
<footer>
        <p>© Copyright by GraceShao | 沪ICP备19302010066</p>
        <p>意见箱</p>
        <p>联系我们</p>
        <p>加入我们</p>
</footer>
</body>
</html>