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






$Catag = mysqli_query($CONNECT,'SELECT * FROM `categorymain`');
//if ($Module == 'category' and $Param['id'] != 1 and $Param['id'] != 2 and $Param['id'] != 3) MessageSend(1, 'Такі категорії не існує.', '/loads');
$Param['page'] += 0;

if($_POST['enterr'] and $_POST['caty']){
	session_start();
	$_POST['caty'] += 0;
	$_SESSION['CATY_VAL'] = $_POST['caty'];
	
	if ($_POST['caty'] == 1 and ($imgs >= $cons_img)) MessageSend(1, 'На даний момент відсутня можливість добавляти зображення', '/loads');
	else if ($_POST['caty'] == 1) MessageSend(2, 'Тип вибраний', '/loads/addimg');
	
	if ($_POST['caty'] == 2 and ($video >= $cons_video)) MessageSend(1, 'На даний момент відсутня можливість добавляти відео', '/loads');
	else if ($_POST['caty'] == 2) MessageSend(2, 'Тип вибраний', '/loads/addvideo');
}

Head('Redeforum - Блог');
?>


<body>

<?php Menu();
MessageShow()
?>

<style>

.calendar .clndr .clndr-controls {
	background: #5d0c72;
	border-top-left-radius: 6px;
	border-top-right-radius: 6px
}

.calendar .clndr .clndr-table {
    table-layout: fixed;
    width: 100%;
    margin: 0 auto;
    background: #111b2f;
	
	border-bottom-left-radius: 6px;
	border-bottom-right-radius: 6px
}
</style>

<div style=" margin-right: 15px; margin-top: -25px;"><div class="row"><div class="col-md">

<br>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb arr-right" style="background-color: #111b2f; margin-top: -8px; margin-left: -2px; margin-right: -15px; box-shadow: 1px 1px 10px #000;">
    <li class="breadcrumb-item "><a href="/" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Головна</a></li>
    <li class="breadcrumb-item text-light active" aria-current="page"><b>Блог<b></li>
  </ol>
</nav> 


<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #111b2f; margin-right: -15px; box-shadow: 1px 1px 10px #000;">
    <button class="navbar-toggler btn-block" type="button" data-toggle="collapse" data-target="#catagorynews" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    Вибрати категорію</button>  <!--justify-content-center-->
    <div class="collapse navbar-collapse" id="catagorynews">
        <ul class="navbar-nav pull-left">
		<li class="nav-item" style="font-size: 90%; padding-top: 4px; "><a class="nav-link" href="/loads"><div">Усі категорії</a></li>
		<?php while ($Catahead = mysqli_fetch_assoc($Catag)) echo '<li class="nav-item" style="font-size: 90%; padding-top: 4px;"><a class="nav-link" href="/loads/category/id/'.$Catahead['id'].'">'.$Catahead['name'].'</a></li>'; 
		if ($_SESSION['USER_LOGIN_IN']) echo '<li><a class="nav-link" href="#"><button type="button" class="btn btn-sm btn-purple btn-block " data-toggle="modal" data-target="#exampleModalCente" style="background-color: #5d0c72"><b style="text-shadow: 1px 1px 10px #000;">Добавити блог<b></button></a></li>
		';
		?>
		</ul>
		<?php 
		echo '<ul class="navbar-nav ml-auto">'.SearchFormForum().'</ul>';
		?>
    </div>
</nav>
</div></div></div>




<div class="modal fade" id="exampleModalCente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background-color: #1a263c;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="color: #6b1382">Виберіть тип блога</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form method="POST" action="">
        <br>
		<select size="1" name="caty" class="form-control form-control-chosen" style="background-color: #6b1382; color: #fff; text-shadow: 1px 1px 10px #000; cursor: pointer">
<option value="1">Зображення</option><option value="2">Відео</option></select><br>
		
      </div>
      <div class="modal-footer">
        <button class="btn btn-md btn-secondary" data-dismiss="modal">Закрити</button>
        <input type="submit" name="enterr" class="btn btn-md btn-purple" value="Вибрати">
		</form>
      </div>
    </div>
  </div>
</div>





<div class="container-fluid">
<div class="row">
<div class=" col-lg-9"><br>
	<div class="container-fluid" style="background-color: #0b111e; border-radius: 6px; box-shadow: 1px 1px 10px #000;">
	<h2 style="color: #fff; text-shadow: 1px 1px 10px #000; margin-bottom: 20px">Блог</h2>
<?php 
if (!$Module or $Module == 'main') {
if ($_SESSION['USER_GROUP'] != 2) $Active = 'WHERE `active` = 1';
$Param1 = 'SELECT * FROM `loads` '.$Active.' ORDER BY `id` DESC LIMIT 0, 9';
$Param2 = 'SELECT * FROM `loads` '.$Active.' ORDER BY `id` DESC LIMIT START, 9';
$Param3 = 'SELECT COUNT(`id`) FROM `loads`';
$Param4 = '/loads/main/page/';
} else if ($Module == 'category') {
if ($_SESSION['USER_GROUP'] != 2) $Active = 'AND `active` = 1';
$Param1 = 'SELECT * FROM `loads` WHERE `cat` = '.$Param['id'].' '.$Active.' ORDER BY `id` DESC LIMIT 0, 9';
$Param2 = 'SELECT * FROM `loads` WHERE `cat` = '.$Param['id'].' '.$Active.' ORDER BY `id` DESC LIMIT START, 9';
$Param3 = 'SELECT COUNT(`id`) FROM `loads` WHERE `cat` = '.$Param['id'];
$Param4 = '/loads/category/id/'.$Param['id'].'/page/';
}

$Count = mysqli_fetch_row(mysqli_query($CONNECT, $Param3));

if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, $Param1);
} else {
$Start = ($Param['page'] - 1) * 9;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, $Param2));
}


PageSelector($Param4, $Param['page'], $Count);
echo '<div style="height: 10px"></div>';

echo '<div class="row text-center padding">';

if (mysqli_num_rows($Result)){
while ($Row = mysqli_fetch_assoc($Result)) {
if (!$Row['active']) $Row['name'] .= ' (Чекає модерації)';
if ($Row['img_or_video'] == 1) $images = '
<img class="img-fluid img-thumbnail" embed-responsive-16by9 data-toggle="tooltip" title="Автор: '.$Row['added'].'" src="/catalog/img/loads/'.$Row['dimg'].'/'.$Row['id'].'.jpg" alt="">

<a href="/loads/material/id/'.$Row['id'].'" style=" position: absolute;
  top: 5px;
  left: 30px; font-size: 200%" class="icon icon-open"><i class="fa fa-picture-o" style="color: #fff" aria-hidden="true"></i></a>

';

if ($Row['img_or_video'] == 2 and $Row['dpostimg'] != 0) $images = '<div class="embed-responsive embed-responsive-16by9" style="border: 5px solid #fff; border-radius: 3px">
								<video src="/catalog/video/loads/'.$Row['dvideo'].'/'.$Row['id'].'.mp4" poster="/catalog/img/loads/mini/'.$Row['dpostimg'].'/'.$Row['id'].'.jpg" controls loop></video>
							  <a href="/loads/material/id/'.$Row['id'].'" style=" position: absolute;
  top: -1px;
  left: 10px; font-size: 200%" class="icon icon-open"><i class="fa fa-file-video-o" style="color: #fff" aria-hidden="true"></i></a>
							  </div>';

if ($Row['img_or_video'] == 2 and $Row['dpostimg'] == 0) $images = '<div class="embed-responsive embed-responsive-16by9" style="border: 5px solid #fff; border-radius: 3px">
								<video src="/catalog/video/loads/'.$Row['dvideo'].'/'.$Row['id'].'.mp4" poster="/catalog/img/loads/mini/0.jpg" controls loop></video>
								  <a href="/loads/material/id/'.$Row['id'].'" style=" position: absolute;
  top: -1px;
  left: 10px; font-size: 200%" class="icon icon-open"><i class="fa fa-file-video-o" style="color: #fff" aria-hidden="true"></i></a>
							  </div>';

echo '
<div class="col-xs-12 col-sm-6 col-md-4" style="margin-bottom: 10px" >
<a href="/loads/material/id/'.$Row['id'].'" style="color: #9200c5; text-shadow: 1px 1px 10px #000;">
			'.$images.'
			</a>
		</div>
';


}
}

else echo '<h5 style="color: #ff0000; text-shadow: 1px 1px 10px #000; margin-bottom: 20px; padding-left: 16px;">Блог пустий</h5>';
?>


	
	</div></div>



</div>


<?php

$pop = mysqli_query($CONNECT, "SELECT * FROM `loads` ORDER BY `rate` DESC LIMIT 0, 1");


echo ' 
<div class=" col-lg-3">';


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
				<div style="background-color: #501061; padding: 5px; margin-bottom: 20px; border-radius: 6px"><h3 style="text-align: center; margin-bottom: 0px; color: #fff;">Популярний блог</h3></div>

';
		
//--------------------------------------------СТАТУС БАР-----------------------------------------------------		
		if (mysqli_num_rows($pop)){
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

				
				echo '<div class="col-xs-28 col-sm-16 col-md-12" style="background-color: #111b2f; border-radius: 6px; box-shadow: 1px 1px 10px #000; padding: 10px; margin-top: 24px">
					<a href="/loads/material/id/'.$Popular['id'].'" style="color: #9200c5; text-shadow: 1px 1px 10px #000;">	
					'.$images1.'
			</a></div>
				';
			}
		}
else echo '<h5 style="color: #ff0000; text-shadow: 1px 1px 10px #000; margin-bottom: 20px; padding-left: 16px;">Блог пустий</h5>';

echo '</div>';


echo '</div>';







?>
</div>
</div>
<?php Footer() ?>

</body>
</html>