<?php 
UAccess(1);
$Param['id'] += 0;
if (!$Param['id']) MessageSend(1, 'Не вказаний ID теми ', '/forum');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `cat`, `name`, `text` FROM `forum` WHERE `id` = $Param[id]"));
if (!$Row['name']) MessageSend(1, 'Тема не знайдена', '/forum');

if ($_POST['enter'] and $_POST['text'] and $_POST['name'] and $_POST['cat']) {
$_POST['name'] = FormChars($_POST['name']);
$_POST['text'] = FormChars($_POST['text']);
$_POST['cat'] += 0;
mysqli_query($CONNECT, "UPDATE `forum` SET `name` = '$_POST[name]', `cat` = $_POST[cat], `text` = '$_POST[text]' WHERE `id` = $Param[id]");
MessageSend(2, 'Тема відредагована.', '/forum/material/id/'.$Param['id']);
}

Head('Редагування теми') ?>
<body><video id="myvid" src="/resource/img/mainlogo/background.mp4" autoplay muted loop></video>

<?php Menu();
MessageShow()
?>
<div style=" margin-right: 15px; margin-top: -30px;"><div class="row" ><div style="background-color: #12161f;" class="col-md">
<br><nav aria-label="breadcrumb">
  <ol class="breadcrumb arr-right" style="background-color: #1c2331; margin-top: -8px; margin-left: -2px; margin-right: -15px; ">
    <li class="breadcrumb-item "><a href="/" style="color: #79249d; margin-left: 6px">Головна</a></li>
	<li class="breadcrumb-item "><a href="/forum" style="color: #79249d; margin-left: 6px">Новини</a></li>
	<?php echo '<li class="breadcrumb-item "><a href="/forum/material/id/'.$Param[id].'" style="color: #79249d; margin-left: 6px">'.$Row['name'].'</a></li>'; ?>
    <li class="breadcrumb-item text-light active" aria-current="page">Редагувати новину</li>
  </ol>
</nav> 
</div></div></div>
<?php
$Rows = mysqli_query($CONNECT, "SELECT `id`, `name` FROM `categorymain`");

echo '
<div class="col">
<br><br>
<div class="container" style="background-color: #131a29; border-radius: 6px">
<br>
<form method="POST" action="/forum/edit/id/'.$Param['id'].'">
<input type="text" maxlength="20" name="name" placeholder="Назва новини" style="color: #fff" value="'.$Row['name'].'" required>

<br><br><label style="color: #fff; font-size: 110%; text-shadow: 1px 1px 10px #000;">Виберіть розділ</label><select size="1" name="cat" class="form-control form-control-chosen" style="background-color: #81219a; color: #fff; text-shadow: 1px 1px 10px #000; cursor: pointer">';
while ($Row1 = mysqli_fetch_assoc($Rows)) echo ''.str_replace('value="'.$Row['cat'], 'selected value="'.$Row['cat'], '<option value="'.$Row1['id'].'">'.$Row1['name'].'</option>');
echo ' </select>
<div class="form-group purple-border">
<label style="color: #fff; font-size: 110%; text-shadow: 1px 1px 10px #000; ">Редагувати текст</label>
<br><textarea  name="text" class="form-control" style="background-color: #131a29; color: #fff; height: 400px" id="exampleFormControlTextarea4" rows="3" required>'.str_replace('<br>', '', $Row['text']).'</textarea>
<input type="submit" style="text-shadow: 1px 1px 10px #000;" name="enter" value="Зберегти"> <input type="reset" style="text-shadow: 1px 1px 10px #000;" value="Знищити">
</div>
</form>
<br>
</div>
</div>'
?>


<?php Footer() ?>

</body>
</html>