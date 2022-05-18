<?php
if ($Module == 'logout' and $_SESSION['USER_LOGIN_IN'] == 1) {
	mysqli_query($CONNECT, "UPDATE `users` SET `storis` = 0 WHERE `id` = $_SESSION[USER_ID]");
if ($_COOKIE['user']) {
setcookie('user', '', strtotime('-30 days'), '/');
unset($_COOKIE['user']);
}
session_unset();
exit(header('Location: /'));
}


function CheckRegInfo($p1, $p2) {
global $CONNECT;
if (mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `users` WHERE `login` = '$p1'"))) MessageSend(1, 'Логін '.$_POST['login'].' вже використовується.');
else if (mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `email` FROM `users` WHERE `email` = '$p2'"))) MessageSend(1, 'Mail '.$_POST['email'].' вже використовується.');
}


if ($Module == 'edit' and $_POST['enter']) {
ULogin(1);
$_POST['opassword'] = FormChars($_POST['opassword']);
$_POST['npassword'] = FormChars($_POST['npassword']);
$_POST['name'] = FormChars($_POST['name']);
$_POST['country'] = FormChars($_POST['country']);
if ($_POST['opassword'] or $_POST['npassword']) {
if (!$_POST['opassword']) MessageSend(2, 'Не вказаний старий пароль');
if (!$_POST['npassword']) MessageSend(2, 'Не вказаний новий пароль');
if ($_SESSION['USER_PASSWORD'] != GenPass($_POST['opassword'], $_SESSION['USER_LOGIN'])) MessageSend(2, 'Старий пароль вказаний не вірно.');
$Password = GenPass($_POST['npassword'], $_SESSION['USER_LOGIN']);
mysqli_query($CONNECT, "UPDATE `users`  SET `password` = '$Password' WHERE `id` = $_SESSION[USER_ID]");
$_SESSION['USER_PASSWORD'] = $Password;
}


if ($_POST['name'] != $_SESSION['USER_NAME']) {
mysqli_query($CONNECT, "UPDATE `users`  SET `name` = '$_POST[name]' WHERE `id` = $_SESSION[USER_ID]");
$_SESSION['USER_NAME'] = $_POST['name'];
}


if (UserCountry($_POST['country']) != $_SESSION['USER_COUNTRY']) {
mysqli_query($CONNECT, "UPDATE `users`  SET `country` = $_POST[country] WHERE `id` = $_SESSION[USER_ID]");
$_SESSION['USER_COUNTRY'] = UserCountry($_POST['country']);
}


if ($_FILES['avatar']['tmp_name']) {
if ($_FILES['avatar']['type'] != 'image/jpeg') MessageSend(2, 'Не вірний тип зображення.');
if ($_FILES['avatar']['size'] > 20000) MessageSend(2, 'Розмір зображення великий.');
$Image = imagecreatefromjpeg($_FILES['avatar']['tmp_name']);
$Size = getimagesize($_FILES['avatar']['tmp_name']);
$Tmp = imagecreatetruecolor(120, 120);
imagecopyresampled($Tmp, $Image, 0, 0, 0, 0, 120, 120, $Size[0], $Size[1]);
$Download = 'resource/avatar/'.$_SESSION['USER_ID'];
imagejpeg($Tmp, $Download.'.jpg');
imagedestroy($Image);
imagedestroy($Tmp);
mysqli_query($CONNECT, "UPDATE `users` SET `avatar` = '$_SESSION[USER_ID]' WHERE `id` = '$_SESSION[USER_ID]'");
}

MessageSend(3, 'Дані змінено.');
}




ULogin(0);

if ($Module == 'restore' and !$Param['code'] and substr($_SESSION['RESTORE'], 0, 4) == 'wait') MessageSend(2, 'Ви вже відправили заявку на відновлення пароля. Перевірте ваш E-mail адреса '.HideEmail(substr($_SESSION['RESTORE'], 5)));
if ($Module == 'restore' and $_SESSION['RESTORE'] and substr($_SESSION['RESTORE'], 0, 4) != 'wait') MessageSend(2, 'Ваш пароль раніше вже був змінений. Для входу використовуйте нвоий пароль '.$_SESSION['RESTORE'], '/');

if ($Module == 'restore' and $Param['code']) {
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT `login` FROM `users` WHERE `id` = '.str_replace(md5(substr($_SESSION['RESTORE'], 5)), '', $Param['code'])));
if (!$Row['login']) MessageSend(1, 'Неможливо відновити пароль.', '/');
$Random = RandomString(15);
$_SESSION['RESTORE'] = $Random;
mysqli_query($CONNECT, "UPDATE `users` SET `password` = '".GenPass($Random, $Row['login'])."' WHERE `login` = '$Row[login]'");
MessageSend(2, 'Пароль успішно змінений, для входу використовуйте новий пароль '.$Random, '/');
}


if ($Module == 'restore' and $_POST['enter']) {
$_POST['login'] = FormChars($_POST['login']);
$_POST['captcha'] = FormChars($_POST['captcha']);
if (!$_POST['login'] or !$_POST['captcha']) MessageSend(1, 'Неможливо обробити форму.');
if ($_SESSION['captcha'] != md5($_POST['captcha'])) MessageSend(1, 'Капча введена не вірно.');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id`, `email` FROM `users` WHERE `login` = '$_POST[login]'"));
if (!$Row['email']) MessageSend(1, 'Користувач не знайдений.');
mail($Row['email'], '', 'Посилання для відновлення: http://redeforum/account/restore/code/'.md5($Row['email']).$Row['id'], 'From: fedeforum.com');
$_SESSION['RESTORE'] = 'wait_'.$Row['email'];
MessageSend(2, 'На ваш E-mail адреса '.HideEmail($Row['email']).' відправлено подтержденіе зміни пароля');
}


if ($_POST['regenter']) {
$_POST['login'] = FormChars($_POST['login']);
$_POST['email'] = FormChars($_POST['email']);
$_POST['password'] = GenPass(FormChars($_POST['password']), $_POST['login']);
$_POST['name'] = FormChars($_POST['name']);
$_POST['country'] = FormChars($_POST['country']);
$_POST['captcha'] = FormChars($_POST['captcha']);
if (!$_POST['login'] or !$_POST['email'] or !$_POST['password'] or !$_POST['name'] or $_POST['country'] > 4 or !$_POST['captcha']) MessageSend(1, 'Неможливо обробити форму.');
if ($_SESSION['captcha'] != md5($_POST['captcha'])) MessageSend(1, 'Капча введена не вірно.');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `users` WHERE `login` = '$_POST[login]'"));
if ($Row['login']) MessageSend(1, 'Логін <b>'.$_POST['login'].'</b> вже використовуєте.');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `email` FROM `users` WHERE `email` = '$_POST[email]'"));
if ($Row['email']) MessageSend(1, 'E-Mail <b>'.$_POST['email'].'</b> вже використовуєте.');
mysqli_query($CONNECT, "INSERT INTO `users`  VALUES ('', '$_POST[login]', '$_POST[password]', '$_POST[name]', NOW(), '$_POST[email]', $_POST[country], 0, 0, 'ua', 0)");
$Code = base64_encode($_POST['email']);
mail($_POST['email'], 'Регістація на форум RedeForum', 'Посилання для активації: http://redeforum/account/activate/code/'.substr($Code, -5).substr($Code, 0, -5), 'From: redeforum.com');
MessageSend(3, 'Реєстрація акаунта успішно завершена. На вказаний E-mail адрес '.$_POST['email'].' надіслано листа про підтвердження реєстрації.');
}

if ($Module == 'activate' and $Param['code']) {
$Email = base64_decode(substr($Param['code'], 5).substr($Param['code'], 0, 5));
}
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `email` = '$Email'"));
if ($Row['active']=0) {
MessageSend(1, 'E-mail адрес '.$_SESSION['USER_ACTIVE_EMAIL'].' вже використовуєте.', '/');   
}
else {
if (strpos($Email, '@') !== false) {
mysqli_query($CONNECT, "UPDATE `users`  SET `active` = 1 WHERE `email` = '$Email'");
$_SESSION['USER_ACTIVE_EMAIL'] = $Email;
MessageSend(3, 'E-mail '.$Email.' підтверджений.', '/');
}}

if ($_POST['logenter']) {
$_POST['login'] = FormChars($_POST['login']);
$_POST['password'] = GenPass(FormChars($_POST['password']), $_POST['login']);
$_POST['captcha'] = FormChars($_POST['captcha']);
if (!$_POST['login'] or !$_POST['password'] or !$_POST['captcha']) MessageSend(1, 'Неможливо обробити форму.');
if ($_SESSION['captcha'] != md5($_POST['captcha'])) MessageSend(1, 'Капча введена не вірно.');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `password`, `active` FROM `users` WHERE `login` = '$_POST[login]'"));
if ($Row['password'] != $_POST['password']) MessageSend(1, 'Невірний логін або пароль.');
if ($Row['active'] == 0) MessageSend(1, 'Аккаунт користувача '.$_POST['login'].' не підтверджений.');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `login` = '$_POST[login]'"));

$_SESSION['USER_LOGIN_IN'] = 1;
foreach ($Row as $Key => $Value) $_SESSION['USER_'.strtoupper($Key)] = $Value;
if ($_REQUEST['remember']) setcookie('user', $_POST['password'], strtotime('+30 days'), '/');
exit(header('Location: /'));
}




?>