<?php
UAccess(2);

if ($Param['id'] and $Param['command']) {

if ($Param['command'] == 'delete') {

mysqli_query($CONNECT, "DELETE FROM `forum` WHERE `id` = $Param[id]");
mysqli_query($CONNECT, "DELETE FROM `comments` WHERE `material` = $Param[id] AND `module` = 1");
MessageSend(3, 'Теми видалена.', '/forum');

} else if ($Param['command'] == 'active') {
//SendNotice('FangFoom', 'Ваша тема активована!');
mysqli_query($CONNECT, "UPDATE `forum` SET `active` = 1 WHERE `id` = $Param[id]");
MessageSend(3, 'Тема активована.', '/forum/material/id/'.$Param['id']);
}


}
?>