<?php 
ULogin(1);
$id=$_GET['result'];
$Info = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id`, `name`, `login`, `email`, `country`, `regdate`, `group` FROM `users` WHERE `id` = '$id' "));

if (!$Info['avatar']) $Avatar = 0;
else $Avatar = $Info[id];

$Draw = '
<img src="/resource/avatar/'.$Info[id].'.jpg" width="120" height="120" alt="Аватар" align="left">
<div class="Block">
ID '.$Info['id'].' ('.UserGroup($Info['group']).') <b style="float: right;">Логін: '.$Info['login'].'</b>
<br>Ім`я '.$Info['name'].'
<br>Почта: '.HideEmail($Info['email']).'
<br>Країна: '.UserCountry($Info['country']).'
<br>Дата регістрації: '.$Info['regdate'].'
</div>
<a href="/pm/send" class="button ProfileB">Написати</a><br><br>
<div class="ProfileEdit">
</div>
';
if ($_POST['enter'] and $_POST['text'] and $_POST['login']) {
SendMessage($_POST['login'], $_POST['text']);
SendNotice($_POST['login'], $_POST['text'], 1);
MessageSend(3, 'Повідомлення відправлено'); 
}

Head('Відправити повідомлення');
?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page">
<form method="POST" action="/pm/send">
<?php echo $Draw ;?><br><br>
<input style="visibility: hidden" type="text" name="login" value="<?php echo $Info['login']; ?>" placeholder="Логин получателя" required>
<br><textarea class="ChatMessage" name="text" placeholder="Текст сообщения" required></textarea>
<br><input type="submit" name="enter" value="Отправить"> <input type="reset" value="Очистить">
</form>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>