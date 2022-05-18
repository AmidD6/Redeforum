<?php
UAccess(2);

if ($Param['id'] and $Param['command']) {

if ($Param['command'] == 'delete') {
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `dfile`, `dimg`, `dvideo`, `dpostimg` FROM `loads` WHERE `id` = $Param[id]"));
mysqli_query($CONNECT, "DELETE FROM `loads` WHERE `id` = $Param[id] AND `img_or_video` = 2");
mysqli_query($CONNECT, "DELETE FROM `comments` WHERE `material` = $Param[id] AND `module` = 2");
unlink('catalog/video/loads/'.$Row['dvideo'].'/'.$Param['id'].'.mp4');
if ($Row['dfile'] != 0) unlink('catalog/file/loads/'.$Row['dfile'].'/'.$Param['id'].'.rar');
MessageSend(3, 'Материал удален.', '/loads');

} else if ($Param['command'] == 'active') {
mysqli_query($CONNECT, "UPDATE `loads` SET `active` = 1 WHERE `id` = $Param[id]");
MessageSend(3, 'Матеріал активований.', '/loads/material/id/'.$Param['id']);
}


}
?>