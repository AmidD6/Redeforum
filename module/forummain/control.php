<?php
if ($_SESSION['USER_LOGIN'] == $_SESSION['TOPIC_ADDED']) UAccess(0);
else UAccess(1);

 


if ($Param['id'] and $Param['command']) {

if ($Param['command'] == 'delete') {


$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `forumtopic` WHERE `id` = $Param[id]"));
mysqli_query($CONNECT, "DELETE FROM `forumtopic` WHERE `id` = $Param[id]");
mysqli_query($CONNECT, "DELETE FROM `messages` WHERE `topic` = $Param[id]");
if ($Row['video'] != 0) unlink('catalog/video/forummain/'.$Row['video'].'/'.$Param['id'].'.mp4');
if ($Row['file'] != 0) unlink('catalog/file/forummain/'.$Row['file'].'/'.$Param['id'].'.rar');
if ($Row['image'] != 0) unlink('catalog/img/forummain/'.$Row['image'].'/'.$Param['id'].'.jpg');
MessageSend(3, 'Тема видалена.', '/forummain/maintopic/id/'.$_SESSION['cataid']);


} 

else if ($Param['command'] == 'active') {
//SendNotice('FangFoom', 'Ваша тема активована!');
mysqli_query($CONNECT, "UPDATE `forumtopic` SET `active` = 1 WHERE `id` = $Param[id]");
MessageSend(3, 'Тема активована.', '/forummain/material/id/'.$Param['id']);
}

if ($Param['command'] == 'delete3') {
		//SendNotice('FangFoom', 'Ваша тема активована!');
		unlink('catalog/file/forummain/'.$_SESSION['TOPIC_FIL'].'/'.$Param['id'].'.rar');
		mysqli_query($CONNECT, "UPDATE `forumtopic` SET `file` = 0 WHERE `id` = $Param[id]");
		MessageSend(3, 'Архів видалено.', '/forummain/edit/id/'.$Param['id']);
	}
	
if ($Param['command'] == 'delete2') {
		//SendNotice('FangFoom', 'Ваша тема активована!');
		unlink('catalog/video/forummain/'.$_SESSION['TOPIC_VID'].'/'.$Param['id'].'.mp4');
		mysqli_query($CONNECT, "UPDATE `forumtopic` SET `video` = 0 WHERE `id` = $Param[id]");
		MessageSend(3, 'Відео видалено.', '/forummain/edit/id/'.$Param['id']);
	}

if ($Param['command'] == 'delete1') {
		//SendNotice('FangFoom', 'Ваша тема активована!');
		unlink('catalog/img/forummain/'.$_SESSION['TOPIC_IMG'].'/'.$Param['id'].'.jpg');
		mysqli_query($CONNECT, "UPDATE `forumtopic` SET `image` = 0 WHERE `id` = $Param[id]");
		MessageSend(3, 'Зображення видалено.', '/forummain/edit/id/'.$Param['id']);
	}
}
?>