<?php 
//===================================================================================
$files = round($_SESSION['ACTIVE_FILE'], 2);
$imgs = round($_SESSION['ACTIVE_IMG'], 2);
$video = round($_SESSION['ACTIVE_VIDEO'], 2);
$allm = round($_SESSION['SIZE_ALL'], 2);

$cons_img = round($_SESSION['CONST_IMG'], 2);
$cons_video = round($_SESSION['CONST_VIDEO'], 2);
$cons_rar = round($_SESSION['CONST_RAR'], 2);


$free = $imgs + $video + $files;
$fre = $allm - $imgs - $video - $files;

$fr = round($free / $allm * 100 , 1);  //Загальна пам'ять
$f = round($fre / $allm * 100 , 1);  //Вільна пам'ять


$fil = round(($files) / ($cons_rar) * 100, 1);  // Пам'ять архівів
$im = round(($imgs) / ($cons_img) * 100, 1);   //Пам'ять зображення
$vid = round(($video)/ ($cons_video) * 100, 1); //Пам'ять відео
//===================================================================================









$Param['id'] += 0;
if ($Param['id'] == 0) MessageSend(1, 'URL адреса вказана невірно.', '/loads');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT * FROM `loads` WHERE `id` = '.$Param['id']));
if (!$Row['name']) MessageSend(1, 'Такий новини не існує.', '/loads');
if (!$Row['active'] and $_SESSION['USER_GROUP'] != 2) MessageSend(1, 'Новина очікує модерації.', '/loads');
mysqli_query($CONNECT, 'UPDATE `loads` SET `read` = `read` + 1 WHERE `id` = '.$Param['id']);
Head('Redeforum - '.$Row['name']);
?>
<body>

<?php Menu();
MessageShow();



echo '<div style=" margin-right: 15px; margin-top: -25px;"><div class="row" ><div class="col-md">
<br>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb arr-right" style="background-color: #111b2f; margin-top: -8px; margin-left: -2px; margin-right: -15px; box-shadow: 1px 1px 10px #000;">
    <li class="breadcrumb-item "><a href="/" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Головна</a></li>
	<li class="breadcrumb-item "><a href="/loads" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Блог</a></li>
    <li class="breadcrumb-item text-light active" aria-current="page"><b>'.$Row['name'].'<b></li>
  </ol>
</nav>
</div></div></div>';
?>

<style>
p {
	text-align: justify;
}
</style>

<br>
<div class="container-fluid" >
<div class="row">
<div class=" col-lg-9"><br>
	<div class="container-fluid" style="background-color: #0b111e; border-radius: 6px; box-shadow: 1px 1px 10px #000;">

<?php 


/*if ($Row['rateusers']) {
$Exp = explode(',', $Row['rateusers']);

foreach ($Exp as $value) {
if ($value) {
	$Row2 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `users` WHERE `id` = $value"));
if($Row2['login'] == $_SESSION['USER_LOGIN']) $RATED .= '<a href="/profile" class="lol">'.$Row2['login'].'<a> ';
else $RATED .= '<a href="/user/'.$Row2['login'].'" class="lol">'.$Row2['login'].'<a> ';

}
}

} else $RATED = 'n/a';*/






if ($_SESSION['USER_GROUP'] == 2 or $_SESSION['USER_GROUP'] == 1) {
	if ($Row['img_or_video'] == 1) $EDIT = '
<a href="/loads/editimg/id/'.$Param['id'].'" class="lol">Редагувати проект</a> | <a href="/loads/controlimg/id/'.$Param['id'].'/command/delete" class="lol">Видалити проект</a>'.$Active;

if ($Row['img_or_video'] == 2) $EDIT = '
<a href="/loads/editvideo/id/'.$Param['id'].'" class="lol">Редагувати проект</a> | <a href="/loads/controlvideo/id/'.$Param['id'].'/command/delete" class="lol">Видалити проект</a>'.$Active;
}

if ($Row['img_or_video'] == 1) {
if($Row['added'] == $_SESSION['USER_LOGIN']) 
	echo '
<h3 style="color: #6f1b8c; text-shadow: 1px 1px 10px #000;">'.$Row['name'].'</h3>
<hr style="border: 1px solid #771790; box-shadow: 1px 1px 10px #000;">
<div class="container">
<div class="row">
	<div class="col-lg-6" >
	<img " class="img-fluid img-thumbnail" data-toggle="tooltip" title="Автор: '.$Row['added'].'" src="/catalog/img/loads/'.$Row['dimg'].'/'.$Row['id'].'.jpg" alt="">
	</div>

	<div class="col-lg-6" style="color: #fff; text-shadow: 1px 1px 10px #000;">
	
	<b>Автор: <a href="/profile" style="color: #7f199b">'.$Row['added'].'<a></b><br><br>
	<b>Переглядів: <b style="color: #7f199b">'.($Row['read'] + 1).'</b></b><br><br>
	
	<b>Дата публікації: </b><b style="color: #7f199b">'.$Row['date'].'</b>
	</div>
</div>
</div>


<br><p style="color: #fff">'.$Row['text'].'</p><br><hr style="border: 1px solid #771790">'.$EDIT;
else
	echo '<h3 style="color: #6f1b8c; text-shadow: 1px 1px 10px #000;">'.$Row['name'].'</h3>
<hr style="border: 1px solid #771790; box-shadow: 1px 1px 10px #000;">
<div class="container">
<div class="row">
	<div class="" style="border: 3px solid red; margin-left: px">
	<img class="img-fluid" height="422" width="750" data-toggle="tooltip" title="Автор: '.$Row['added'].'" src="/catalog/img/loads/'.$Row['dimg'].'/'.$Row['id'].'.jpg" alt="">
	</div>

	<div class="col-lg-6" style="color: #fff; text-shadow: 1px 1px 10px #000;">
	
	<b>Автор: <a href="/profile" style="color: #7f199b">'.$Row['added'].'<a></b><br><br>
	<b>Переглядів: <b style="color: #7f199b">'.($Row['read'] + 1).'</b></b><br><br>
	<b>Дата публікації: </b><b style="color: #7f199b">'.$Row['date'].'</b>
	<br><p style="color: #fff;">'.$Row['text'].'</p><br>
	</div>
</div>
</div><hr style="border: 1px solid #771790"><br>';



//===================================================================================
/*$files = $_SESSION['SIZE_FILE'];
$imgs = $_SESSION['SIZE_IMG'];
$video = $_SESSION['SIZE_VIDEO'];
$allm = $_SESSION['SIZE_ALL'];

$cons_img = $_SESSION['CONST_IMG'];
$cons_video = $_SESSION['CONST_VIDEO'];
$cons_rar = $_SESSION['CONST_RAR'];


$free = ($cons_img - $imgs) + ($cons_video - $video) + ($cons_rar - $files);
$fre = $allm - ($cons_img - $imgs) - ($cons_video - $video) - ($cons_rar - $files);

$fr = round($free / $allm * 100 , 1);  //Загальна пам'ять
$f = round($fre / $allm * 100 , 1);  //Вільна пам'ять


$fil = round(($files) / ($cons_rar) * 100, 1);  // Пам'ять архівів
$im = round(($imgs) / ($cons_img) * 100, 1);   //Пам'ять зображення
$vid = round(($video)/ ($cons_video) * 100, 1); //Пам'ять відео*/
//===================================================================================



echo '</div>';

}

if ($Row['img_or_video'] == 2) {
	
	if($Row['added'] == $_SESSION['USER_LOGIN']) 
	echo '
<h3 style="color: #6f1b8c; text-shadow: 1px 1px 10px #000;">'.$Row['name'].'</h3>
<hr style="border: 1px solid #771790; box-shadow: 1px 1px 10px #000;">
<div class="container">
<div class="row">
	<div class="col-lg-6">
	<video src="/catalog/video/loads/'.$Row['dvideo'].'/'.$Popular['id'].'.mp4" poster="/catalog/img/loads/mini/'.$Row['dpostimg'].'/'.$Row['id'].'.jpg" controls loop></video>
	</div>

	<div class="col-lg-6" style="color: #fff; text-shadow: 1px 1px 10px #000;">
	
	<b>Автор: <a href="/profile" style="color: #7f199b">'.$Row['added'].'<a></b><br><br>
	<b>Переглядів: <b style="color: #7f199b">'.($Row['read'] + 1).'</b></b><br><br>
	
	<b>Дата публікації: </b><b style="color: #7f199b">'.$Row['date'].'</b>
	</div>
</div>
</div>

<br><p style="color: #fff;">'.$Row['text'].'</p><br><hr style="border: 1px solid #771790">'.$EDIT;
else
	echo '<h3 style="color: #6f1b8c; text-shadow: 1px 1px 10px #000;">'.$Row['name'].'</h3>
<hr style="border: 1px solid #771790; box-shadow: 1px 1px 10px #000;">
<div class="container">
<div class="row">
	<div class="col-lg-6">
	<video src="/catalog/video/loads/'.$Row['dvideo'].'/'.$Row['id'].'.mp4" poster="/catalog/img/loads/mini/'.$Row['dpostimg'].'/'.$Row['id'].'.jpg" controls loop></video>
	</div>

	<div class="col-lg-6" style="color: #fff; text-shadow: 1px 1px 10px #000;">
	
	<b>Автор: <a href="/profile" style="color: #7f199b">'.$Row['added'].'<a></b><br><br>
	<b>Переглядів: <b style="color: #7f199b">'.($Row['read'] + 1).'</b></b><br><br>
	<b>Дата публікації: </b><b style="color: #7f199b">'.$Row['date'].'</b>
	</div>
</div>
</div>

<br><p style="color: #fff;">'.$Row['text'].'</p><br><hr style="border: 1px solid #771790"><br>';


//===================================================================================
/*$files = $_SESSION['SIZE_FILE'];
$imgs = $_SESSION['SIZE_IMG'];
$video = $_SESSION['SIZE_VIDEO'];
$allm = $_SESSION['SIZE_ALL'];

$cons_img = $_SESSION['CONST_IMG'];
$cons_video = $_SESSION['CONST_VIDEO'];
$cons_rar = $_SESSION['CONST_RAR'];


$free = ($cons_img - $imgs) + ($cons_video - $video) + ($cons_rar - $files);
$fre = $allm - ($cons_img - $imgs) - ($cons_video - $video) - ($cons_rar - $files);

$fr = round($free / $allm * 100 , 1);  //Загальна пам'ять
$f = round($fre / $allm * 100 , 1);  //Вільна пам'ять


$fil = round(($files) / ($cons_rar) * 100, 1);  // Пам'ять архівів
$im = round(($imgs) / ($cons_img) * 100, 1);   //Пам'ять зображення
$vid = round(($video)/ ($cons_video) * 100, 1); //Пам'ять відео*/
//===================================================================================



echo '</div>';
	
}

$pop = mysqli_query($CONNECT, "SELECT * FROM `loads` WHERE `id` != '$Param[id]' AND `img_or_video` = '$Row[img_or_video]' ORDER BY `id` DESC LIMIT 0, 7");


echo '<div class="container-fluid" style="background-color: #0b111e; border-radius: 6px; box-shadow: 1px 1px 10px #000; margin-top: 50px; padding-top: 10px">';
$Nome = $Param['id'];
$Com = mysqli_query($CONNECT, 'SELECT SUM(`one`) AS `num` FROM `comments` WHERE `module` = 2 AND `material` = '.$Nome.'');
$Comres = mysqli_fetch_assoc($Com);
mysqli_query($CONNECT, "UPDATE `loads` SET `numloads` = '$Comres[num]' WHERE `id` = '$Nome'");
if ($Comres['num'] == 0) echo '<h3 style="color: #fff; text-shadow: 1px 1px 10px #000;">Відсутні коментарі</h3>';
else echo '<h3 style="color: #fff; text-shadow: 1px 1px 10px #000; padding-bottom: 10px; margin-left: 15px">Коментарів ('.$Comres['num'].')</h3>';
COMMENTS();
echo '</div>';

echo '</div>';
echo ' 
<div class=" col-lg-3">';

//-----------------------------СТАТУС БАР---------------------------------------------------
echo '

<div class="ccontainer-fluid" style="background-color: #111b2f; border-radius: 6px; box-shadow: 1px 1px 10px #000; padding: 10px; margin-top: 24px">
		<h4 style="color: #fff; text-shadow: 1px 1px 10px #000; margin-bottom: 20px; padding-bottom: 10px">Пам`ять домена</h4>';
					
		
if ($imgs >= $cons_img) echo '
					<div class="progress">
					
  <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: 100%; height: 100%; box-shadow: 1px 1px 10px #000;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"><b style="text-shadow: 1px 1px 10px #000;">100%</b></div>
</div>';
else echo '<div class="progress">
					
  <div class="progress-bar bg-success progress-bar-striped" role="progressbar" style="width: '.$im.'%; height: 100%; box-shadow: 1px 1px 10px #000;" aria-valuenow="'.$im.'" aria-valuemin="0" aria-valuemax="100"><b style="text-shadow: 1px 1px 10px #000;">'.$im.'%</b></div>
</div>';


if ($video >= $cons_video) echo '
<div class="progress">
  <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: 100%; height: 100%; box-shadow: 1px 1px 10px #000;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"><b style="text-shadow: 1px 1px 10px #000;">100%</b></div>
</div>';
else echo '<div class="progress">
  <div class="progress-bar bg-info progress-bar-striped" role="progressbar" style="width: '.$vid.'%; height: 100%; box-shadow: 1px 1px 10px #000;" aria-valuenow="'.$vid.'" aria-valuemin="0" aria-valuemax="100"><b style="text-shadow: 1px 1px 10px #000;">'.$vid.'%</b></div>
</div>';

if ($files >= $cons_rar) echo '
<div class="progress">
  <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: 100%; height: 100%; box-shadow: 1px 1px 10px #000;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"><b style="text-shadow: 1px 1px 10px #000;">100%</b></div>
</div><br>';
else echo '
<div class="progress">
  <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" style="width: '.$fil.'%; height: 100%; box-shadow: 1px 1px 10px #000;" aria-valuenow="'.$fil.'" aria-valuemin="0" aria-valuemax="100"><b style="text-shadow: 1px 1px 10px #000;">'.$fil.'%</b></div>
</div><br>';




if ($free >= $allm) echo '
<div class="progress">
  <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: 100%; height: 100%; box-shadow: 1px 1px 10px #000;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"><b style="text-shadow: 1px 1px 10px #000;">100%</b></div>
</div>';
else echo '
<div class="progress">
  <div class="progress-bar bg-secondary progress-bar-striped" role="progressbar" style="width: '.$fr.'%; height: 100%; box-shadow: 1px 1px 10px #000;" aria-valuenow="'.$fr.'" aria-valuemin="0" aria-valuemax="100"><b style="text-shadow: 1px 1px 10px #000;">'.$fr.'%</b></div>
</div>';






					
		echo '			
					
					<hr style="border: 1px solid #5d0c72">';
					if ($imgs >= $cons_img) echo'
					<p style="color: #fff; text-shadow: 1px 1px 10px #000;">Пам`ять картинок: <b style="color: #ff0000;"> '.($cons_img).' мб</b> із '.($cons_img).' мб</p>';
					else echo'
					<p style="color: #fff; text-shadow: 1px 1px 10px #000;">Пам`ять картинок: <b style="color: #28a745;"> '.$imgs.' мб</b> із '.($cons_img).' мб</p>';
					
					if ($video >= $cons_video) echo '
					<p style="color: #fff;text-shadow: 1px 1px 10px #000;">Пам`ять відео: <b style="color: #ff0000;">'.($cons_video).' мб</b> із '.($cons_video).' мб</p>';
					else echo '
					<p style="color: #fff;text-shadow: 1px 1px 10px #000;">Пам`ять відео: <b style="color: #17a2b8;">'.$video.' мб</b> із '.($cons_video).' мб</p>';
					
					if ($files >= $cons_rar) echo '
					<p style="color: #fff;text-shadow: 1px 1px 10px #000;">Пам`ять архівів: <b style="color: #ff0000;">'.($cons_rar).' мб</b> із '.($cons_rar).' мб</p>';
					else echo '<p style="color: #fff;text-shadow: 1px 1px 10px #000;">Пам`ять архівів: <b style="color: #ffc107;">'.$files.' мб</b> із '.($cons_rar).' мб</p>';
					
				echo'	<hr style="border: 1px solid #5d0c72">';
				
				if ($free >= $allm) echo '
					<p style="color: #fff;text-shadow: 1px 1px 10px #000;">Загальна пам`ять: <b style="color: #ff0000;">'.$allm.' мб</b> із '.$allm.' мб</p>';
					else echo '
					<p style="color: #fff;text-shadow: 1px 1px 10px #000;">Загальна пам`ять: <b style="color: #676f77;">'.$free.' мб</b> із '.$allm.' мб</p>';
					
					
					echo '
					<!--<p style="color: #a2b1cd;text-shadow: 1px 1px 10px #000;">Вільна пам`ять: '.$fre.' мб</p>
					<p style="color: #dc3545;text-shadow: 1px 1px 10px #000;">Зайнята пам`ять: '.$free.' мб</p>-->
		</div>';








echo '<div class="col-xs-28 col-sm-16 col-md-12" style="background-color: #111b2f; border-radius: 6px; box-shadow: 1px 1px 10px #000; padding: 10px; margin-top: 24px">
				<div style="background-color: #501061; padding: 5px; margin-bottom: 20px; border-radius: 6px"><h3 style="text-align: center; margin-bottom: 0px; color: #fff;">Похожі запроси</h3></div>
				';
while ($Popular = mysqli_fetch_assoc($pop)) {
			if ($Popular['img_or_video'] == 1) $images1 = '
						<img class="img-fluid img-thumbnail" embed-responsive-16by9 data-toggle="tooltip" title="Автор: '.$Popular['added'].'" src="/catalog/img/loads/'.$Popular['dimg'].'/'.$Popular['id'].'.jpg" alt="">

						<a href="/loads/material/id/'.$Popular['id'].'" style=" position: absolute;  top: 14px; left: 27px; font-size: 200%" class="icon icon-open"><i class="fa fa-picture-o" style="color: #fff" aria-hidden="true"></i></a>

						';

						if ($Popular['img_or_video'] == 2 and $Popular['dpostimg'] != 0) $images1 = '<div class="embed-responsive embed-responsive-16by9" style="border: 5px solid #fff; border-radius: 3px">
														<video src="/catalog/video/loads/'.$Popular['dvideo'].'/'.$Popular['id'].'.mp4" poster="/catalog/img/loads/mini/'.$Popular['dpostimg'].'/'.$Popular['id'].'.jpg" controls loop></video>
													  <a href="/loads/material/id/'.$Popular['id'].'" style=" position: absolute;
						  top: -1px;
						  left: 10px; font-size: 200%" class="icon icon-open"><i class="fa fa-file-video-o" style="color: #fff" aria-hidden="true"></i></a>
													  </div>';

						if ($Popular['img_or_video'] == 2 and $Popular['dpostimg'] == 0) $images1 = '<div class="embed-responsive embed-responsive-16by9" style="border: 5px solid #fff; border-radius: 3px">
														<video src="/catalog/video/loads/'.$Popular['dvideo'].'/'.$Popular['id'].'.mp4" poster="/catalog/img/loads/mini/0.jpg" controls loop></video>
														  <a href="/loads/material/id/'.$Popular['id'].'" style=" position: absolute;
						  top: -1px;
						  left: 10px; font-size: 200%" class="icon icon-open"><i class="fa fa-file-video-o" style="color: #fff" aria-hidden="true"></i></a>
													  </div>';

				
				echo '
				<div class="col-xs-28 col-sm-16 col-md-12" style="background-color: #111b2f; border-radius: 6px; box-shadow: 1px 1px 10px #000; padding: 10px; margin-top: 24px">
					<a href="/loads/material/id/'.$Popular['id'].'" style="color: #9200c5; text-shadow: 1px 1px 10px #000;">	
					'.$images1.'
			</a></div>
				';
			}








/*		<div class="ccontainer-fluid" style="background-color: #111b2f; border-radius: 6px; box-shadow: 1px 1px 10px #000; padding: 10px; margin-top: 24px">
		<h4 style="color: #fff; text-shadow: 1px 1px 10px #000; margin-bottom: 20px; padding-bottom: 10px">Пам`ять домена</h4>
					
					
					<div class="progress">
  <div class="progress-bar bg-success progress-bar-striped" role="progressbar" style="width: '.$im.'%; height: 100%; box-shadow: 1px 1px 10px #000;" aria-valuenow="'.$im.'" aria-valuemin="0" aria-valuemax="100"><b style="text-shadow: 1px 1px 10px #000;">'.$im.'%</b></div>
</div>
<div class="progress">
  <div class="progress-bar bg-info progress-bar-striped" role="progressbar" style="width: '.$vid.'%; height: 100%; box-shadow: 1px 1px 10px #000;" aria-valuenow="'.$vid.'" aria-valuemin="0" aria-valuemax="100"><b style="text-shadow: 1px 1px 10px #000;">'.$vid.'%</b></div>
</div>
<div class="progress">
  <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" style="width: '.$fil.'%; height: 100%; box-shadow: 1px 1px 10px #000;" aria-valuenow="'.$fil.'" aria-valuemin="0" aria-valuemax="100"><b style="text-shadow: 1px 1px 10px #000;">'.$fil.'%</b></div>
</div><br>
<div class="progress">
  <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: '.$fr.'%; height: 100%; box-shadow: 1px 1px 10px #000;" aria-valuenow="'.$fr.'" aria-valuemin="0" aria-valuemax="100"><b style="text-shadow: 1px 1px 10px #000;">'.$fr.'%</b></div>
</div>

					
					
					
					<hr style="border: 1px solid #5d0c72">
					<p style="color: #fff; text-shadow: 1px 1px 10px #000;">Пам`ять картинок: <b style="color: #28a745;"> '.$imgs.' мб</b> із '.($cons_img).'</p>
					<p style="color: #fff;text-shadow: 1px 1px 10px #000;">Пам`ять відео: <b style="color: #17a2b8;">'.$video.' мб</b> із '.($cons_video).'</p>
					<p style="color: #fff;text-shadow: 1px 1px 10px #000;">Пам`ять архівів: <b style="color: #ffc107;">'.$files.' мб</b> із '.($cons_rar).'</p>
					
					<hr style="border: 1px solid #5d0c72">
					<p style="color: #28a745;text-shadow: 1px 1px 10px #000;">Загальна пам`ять: '.$allm.' мб</p>
					<p style="color: #a2b1cd;text-shadow: 1px 1px 10px #000;">Вільна пам`ять: '.$fre.' мб</p>
					<p style="color: #dc3545;text-shadow: 1px 1px 10px #000;">Зайнята пам`ять: '.$free.' мб</p>
		</div>';*/







 ?>
 </div>
  </div>
 </div>
</div>





<?php Footer(); ?>
</body>
</html>