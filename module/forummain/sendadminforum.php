<?php 
ULogin(1);
$id=$_GET['result'];
$Info = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id`, `name`, `login`, `email`, `country`, `regdate`, `group` FROM `users` WHERE `id` = 2 "));

if ($_POST['enter'] and $_POST['text'] and $_POST['login']) {
$a="Скарга " + $_POST['text'];
SendMessage($_POST['login'], $a);
SendNotice($_POST['login'], $a);
MessageSend(3, 'Сообщение отправлено'); 
}

Head('Отправить сообщение');

?>
<body>
<?php Menu();
MessageShow() 
?>
<div class="Page">
<form method="POST" action="/pm/send">
<?php echo $Draw ;?>
<h1 style="text-align: center;">Меню скарг</h1><br><br>
<p style="text-align: center; font-size:140%;">Надрукуйте побажання або скаргу, адміністратор її розгляне найближчим часом.</p>
<p style="text-align: center; font-size:120%;">Дякуємо за допомогу і терпіння.</p>
<input style="visibility: hidden;" type="text" name="login" value="<?php echo $Info['login']; ?>" placeholder="Логин получателя" required>
<br><textarea style="margin-left: 90px;" class="ChatMessage" name="text" placeholder="Текст повідомлення" required></textarea>
<br><input style="margin-left: 90px; width: 381px;" type="submit" name="enter" value="Отправить"> <input style="width: 381px;" type="reset" value="Очистить">
</form>


<?php Footer() ?>

</body>
</html>