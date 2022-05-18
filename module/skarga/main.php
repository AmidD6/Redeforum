<?php 
ULogin(1);
mysqli_query($CONNECT, "UPDATE `users` SET `storis` = 1 WHERE `id` = $_SESSION[USER_ID]");
$Param['page'] += 0;
session_start();
Head('Redeforum - Скарга') ?>
<body><video id="myvid" src="/resource/img/mainlogo/play.mp4" autoplay muted loop></video>

<?php Menu();
MessageShow() 
?>

<div style=" margin-right: 15px; margin-top: -25px;"><div class="row"><div class="col-md" style="background-color: #0e1621">

<br>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb arr-right" style="background-color: #111b2f; margin-top: -8px; margin-left: -2px; margin-right: -15px; box-shadow: 1px 1px 10px #000;">
    <li class="breadcrumb-item "><a href="/" style="color: #69147f; margin-left: 6px; text-shadow: 1px 1px 10px #000;">Головна</a></li>
    <li class="breadcrumb-item text-light active" aria-current="page"><b>Список скарг<b></li>
  </ol>
</nav> 
</div></div></div>
<div class="col">
<br><br><br><br><br>
<div class="container" style="background-color: #0b111e;  border-radius: 6px; box-shadow: 1px 1px 10px #000;">

 <ul class="nav nav-tabs nav-justified" style="">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" style="color: #78218f; text-shadow: 1px 1px 10px #000;" href="#home">Список скарг</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab"  style="color: #78218f; text-shadow: 1px 1px 10px #000;" href="#menu1">Повідомлення від адміністратора</a>
    </li>
    
  </ul>
  
  
  


  
  
  
  
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
						
				

  <?php
  
  
  
  if (!$Module or $Module == 'main') {

$Param1 = 'SELECT * FROM `complaint` WHERE `id_added` = '.$_SESSION['USER_ID'].' ORDER BY `id` DESC LIMIT 0, 9';
$Param2 = 'SELECT * FROM `complaint` WHERE `id_added` = '.$_SESSION['USER_ID'].' ORDER BY `id` DESC LIMIT START, 9';
$Param3 = 'SELECT COUNT(`id`) FROM `complaint`';
$Param4 = '/complaint/main/page/';
} 

$Count = mysqli_fetch_row(mysqli_query($CONNECT, $Param3));


PageSelector($Param4, $Param['page'], $Count);


		if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, $Param1);
} else {
$Start = ($Param['page'] - 1) * 9;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, $Param2));
}


				if (!$Param['page']) {
					$Param['page'] = 1;
					$Result = mysqli_query($CONNECT, $Param1);
				} else {
					$Start = ($Param['page'] - 1) * 9;
					$Result = mysqli_query($CONNECT, str_replace('START', $Start, $Param2));
				}
		while ($Row = mysqli_fetch_assoc($Result)) {
		echo '<div class="container-fluid" style="background-color: #111b2f; box-shadow: 1px 1px 10px #000; padding: 10px; border-radius: 6px; ">
		<h3 style="color: #9200c5; text-shadow: 1px 1px 10px #000; text-align: justify; ">'.$Row['name'].'</h3>
		
		</div><br>
		
		';}
  
  
  
  
  
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
   
  </div>
  

<br>
</div>    

                    
</div>
<?php Footer() ?>

</body>
</html>