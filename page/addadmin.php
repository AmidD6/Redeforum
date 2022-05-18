<?php
if ($_POST['admin']){
	if ($_POST['password'] == '1234567890') MessageSend(2, 'Ви увійшли у систему', '/admin');
else MessageSend(2, 'Невірний пароль', '/');
}


?>