<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改</title>
    <link rel="stylesheet"  type="text/css" href="../css/nav.css" media="all">
    <link rel="stylesheet"  type="text/css" href="../css/upload.css" media="all">
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

<div id="main">
    <h2>上传</h2>
    <form action="alterAction.php" method="post">
        <div id="imgPreview">
            <div class="yanzRight">
                <input id="evidence" onchange="uploadImg(this,'preview')" type="file" required>
                <span class="dui" id="imgOrder_dui" style="display: none;"></span>
            </div>
            <div id="preview">
                <?php
                $src=$_GET['src'];
                echo '<img  id="img" class="image2" src="'.$src.'">';
                ?>
            </div>
        </div>

        <form name="form1" action="#" method="post" id="form1">
            <select name="type">
                <option value="0">选择内容</option>
                <option value="Scenery">Scenery</option>
                <option value="People">People</option>
                <option value="Wonder">Wonder</option>
                <option value="Building">Building</option>
                <option value="Building">Animal</option>
                <option value="Building">City</option>
                <option value="Building">Other</option>
            </select>
            <select name="country" id= "double_choice" onChange="set_city(this, this.form.city);">
                <option value="0">选择国家</option>
                <option value="中国">中国</option>
                <option value="意大利">意大利</option>
                <option value="日本">日本</option>
                <option value="美国">美国</option>
            </select>
            <select   name="city" id="citys">
                <option value="0">选择城市</option>
            </select>
        </form>
        <div id="right">
            <p>图片标题
                <input type="text" id="small_description" required>
                <?php
                $title=$_GET['title'];
                echo '<input type="text" name="title" value="'.$title.'" required>';
                ?>
            </p>
            <p>
                图片描述
                <input type="text" id="description" required>
                <?php
                $d=$_GET['des'];
                echo '<textarea style="resize: none;width:440px;height:180px;" name="des"  required>'.$d.'</textarea>';
                ?>
            </p>
        </div>

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
                    city.options[ii].text = cities[pv][i];       city.options[ii].value = cities[pv][i];    } }
        </script>
        <input type="button" id="提交" name="continue" value="上传" >
</div>
</form>
</div>
<script>
    function uploadImg(file,imgNum){
        var widthImg = 630;
        var heightImg = 430;
        var div = document.getElementById(imgNum);
        if (file.files && file.files[0]){
            div.innerHTML ='<img id="upImg">'; //生成图片
            var img = document.getElementById('upImg'); //获得用户上传的图片节点
            img.onload = function(){
                img.width = widthImg;
                img.height = heightImg;
            }
            var reader = new FileReader(); //判断图片是否加载完毕
            reader.onload = function(evt){
                if(reader.readyState === 2){ //加载完毕后赋值
                    img.src = evt.target.result;
                }
            }
            reader.readAsDataURL(file.files[0]);
        }
    }
</script>
<footer>
    <p>备案号：19302010066</p>
    <p>意见箱</p>
    <p>联系我们</p>
    <p>加入我们</p>
</footer>
</body>