<?php
session_start();
$_SESSION['bCountry'] = $_POST['country'];
$_SESSION['bCity'] = $_POST['city'];
$_SESSION['bType'] = $_POST['type'];
$_SESSION['chooseType'] = 1;
$_SESSION['bCityCode'] = 1;
if ($_SESSION['bCountry'] == '中国') {
    if ($_SESSION['bCity'] == 'Beijing') {
        $_SESSION['bCityCode'] = '1816670';
    }
    else if ($_SESSION['bCity'] == 'Kunming') {
        $_SESSION['bCityCode'] = '1804651';
    }
    else if ($_SESSION['bCity'] == 'Wuhan') {
        $_SESSION['bCityCode'] = '1806951';
    }
    else if ($_SESSION['bCity'] == 'Shanghai') {
        $_SESSION['bCityCode'] = '1796236';
    }
}
else if ($_SESSION['bCountry'] == '日本') {
    if ($_SESSION['bCity'] == 'Okinawa') {
        $_SESSION['bCityCode'] = '1894616';
    }
    else if ($_SESSION['bCity'] == 'Osaka') {
        $_SESSION['bCityCode'] = '1853909';
    }
    else if ($_SESSION['bCity'] == 'Tokyo') {
        $_SESSION['bCityCode'] = '1850147';
    }
    else if ($_SESSION['bCity'] == 'Yokohama') {
        $_SESSION['bCityCode'] = '1848354';
    }
}
else if ($_SESSION['bCountry'] == '意大利') {
    if ($_SESSION['bCity'] == 'Venice') {
        $_SESSION['bCityCode'] = '3164603';
    }
    else if ($_SESSION['bCity'] == 'Milan') {
        $_SESSION['bCityCode'] = '3173435';
    }
    else if ($_SESSION['bCity'] == 'Roma') {
        $_SESSION['bCityCode'] = '3169070';
    }
}
else if ($_SESSION['bCountry'] == '美国') {
    if ($_SESSION['bCity'] == 'New York') {
        $_SESSION['bCityCode'] = '5128581';
    }
    else if ($_SESSION['bCity'] == 'San Francisco') {
        $_SESSION['bCityCode'] = '4166066';
    }
    else if ($_SESSION['bCity'] == 'Washington') {
        $_SESSION['bCityCode'] = '4166673';
    }
}
header("location: browser.php");