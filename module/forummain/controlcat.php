<?php
if ($_SESSION['USER_LOGIN'] == $_SESSION['TOPIC_ADDED']) UAccess(0);
else UAccess(1);

 


if ($Param['id'] and $Param['command']) {

if ($Param['command'] == 'active') {
	
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `catagoryforum` WHERE `id` = $Param[id]"));
//$User = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `id` = $Row[id_user]"));
//SendNotice('FangFoom', 'Ваша тема активована!');
mysqli_query($CONNECT, "UPDATE `catagoryforum` SET `active` = 1 WHERE `id` = $Param[id]");
SendNotice($Row['author'], 'Ваш каталог '.$Row['name'].' активований', '/forummain/maintopic/id/'.$Param['id']);
MessageSend(3, 'Каталог '.$Row['name'].' активований.', '/forummain/maintopic/id/'.$Param['id']);
}

else if ($Param['command'] == 'delete') {
	
$Rowtopic = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `forumtopic` WHERE `id_cat` = $Param[id]"));
$Rowcomments = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `messages` WHERE `catalog` = $Param[id]"));

if ($Rowcomments['video'] != 0) unlink('catalog/video/forummessages/'.$Rowcomments['video'].'/'.$Rowcomments['id'].'.mp4');
if ($Rowcomments['file'] != 0) unlink('catalog/file/forummessages/'.$Rowcomments['file'].'/'.$Rowcomments['id'].'.rar');
if ($Rowcomments['image'] != 0) unlink('catalog/img/forummessages/'.$Rowcomments['image'].'/'.$Rowcomments['id'].'.jpg');

mysqli_query($CONNECT, "DELETE FROM `messages` WHERE `catalog` = $Param[id]");

if ($Rowtopic['video'] != 0) unlink('catalog/video/forummain/'.$Rowtopic['video'].'/'.$Rowtopic['id'].'.mp4');
if ($Rowtopic['file'] != 0) unlink('catalog/file/forummain/'.$Rowtopic['file'].'/'.$Rowtopic['id'].'.rar');
if ($Rowtopic['image'] != 0) unlink('catalog/img/forummain/'.$Rowtopic['image'].'/'.$Rowtopic['id'].'.jpg');


mysqli_query($CONNECT, "DELETE FROM `forumtopic` WHERE `id_cat` = $Param[id]");

$User = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT * FROM `users`'));

mysqli_query($CONNECT, "DELETE FROM `catagoryforum` WHERE `id` = $Param[id]");


SendNotice();

MessageSend(3, 'Каталог був видалений.', '/forummain');

}

}
?>