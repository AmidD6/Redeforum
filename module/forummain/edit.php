<?php 
if ($_SESSION['USER_LOGIN'] == $_SESSION['TOPIC_ADDED']) UAccess(0);
else UAccess(1);
$Param['id'] += 0;
if (!$Param['id']) MessageSend(1, 'Не вказаний ID теми ', '/forummain');
$iii = mysqli_query($CONNECT, "SELECT * FROM `forumtopic` WHERE `id` = '$Param[id]'");
$Row = mysqli_fetch_assoc($iii);
session_start();
$_SESSION['TOPIC_VID'] = $Row['video'];
$_SESSION['TOPIC_IMG'] = $Row['image'];
$_SESSION['TOPIC_FIL'] = $Row['file'];


if (!$Row['topic']) MessageSend(1, 'Тема не знайдена', '/forummain');

if ($_POST['enter'] and $_POST['text'] and $_POST['name']) {
$_POST['name'] = FormChars($_POST['name']);
$_POST['text'] = FormChars($_POST['text']);

$MaxId = mysqli_fetch_row(mysqli_query($CONNECT, 'SELECT max(`id`) FROM `forumtopic`'));
if ($MaxId[0] == 0) mysqli_query($CONNECT, 'ALTER TABLE `forumtopic` AUTO_INCREMENT = 1');
$MaxId[0] += 1;


if ($Row['file'] == 0){
			if ($_FILES['file']['type']){
				foreach(glob('catalog/file/forummain/*', GLOB_ONLYDIR) as $num => $Dir) {
				$num_file ++;
				$Count = sizeof(glob($Dir.'/*.*'));
				if ($Count < 250) {
				move_uploaded_file($_FILES['file']['tmp_name'], $Dir.'/'.$Param['id'].'.rar');
				
				break;
				}
				}
				if ($_FILES['file']['type'] != 'application/octet-stream') MessageSend(2, 'Не вірний тип файлу.');
				}
				else $num_file = 0;
					mysqli_query($CONNECT, "UPDATE `forumtopic` SET `file` = $num_file WHERE `id` = $Param[id]");
}
else if ($_FILES['file']['tmp_name']) {
	move_uploaded_file($_FILES['file']['tmp_name'], 'catalog/file/forummain/'.$Row['file'].'/'.$Param['id'].'.rar');
	
	
	if ($_FILES['file']['type'] != 'application/octet-stream') MessageSend(2, 'Не вірний тип файлу.');
	if ($_FILES['file']['size'] > 2000000) MessageSend(2, 'Розмір архіва великий.');
	}
	
	
if ($Row['video'] == 0){
					if ($_FILES['video']['type']) {
					foreach(glob('catalog/video/forummain/*', GLOB_ONLYDIR) as $num => $Dir) {
					$num_video ++;
					
					$Count = sizeof(glob($Dir.'/*.*'));
					if ($Count < 250) {
					move_uploaded_file($_FILES['video']['tmp_name'], $Dir.'/'.$Param['id'].'.mp4');

					break;
					}
					}
					if ($_FILES['video']['type'] != 'video/mp4') MessageSend(2, 'Не вірний тип відео.');
					}
					else $num_video = 0;
	mysqli_query($CONNECT, "UPDATE `forumtopic` SET `video` = $num_video WHERE `id` = $Param[id]");
}	
else if ($_FILES['video']['tmp_name']) {
move_uploaded_file($_FILES['video']['tmp_name'], 'catalog/video/forummain/'.$Row['video'].'/'.$Param['id'].'.mp4');

	
if ($_FILES['video']['type'] != 'video/mp4') MessageSend(2, 'Не вірний тип відео.');
if ($_FILES['video']['size'] > 25000000) MessageSend(2, 'Розмір відео великий.');
}


if ($Row['image'] == 0){

					if ($_FILES['img']['type']){
					foreach(glob('catalog/img/forummain/*', GLOB_ONLYDIR) as $num => $Dir) {
					$num_img ++;
					$Count = sizeof(glob($Dir.'/*.*'));
					if ($Count < 250) {
					move_uploaded_file($_FILES['img']['tmp_name'], $Dir.'/'.$Param['id'].'.jpg');
					break;
					}
					}

					MiniIMG('catalog/img/forummain/'.$num_img.'/'.$Param['id'].'.jpg', 'catalog/img/forummain/mini/'.$num_img.'/'.$MaxId[0].'.jpg', 465, 300);

					if ($_FILES['img']['type'] != 'image/jpeg') MessageSend(2, 'Не вірний тип картинки.');
					}
					else $num_img = 0;
mysqli_query($CONNECT, "UPDATE `forumtopic` SET `image` = $num_img WHERE `id` = $Param[id]");
}
else if ($_FILES['img']['tmp_name']) {
	move_uploaded_file($_FILES['img']['tmp_name'], 'catalog/img/forummain/'.$Row['image'].'/'.$Param['id'].'.jpg');
	
	
	if ($_FILES['img']['type'] != 'image/jpeg') MessageSend(2, 'Не вірний тип картинки.');
	if ($_FILES['img']['size'] > 537000) MessageSend(2, 'Розмір зображення великий.');
	}



mysqli_query($CONNECT, "UPDATE `forumtopic` SET `topic` = '$_POST[name]', `text` = '$_POST[text]' WHERE `id` = $Param[id]");
MessageSend(2, 'Тема відредагована.', '/forummain/material/id/'.$Param['id']);
}

Head('Редагування теми') ?>
<body><video id="myvid" src="/resource/img/mainlogo/background.mp4" autoplay muted loop></video>

<?php Menu();
MessageShow()
?>
<div style=" margin-right: 15px; margin-top: -25px;"><div class="row"><div class="col-md">
<?php
echo '<br>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb arr-right" style="background-color: #111b2f; margin-top: -8px; margin-left: -2px; margin-right: -15px; box-shadow: 1px 1px 10px #000;">
    <li class="breadcrumb-item "><a href="/" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Головна</a></li>
	<li class="breadcrumb-item "><a href="/forummain" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Форум</a></li>
	<li class="breadcrumb-item "><a href="/forummain/maintopic/id/'.$_SESSION['cataid'].'" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">'.$_SESSION['namecat'].'</a></li>
    <li class="breadcrumb-item "><a href="/forummain/material/id/'.$Param['id'].'" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">'.$_SESSION['TOPIC_N'].'</a></li>
	<li class="breadcrumb-item text-light active" aria-current="page"><b>Редагування теми<b></li>
  </ol>
</nav> 
</div></div></div>';
?>
<div class="col">
<br><br>
<div class="container" style="background-color: #131a29; border-radius: 6px">
<br>
<?php
echo '<form method="POST" action="/forummain/edit/id/'.$Param['id'].'" enctype="multipart/form-data">
<input type="text" name="name" placeholder="Назва новини" value="'.$Row['topic'].'" maxlength="20" style="color: #fff" required>



<!-- Nav tabs -->







<br>
<br>



  <ul class="nav nav-tabs nav-justified">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" style="color: #5d0c73; text-shadow: 1px 1px 10px #000;" href="#home">Зображення</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab"  style="color: #5d0c73; text-shadow: 1px 1px 10px #791f91;" href="#menu1">Відео</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab"  style="color: #5d0c73; text-shadow: 1px 1px 10px #791f91;" href="#menu2">Архів</a>
    </li>
  </ul>



  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
					<div class="custom-file">
					<input type="file" name="img" class="custom-file-input" style="cursor: pointer;" id="customFile">
					<label class="custom-file-label" style="background-color: #5d0c73; color: #fff;" for="customFile">Виберіть зображення у форматі JPG</label>
				  </div>';
	if ($Row['image'] != 0) echo '<a href="/forummain/control/id/'.$Param['id'].'/command/delete1" class="lol">Видалити зображення</a>';			  
				  
 echo '</div>
    <div id="menu1" class="container tab-pane fade"><br>
					<div class="custom-file">
					<input type="file" name="video" class="custom-file-input" style="cursor: pointer;" id="customFile">
					<label class="custom-file-label" style="background-color: #5d0c73; color: #fff;" for="customFile">Виберіть відео у форматі MP4</label>
				  </div>';
		if ($Row['video'] != 0) echo '<a href="/forummain/control/id/'.$Param['id'].'/command/delete2" class="lol">Видалити відео</a>';
  echo '  </div>
    <div id="menu2" class="container tab-pane fade"><br>
					<div class="custom-file">
					<input type="file" name="file" class="custom-file-input" style="cursor: pointer;" id="customFile">
					<label class="custom-file-label" style="background-color: #5d0c73; color: #fff;" for="customFile">Виберіть архів у форматі RAR</label>
				  </div>';
		if ($Row['file'] != 0) echo '<a href="/forummain/control/id/'.$Param['id'].'/command/delete3" class="lol">Видалити архів</a>';
  echo '  </div>
  </div>
';
?>

  <script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
<?php echo '
<br>
<div class="form-group purple-border">
  <label style="color: #fff; font-size: 110%; text-shadow: 1px 1px 10px #000; ">Введіть текст</label>
  <textarea name="text" class="form-control" style="background-color: #131a29; color: #fff; height: 400px" id="exampleFormControlTextarea4" rows="3" required>'.str_replace('<br>', '', $Row['text']).'</textarea>
</div>
<input type="submit" style="text-shadow: 1px 1px 10px #000;" name="enter" value="Зберегти"> <input type="reset" style="text-shadow: 1px 1px 10px #000;" value="Знищити"><a href="#"style="float: right; color: #fff; text-shadow: 1px 1px 10px #ff0000;">Як добавити тему ?</a>
</form>
<br>
</div>
';
?>
</div>
</body>
</html>