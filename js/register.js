function pass() {
    alert("1");
    var pwd1 = document.getElementById("pass").value;
    if (pwd1.length<8){
        document.getElementById("tishi2").innerHTML="<font color='red'>弱密码</font>"
        document.getElementById("submit").disabled = true;
    }else {
        document.getElementById("tishi2").innerHTML="<font color='green'></font>"
        document.getElementById("submit").disabled =false;
    }
}

function testName() {
    var user=document.getElementById("user").value;
    var b=/^[a-zA-Z0-9\u4e00-\u9fa5\_]+$/;
    if (!b.test(user)){
        document.getElementById("tishi1").innerHTML="<font color='red'>用户名非法</font>"
        document.getElementById("submit").disabled = true;
    }else {
        document.getElementById("tishi1").innerHTML="<font color='green'>用户名格式正确</font>"
        document.getElementById("submit").disabled = false;
    }
}