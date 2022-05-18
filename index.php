<?php
include_once 'setting.php';
session_start();
$CONNECT = mysqli_connect(HOST, USER, PASS, DB);


if ($_SESSION['USER_LOGIN_IN'] != 1 and $_COOKIE['user']) {
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `password` = '$_COOKIE[user]'"));
$_SESSION['USER_LOGIN'] = $Row['login'];
$_SESSION['USER_ID'] = $Row['id'];
$_SESSION['USER_NAME'] = $Row['name'];
$_SESSION['USER_REGDATE'] = $Row['regdate'];
$_SESSION['USER_EMAIL'] = $Row['email'];
$_SESSION['USER_COUNTRY'] = UserCountry($Row['country']);
$_SESSION['USER_IMG'] = $Row['img'];
$_SESSION['USER_AVATAR'] = $Row['avatar'];
$_SESSION['USER_GROUP'] = $Row['group'];
$_SESSION['USER_LOGIN_IN'] = 1;
}



session_start();
$Moi = mysqli_query($CONNECT, "SELECT `avatar`, `language` FROM `users` WHERE `id` = '$_SESSION[USER_ID]'");
$My = mysqli_fetch_assoc($Moi);
$_SESSION['MU_AVATAR'] = $My['avatar'];
$_SESSION['MU_LAN'] = $My['language'];


if ($_SESSION['USER_LOGIN_IN'] == 1) include 'resource/language/'.$_SESSION['MU_LAN'].'.php';
else include 'resource/language/ua.php';


if ($_SERVER['REQUEST_URI'] == '/') {
$Page = 'index';
$Module = 'index';
} else {
$URL_Path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$URL_Parts = explode('/', trim($URL_Path, ' /'));
$Page = array_shift($URL_Parts);
$Module = array_shift($URL_Parts);


if (!empty($Module)) {
$Param = array();
for ($i = 0; $i < count($URL_Parts); $i++) {
$Param[$URL_Parts[$i]] = $URL_Parts[++$i];
}
}
}



if ($Page == 'index') include('page/index.php');
else if ($Page == 'account') include('form/account.php');
else if ($Page == 'profile') include('page/profile.php');
else if ($Page == 'restore') include('page/restore.php');
else if ($Page == 'user') include('page/user.php');
else if ($Page == 'search') include('page/search.php');
else if ($Page == 'rusel') include('page/rusel.php');
else if ($Page == 'rusel_') include('page/rusel_.php');
else if ($Page == 'searchuser') include('page/searchuser.php');
else if ($Page == 'sendadmin') include('page/sendadmin.php');
else if ($Page == 'notice') include('page/notice.php');
else if ($Page == 'newspopulars') include('page/newspopulars.php');
else if ($Page == 'rate') include('form/rate.php');
else if ($Page == 'searchcatag') include('page/searchcatag.php');
else if ($Page == 'searchtopic') include('page/searchtopic.php');
else if ($Page == 'addadmin') include('page/addadmin.php');
else if ($Page == 'language') include('page/language.php');
else if ($Page == 'messegs') include('page/messegs.php');



else if ($Page == 'forum') {
if (!$Module or $Page == 'forum' and $Module == 'category' or $Page == 'forum' and $Module == 'main') include('module/forum/main.php');
else if ($Module == 'material') {
include('module/comments/main.php');
include('module/forum/material.php');
}
else if ($Module == 'add') include('module/forum/add.php');
else if ($Module == 'edit') include('module/forum/edit.php');
else if ($Module == 'control') include('module/forum/control.php');
}





else if ($Page == 'skarga') {
if (!$Module or $Page == 'skarga' and $Module == 'category' or $Page == 'skarga' and $Module == 'main') include('module/skarga/main.php');
else if ($Module == 'material') {
include('module/skarga/material.php');
}
else if ($Module == 'control') include('module/skarga/control.php');
}








else if ($Page == 'pm') {
if ($Module == 'send') include('module/pm/send.php');
else if ($Module == 'dialog') include('module/pm/dialog.php');
else if ($Module == 'message') include('module/pm/message.php');
else if ($Module == 'control') include('module/pm/control.php');
}

else if ($Page == 'loads') {
if (!$Module or $Page == 'loads' and $Module == 'category' or $Page == 'loads' and $Module == 'main') include('module/loads/main.php');
else if ($Module == 'material') {
include('module/comments/main.php');
include('module/loads/material.php');
}
else if ($Module == 'addimg') include('module/loads/addimg.php');
else if ($Module == 'addvideo') include('module/loads/addvideo.php');
else if ($Module == 'editimg') include('module/loads/editimg.php');
else if ($Module == 'editvideo') include('module/loads/editvideo.php');
else if ($Module == 'controlimg') include('module/loads/controlimg.php');
else if ($Module == 'controlvideo') include('module/loads/controlvideo.php');

}












else if ($Page == 'forummain') {
if (!$Module or $Page == 'forummain' and $Module == 'category' or $Page == 'forummain' and $Module == 'main') include('module/forummain/main.php');
else if (!$Module or $Page == 'forummain' and $Module == 'category' or $Page == 'forummain' and $Module == 'maintopic') include('module/forummain/maintopic.php');

else if ($Module == 'material') {
include('module/messages/main.php');
include('module/forummain/material.php');
}

else if ($Module == 'add') include('module/forummain/add.php');
else if ($Module == 'addtopic') include('module/forummain/addtopic.php');
else if ($Module == 'edit') include('module/forummain/edit.php');
else if ($Module == 'editcata') include('module/forummain/editcata.php');
else if ($Module == 'control') include('module/forummain/control.php');
else if ($Module == 'controlcat') include('module/forummain/controlcat.php');
else if ($Module == 'download') include('module/forummain/download.php');
else if ($Module == 'rateforum') include('module/forummain/rateforum.php');
else if ($Module == 'rateforum') include('module/forummain/rateforum.php');
else if ($Module == 'sendadminforum') include('module/forummain/sendadminforum.php');
else if ($Module == 'sendadminquery') include('module/forummain/sendadminquery.php');
}






else if ($Page == 'comments') {
if ($Module == 'add') include('module/comments/add.php');
else if ($Module == 'main') include('module/comments/main.php');
else if ($Module == 'enter') include('module/comments/enter.php');
else if ($Module == 'control') include('module/comments/control.php');
else if ($Module == 'update') include('module/comments/update.php');

}



else if ($Page == 'messages') {
if ($Module == 'add') include('module/messages/add.php');
else if ($Module == 'main') include('module/messages/main.php');
else if ($Module == 'enter') include('module/messages/enter.php');
else if ($Module == 'control') include('module/messages/control.php');
else if ($Module == 'update') include('module/messages/update.php');
else if ($Module == 'ratemessages') include('module/messages/ratemessages.php');
else if ($Module == 'download') include('module/messages/download.php');
}




else if ($Page == 'admin') {
	$_SESSION['ADMIN_LOGIN_IN'] = 1;
if ($_SESSION['ADMIN_LOGIN_IN']) {
if (!$Module) include('module/admin/main.php');
else if ($Module == 'query') include('module/admin/query.php');
else if ($Module == 'userspisok') include('module/admin/userspisok.php');
else if ($Module == 'control') include('module/admin/control.php');
} 
} 



function SendMessage($p1, $p2) {
global $CONNECT;

	
	
	$p1 = FormChars($p1, 1);
	$p2 = FormChars($p2);


	if ($p1 == $_SESSION['USER_LOGIN']) MessageSend(1, 'Ви не можете відправити повідомлення самому собі', '/');
	
	$ID = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id` FROM `users` WHERE `login` = '$p1'"));
	
if (!$ID) MessageSend(1, 'Користувач не знайдений', '/');
	
	
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id` FROM `dialog` WHERE `recive` = $ID[id] AND `send` = $_SESSION[USER_ID] OR `recive` = $_SESSION[USER_ID] AND `send` = $ID[id]"));
	
	

if ($Row) {

	$DID = $Row['id'];
	mysqli_query($CONNECT, "UPDATE `dialog` SET `status` = 0, `send` = $_SESSION[USER_ID], `recive` = $ID[id] WHERE `id` = $Row[id]");

	} else {


	mysqli_query($CONNECT, "INSERT INTO `dialog` VALUES ('', 0, $_SESSION[USER_ID], $ID[id])");
	$DID = mysqli_insert_id($CONNECT);
	
	}
	
	
	
	
	mysqli_query($CONNECT, "INSERT INTO `message` VALUES ('', $DID, $_SESSION[USER_ID], '$p2', NOW())");
	
	
	
	}


function SendNotice($p1, $p2, $p3) {
global $CONNECT;
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id` FROM `users` WHERE `login` = '$p1'"));
if (!$Row['id']) echo 'Error';
mysqli_query($CONNECT, "INSERT INTO `notice` VALUES ('', $Row[id], 0, NOW(), '$p2', '$p3')");
}


function ULogin($p1) {
if ($p1 <= 0 and $_SESSION['USER_LOGIN_IN'] != $p1) MessageSend(1, 'Дана сторінка доступна тільки для гостей.', '/');
else if ($_SESSION['USER_LOGIN_IN'] != $p1) MessageSend(1, 'Дана сторінка доступна тільки для користувачів.', '/');
}



function MessageSend($p1, $p2, $p3 = '', $p4 = 1) {
if ($p1 == 1) $p1 = 'Помилка';
else if ($p1 == 2) $p1 = 'Підказка';
else if ($p1 == 3) $p1 = 'Інформація';
$_SESSION['message'] = '<script> alert("'.$p1.': '.$p2.'")</script>';
if ($p4) {
if ($p3) $_SERVER['HTTP_REFERER'] = $p3;
exit(header('Location: '.$_SERVER['HTTP_REFERER']));
}
}


function MessageSend1($p1, $p2, $p3 = '', $p4 = 1) {
if ($p1 == 1) $p1 = 'Помилка';
else if ($p1 == 2) $p1 = 'Підказка';
else if ($p1 == 3) $p1 = 'Інформація';
$_SESSION['message'] = '<div class="MessageBlock"><b>'.$p1.'</b>: '.$p2.'</div>';
if ($p4) {
if ($p3) $_SERVER['HTTP_REFERER'] = $p3;
exit(header('Location: '.$_SERVER['HTTP_REFERER']));
}
}



function RandomString($p1) {
$Char = '0123456789abcdefghijklmnopqrstuvwxyz';
for ($i = 0; $i < $p1; $i ++) $String .= $Char[rand(0, strlen($Char) - 1)];
return $String;
}


function HideEmail($p1) {
$Explode = explode('@', $p1);
return $Explode[0].'@*****';
}


function MessageShow() {
if ($_SESSION['message'])$Message = $_SESSION['message'];
echo $Message;
$_SESSION['message'] = array();
}


function UserCountry($p1) {
if ($p1 == 0) return 'Не вказаний';
else if ($p1 == 1) return 'Україна';
else if ($p1 == 2) return 'Росія';
else if ($p1 == 3) return 'США';
else if ($p1 == 4) return 'Канада';
}


function UserGroup($p1) {
if ($p1 == 0) return 'Користувач';
else if ($p1 == 1) return 'Модератор';
else if ($p1 == 2) return 'Адміністратор';
else if ($p1 == -1) return 'Заблокований';
}

function UAccess($p1) {
if ($_SESSION['USER_GROUP'] < $p1) MessageSend(1, L4, '/');
}


function FormChars($p1, $p2 = 0) {
global $CONNECT;
if ($p2) return mysqli_real_escape_string($CONNECT, $p1);
else return nl2br(htmlspecialchars(trim($p1), ENT_QUOTES), false);
}


function GenPass ($p1, $p2) {
return md5('MRSHIFT'.md5('321'.$p1.'123').md5('678'.$p2.'890'));
}




function Head($p1) {
echo '<!DOCTYPE html><html><head><meta charset="utf-8" /><title>'.$p1.'</title><meta name="keywords" content="" /><meta name="description" content="" />

<link href="/resource/style.css" rel="stylesheet"><link rel="icon" href="/resource/img/favicon.png" type="image/x-icon">





<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="/resource/site.css">
        <link rel="stylesheet" href="/resource/richtext.min.css">
		
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

   <script type="text/javascript" src="/resource/jquery.richtext.js"></script>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
       
   
   
   
   <link rel="stylesheet" href="https://bootstraptema.ru/snippets/calendar/clndr/calendar-redhead.css" />

<script src="https://bootstraptema.ru/snippets/calendar/clndr/calendar.js"></script>
<script src="https://bootstraptema.ru/snippets/calendar/clndr/moment.js"></script>


</head>';


}

function Background($b) {
echo '<video id="myvid" autoplay muted loop><source src="/resource/img/mainlogo/background.mp4" type="video/mp4"/></video>';	
}

function ModuleID($p1) {
if ($p1 == 'forum') return 1;
else if ($p1 == 'loads') return 2;
else MessageSend(1, 'Модуль не знайдено.', '/');
}

function PageSelector($p1, $p2, $p3, $p4 = 9) {

$Page = ceil($p3[0] / $p4); 
if ($Page > 1) { 
echo '<div class="PageSelector">';
for($i = ($p2 - 3); $i < ($Page + 1); $i++) {
if ($i > 0 and $i <= ($p2 + 3)) {
if ($p2 == $i) $Swch = 'SwchItemCur';
else $Swch = 'SwchItem';
echo '<a class="'.$Swch.'", style="color: #fff; text-shadow: 1px 1px 10px #000;" href="'.$p1.$i.'#page">'.$i.'</a>';
}
}
echo '</div>';
}
}


function MiniIMG($p1, $p2, $p3, $p4, $p5 = 50) {

$Scr = imagecreatefromjpeg($p1);
$Size = getimagesize($p1);
$Tmp = imagecreatetruecolor($p3, $p4);
imagecopyresampled($Tmp, $Scr, 0, 0, 0, 0, $p3, $p4, $Size[0], $Size[1]);
imagejpeg($Tmp, $p2, $p5);
imagedestroy($Scr);
imagedestroy($Tmp);
}


function SearchFormTopic() {

echo '
<form method="POST" action="/searchtopic/" class="domain-form">
		<div class="input-group">
    <input type="text" class="form-control" style="height: 35px; color: #5d0c72; margin-top: 4px" name="text" value="'.$_SESSION['SEARCH'].'" placeholder="Що знайти ?" required/>
    <span class="input-group-addon">
        <input type="submit" name="enter" style="background-color: #5d0c72; height: 49px" value="Пошук">
    </span>
</div>
</form>

';
}



function SearchFormForum() {

echo '
<form method="POST" action="/searchcatag/" class="domain-form">
		<div class="input-group">
    <input type="text" class="form-control" style="height: 35px; font-weight: bold; color: #5d0c72; margin-top: 4px" name="text" value="'.$_SESSION['SEARCH'].'" placeholder="Що знайти ?" required/>
    <span class="input-group-addon">
        <input type="submit" name="enter" style="background-color: #5d0c72; height: 54px" value="Пошук">
    </span>
</div>
</form>

';
}
//<button type="submit" name="enter" style="background-color: #9200c5;"><img src="/resource/img/search.png" width="32"></button>

function SearchForm() {

global $Page;
echo '
<form method="POST" action="/search/'.$Page.'" class="domain-form">
		<div class="input-group">
    <input type="text" class="form-control" style="height: 35px; font-weight: bold; color: #5d0c72; margin-top: 4px" name="text" value="'.$_SESSION['SEARCH'].'" placeholder="Що знайти ?" required/>
    <span class="input-group-addon">
        <button type="submit" name="enter" style="background-color: #9200c5;"><img src="/resource/img/search.png" width="32"></button>
    </span>
</div>
</form>

';

//echo '<div class="d"><form method="POST" action="/search/'.$Page.'"><input type="text" name="text" value="'.$_SESSION['SEARCH'].'" placeholder="Що знайти ?" required><input type="submit" name="enter" value="Пошук"></form></div>';	

}

function SearchFormUser() {
global $Page;
echo '<form method="POST" action="/searchuser/'.$Page.'"><input style="width: 700px;" type="text" name="text" value="'.$_SESSION['SEARCH'].'" placeholder="Кого шукаєте ?" required><input type="submit" name="enter" value="Пошук"></form>';	
}




function dirSize($directory) { 
    $size = 0; 
    foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){ 
        $size+=$file->getSize(); 
    } 
    return $size; 
}

$sto = (1024*1024);
session_start();
$Rowsizas = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `domainmemory`"));
$_SESSION['SIZE_ALL'] = $Rowsizas['all_memory']/$sto;
$_SESSION['SIZE_FILE'] = $Rowsizas['file_memory']/$sto;
$_SESSION['SIZE_IMG'] = $Rowsizas['img_memory']/$sto;
$_SESSION['SIZE_VIDEO'] = $Rowsizas['video_memory']/$sto;
$_SESSION['SIZE_WAY'] = $Rowsizas['way'];
$_SESSION['SIZE_IMG_M'] = $Rowsizas['img_m'];
$_SESSION['SIZE_VIDEO_M'] = $Rowsizas['video_m'];
$_SESSION['SIZE_RAR_M'] = $Rowsizas['rar_m'];

$_SESSION['CONST_IMG'] = $Rowsizas['const_img']/$sto;
$_SESSION['CONST_VIDEO'] = $Rowsizas['const_video']/$sto;
$_SESSION['CONST_RAR'] = $Rowsizas['const_rar']/$sto;


$img1 = $_SESSION['SIZE_WAY'].$_SESSION['SIZE_IMG_M'];
$video1 = $_SESSION['SIZE_WAY'].$_SESSION['SIZE_VIDEO_M'];
$file1 = $_SESSION['SIZE_WAY'].$_SESSION['SIZE_RAR_M'];

$img = dirSize($img1);
$video = dirSize($video1);
$file = dirSize($file1);

$_SESSION['ACTIVE_IMG'] = $img/$sto;
$_SESSION['ACTIVE_VIDEO'] = $video/$sto;
$_SESSION['ACTIVE_FILE'] = $file/$sto;


mysqli_query($CONNECT, "UPDATE `domainmemory` SET `file_memory` = $file, `img_memory` = $img, `video_memory` = $video WHERE `id` = 1");


if ($_SESSION['USER_LOGIN_IN']) {
//	$Not = mysqli_fetch_row(mysqli_query($CONNECT, "SELECT `nums` FROM `notice` WHERE `uid` = '$_SESSION[USER_ID]'"));
if ($Page != 'notice') {

$Num1 = mysqli_fetch_row(mysqli_query($CONNECT, "SELECT COUNT(`id`) FROM `notice` WHERE `status` = 0 AND `uid` = '$_SESSION[USER_ID]'"));
session_start();
if ($Num1[0]) $_SESSION['NUM1'] = $Num1[0];
else $_SESSION['NUM1'] = '';

}
}

?>
<!DOCTYPE html>
<html>
<head>
 <title>Redeforum - Головна сторінка</title>
</head>
<body style="background-color: #0e1621;">


<?php
function Menu ($m1 = 'nav-link active', $m2 = 'nav-link active', $m3 = 'nav-link active', $m4 = 'nav-link active') {
session_start();
if ($_SESSION['USER_LOGIN_IN'] != 1) {
	
	
//$Menu = '<a href="/login"><div class="Menu">Вхід</div></a><a href="/restore"><div class="Menu">Відновити пароль</div></a>';

$Menu = '';


}
if ($_SESSION['USER_LOGIN_IN'] == 1){
	if ($_SESSION['USER_GROUP'] == 2) $adm = '<a class="dropdown-item" data-toggle="modal" data-target="#exampleModalCenter"><b>Адмін панель</b></a><hr>';

	//$Menu = '<a href="/profile"><div class="Menu">Профіль</div></a><a href="/pm/dialog"><div class="Menu">Особисті повідомлення</div></a><a href="/admin"><div class="Menu">Адмін панель</div></a><img style="padding: 5px; border-radius: 60px;" src="/resource/avatar/'.$_SESSION['USER_ID'].'.jpg" width="50" height="50" alt="Аватар" align="right">';
$Menu = ' 
		<ul class="navbar-nav ml-auto nav-flex-icons" >
                         <li class="nav-item" style="margin-top:3px">
                            <a href="/skarga" class="nav-link waves-effect waves-light" style="color: #69147f; text-shadow: 1px 1px 10px #000;"><i class="fa fa-user" style="font-size: 110%; "></i></a>
                        </li>
						<li class="nav-item" style="margin-top:3px">
                            <a href="/notice" class="nav-link waves-effect waves-light" style="color: #69147f; text-shadow: 1px 1px 10px #000;">'.$_SESSION['NUM1'].' <i class="fa fa-bell" aria-hidden="true"></i></a>
                        </li>
						<li class="nav-item" style="margin-top:3px">
                            <a href="/pm/dialog" class="nav-link waves-effect waves-light" style="color: #69147f; text-shadow: 1px 1px 10px #000;"> <i class="fa fa-envelope" style="font-size: 110%; "></i></a>
                        </li>
						<li class="nav-item" style="margin-top:3px">
                            <a data-toggle="modal" data-target="#lan" class="nav-link waves-effect waves-light" style="color: #69147f; text-shadow: 1px 1px 10px #000;"><i class="fa fa-language" style="font-size: 110%; "></i></a>
                        </li>
					
                       <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" style="text-shadow: 1px 1px 10px #000; color: #69147f" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="/resource/avatar/'.$_SESSION['MU_AVATAR'].'.jpg" class="rounded-circle z-depth-0" alt="avatar image" height="35"> '.$_SESSION['USER_LOGIN'].' </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4" style="background-color: #69147f; margin-left: -20px">
                                <a class="dropdown-item" href="/profile"><b>Мій профіль</b></a>
								<a class="dropdown-item" href="/profile"><b>Пошук користувачів</b></a>
								<hr>
								
								'.$adm.'
								<!--<a class="dropdown-item" href="#"><b>Українська мова</b></a>
								<a class="dropdown-item" href="#"><b>Англійська мова</b></a>-->
								
								<a class="dropdown-item" href="/account/logout"><b>Вихід</b></a>
                            </div>
					
                        </li>
                    </ul>	
					
					</div>
            
';


}
//echo '<div class="MenuHead"><a href="/"><div class="Menu">Головна</div></a><a href="/forum"><div class="Menu">Форум</div></a><a href="/loads"><div class="Menu">Проекти</div></a>'.$Menu.'</div>';
//echo L1;
echo '
	<nav class="mb-4 navbar navbar-expand-lg navbar-dark" style="background-color: #111b2f; box-shadow: 1px 1px 10px #000;">
                <a class="navbar-brand" style="padding-top: 15px;" href="/"><img src="/resource/img/logom.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-3">
                    <span class="navbar-dark navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent-3";>
                    <ul class="navbar-nav ml-auto">
                       
						<li class="nav-item" style="margin-top:3px">
                            <a class="nav-link" href="/forummain" style="color: #69147f; text-shadow: 1px 1px 10px #000;"><b>'.L1.'</b></a>
                        </li>
						 <li class="nav-item" style="margin-top:3px">
                            <a class="nav-link" href="/forum" style="color: #69147f; text-shadow: 1px 1px 10px #000;"><b>'.L2.'</b></a>
                        </li>
						 <li class="nav-item" style="margin-top:3px">
                            <a class="nav-link" href="/loads" style="color: #69147f; text-shadow: 1px 1px 10px #000;"><b>'.L3.'</b></a>
                        </li>
                        '.$Menu.'</nav>';


}
/* */


?>


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background-color: #162543">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalCenterTitle" style="color: #6c1982">Вхід у панель адміністратора</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
		<form method="post" action="/addadmin">
		<input type="password" class="form-control" id="name-field" style="width: 95%" name="password" placeholder="Пароль" maxlength="15" pattern="[A-Za-z-0-9]{5,15}" title="Не менше 5 і небільше 15 латинській символів або цифр." required>

		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрити</button>
        <input type="submit" name="admin" class="btn btn-md btn-purple" value="Вхід">
		
		</form>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="lan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background-color: #162543">
      <div class="modal-header">
        <h5 class="modal-title" style="color: #6c1982" id="exampleModalLongTitle">Змінити мову</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="/language">
		
		<select size="1" name="lanu" class="form-control form-control-chosen" style="background-color: #81219a; color: #fff; text-shadow: 1px 1px 10px #000; cursor: pointer">
		
		<option value="1">Українська мова</option>
		<option value="2">Англійська мова</option>
		
		
		</select>
		
		
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="lang" class="btn btn-primary" value="Підтвердити">
		</form>
      </div>
    </div>
  </div>
</div>

</body>


<?php
function Footer () {
echo '<footer class="footer"><b>Курсова робота</b></footer>';
}
?>