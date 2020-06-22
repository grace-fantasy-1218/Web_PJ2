<?php
header("content-type:text/html;charset=utf8");
$servername = "localhost";
$db_username = "root";
$db_password = "Grace1218";
$db_name = "travel";
$conn = new mysqli($servername, $db_username, $db_password, $db_name);
$name = $_POST['user'];
$pass = $_POST['pass'];
$email = $_POST['email'];
$repass = $_POST['repass'];
$sql = "SELECT UserName From traveluser WHERE (UserName='$name')";
$query = mysqli_query($conn, $sql);
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo '<script>
    alert(\'用户名重复，请重试\');
    window.location.href = "register.html";
    </script>';
} else if($pass != $repass){
    echo '<script>
    alert(\'两次密码不一致，请重试\');
    window.location.href = "register.html";
    </script>';
}
else if(is_numeric($pass)){  //纯数字密码不可
    echo '<script>
    alert(\'密码太简单，请重试\');
    window.location.href = "register.html";
    </script>';
}
else {
    $sql1 = "INSERT INTO traveluser(Email,UserName,Pass) VALUES ('$email','$name','$pass')";
    if (mysqli_query($conn, $sql1)) {
        echo '<script>
    alert(\'注册成功，请登录\');
    window.location.href = "login.html";
    </script>';
    } else {
        echo '<script>
    alert(\'数据库连接失败，请检查后重试\');
    window.location.href = "register.html";
    </script>';
    }
}
