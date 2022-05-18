<?php 
if ($_SESSION['USER_GROUP'] == -1) MessageSend(2, 'Адміністратор відключив можливість додавання видеороликів за певних причин.', '/loads');
if ($_SESSION['USER_GROUP'] == 2 or $_SESSION['USER_GROUP'] == 1) $Active = 1;
else $Active = 1;
if ($_POST['enter'] and $_POST['text'] and $_POST['name'] and $_POST['cat']) {

if (!$_FILES['img']['type']) MessageSend(2, 'Ви не вибрали зображення.');


if (($_SESSION['SIZE_FILE'] >= $_SESSION['CONST_RAR']) or ($_SESSION['SIZE_IMG'] >= $_SESSION['CONST_IMG']) or ($_SESSION['SIZE_VIDEO'] >= $_SESSION['CONST_VIDEO'])) MessageSend(2, 'Пам`ять каталога перевищує обмеження.', '/loads');
else {
$_POST['name'] = FormChars($_POST['name']);
$_POST['text'] = FormChars($_POST['text']);
$_POST['cat'] += 0;
$MaxId = mysqli_fetch_row(mysqli_query($CONNECT, 'SELECT max(`id`) FROM `loads`'));
if ($MaxId[0] == 0) mysqli_query($CONNECT, 'ALTER TABLE `loads` AUTO_INCREMENT = 1');
$MaxId[0] += 1;




if ($_FILES['img']['type']){
foreach(glob('catalog/img/loads/*', GLOB_ONLYDIR) as $num => $Dir) {
$num_img ++;
$Count = sizeof(glob($Dir.'/*.*'));

if ($Count < 250) {
move_uploaded_file($_FILES['img']['tmp_name'], $Dir.'/'.$MaxId[0].'.jpg');
break;
}
}

//MiniIMG('catalog/img/forummain/'.$num_img.'/'.$MaxId[0].'.jpg', 'catalog/img/forummain/mini/'.$num_img.'/'.$MaxId[0].'.jpg', 465, 300);

if ($_FILES['img']['type'] != 'image/jpeg') MessageSend(2, 'Не вірний тип картинки.');
if ($_FILES['img']['size'] > 537000) MessageSend(2, 'Розмір зображення великий.');
if ($_SESSION['ACTIVE_IMG'] >= $_SESSION['CONST_IMG']) MessageSend(2, 'На даний момент відсутня можливість добавляти зображення.', '/loads');

}
else $num_img = 0;



if ($_FILES['file']['type']){
foreach(glob('catalog/file/loads/*', GLOB_ONLYDIR) as $num => $Dir) {
$num_file ++;
$Count = sizeof(glob($Dir.'/*.*'));
if ($Count < 250) {
move_uploaded_file($_FILES['file']['tmp_name'], $Dir.'/'.$MaxId[0].'.rar');
break;
}
}
if ($_FILES['file']['type'] != 'application/octet-stream') MessageSend(2, 'Не вірний тип файлу.');
if ($_FILES['file']['size'] > 2000000) MessageSend(2, 'Розмір архіва великий.');
if ($_SESSION['ACTIVE_FILE'] >= $_SESSION['CONST_RAR']) MessageSend(2, 'На даний момент відсутня можливість добавляти архів.');
}
else $num_file = 0;

mysqli_query($CONNECT, "INSERT INTO `loads`  VALUES ($MaxId[0], '$_SESSION[CATY_VAL]', '$_POST[name]', '$_POST[cat]', 0, 0, '$_SESSION[USER_LOGIN]', '$_POST[text]', NOW(), $Active, $num_img, $num_file, 0, 0, 0, '', '', '$_SESSION[USER_ID]', 0)");
MessageSend(2, 'Тема додана', '/loads');
}
}
Head('Redeforum - Добавлення блога') ?>
<body>

<?php Menu();
MessageShow() 
?>
<div style=" margin-right: 15px; margin-top: -25px;"><div class="row"><div class="col-md">

<br>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb arr-right" style="background-color: #111b2f; margin-top: -8px; margin-left: -2px; margin-right: -15px; box-shadow: 1px 1px 10px #000;">
    <li class="breadcrumb-item "><a href="/" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Головна</a></li>
	<li class="breadcrumb-item "><a href="/loads" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Блог</a></li>
    <li class="breadcrumb-item text-light active" aria-current="page"><b>Створення блогу<b></li>
  </ol>
</nav> </div></div></div>





<div class="col">
<br><br>
<div class="container" style="background-color: #131a29; border-radius: 6px; box-shadow: 1px 1px 10px #000;">
<br>
<form method="POST" action="/loads/addimg" enctype="multipart/form-data">
<input type="text" name="name" placeholder="Назва блога" maxlength="20" style="color: #fff" required>

<br><br><label style="color: #fff; font-size: 110%; text-shadow: 1px 1px 10px #000;">Виберіть розділ</label><select size="1" name="cat" class="form-control form-control-chosen" style="background-color: #81219a; color: #fff; text-shadow: 1px 1px 10px #000; cursor: pointer">
<?php 
$Cat = mysqli_query($CONNECT,'SELECT * FROM `categorymain`');

while ($Row = mysqli_fetch_assoc($Cat)) echo '<option value="'.$Row['id'].'">'.$Row['name'].'</option>'; 


?>
</select>

<!-- Nav tabs -->

<?php

echo $_SESSION['CATY_VAL'];
?>	



<br>
<br>



  <ul class="nav nav-tabs nav-justified">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" style="color: #5d0c73; text-shadow: 1px 1px 10px #000;" href="#home">Зображення</a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab"  style="color: #5d0c73; text-shadow: 1px 1px 10px #000;" href="#menu2">Архів</a>
    </li>
  </ul>



  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
					<div class="custom-file">
					<input type="file" name="img" class="custom-file-input" style="cursor: pointer;" id="customFile">
					<label class="custom-file-label" style="background-color: #5d0c73; color: #fff;" for="customFile">Виберіть зображення у форматі JPG</label>
				  </div>
    </div>
    
    <div id="menu2" class="container tab-pane fade"><br>
					<div class="custom-file">
					<input type="file" name="file" class="custom-file-input" style="cursor: pointer;" id="customFile">
					<label class="custom-file-label" style="background-color: #5d0c73; color: #fff;" for="customFile">Виберіть архів у форматі RAR</label>
				  </div>
    </div>
  </div>

  <script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

<br>
<div class="form-group purple-border">
  <label style="color: #fff; font-size: 110%; text-shadow: 1px 1px 10px #000; ">Введіть текст</label>
  <textarea name="text" class="form-control" style="background-color: #131a29; color: #fff; height: 400px" id="exampleFormControlTextarea4" rows="3" required></textarea>
</div>
<input type="submit" style="text-shadow: 1px 1px 10px #000;" name="enter" value="Створити"> <input type="reset" style="text-shadow: 1px 1px 10px #000;" value="Очистити"><a href="#"style="float: right; color: #fff; text-shadow: 1px 1px 10px #ff0000;">Як добавити блог ?</a>
</form>
<br>
</div>
</div>




<?php Footer() ?>

</body>
</html>