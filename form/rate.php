<?php
ULogin(1);


if ($Module != 'forum' and $Module != 'loads') MessageSend(1, 'Модуль вказано не вірно.', '/');
$Param['id'] += 0;

$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `rateusers` FROM `$Module` WHERE `id` = $Param[id]"));

if (!isset($Row['rateusers'])) MessageSend(1, 'Проект не знайден.', '/');

if (in_array($_SESSION['USER_ID'], explode(',', $Row['rateusers']))) MessageSend(2, 'Ви вже оцінили цей проект.');


mysqli_query($CONNECT, "UPDATE `$Module` SET `rate` = `rate` + 1, `rateusers` = CONCAT(rateusers, ',$_SESSION[USER_ID]') WHERE `id` = $Param[id]");




MessageSend(3, 'Ваша оцінка прийнята. Дякуємо.');

?>