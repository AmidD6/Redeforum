<?php 
ULogin(1);

if ($_POST['enter'] and $_POST['text']) {
$_POST['text'] = FormChars($_POST['text']);

$MaxId = mysqli_fetch_row(mysqli_query($CONNECT, 'SELECT max(`id`) FROM `messages`'));
if ($MaxId[0] == 0) mysqli_query($CONNECT, 'ALTER TABLE `messages` AUTO_INCREMENT = 1');
$MaxId[0] += 1;





if ($_FILES['video']['type']) {
foreach(glob('catalog/video/forummessages/*', GLOB_ONLYDIR) as $num => $Dir) {
$num_video ++;
$Count = sizeof(glob($Dir.'/*.*'));
if ($Count < 250) {
move_uploaded_file($_FILES['video']['tmp_name'], $Dir.'/'.$MaxId[0].'.mp4');

break;
}
}
if ($_FILES['video']['type'] != 'video/mp4') MessageSend(2, 'Не вірний тип відео.');
if ($_FILES['video']['size'] > 25000000) MessageSend(2, 'Розмір відео великий.');
}
else $num_video = 0;








if ($_FILES['img']['type']){
foreach(glob('catalog/img/forummessages/*', GLOB_ONLYDIR) as $num => $Dir) {
$num_img ++;
$Count = sizeof(glob($Dir.'/*.*'));
if ($Count < 250) {
move_uploaded_file($_FILES['img']['tmp_name'], $Dir.'/'.$MaxId[0].'.jpg');
break;
}
}

//MiniIMG('catalog/img/forummessages/'.$num_img.'/'.$MaxId[0].'.jpg', 'catalog/img/forummessages/mini/'.$num_img.'/'.$MaxId[0].'.jpg', 465, 300);

if ($_FILES['img']['type'] != 'image/jpeg') MessageSend(2, 'Не вірний тип картинки.');
if ($_FILES['img']['size'] > 537000) MessageSend(2, 'Розмір зображення великий.');
}
else $num_img = 0;



if ($_FILES['file']['type']){
foreach(glob('catalog/file/forummessages/*', GLOB_ONLYDIR) as $num => $Dir) {
$num_file ++;
$Count = sizeof(glob($Dir.'/*.*'));
if ($Count < 250) {
move_uploaded_file($_FILES['file']['tmp_name'], $Dir.'/'.$MaxId[0].'.rar');
break;
}
}
if ($_FILES['file']['type'] != 'application/octet-stream') MessageSend(2, 'Не вірний тип файлу.');
if ($_FILES['file']['size'] > 2000000) MessageSend(2, 'Розмір архіва великий.');
}
else $num_file = 0;






$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT * FROM `forumtopic` WHERE `id` ='.$_SESSION['TOPIC_IDCAT']));
if (!$Row['id']) MessageSend(1, 'Матеріал не найден.', '/forummain/material/id/'.$_SESSION['TOPIC_IDCAT']);
if ($_SESSION['USER_GROUP'] == -1) MessageSend(2, 'Адміністратор вас заблокувар. У вас немає можливості довавити коментарій.');
else {
	
	
mysqli_query($CONNECT, "INSERT INTO `messages`  VALUES ('', '', '$_SESSION[catamain]', '$_SESSION[cataid]', '$_SESSION[TOPIC_IDCAT]', '$_SESSION[USER_ID]', '$_SESSION[USER_LOGIN]', '$_POST[text]', NOW(), $num_img, $num_video, $num_file, 0, 0, 0, '', 0, 1, 0, 0, 0, 0, '', '')");
MessageSend(3, 'Коментар доданий.', '/forummain/material/id/'.$_SESSION['TOPIC_IDCAT']);
}
}
?>