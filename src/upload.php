<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>上传</title>
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
                <a id="login_out" href=" <?php if (empty($_SESSION['user'])){echo 'login.html';}?>">登录</a>
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
        <form action="uploadAction.php" method="post">
            <div id="imgPreview">
                <div class="yanzRight">
                    <input id="evidence" onchange="uploadImg(this,'preview')" type="file" name="file" required>
                    <span class="dui" id="imgOrder_dui" style="display: none;"></span>
                </div>
                <div id="preview">
                    <input id="imghead5" type="text" value="未显示图片" disabled>
                </div>
            </div>

                <select name="type"  class="content">
                    <option value="0">选择内容</option>
                    <option value="Scenery">Scenery</option>
                    <option value="People">People</option>
                    <option value="Wonder">Wonder</option>
                    <option value="Building">Building</option>
                    <option value="Building">Animal</option>
                    <option value="Building">City</option>
                    <option value="Building">Other</option>
                </select>

            <div id="right">
                <p>图片标题
                    <input type="text"  class="small_description" name="title" required>
                </p>
                <p>拍摄国家
                    <input type="text"  class="small_description" name="country" required>
                </p>
                <p>拍摄城市
                    <input type="text"  class="small_description" name="city" required>
                </p>

                <p>
                图片描述
                <input type="text" id="description" name="des"  required>
            </p>
            </div>
            <input type="submit" id="提交" name="continue" value="上传">
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