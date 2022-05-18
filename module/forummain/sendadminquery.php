<?php

$Row = mysqli_fetch_array(mysqli_query($CONNECT, "SELECT * FROM `forumtopic` WHERE `id` = '$_SESSION[TOPIC_IDCAT]'"));

if(isset($_POST['button'])){
	
if ($Row['file'] != 0) $imgo = '/catalog/img/forummain/'.$Row['image'].'/'.$Param['id'].'.jpg';
else $img = 0;
if ($Row['file'] != 0) $videoo = '/catalog/video/forummain/'.$Row['video'].'/'.$Param['id'].'.mp4';
else $videoo = 0;
if ($Row['file'] != 0) $fileo = '/forummain/download/id/'.$Param['id'].'';
else $fileo = 0;
	
	mysqli_query($CONNECT, "INSERT INTO `complaint` VALUES ('', '$Row[id_user]', '$Row[added]', 1, '$Row[id]', $img, $videoo, 0, $fileo, '$Row[topic]', '$Row[text]', '$Row[date]', NOW(), '$_SESSION[USER_ID]', '$_SESSION[USER_LOGIN]', 0, 0)");
	MessageSend(2, 'Скарга на'.$Row['added'], '/forummain/sendadminforum');
}

?>