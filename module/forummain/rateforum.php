<?php
ULogin(1);
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `rateusersplus`, `rateusersminus` FROM `messages` WHERE `id` = $Param[id]"));

if ($Param['rate'] == 'plus') {



if (in_array($_SESSION['USER_ID'], explode(',', $Row['rateusersplus'])) or in_array($_SESSION['USER_ID'], explode(',', $Row['rateusersminus']))) MessageSend(2, 'Ви вже оцінили цю відповідь.');
if (!in_array($_SESSION['USER_ID'], explode(',', $Row['rateusersplus'])) and !in_array($_SESSION['USER_ID'], explode(',', $Row['rateusersminus']))) {

mysqli_query($CONNECT, "UPDATE `messages` SET `rate` = `rate` + 1, `rateusersplus` = CONCAT(rateusersplus, ',$_SESSION[USER_ID]') WHERE `id` = $Param[id]");

MessageSend(3, 'Ваша оцінка прийнята. Дякуємо =)');}

}

else if ($Param['rate'] == 'minus') {
	

if (in_array($_SESSION['USER_ID'], explode(',', $Row['rateusersplus'])) or in_array($_SESSION['USER_ID'], explode(',', $Row['rateusersminus']))) MessageSend(2, 'Ви вже оцінили цю відповідь.');
 {
mysqli_query($CONNECT, "UPDATE `messages` SET `rate` = `rate` - 1, `rateusersminus` = CONCAT(rateusersminus, ',$_SESSION[USER_ID]') WHERE `id` = $Param[id]");

MessageSend(3, 'Ваша оцінка прийнята. Дякуємо =(');	}
}

?>