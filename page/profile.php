<?php 
ULogin(1);
mysqli_query($CONNECT, "UPDATE `users` SET `storis` = 1 WHERE `id` = $_SESSION[USER_ID]");
session_start();
Head('Redeforum - Мій профіль') ?>
<body><video id="myvid" src="/resource/img/mainlogo/play.mp4" autoplay muted loop></video>

<?php Menu();
MessageShow() 
?>

<div style=" margin-right: 15px; margin-top: -25px;"><div class="row"><div class="col-md" style="background-color: #0e1621">

<br>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb arr-right" style="background-color: #111b2f; margin-top: -8px; margin-left: -2px; margin-right: -15px; box-shadow: 1px 1px 10px #000;">
    <li class="breadcrumb-item "><a href="/" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Головна</a></li>
    <li class="breadcrumb-item text-light active" aria-current="page"><b>Мій профіль<b></li>
  </ol>
</nav> 
</div></div></div>
<div class="col">
<br><br><br><br><br><br><br>
<div class="container" style="background-color: #0b111e;  border-radius: 6px; box-shadow: 1px 1px 10px #000; opacity: 0.8;">

<?php 

echo '
<div class="container-fluid" style=" background: linear-gradient(#0b111e, #5d0c73); padding-top: 20px; padding-bottom: 20px; color: #fff; box-shadow: 1px 1px 10px #000; ">
<img style="padding-right: 20px; border-radius: 10% / 50%;" src="/resource/avatar/'.$_SESSION['MU_AVATAR'].'.jpg" alt="Аватар" align="left">

<b>Логін</b> '.$_SESSION['USER_LOGIN'].' ('.UserGroup($_SESSION['USER_GROUP']).')
<br><b>Ім`я:</b> '.$_SESSION['USER_NAME'].'
<br><b>Почта:</b> '.$_SESSION['USER_EMAIL'].'
<br><b>Країна:</b> '.UserCountry($_SESSION['USER_COUNTRY']).'
<br><b>Дата реєстрації:</b> '.$_SESSION['USER_REGDATE'].'
</div>
';

echo '<a style="margin-top: -100px; margin-right: 10px; float: right;" data-toggle="modal" data-target="#open" class="button ProfileB">Редагування</a>';


?>
 <ul class="nav nav-tabs nav-justified" style="">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" style="color: #78218f; text-shadow: 1px 1px 10px #000;" href="#home">Теми</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab"  style="color: #78218f; text-shadow: 1px 1px 10px #000;" href="#menu1">Новини</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab"  style="color: #78218f; text-shadow: 1px 1px 10px #000;" href="#menu2">Блог</a>
    </li>
  </ul>
  
  
  
  <?php
  echo '
  <div class="modal fade" id="open" tabindex="-1" role="dialog" aria-labelledby="open" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content" style="background-color: #1a263c;">
				<div class="modal-header">
					<h1 class="modal-title" style="color: #8e24aa" id="open">Вхід у свій профіль</h1>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
				<form method="POST" action="/account/edit" enctype="multipart/form-data">
				<input class="form-control" id="name-field" style="width: 97%" type="password" name="opassword" placeholder="Старий пароль" maxlength="15" pattern="[A-Za-z-0-9]{5,15}" title="Не менше 5 і небільше 15 латинській символів або цифр.">
				<input class="form-control" id="name-field" style="width: 97%" type="password" name="npassword" placeholder="Новий пароль" maxlength="15" pattern="[A-Za-z-0-9]{5,15}" title="Не менше 5 і небільше 15 латинській символів або цифр.">
				<input class="form-control" id="name-field" style="width: 97%" type="text" name="name" placeholder="Имя" maxlength="10" pattern="[\D [^0-9]]{4,10}" title="Будь-який символ окрім цифри." value="'.$_SESSION['USER_NAME'].'" required>
				<select size="1" class="browser-default custom-select" style="cursor: pointer;" name="country" >'.str_replace('>'.$_SESSION['USER_COUNTRY'], 'selected>'.$_SESSION['USER_COUNTRY'], '<option value="0">Не скажу</option><option value="1">Україна</option><option value="2">Росія</option><option value="3">США</option><option value="4">Канада</option>').'</select> 
				 <br><br>
				 <div class="custom-file">
				<input type="file" class="custom-file-input" style="cursor: pointer;" name="avatar" >
				<label class="custom-file-label" style="background-color: #5d0c73; color: #fff;" for="customFile">Виберіть зображення у форматі JPG</label>
			</div>
				
				
				
				
				</div>
				<div class="modal-footer">
				<button class="btn btn-md btn-secondary" data-dismiss="modal">Закрити</button>
				<input type="reset" class="btn btn-md btn-purple" value="Очистити">
			
				<input type="submit" name="enter" class="btn btn-md btn-purple" value="Зберегти">
				</div></form>
			</div>
		</div>
</div>';
  ?>
  
  <script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
  
  
  
  
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
						
				

<?php

$Result1 = mysqli_query($CONNECT, 'SELECT * FROM `forumtopic` WHERE `id_user` = '.$_SESSION['USER_ID'].' AND `active` = 1 ORDER BY `id` DESC');

if (mysqli_num_rows($Result1)){
while ($Row2 = mysqli_fetch_assoc($Result1)) {
		
	
			if (!$Row2['active']) $Row2['topic'] .= ' <b style="color: red"> - (Чекає модерації)</b>';
			echo '<nav class="mb-4 navbar navbar-expand-lg" style="background-color: #111b2f; padding: 6px; border-radius: 6px; border: 1px solid #fff;  margin-bottom: 10px; box-shadow: 1px 1px 10px #000;">
		<img src="/resource/img/forum.png" class="rounded" width="70">
		<ul class="navbar-nav ml-auto"><li  class="nav-item"><a style="padding-left: 5px; color: #5d0c72; font-size: 110%;  text-shadow: 1px 1px 10px #000; text-align: left;" href="/forummain/material/id/'.$Row2['id'].'">'.$Row2['topic'].'</a><br>
		<b style="padding-left: 5px; color:#fff; font-size: 80%; text-shadow: 1px 1px 10px #000; text-align: left;"> Відповідей: '.$Row2['messnumber'].'</b>
		</li></ul>
		
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#forumm'.$Row2['id'].'">
                    <span class="navbar-dark navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="forumm'.$Row2['id'].'";>
                     <ul class="navbar-nav ml-auto">
						<li class="nav-item" style="">
						<div style="background-color: #172542; padding: 5px; border-radius: 6px;">
							<b style="color: #fff; padding-left: 15px; padding-right: 15px;"><span style="color: #69147f; font-weight: bold; text-shadow: 1px 1px 10px #000;">Дата:</span> '.$Row2['date'].'</b><br>
							<b style="color: #fff; padding-left: 15px; padding-right: 15px;"><span style="color: #69147f; font-weight: bold; text-shadow: 1px 1px 10px #000;">Автор:</span> '.$Row2['added'].'</b>
						
						</div>
						</li>
					</ul>
				</div>
		
		</nav>
		
';}}
else echo '<p style="color: #fff">Теми відсутні</p>';


?>


				
						
    </div>
    <div id="menu1" class="container tab-pane fade"><br>
					
					<?php $Result111 = mysqli_query($CONNECT, 'SELECT * FROM `forum` WHERE `idforum` = '.$_SESSION['USER_ID'].' ORDER BY `id` DESC ');
					if (mysqli_num_rows($Result111)){
while ($Row1 = mysqli_fetch_assoc($Result111)) echo '




<nav class="mb-4 navbar navbar-expand-lg" style="background-color: #111b2f; padding: 6px; border-radius: 6px; border: 1px solid #fff;  margin-bottom: 10px; box-shadow: 1px 1px 10px #000;">
		<img src="/resource/img/forum.png" class="rounded" width="70">
		<ul class="navbar-nav ml-auto"><li  class="nav-item"><a style="padding-left: 5px; color: #5d0c72; font-size: 110%;  text-shadow: 1px 1px 10px #000; text-align: left;" href="/forum/material/id/'.$Row1['id'].'">'.$Row1['name'].'</a><br>
		<b style="padding-left: 5px; color:#fff; font-size: 80%; text-shadow: 1px 1px 10px #000; text-align: left;"> Коментарі: '.$Row1['messnumber'].'</b>
		</li></ul>
		
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#forumm'.$Row1['id'].'">
                    <span class="navbar-dark navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="forumm'.$Row1['id'].'";>
                     <ul class="navbar-nav ml-auto">
						<li class="nav-item" style="">
						<div style="background-color: #172542; padding: 5px; border-radius: 6px;">
							<b style="color: #fff; padding-left: 15px; padding-right: 15px;"><span style="color: #69147f; font-weight: bold; text-shadow: 1px 1px 10px #000;">Дата:</span> '.$Row1['date'].'</b><br>
							<b style="color: #fff; padding-left: 15px; padding-right: 15px;"><span style="color: #69147f; font-weight: bold; text-shadow: 1px 1px 10px #000;">Автор:</span> '.$Row1['added'].'</b>
						
						</div>
						</li>
					</ul>
				</div>
		
		</nav>





';

					}
					else echo '<p style="color: #fff">Новини відсутні</p>';

?>
					
    </div>
    <div id="menu2" class="container tab-pane fade"><br>
				<div class="row text-center padding">	
			<?php
 $Query = mysqli_query($CONNECT, 'SELECT * FROM `loads` WHERE `img_or_video` = 1 AND `iduser` = '.$_SESSION['USER_ID'].' ORDER BY `date` DESC'); 
 if (mysqli_num_rows($Query)){
while ($Row = mysqli_fetch_assoc($Query)) {
	if ($Row['img_or_video'] == 1) echo '
<div class="col-xs-12 col-sm-6 col-md-4" style="margin-bottom: 10px" >
<a href="/loads/material/id/'.$Row['id'].'"><img class="img-fluid img-thumbnail" src="/catalog/img/loads/'.$Row['dimg'].'/'.$Row['id'].'.jpg" class="lm" alt="'.$Row['name'].'" title="'.$Row['name'].'"><a href="/loads/material/id/'.$Row['id'].'" style=" position: absolute;
  top: 5px;
  left: 30px; font-size: 200%" class="icon icon-open"><i class="fa fa-picture-o" style="color: #fff" aria-hidden="true"></i></a></a>
</div>
';
}
}
else echo '<p style="color: #fff">Блоги відсутні</p>';
?>		
		</div>			
    </div>
  </div>
  

<br>
</div>    

                    
</div>
<?php Footer() ?>

</body>
</html>