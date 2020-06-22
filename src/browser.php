<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>浏览</title>
    <link rel="stylesheet"  type="text/css" href="../css/nav.css" media="all">
    <link rel="stylesheet"  type="text/css" href="../css/browser.css" media="all">
</head>
<body>
    <header>
        <h1>Travel Images</h1>
        <nav>
            <a href="../index.php" id="home" autofocus><p>首页</p></a>
            <a href="browser.php" autofocus id="browser"><p>浏览</p></a>
            <a href="search.php" autofocus><p>搜索</p></a>
            <div class="box">
                <a id="login_out" href=" <?php if (empty($_SESSION['user'])){echo 'login.html';}?>">登录</a>
                <ul class="box-ul">
                    <?php
                    session_start();
                    if($_SESSION['loggedIn'] == 0){
                        echo '<script>
                alert(\'欲看更多，请先登录\');
                window.location.href = "login.html";
                </script>';
                    }
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

    <aside>
    <form class="part" action="browserAction1.php" method="post">
        <h3 id="small_title">搜索标题</h3><br>
        <input type="text" name="bThing" placeholder="搜索景点" id="search">
        <input type="submit" value="🔍" id="search_check">
    </form>
    </div>
    <div class="part">
        <h3 id="small_title">热门内容</h3>
        <ul>
            <li><a href="browserAction4.php?hot=scenery" >风景</a></li>
            <li><a href="browserAction4.php?hot=city" >城市</a></li>
            <li><a href="browserAction4.php?hot=people">人文</a></li>
            <li><a href="browserAction4.php?hot=animal" >动物</a></li>
            <li><a href="browserAction4.php?hot=building">建筑</a></li>
        </ul>
    </div>
    <div class="part">
        <h3 id="small_title">热门国家</h3>
        <ul>
            <li><a href="browserAction2.php?hot=DE" >德国</a></li>
            <li><a href="browserAction2.php?hot=US" >美国</a></li>
            <li><a href="browserAction2.php?hot=CA">加拿大</a></li>
            <li><a href="browserAction2.php?hot=BS" >英国</a></li>
            <li><a href="browserAction2.php?hot=IT" >意大利</a></li>
        </ul>
    </div>
    <div class="part">
        <h3 id="small_title">热门城市</h3>
        <ul>
            <li><a href="browserAction3.php?hot=3164603" >威尼斯</a></li>
            <li><a href="browserAction3.php?hot=3164527" >维罗纳</a></li>
            <li><a href="browserAction3.php?hot=4167147" >奥兰多</a></li>
            <li><a href="browserAction3.php?hot=3169070" >罗马</a></li>
            <li><a href="browserAction3.php?hot=264371" >雅典</a></li>
        </ul>
    </div>
    
    </aside>

    <div id="main_part">
        <div class="part">
        <h3 id="small_title">筛选</h3>
        <form name="form1" action="browserAction.php" method="post">
            <select name="type">
                <option value="0">选择内容</option>    
                <option value="scenery">Scenery</option>
                <option value="people">People</option>
                <option value="wonder">Wonder</option>
                <option value="building">Building</option>
                <option value="animal">Animal</option>
                <option value="city">City</option>
                <option value="other">Other</option>

            </select>
            <select name="country" onChange="set_city(this, this.form.city);">    
                <option value="0">选择国家</option>    
                <option value="中国">中国</option>    
                <option value="意大利">意大利</option>
                <option value="日本">日本</option>
                <option value="美国">美国</option>
            </select>    
            <select   name="city" id="citys">    
                <option value="0">选择城市</option>   
            </select>
            <input type="submit" id="start_select" value= "搜索" >
        </form>
        <script>
            cities = new Object();
            cities['中国']=new Array('Shanghai','Kunming','Beijing','Wuhan');
            cities['意大利']=new Array('Roma','Milan','Venice');
            cities['日本']=new Array('Tokyo', 'Osaka', 'Yokohama', 'Okinawa');
            cities['美国']=new Array('New York','San Francisco', 'Washington'); 
            function set_city(country, city){    
                var pv;
                var i, ii;     
                pv=country.value;
                city.length=1;     
                if(pv=='0') return;   
                if(typeof(cities[pv])=='undefined') return;     
                for(i=0; i<cities[pv].length; i++)    {       
                    ii = i+1;       
                    city.options[ii] = new Option();       
                    city.options[ii].text = cities[pv][i];
                    city.options[ii].value = cities[pv][i];    } }
        </script>
        </div>

        <?php
        error_reporting(0);
        $servername ="localhost";
        $db_username="root";
        $db_password="Grace1218";
        $db_name="travel";
        $conn=new mysqli($servername,$db_username,$db_password,$db_name);

        if (!isset($_GET['page'])){
            $_GET['page']=1;
        }
        if (isset($_SESSION['chooseType'])){
            if ($_SESSION['chooseType']==1){
                $bCityCode = $_SESSION['bCityCode'];
                $bType =$_SESSION['bType'];
                $sql2 = "SELECT * FROM travelimage WHERE (CityCode='$bCityCode') AND (Content = '$bType')";
            }
            else if ($_SESSION['chooseType']==2) {
                $bThing = $_SESSION['bThing'];
                $sql2 = "SELECT * FROM travelimage WHERE Title LIKE '%" . $bThing . "%'";          //模糊查询，查标题中含bthing字符的

                }

            else if ($_SESSION['chooseType']==3) {
                //国家
                if ($_SESSION['chooseType2']==1){
                    $hot=$_SESSION['hot'];
                    $sql2 = "SELECT * FROM travelimage WHERE Country_RegionCodeIso='$hot'";
                }
                //城市
                else if($_SESSION['chooseType2']==2){
                    $hot2= $_SESSION['hot2'];
                    $sql2 = "SELECT * FROM travelimage WHERE CityCode='$hot2'";
                }
                //内容
                else if($_SESSION['chooseType2']==3){
                    $hot3=$_SESSION['hot3'];
                    $sql2 = "SELECT * FROM travelimage WHERE Content='$hot3'";
                }
            }
                $value = $conn->query($sql2)->num_rows;

                    if ($_GET['page'] == 1) {
                        $l = 1;
                    } else if ($_GET['page'] == 2) {
                        $l = 10;
                    } else if ($_GET['page'] == 3) {
                        $l = 19;
                    } else if ($_GET['page'] == 4) {
                        $l = 28;
                    } else if ($_GET['page'] == 5) {
                        $l = 37;
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
                        if($_SESSION['chooseType']==1){
                            $sql0 = "SELECT * FROM travelimage WHERE (CityCode='$bCityCode') AND (Content = '$bType') limit  $j,1";
                        }
                        else if ($_SESSION['chooseType']==2) {
                            $sql0 = "SELECT * FROM travelimage WHERE Title LIKE '%" . $bThing . "%' limit  $j,1";
                        }
                        else if ($_SESSION['chooseType']==3) {
                            if ($_SESSION['chooseType2']==1){
                                $sql0 = "SELECT * FROM travelimage WHERE Country_RegionCodeISO='$hot' limit  $j,1";
                            }
                            else if($_SESSION['chooseType2']==2){
                                $sql0 = "SELECT * FROM travelimage WHERE CityCode='$hot2' limit  $j,1";
                            }
                            else if($_SESSION['chooseType2']==3){
                                $sql0 = "SELECT * FROM travelimage WHERE Content='$hot3' limit  $j,1";
                            }
                        }

                            $query=mysqli_query($conn,$sql0);
                            $row=mysqli_fetch_assoc($query);
                            $h="../images/small/".$row["PATH"];
                            $t=$row["Title"];
                            $d=$row["Description"];
                            $n=$row["UID"]-1;
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
                    for($i=$value; $i < 200; $i++){
                        $ps[$i] = "../images/none.jpg";  //剩余的填图”空“
                    }

            ?>

            <?php
            echo ' <div class="part">
        <table id="pics">
            <tr>
                <td><a class="pic_a" href="details.php?imageSrc='.$rs[($_GET['page'] - 1) * 9].'&src='.$ps[($_GET['page'] - 1) * 9].'&name='.$ts[($_GET['page'] - 1) * 9].'&des='.$ds[($_GET['page'] - 1) * 9].'&author='.$nams[($_GET['page'] - 1) * 9].'&countryname='.$cs[($_GET['page'] - 1) * 9].'&cn='.$cns[($_GET['page'] - 1) * 9].'&cc1='.$ccs[($_GET['page'] - 1) * 9].'">
                <img src="'.$ps[($_GET['page'] - 1) * 9].'" class="pic_img"></a></td>
                <td><a class="pic_a" href="details.php?imageSrc='.$rs[($_GET['page'] - 1) * 9 + 1].'&src='.$ps[($_GET['page'] - 1) * 9 + 1].'&name='.$ts[($_GET['page'] - 1) * 9 + 1].'&des='.$ds[($_GET['page'] - 1) * 9 + 1].'&author='.$nams[($_GET['page'] - 1) * 9 + 1].'&countryname='.$cs[($_GET['page'] - 1) * 9 + 1].'&cn='.$cns[($_GET['page'] - 1) * 9 + 1].'&cc1='.$ccs[($_GET['page'] - 1) * 9 + 1].'">
                <img src="' . $ps[($_GET['page'] - 1) * 9 + 1] . '" class="pic_img"></a></td>
                <td><a class="pic_a" href="details.php?imageSrc='.$rs[($_GET['page'] - 1) * 9 + 2].'&src='.$ps[($_GET['page'] - 1) * 9 + 2].'&name='.$ts[($_GET['page'] - 1) * 9 + 2].'&des='.$ds[($_GET['page'] - 1) * 9 + 2].'&author='.$nams[($_GET['page'] - 1) * 9 + 2].'&countryname='.$cs[($_GET['page'] - 1) * 9 + 2].'&cn='.$cns[($_GET['page'] - 1) * 9 + 2].'&cc1='.$ccs[($_GET['page'] - 1) * 9 + 2].'">
                <img src="' . $ps[($_GET['page'] - 1) * 9 + 2] . '" class="pic_img"></a></td>
            </tr>
            <tr>
                <td><a class="pic_a" href="details.php?imageSrc='.$rs[($_GET['page'] - 1) * 9 + 3].'&src='.$ps[($_GET['page'] - 1) * 9 + 3].'&name='.$ts[($_GET['page'] - 1) * 9 + 3].'&des='.$ds[($_GET['page'] - 1) * 9 + 3].'&author='.$nams[($_GET['page'] - 1) * 9 + 3].'&countryname='.$cs[($_GET['page'] - 1) * 9 + 3].'&cn='.$cns[($_GET['page'] - 1) * 9 + 3].'&cc1='.$ccs[($_GET['page'] - 1) * 9 + 3].'">
                <img src="' . $ps[($_GET['page'] - 1) * 9 + 3] . '" class="pic_img"></a></td>
                <td><a class="pic_a" href="details.php?imageSrc='.$rs[($_GET['page'] - 1) * 9 + 4].'&src='.$ps[($_GET['page'] - 1) * 9 + 4].'&name='.$ts[($_GET['page'] - 1) * 9 + 4].'&des='.$ds[($_GET['page'] - 1) * 9 + 4].'&author='.$nams[($_GET['page'] - 1) * 9 + 4].'&countryname='.$cs[($_GET['page'] - 1) * 9 + 4].'&cn='.$cns[($_GET['page'] - 1) * 9 + 4].'&cc1='.$ccs[($_GET['page'] - 1) * 9 + 4].'">
                <img src="' . $ps[($_GET['page'] - 1) * 9 + 4] . '" class="pic_img"></a></td>
                <td><a class="pic_a" href="details.php?imageSrc='.$rs[($_GET['page'] - 1) * 9 + 5].'&src='.$ps[($_GET['page'] - 1) * 9 + 5].'&name='.$ts[($_GET['page'] - 1) * 9 + 5].'&des='.$ds[($_GET['page'] - 1) * 9 + 5].'&author='.$nams[($_GET['page'] - 1) * 9 + 5].'&countryname='.$cs[($_GET['page'] - 1) * 9 + 5].'&cn='.$cns[($_GET['page'] - 1) * 9 + 5].'&cc1='.$ccs[($_GET['page'] - 1) * 9 + 5].'">
                <img src="' . $ps[($_GET['page'] - 1) * 9 + 5] . '" class="pic_img"></a></td>
            </tr>
            <tr>
                <td><a class="pic_a" href="details.php?imageSrc='.$rs[($_GET['page'] - 1) * 9 + 6].'&src='.$ps[($_GET['page'] - 1) * 9 + 6].'&name='.$ts[($_GET['page'] - 1) * 9 + 6].'&des='.$ds[($_GET['page'] - 1) * 9 + 6].'&author='.$nams[($_GET['page'] - 1) * 9 + 6].'&countryname='.$cs[($_GET['page'] - 1) * 9 + 6].'&cn='.$cns[($_GET['page'] - 1) * 9 + 6].'&cc1='.$ccs[($_GET['page'] - 1) * 9 + 6].'">
                <img src="' . $ps[($_GET['page'] - 1) * 9 + 6] . '" class="pic_img"></a></td>
                <td><a class="pic_a" href="details.php?imageSrc='.$rs[($_GET['page'] - 1) * 9 + 7].'&src='.$ps[($_GET['page'] - 1) * 9 + 7].'&name='.$ts[($_GET['page'] - 1) * 9 + 7].'&des='.$ds[($_GET['page'] - 1) * 9 + 7].'&author='.$nams[($_GET['page'] - 1) * 9 + 7].'&countryname='.$cs[($_GET['page'] - 1) * 9 + 7].'&cn='.$cns[($_GET['page'] - 1) * 9 + 7].'&cc1='.$ccs[($_GET['page'] - 1) * 9 + 7].'">
                <img src="' . $ps[($_GET['page'] - 1) * 9 + 7] . '" class="pic_img"></a></td>
                <td><a class="pic_a" href="details.php?imageSrc='.$rs[($_GET['page'] - 1) * 9 + 8].'&src='.$ps[($_GET['page'] - 1) * 9 + 8].'&name='.$ts[($_GET['page'] - 1) * 9 + 8].'&des='.$ds[($_GET['page'] - 1) * 9 + 8].'&author='.$nams[($_GET['page'] - 1) * 9 + 8].'&countryname='.$cs[($_GET['page'] - 1) * 9 + 8].'&cn='.$cns[($_GET['page'] - 1) * 9 + 8].'&cc1='.$ccs[($_GET['page'] - 1) * 9 + 8].'">
                <img src="' . $ps[($_GET['page'] - 1) * 9 + 8] . '" class="pic_img"></a></td>
            </tr>
        </table>
          ';
            }
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
        </ul>
        </div>
    </div>


    <footer>
        <p>© Copyright by GraceShao | 沪ICP备19302010066</p>
        <p>意见箱</p>
        <p>联系我们</p>
        <p>加入我们</p>          
    </footer>
    <script>
        window.onload = function () {
            for(var i =0; i < document.getElementsByClassName("pic_img").length; i++){
                if(document.getElementsByClassName("pic_img")[i].src === 'http://localhost/images/none.jpg'){
                    document.getElementsByClassName("pic_a")[i].href = "#";}
            }
        }
    </script>
</body>
</html>