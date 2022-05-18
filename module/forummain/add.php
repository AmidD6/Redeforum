<?php 
if ($_SESSION['USER_GROUP'] == -1) MessageSend(2, 'Адміністратор відключив можливість додавання видеороликів за певних причин.', '/forumtopic');
if ($_SESSION['USER_GROUP'] == 2 or $_SESSION['USER_GROUP'] == 1) $Active = 1;
else $Active = 0;
if ($_POST['enter'] and $_POST['text'] and $_POST['name']) {
	


$_POST['name'] = FormChars($_POST['name']);
$_POST['text'] = FormChars($_POST['text']);
$MaxId = mysqli_fetch_row(mysqli_query($CONNECT, 'SELECT max(`id`) FROM `forumtopic`'));
if ($MaxId[0] == 0) mysqli_query($CONNECT, 'ALTER TABLE `forumtopic` AUTO_INCREMENT = 1');
$MaxId[0] += 1;




if ($_FILES['video']['type']) {
foreach(glob('catalog/video/forummain/*', GLOB_ONLYDIR) as $num => $Dir) {
$num_video ++;
$Count = sizeof(glob($Dir.'/*.*'));
if ($Count < 250) {
move_uploaded_file($_FILES['video']['tmp_name'], $Dir.'/'.$MaxId[0].'.mp4');

break;
}
}
if ($_FILES['video']['type'] != 'video/mp4') MessageSend(2, 'Не вірний тип відео.');
if ($_FILES['video']['size'] > 25000000) MessageSend(2, 'Розмір відео великий.');
if ($_SESSION['ACTIVE_VIDEO'] >= $_SESSION['CONST_VIDEO']) MessageSend(2, 'На даний момент відсутня можливість добавляти зображення.');
}
else $num_video = 0;








if ($_FILES['img']['type']){
foreach(glob('catalog/img/forummain/*', GLOB_ONLYDIR) as $num => $Dir) {
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
if ($_SESSION['ACTIVE_IMG'] >= $_SESSION['CONST_IMG']) MessageSend(2, 'На даний момент відсутня можливість добавляти зображення.');
}
else $num_img = 0;



if ($_FILES['file']['type']){
foreach(glob('catalog/file/forummain/*', GLOB_ONLYDIR) as $num => $Dir) {
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

mysqli_query($CONNECT, "INSERT INTO `forumtopic`  VALUES ($MaxId[0], '$_SESSION[catamain]', '$_SESSION[cataid]', '$_POST[name]', '$_SESSION[USER_ID]', '$_SESSION[USER_LOGIN]', NOW(), 0, 0, $Active, '$_POST[text]', $num_file, $num_img, $num_video, 0, 0)");
MessageSend(2, 'Тема додана', '/forummain/maintopic/id/'.$_SESSION['cataid']);
}
Head('Redefprum - Створення теми') ?>
<body>
<body><video id="myvid" src="/resource/img/mainlogo/background.mp4" autoplay muted loop></video>
<?php Menu();
MessageShow() 

?>

 

<div style=" margin-right: 15px; margin-top: -25px;"><div class="row"><div class="col-md" style="background-color: #0e1621">
<?php
echo '<br>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb arr-right" style="background-color: #111b2f; margin-top: -8px; margin-left: -2px; margin-right: -15px; box-shadow: 1px 1px 10px #000;">
    <li class="breadcrumb-item "><a href="/" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Головна</a></li>
	<li class="breadcrumb-item "><a href="/forummain" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Форум</a></li>
	<li class="breadcrumb-item "><a href="/forummain/maintopic/id/'.$_SESSION['cataid'].'" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">'.$_SESSION['namecat'].'</a></li>
    <li class="breadcrumb-item text-light active" aria-current="page"><b>Створення теми<b></li>
  </ol>
</nav> 
</div></div></div>';
?>
<div class="col">
<br><br>
<div class="container" style="background-color: #131a29; border-radius: 6px;  box-shadow: 1px 1px 10px #000;">
<br>
<form method="POST" action="/forummain/add" enctype="multipart/form-data">
<input type="text" name="name" placeholder="Назва теми" maxlength="40" style="color: #fff" required>



<!-- Nav tabs -->







<br>
<br>



  <ul class="nav nav-tabs nav-justified">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" style="color: #5d0c73; text-shadow: 1px 1px 10px #000;" href="#home">Зображення</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab"  style="color: #5d0c73; text-shadow: 1px 1px 10px #000;" href="#menu1">Відео</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab"  style="color: #5d0c73; text-shadow: 1px 1px 10px #000;" href="#menu2">Архів</a>
    </li>
  </ul>



  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
					<div class="custom-file">
					<input type="file" name="img" class="custom-file-input" style="cursor: pointer;" id="customFile" lang="ua">
					<label class="custom-file-label" style="background-color: #5d0c73; color: #fff;" for="customFile">Виберіть зображення у форматі JPG</label>
				  </div>
    </div>
    <div id="menu1" class="container tab-pane fade"><br>
					<div class="custom-file">
					<input type="file" name="video" class="custom-file-input" style="cursor: pointer;" id="customFile" lang="ua">
					<label class="custom-file-label" style="background-color: #5d0c73; color: #fff;" for="customFile">Виберіть відео у форматі MP4</label>
				  </div>
    </div>
    <div id="menu2" class="container tab-pane fade"><br>
					<div class="custom-file">
					<input type="file" name="file" class="custom-file-input" style="cursor: pointer;" id="customFile" lang="ua">
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
  <textarea name="text" class="form-control" style="background-color: #13213d; color: #fff; height: 400px" id="exampleFormControlTextarea4" rows="3" required></textarea>
</div>
<input type="submit" style="text-shadow: 1px 1px 10px #000;" name="enter" value="Створити"> <input type="reset" style="text-shadow: 1px 1px 10px #000;" value="Очистити"><a href="#"style="float: right; color: #fff; text-shadow: 1px 1px 10px #ff0000;">Як добавити тему ?</a>
</form>
<br>
</div>
</div>
</body>
</html>