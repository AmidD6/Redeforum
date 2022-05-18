<?php
$Rows = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT * FROM `messages` WHERE `id` = '.$Param['id']));
session_start();
$_SESSION['regName'] = $Param['id'];
$_SESSION['UCOMM_TEXT'] = $Rows['text'];
$_SESSION['UCOMM_ADDED'] = $Rows['added'];
$_SESSION['UCOMM_AD'] = $Rows['added'];
$_SESSION['UCOMM_ID'] = $Rows['id'];
$_SESSION['UCOMM_DATE'] = $Rows['date'];
$_SESSION['UCOMM_IMG'] = $Rows['image'];
$_SESSION['UCOMM_VIDEO'] = $Rows['video'];
$_SESSION['UCOMM_FILE'] = $Rows['file'];
$_SESSION['UCOMM_CATAG'] = $Rows['catagory'];
$_SESSION['UCOMM_CATAL'] = $Rows['catalog'];
$_SESSION['UCOMM_TOPIC'] = $Rows['topic'];

$a = $_SESSION['TOPIC_IDCAT'];


$Rowss = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT * FROM `ucomments` WHERE `id_uc` = '.$Param['id']));

if ($Param['action'] == 'delete') {

mysqli_query($CONNECT, "DELETE FROM `messages` WHERE `id` = $Param[id]");

if ($Rows['video'] != 0) unlink('catalog/video/forummessages/'.$Rows['video'].'/'.$Param['id'].'.mp4');
if ($Rows['file'] != 0) unlink('catalog/file/forummessages/'.$Rows['file'].'/'.$Param['id'].'.rar');
if ($Rows['image'] != 0) unlink('catalog/img/forummessages/'.$Rows['image'].'/'.$Param['id'].'.jpg');

MessageSend(3, 'Відповідь видалено.', '/forummain/material/id/'.$a);
} 


else if ($Param['action'] == 'editm') {
$_SESSION['COMMENTS_EDITM'] = $Param['id'];
mysqli_query($CONNECT, "INSERT INTO `ucomments`  VALUES ('$Param[id]', 0, '$Rows[added]', '$Rows[date]', '$Rows[text]', '$Rows[img]', '$Rows[video]', '$Rows[file]' )");
$Param['id'];

exit(header('location: '.$_SERVER['HTTP_REFERER']));

} 



?>