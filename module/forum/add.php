<?php 
if ($_SESSION['USER_GROUP'] ==-1 ) MessageSend(2, 'Адміністратор відключив можливість додавання тем за певних причин.', '/forum');

if ($_SESSION['USER_GROUP'] == 2) $Active = 1;
else $Active = 0;
if ($_POST['enter'] and $_POST['text'] and $_POST['name'] and $_POST['cat']) {
$_POST['name'] = FormChars($_POST['name']);
$_POST['text'] = FormChars($_POST['text']);
$_POST['cat'] += 0;
mysqli_query($CONNECT, "INSERT INTO `forum`  VALUES ('', '$_POST[name]', $_POST[cat], 0, '$_SESSION[USER_LOGIN]', '$_POST[text]', NOW(), $Active, '$_SESSION[USER_ID]', '')");
MessageSend(2, 'Тема додана', '/forum');
}
Head('Redeforum - Добавити новину') ?>
<body><video id="myvid" src="/resource/img/mainlogo/background.mp4" autoplay muted loop></video>
<?php Menu();
MessageShow() 

?>

 

<div style=" margin-right: 15px; margin-top: -30px;"><div class="row" ><div style="background-color: #12161f;" class="col-md">
<br><nav aria-label="breadcrumb">
  <ol class="breadcrumb arr-right" style="background-color: #1c2331; margin-top: -8px; margin-left: -2px; margin-right: -15px; ">
    <li class="breadcrumb-item "><a href="/" style="color: #79249d; margin-left: 6px">Головна</a></li>
	<li class="breadcrumb-item "><a href="/forum" style="color: #79249d; margin-left: 6px">Новини</a></li>
    <li class="breadcrumb-item text-light active" aria-current="page">Добавити новину</li>
  </ol>
</nav> 
</div></div></div>

<div class="col">
<br><br>
<div class="container" style="background-color: #131a29; border-radius: 6px">
<br>
<form method="POST" action="/forum/add">
<input type="text" name="name" placeholder="Назва новини" maxlength="20" style="color: #fff" required>
<br><br><label style="color: #fff; font-size: 110%; text-shadow: 1px 1px 10px #000;">Виберіть розділ</label><select size="1" name="cat" class="form-control form-control-chosen" style="background-color: #81219a; color: #fff; text-shadow: 1px 1px 10px #000; cursor: pointer">
<?php 
$Cat = mysqli_query($CONNECT,'SELECT * FROM `categorymain`');

while ($Row = mysqli_fetch_assoc($Cat)) echo '<option value="'.$Row['id'].'">'.$Row['name'].'</option>'; 


?>
</select>

<br>
<div class="form-group purple-border">
  <label style="color: #fff; font-size: 110%; text-shadow: 1px 1px 10px #000; ">Введіть текст</label>
  <textarea name="text" class="form-control" style="background-color: #131a29; color: #fff; height: 400px" id="exampleFormControlTextarea4" rows="3" required></textarea>
</div>
<input type="submit" style="text-shadow: 1px 1px 10px #000;" name="enter" value="Додати"> <input type="reset" style="text-shadow: 1px 1px 10px #000;" value="Очистити"><a href="#"style="float: right; color: #fff; text-shadow: 1px 1px 10px #ff0000;">Як добавити новину ?</a>
</form>
<br>
</div>
</div>

<?php Footer() ?>

</body>
</html>