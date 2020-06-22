<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首页</title>
    <link rel="stylesheet"  type="text/css" href="css/nav.css" media="all">
    <link rel="stylesheet"  type="text/css" href="css/home.css" media="all">
    <script type="text/javascript" src="js/home.js"></script>
</head>

<script>
        var loggedIn = window.frames("src/login").document.getElementById("loggedIn").value;
        alert(loggedIn);
</script>

<body>
    <header>
        <h1>Travel Images</h1>
        <nav>
            <a href="index.php" id="home" autofocus><p>首页</p></a>
            <a href="src/browser.php" autofocus><p>浏览</p></a>
            <a href="src/search.php" autofocus><p>搜索</p></a>
            <div class="box">
            <a id="login_out" href=" <?php if (empty($_SESSION['user'])){echo 'src/login.html';}?>">登录</a>
            <ul class="box-ul">
            <?php
            session_start();
            if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                echo "
                    <li><a href=\"src/upload.php\"><img src=\"images/myAccount/upload.jpg\">上传</a></li>
                    <li><a href=\"src/photos.php\"><img src=\"images/myAccount/photos.jpg\">我的照片</a></li>
                    <li><a href=\"src/favor.php\"><img src=\"images/myAccount/favor.jpg\">我的收藏</a></li>
                    <li><a href='src/logout.php'>登出</a></div></li>
                </ul>
            </div>";
                echo '<script type="text/javascript">
                document.getElementById("login_out").innerText="个人中心";
                document.getElementById("login_out").href = "#"</script>';
            }
            ?>
        </nav>
    </header>

    <div id="main">
    <div>

        <?php
        header("content-type:text/html;charset=utf8");
        $servername ="localhost";
        $db_username="root";
        $db_password="Grace1218";
        $db_name="travel";
        $conn=new mysqli($servername,$db_username,$db_password,$db_name);
        //获取最爱照片表单选出次数最多
        $sql='SELECT PATH,travelimage.ImageID, COUNT(travelimagefavor.ImageID) AS instnum FROM travelimage LEFT 
              JOIN travelimagefavor ON travelimage.ImageID =travelimagefavor.ImageID GROUP BY travelimage.ImageID ORDER BY instnum DESC LIMIT 1';
        $query1=mysqli_query($conn,$sql);
        $row1 = mysqli_fetch_assoc($query1);
        $h="images/small/".$row1["PATH"];

        echo '
             <img  id="big" src="'.$h.'"></a>';
        ?>
    </div>

    <h3>热门景点一览</h3>
        <?php
        //装进数组
        $rs = array();
        $ps = array();
        $ts = array();
        $ds = array();
        $nams = array();//作家
        $cs = array();//国家
        $cns = array();//内容
        $ccs = array();//城市

        error_reporting(0);//不看notice的报错提醒

        for($i=0; $i<30; $i++){
        $sql1='SELECT *, COUNT(travelimagefavor.ImageID) AS instnum FROM travelimage LEFT 
               JOIN travelimagefavor ON travelimage.ImageID =travelimagefavor.ImageID GROUP BY travelimage.ImageID ORDER BY instnum DESC LIMIT  '.$i.' ,1';
        $query=mysqli_query($conn,$sql1);
        $row=mysqli_fetch_assoc($query);
            $h="images/small/".$row["PATH"];
            $t=$row["Title"];
            $d=$row["Description"];
            $n=$row["UID"]-1;
            $country=$row["Country_RegionCodeISO"];
            $cc=$row["CityCode"];
            $content = $row["Content"];
            $sql3="SELECT CountryName,Continent From geocountries_regions WHERE (ISO='$country')";
            $sql2="SELECT UserName FROM traveluser order by UID limit $n,1";
            $query2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_assoc($query2);
            $query3=mysqli_query($conn,$sql3);
            $row3=mysqli_fetch_assoc($query3);
            $continent=$row3["Continent"];
            $sql4="SELECT ContinentName From geocontinents WHERE (ContinentCode='$continent')";
            $query4=mysqli_query($conn,$sql4);
            $row4=mysqli_fetch_assoc($query4);

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

            $rs[$i] = $row["PATH"];
            $ps[$i] = $h;
            $ts[$i] = $t;
            $ds[$i] = $d;
            $nam[$i] = $nam;
            $cs[$i] = $Country;
            $cns[$i] = $content;
            $ccs[$i] = $ccn;
        }
        echo'<div id="motion_graph">
            <ul>
            <li><img src="'.$ps[0].'" alt=""></li>
            <li><img src="'.$ps[1].'" alt=""></li>
            <li><img src="'.$ps[2].'" alt=""></li>
            <li><img src="'.$ps[3].'" alt=""></li>
            <li><img src="'.$ps[4].'" alt=""></li>
            <li><img src="'.$ps[5].'" alt=""></li>
            <li><img src="'.$ps[6].'" alt=""></li>
            <li><img src="'.$ps[7].'" alt=""></li>
            <li><img src="'.$ps[8].'" alt=""></li>
            <li><img src="'.$ps[9].'" alt=""></li>
            <li><img src="'.$ps[10].'" alt=""></li>
            <li><img src="'.$ps[11].'" alt=""></li>
            <li><img src="'.$ps[12].'" alt=""></li>
            <li><img src="'.$ps[13].'" alt=""></li>
            <li><img src="'.$ps[14].'" alt=""></li>
        </ul>
    </div>
    ';

        try{
            $a = rand(0,30);
            $b = rand(0,30);
            $c = rand(0,30);
            $d = rand(0,30);
            $e = rand(0,30);
            $f = rand(0,30);
            $g = rand(0,30);
        echo'<h3>此刻TA们在</h3>
    <table>
        <tr>
            <td rowspan="2"><div id="p1"> 
                <a href="src/details.php?imageSrc='.$rs[$a].'&src='.$ps[$a].'&name='.$ts[$a].'&des='.$ds[$a].'&author='.$nams[$a].'&countryname='.$cs[$a].'&cn='.$cns[$a].'&cc1='.$ccs[$a].'"><img  name="a" src="'.$ps[$a].'"></a>
                <h4>'.$ts[$a].'</h4>
                <p class= "omit">'.$ds[$a].'</p>
            </div></td>
            <td>
                <table>
                    <td><div id="p2">
                         <a href="src/details.php?imageSrc='.$rs[$b].'&src='.$ps[$b].'&name='.$ts[$b].'&des='.$ds[$b].'&author='.$nams[$b].'&countryname='.$cs[$b].'&cn='.$cns[$b].'&cc1='.$ccs[$b].'"><img  name="a" src="'.$ps[$b].'"></a>
                        <h4>'.$ts[$b].'</h4>
                        <p class= "omit">'.$ds[$b].'</p></div>
                    </td>
                    <td><div id="p3">
                         <a href="src/details.php?imageSrc='.$rs[$c].'&src='.$ps[$c].'&name='.$ts[$c].'&des='.$ds[$c].'&author='.$nams[$c].'&countryname='.$cs[$c].'&cn='.$cns[$c].'&cc1='.$ccs[$c].'"><img  name="a" src="'.$ps[$c].'"></a>
                        <h4>'.$ts[$c].'</h4>
                        <p class= "omit">'.$ds[$c].'</p></div>
                    </td>
                </table>
            </td>
        </tr>

        <tr><td>
            <table>
            <td>
                <div id="p4">
                     <a href="src/details.php?imageSrc='.$rs[$d].'&src='.$ps[$d].'&name='.$ts[$d].'&des='.$ds[$d].'&author='.$nams[$d].'&countryname='.$cs[$d].'&cn='.$cns[$d].'&cc1='.$ccs[$d].'"><img  name="a" src="'.$ps[$d].'"></a>
                    <h4>'.$ts[$d].'</h4>
                    <p class= "omit">'.$ds[$d].'</p></div>
            </td>
            <td>
                <div id="p5">
                     <a href="src/details.php?imageSrc='.$rs[$e].'&src='.$ps[$e].'&name='.$ts[$e].'&des='.$ds[$e].'&author='.$nams[$e].'&countryname='.$cs[$e].'&cn='.$cns[$e].'&cc1='.$ccs[$e].'"><img  name="a" src="'.$ps[$e].'"></a>
                    <h4>'.$ts[$e].'</h4>
                    <p class= "omit">'.$ds[$e].'</p></div>
            </td>
            </table>
        </td></tr>
    </table>

    <table>
        <tr>
            <td>
                <div id="p6">
                     <a href="src/details.php?imageSrc='.$rs[$f].'&src='.$ps[$f].'&name='.$ts[$f].'&des='.$ds[$f].'&author='.$nams[$f].'&countryname='.$cs[$f].'&cn='.$cns[$f].'&cc1='.$ccs[$f].'"><img  name="a" src="'.$ps[$f].'"></a>
                    <h4>'.$ts[$f].'</h4>
                    <p class= "omit">'.$ds[$f].'</p></div>
            </td>
            <td>
                <div id="p7">
                     <a href="src/details.php?imageSrc='.$rs[$g].'&src='.$ps[$g].'&name='.$ts[$g].'&des='.$ds[$g].'&author='.$nams[$g].'&countryname='.$cs[$g].'&cn='.$cns[$g].'&cc1='.$ccs[$g].'"><img  name="a" src="'.$ps[$g].'"></a>
                    <h4>'.$ts[$g].'</h4>
                    <p class= "omit">'.$ds[$g].'</p></div>
            </td>
        </tr>
    </table>
    </div>
    ';
        }catch(Exception $e) {}
?>

    <footer>
        <p>© Copyright by GraceShao | 沪ICP备19302010066</p>
        <p>意见箱</p>
        <p>联系我们</p>
        <p>加入我们</p>          
    </footer>

    <aside>
        <input type="button" value="刷新界面" id="renew" onclick="function renew() {
        location.reload(true);
        }
        renew()"><br>
        <a href="#top" target="_self">返回顶部</a>
    </aside>

</body>
</html>