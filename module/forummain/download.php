<?php
if (!$Param['id']) MessageSend(1, 'Архів не вказано', '/forummain/maintopic/id/'.$_SESSION['cataid']);
$Param['id'] += 0;
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `file` FROM `forumtopic` WHERE `id` = $Param[id]"));
if (!$Row['file']) MessageSend(1, 'Архів не знайдено.', '/forummain/maintopic/id/'.$_SESSION['cataid']);
mysqli_query($CONNECT, "UPDATE `forumtopic` SET `download` = `download` + 1 WHERE `id` = $Param[id]");
header('location: /catalog/file/forummain/'.$Row['file'].'/'.$Param['id'].'.rar');
?>