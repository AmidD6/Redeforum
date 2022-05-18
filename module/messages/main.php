<script>

</script>











<?php

function MESSFORUM() {
session_start();
global $CONNECT, $Page, $Param;
$Suma = mysqli_query($CONNECT, 'SELECT SUM(`one`) AS `ress` FROM `messages` WHERE `topic` = '.$Param[id]);
$Sum = mysqli_fetch_assoc($Suma);
echo '<div id="page" class="container-fluid" style="background-color: #0b111e; border-radius: 6px; box-shadow: 1px 1px 10px #000; padding: 20px;">';

if ($Sum['ress'] == 0) echo '

<nav class="mb-4 navbar navbar-expand-lg" style="box-shadow: 1px 1px 10px #000; style="background-color: ">
<h3 style="color: #fff; text-shadow: 1px 1px 10px #000;">Відповіді відсутні</h3>
<ul class="navbar-nav ml-auto">
<li><button type="button" class="btn btn-sm btn-purple btn-block " style="background-color: #5d0c72" data-toggle="modal" data-target="#messg"><b style="font-size: 120%; text-shadow: 1px 1px 10px #000;"><i class="fa fa-envelope" aria-hidden="true"></i> Відповісти<b></button>
</li></ul></nav>
';

else echo '	<nav class="mb-4 navbar navbar-expand-lg" style="box-shadow: 1px 1px 10px #000; style="background-color: ">

<h3 style="color: #fff; text-shadow: 1px 1px 10px #000;">Відповідей ('.$Sum['ress'].')</h3>
<ul class="navbar-nav ml-auto">
<li><button type="button" class="btn btn-sm btn-purple btn-block " style="background-color: #5d0c72" data-toggle="modal" data-target="#messg"><b style="font-size: 120%; text-shadow: 1px 1px 10px #000;"><i class="fa fa-envelope" aria-hidden="true"></i> Відповісти<b></button>
</li></ul>
</nav>
';
mysqli_query($CONNECT, "UPDATE `forumtopic` SET `messnumber` = '$Sum[ress]' WHERE `id` = $Param[id]");



$Numtop = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT SUM(`active`) AS `numm` FROM `forumtopic` WHERE `id_cat` ='.$_SESSION['cataid']));
mysqli_query($CONNECT,"UPDATE `catagoryforum` SET `topicnumber` = $Numtop[numm] WHERE `id` = $_SESSION[cataid]");

// Загрузка файлів відео картинок



if ($_SESSION['USER_LOGIN_IN'] != 1 and $_SESSION['USER_GROUP'] == -1) {
	$Admin = '  <a href="/messages/control/action/delete/id/'.$Row['id'].'" class="lol">        </a>   <a href="/messages/control/action/edit/id/'.$Row['id'].'" class="lol">          </a>';
	echo '<br><br>Залишати комменатріі можуть тільки зареєстровані користувачі.';}
else echo '





<div class="modal fade" id="messg" tabindex="-1" role="dialog" aria-labelledby="messg" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" style="background-color: #1a263c;">
				<div class="modal-header">
					<h1 class="modal-title" style="color: #8e24aa" id="messg">Панель відправки повідомлення</h1>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<form method="POST" action="/messages/add" enctype="multipart/form-data">
				<div class="modal-body">
				
				
				<textarea class="form-control" style="background-color: #1a294a; height: 150px; color: #fff" rows="2" name="text" placeholder="Текст повідомлення" required></textarea>
				<h3 style="text-shadow: 1px 1px 10px #000; color: #fff; padding-bottom: 20px">Прикріпити</h3>
			
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
											<input type="file" name="img" class="custom-file-input" style="cursor: pointer;" id="customFile">
											<label class="custom-file-label" style="background-color: #5d0c73; color: #fff;" for="customFile">Виберіть зображення у форматі JPG</label>
										  </div>
							</div>
							<div id="menu1" class="container tab-pane fade"><br>
											<div class="custom-file">
											<input type="file" name="video" class="custom-file-input" style="cursor: pointer;" id="customFile">
											<label class="custom-file-label" style="background-color: #5d0c73; color: #fff;" for="customFile">Виберіть відео у форматі MP4</label>
										  </div>
							</div>
							<div id="menu2" class="container tab-pane fade"><br>
											<div class="custom-file">
											<input type="file" name="file" class="custom-file-input" style="cursor: pointer;" id="customFile">
											<label class="custom-file-label" style="background-color: #5d0c73; color: #fff;" for="customFile">Виберіть архів у форматі RAR</label>
										  </div>
							</div>
						  </div>
						    
				<br>
				</div>
				<div class="modal-footer">
	
	
	
	
	
	
				<button class="btn btn-md btn-secondary" data-dismiss="modal">Закрити</button>
				<input type="reset" class="btn btn-md btn-purple" value="Очистити">
				<input type="submit" name="enter" class="btn btn-md btn-purple" value="Надіслати">
				</div> </form>
			</div>
		</div>
</div>



';



echo'<head><link href="/resource/messages.css" rel="stylesheet"></head>';

$Count = mysqli_fetch_row(mysqli_query($CONNECT, 'SELECT COUNT(`id`) FROM `messages` WHERE `topic` = '.$Param['id']));












if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, 'SELECT * FROM `messages` WHERE `topic` = '.$Param['id'].' ORDER BY `id` DESC LIMIT 0, 9');

} else {
$Start = ($Param['page'] - 1) * 9;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, 'SELECT * FROM `messages` WHERE `topic` = '.$Param['id'].'  ORDER BY `id` DESC LIMIT START, 9'));

}
PageSelector("/forummain/material/id/$Param[id]/page/", $Param['page'], $Count);












while ($Row = mysqli_fetch_assoc($Result)) {
	
	
session_start();
$_SESSION['ID_MESS'] = $Row['id'];	

	
	
	
	
	
	
	
	
if ($_SESSION['USER_GROUP'] == 2 or $_SESSION['USER_GROUP'] == 1) 
{$Admin = ' | <a href="/messages/control/action/delete/id/'.$Row['id'].'" class="lol" style="color: #5d0c73"><i class="fa fa-trash" aria-hidden="true"></i> Видалити</a> | <a style="color: #74198d;" href="/messages/update/action/edit/id/'.$Row['id'].'#txt'.$Row['id'].'" class="lol"><i class="fa fa-edit"></i> Редагувати</a> ';}






echo '<div class="modal fade" id="resd" tabindex="-1" role="dialog" aria-labelledby="resd" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" style="background-color: #1a263c;">
				<div class="modal-header">
					<h1 class="modal-title" style="color: #8e24aa" id="resd">Вхід у свій профіль</h1>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<form method="POST" action="/account/login">
				<div class="modal-body">
				<input type="text" class="form-control" id="name-field" style="width: 97%" name="login" placeholder="Логін" maxlength="10" pattern="[A-Za-z-0-9]{3,20}" title="Не менш 3 і небільше 20 латинській символів або цифр." required>
				<input type="password" class="form-control" id="name-field" style="width: 97%" name="password" placeholder="Пароль" maxlength="15" pattern="[A-Za-z-0-9]{5,15}" title="Не менше 5 і небільше 15 латинській символів або цифр." required>
				<input type="text" class="form-control" id="name-field" style="width: 50%" name="captcha" placeholder="Капча" maxlength="10" pattern="[0-9]{1,5}" title="Тільки цифри." required><img src="/resource/captcha.php" class="capimg" alt="Каптча">
				<br><div style="margin-left: 22px"><input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1" ><h6 style="color: #9600c7;"><b>Запам`ятати мене</b></h6></div>
				</div>
				<div class="modal-footer">
				<button class="btn btn-md btn-secondary" data-dismiss="modal">Закрити</button>
				<input type="reset" class="btn btn-md btn-purple" value="Очистити">
				<input type="submit" name="logenter" class="btn btn-md btn-purple" value="Вхід">
				</div></form>
			</div>
		</div>
</div>';


/*echo '
<div class="modal fade" id="redag" tabindex="-1" role="dialog" aria-labelledby="redag" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" style="background-color: #1a263c;">
				<div class="modal-header">
					<h1 class="modal-title" style="color: #8e24aa" id="redag">Панель релагування повідомлення</h1>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
				
				'.$Row['text'].'= <form method="POST" action="/messages/update">
				<div class="col-md-12"><div class="panel"><div class="panel-body">
				<textarea class="form-control" style="background-color: #642a86; color: #fff; height: 150px;" rows="2" name="text" placeholder="Текст повідомлення" required>'.$Row['text'].'</textarea></div>
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
  <br>
				
				
				
				
				<div class="modal-footer">
				<button class="btn btn-md btn-secondary" data-dismiss="modal">Закрити</button>
				<input type="reset" class="btn btn-md btn-purple" value="Вернути назад">
				
				<input type="submit" name="save" class="btn btn-md btn-purple" value="Зберегти">
				</div></div></div></form></div>
			</div>
		</div>
</div>
';



*/






if ($Row['id'] == $_SESSION['COMMENTS_EDIT']) {

$Row['text'] = '<form method="POST" action="/messages/update">
<div id="txt" style="margin-left: 89px">
<textarea class="form-control" style="background-color: #1a294a; color: #fff; height: 150px" rows="2" name="text" placeholder="Текст повідомлення" required>'.$Row['text'].'</textarea><br><input type="submit" name="save" value="Зберегти"> <input type="submit" name="cancel" value="Відмінити">
</div>
</form>';}


//$Re = mysqli_query($CONNECT, "SELECT * FROM `ucomments` WHERE `id_uc` = '$Row[id]'");

	








if ($_SESSION['USER_GROUP'] == 0) {
	if($_SESSION['USER_STORIS'] == 1) $Admin = '  <a href="/messages/control/action/delete/id/'.$Row['id'].'" class="lol">        </a>   <a href="/messages/control/action/edit/id/'.$Row['id'].'" class="lol">          </a> <a href="/messages/control/action/editm/id/'.$Row['id'].'" class="lol">Відправити</a>';
	if($_SESSION['USER_STORIS'] == 0) $Admin = '  <a href="/messages/control/action/delete/id/'.$Row['id'].'" class="lol">        </a>   <a href="/messages/control/action/edit/id/'.$Row['id'].'" class="lol">          </a> <a href="/messages/control/action/editm/id/'.$Row['id'].'" class="lol"> </a>';
	}
if ($_SESSION['USER_GROUP'] == -1) $Admin = '  <a href="/messages/control/action/delete/id/'.$Row['id'].'" class="lol">        </a>   <a href="/messages/control/action/edit/id/'.$Row['id'].'" class="lol">          </a>';

















echo '
<hr id="txt'.$Row['id'].'" style="border: 1px solid #5d0c72; margin-top: 30px">

 <div class="panel-body">
 <!-- Содержание Новостей -->
 <!--===================================================-->
 <div class="media-block">
 <a class="media-left" href="/user/'.$Row['added'].'"><img class="img-circle img-sm" style="border-radius: 25% 10%;" height="60" src="/resource/avatar/'.$Row['id_user'].'.jpg"></a> 
 
 <div class="btn-group" style="padding-left: 20px">
 <a class="btn btn-sm btn-default btn-hover-success" href="/messages/ratemessages/rate/plus/id/'.$Row['id'].'" style="background-color: #59176b;"><i class="fa fa-thumbs-up"></i></a>
 <a class="btn btn-sm" href="#" style="background-color: #59176b; ">'.$Row['rate'].'</a>
 <a class="btn btn-sm btn-default btn-hover-danger" href="/messages/ratemessages/rate/minus/id/'.$Row['id'].'" style="background-color: #59176b;"><i class="fa fa-thumbs-down"></i></a>
 </div>
 
 <div class="media-body" style="font-size: 90%">
 <div class="mar-btm" style="padding-left: 87px">
 <a href="/user/'.$Row['added'].'">'.$Row['added'].'</a>
 <p class="text-muted text-sm"style="font-size: 90%;"><i class="fa fa-clock-o"></i> - '.$Row['date'].'</p>
 </div>';
 
 
 
 if ($Row['activecom'] == 1) {echo '
	
	
	
	
	<div style="margin-left: 90px; margin-bottom: 20px;"><div class="container-fluid" style="background-color: #290a31;
	border: 5px solid #3c154d; border-left: 20px solid #3c154d;">
	<p style="font-size: 90%">Цитата від <a href="/user/'.$Row['himm'].'">'.$Row['himm'].'</a></p>
	<hr style="border: 1px solid #000"><i class="fa fa-quote-left" style="color: #fff"></i>';
	
	
	
		if ($Row['imghim'] != 0){
echo '

<div class="panel panel-default" id="collapseTwomhh'.$Row['id'].'_container" style="box-shadow: 1px 1px 10px #000; margin-left: 89px;">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title" style="padding-bottom: 10px; padding-top: 5px; padding-left: 10px;">
          <a role="button" 
             data-toggle="collapse" 
             data-parent="#accordion" 
			 style="color: #fff; text-shadow: 1px 1px 10px #000;"
             href="#collapseTwomhh'.$Row['id'].'" 
             aria-expanded="true" 
             aria-controls="collapseTwomhh'.$Row['id'].'">
           <i class="fa fa-picture-o" aria-hidden="true"></i>  Зображення
          </a>
        </h4>
                  </div>
                  <div id="collapseTwomhh'.$Row['id'].'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
						<div class="text-center">
						<img src="/catalog/img/forummessages/'.$Row['imghim'].'/'.$Row['uuid'].'.jpg" class="img-fluid" height="422" width="750" alt="Responsive image">
						 </div> 
                    </div>
                  </div>
                </div>

<br>';}





if ($Row['videohim'] != 0)  {
	
	echo '
<div class="panel panel-default" id="collapseOnemhhh'.$Row['id'].'_container" style="box-shadow: 1px 1px 10px #000; margin-left: 89px;">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title" style="padding-bottom: 10px; padding-top: 5px; padding-left: 10px;">
          <a role="button" 
             data-toggle="collapse" 
             data-parent="#accordion" 
			 style="color: #fff; text-shadow: 1px 1px 10px #000;"
             href="#collapseOnemhhh'.$Row['id'].'" 
             aria-expanded="true" 
             aria-controls="collapseOnemhhh'.$Row['id'].'">
           <i class="fa fa-youtube-play" aria-hidden="true"></i>  Відео
          </a>
        </h4>
                  </div>
                  <div id="collapseOnemhhh'.$Row['id'].'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
					
						  <div class="col col-lg-5" style=" padding: 5px; margin-left: auto; margin-right: auto;">
							  <div class="embed-responsive embed-responsive-16by9">
								<video src="/catalog/video/forummessages/'.$Row['videohim'].'/'.$Row['uuid'].'.mp4" controls loop></video>
							  </div>
						  </div>
                    </div>
                  </div>
                </div>
<br>

';}




if ($Row['filehim'] != 0)  { echo '




<div class="panel panel-default" id="collapseTreemh'.$Row['id'].'_container" style="box-shadow: 1px 1px 10px #000; margin-left: 89px;">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title" style="padding-bottom: 10px; padding-top: 5px; padding-left: 10px;">
          <a role="button" 
             data-toggle="collapse" 
             data-parent="#accordion" 
			 style="color: #fff; text-shadow: 1px 1px 10px #000;"
             href="#collapseTreemh'.$Row['id'].'" 
             aria-expanded="true" 
             aria-controls="collapseTreemh'.$Row['id'].'">
           <i class="fa fa-file-archive-o" aria-hidden="true"></i>  Архів
          </a>
        </h4>
                  </div>
                  <div id="collapseTreemh'.$Row['id'].'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
					<b style="padding: 10px; color: #fff; text-shadow: 1px 1px 10px #000;">Завантажили: '.$Row['download'].'</b>
						<div class="text-center" style="padding: 20px">
						<img src="/resource/img/rar.png" class="rounded mx-auto d-block" height="100" alt="Responsive image">
						<a href="/forummessages/download/id/'.$Row['uuid'].'" class="lol" style="font-size: 120%">'.$Row['uuid'].'.rar</a>
						 </div> 
                    </div>
                  </div>
                </div>

<br>';}

	
	
	
	
	echo '<hr style="border: 1px solid #000"><p style="font-size: 85%; text-shadow: 1px 1px 10px #000;">'.$Row['texthim'].'</p>
	
	
	</div></div>
	
	';
	
	
	

	
	}

 
 
 
 

if ($Row['image'] != 0){
echo '
<div class="panel panel-default" id="collapseTwom'.$Row['id'].'_container" style="box-shadow: 1px 1px 10px #000; margin-left: 89px;">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title" style="padding-bottom: 10px; padding-top: 5px; padding-left: 10px;">
          <a role="button" 
             data-toggle="collapse" 
             data-parent="#accordion" 
			 style="color: #fff; text-shadow: 1px 1px 10px #000;"
             href="#collapseTwom'.$Row['id'].'" 
             aria-expanded="true" 
             aria-controls="collapseTwom'.$Row['id'].'">
           <i class="fa fa-picture-o" aria-hidden="true"></i>  Зображення
          </a>
        </h4>
                  </div>
                  <div id="collapseTwom'.$Row['id'].'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
						<div class="text-center">
						<img src="/catalog/img/forummessages/'.$Row['image'].'/'.$Row['id'].'.jpg" class="img-fluid" height="422" width="750" alt="Responsive image">
						 </div> 
                    </div>
                  </div>
                </div>

<br>';}





if ($Row['video'] != 0)  {
	
	echo '
<div class="panel panel-default" id="collapseOnem'.$Row['id'].'_container" style="box-shadow: 1px 1px 10px #000; margin-left: 89px;">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title" style="padding-bottom: 10px; padding-top: 5px; padding-left: 10px;">
          <a role="button" 
             data-toggle="collapse" 
             data-parent="#accordion" 
			 style="color: #fff; text-shadow: 1px 1px 10px #000;"
             href="#collapseOnem'.$Row['id'].'" 
             aria-expanded="true" 
             aria-controls="collapseOnem'.$Row['id'].'">
           <i class="fa fa-youtube-play" aria-hidden="true"></i>  Відео
          </a>
        </h4>
                  </div>
                  <div id="collapseOnem'.$Row['id'].'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
					
						  <div class="col col-lg-5" style=" padding: 5px; margin-left: auto; margin-right: auto;">
							  <div class="embed-responsive embed-responsive-16by9">
								<video src="/catalog/video/forummessages/'.$Row['video'].'/'.$Row['id'].'.mp4" controls loop></video>
							  </div>
						  </div>
                    </div>
                  </div>
                </div>
<br>

';}




if ($Row['file'] != 0)  {echo'





<div class="panel panel-default" id="collapseTreem'.$Row['id'].'_container" style="box-shadow: 1px 1px 10px #000; margin-left: 89px;">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title" style="padding-bottom: 10px; padding-top: 5px; padding-left: 10px;">
          <a role="button" 
             data-toggle="collapse" 
             data-parent="#accordion" 
			 style="color: #fff; text-shadow: 1px 1px 10px #000;"
             href="#collapseTreem'.$Row['id'].'" 
             aria-expanded="true" 
             aria-controls="collapseTreem'.$Row['id'].'">
           <i class="fa fa-file-archive-o" aria-hidden="true"></i>  Архів
          </a>
        </h4>
                  </div>
                  <div id="collapseTreem'.$Row['id'].'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
					<b style="padding: 10px; color: #fff; text-shadow: 1px 1px 10px #000;">Завантажили: '.$Row['download'].'</b>
						<div class="text-center" style="padding: 20px">
						<img src="/resource/img/rar.png" class="rounded mx-auto d-block" height="100" alt="Responsive image">
						<a href="/messages/download/id/'.$Row['id'].'" class="lol" style="font-size: 120%">'.$Row['id'].'.rar</a>
						 </div> 
                    </div>
                  </div>
                </div>

<br>';}





 echo '
 
 <p style="font-size: 100%; margin-left: 89px; overflow-x:hidden;">'.$Row['text'].'</p>';
 
 
 
 echo '<div class="pad-ver" style="margin-top: 30px">

 <a href="/messages/control/action/editm/id/'.$Row['id'].'#txt'.$Row['id'].'" style="color: #74198d; padding-left: 90px"><i class="fa fa-reply" aria-hidden="true"></i> Відповісти</a>
<span> '.$Admin.'</span>
 </div>
 <hr></div>
 ';
 
 
  if ($Row['id'] == $_SESSION['COMMENTS_EDITM']) {
	
echo '<br>
<div style="margin-left: 89px">
<br/>
<form method="POST" action="/messages/enter/id/'.$Param['id'].'">
<textarea class="form-control" style="background-color: #1a294a; height: 150px; color: #fff" rows="2" name="textcontrol" class="form-control" placeholder="Текст повідомлення"></textarea>
<br>
<input type="submit" name="enterm" value="Надіслати"> <input type="reset" value="Очистити"> <input type="submit" name="cancel" value="Відмовити"></form></div>

';}
 
 
echo '</div>';



}
//href="/messages/control/action/editm/id/'.$Row['id'].'"   ---    'Відповісти'
$_SESSION['COM_UID'] = $Row['uuid'];
$_SESSION['COM_ID'] = $Row['id'];
}
echo '</div>'
?>
</html>