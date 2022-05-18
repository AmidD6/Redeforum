<?php 
UAccess(2);
$Query = mysqli_query($CONNECT, 'SELECT `login`, `regdate`, `group` FROM `users` WHERE `group`!=2 ORDER BY `regdate` DESC');
while ($Row = mysqli_fetch_assoc($Query)) $INFO1 .= '<div class="ChatBlock"><span>Дата реєстрації: '.$Row['regdate'].'</span>'.UserGroup($Row['group']).': '.$Row['login'].'</div>';

$Query = mysqli_query($CONNECT, 'SELECT `id`, `text`, `date`, `added` FROM `comments` ORDER BY `date`');
while ($Row = mysqli_fetch_assoc($Query)) $INFO2 .= '<div class="ChatBlock"><span>Логін: <a href="/user/'.$Row['added'].'">'.$Row['added'].'</a> | Дата: '.$Row['date'].' | <a href="/admin/query/com_delete/'.$Row['id'].'" class="lol">Удалить</a></span>'.$Row['text'].'</div>';


Head('Адмін панель');
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

     
   
    <link rel="stylesheet" href="/resource/style5.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>


</head>

<body style="background-color: #fff">

    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
               <img class="img-fluid" src="/resource/img/panel.png">
            </div>

            <ul class="list-unstyled components">
                <p><i class="fa fa-cog" aria-hidden="true"></i> Адмін панель</p>
			
				 <li class="active">
                    <a href="/admin">Користувачі</a>
                </li>
				
				 <li>
                    <a href="/admin/userspisok">Модерація</a>
                </li>
				
                <li>
                    <a href="#">Скарги</a>
                </li>
				
				
            
				<li>
                    <a href="#">Розділи</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Форум</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Список каталогів</a>
                        </li>
                        <li>
                            <a href="#">Список тем</a>
                        </li>
                        <li>
                            <a href="#">Список повідомлень</a>
                        </li>
						
						
                    </ul>
                </li>
				
				<li>
                    <a href="#pageSubme" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Новини</a>
                    <ul class="collapse list-unstyled" id="pageSubme">
                        <li>
                            <a href="#">Список новин</a>
                        </li>
                        <li>
                            <a href="#">Список коментарів</a>
                        </li>
                        
                    </ul>
                </li>
				
				<li>
                    <a href="#pageSubm" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Блог</a>
                    <ul class="collapse list-unstyled" id="pageSubm">
                        <li>
                            <a href="#">Список блога</a>
                        </li>
                        <li>
                            <a href="#">Список коментарів</a>
                        </li>
                       
                    </ul>
                </li>
				
		
            </ul>

            <ul class="list-unstyled CTAs">
              
                <li>
                    <a href="/" class="article">Вийти із адмін панеля</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    
<img height="50" src="/resource/img/logoadmin.png">
                    
                </div>
            </nav>
            
<?php


?>

 <ul class="nav nav-tabs nav-justified">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" style="color: #000;" href="#home">Усі</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab"  style="color: #000;" href="#menu1">Користувачі</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab"  style="color: #000;" href="#menu2">Модератори</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" data-toggle="tab"  style="color: #000;" href="#menu3">Заблоковані</a>
    </li>
  </ul>



  <div class="tab-content">
    <div id="home" class="container-fluid tab-pane active"><br>
	<form method="post" action="">
	<div class="md-form mt-0">
  <input class="form-control" type="text" name="text" placeholder="Пошук" aria-label="Search">
  <button type="submit" name="user1" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
  <button type="resest" class="btn btn-primary"><i class="fa fa-times" aria-hidden="true"></i></button>
</div>
	</form>
	<form method="POST" action="/admin/query">
<input style="width: 210px;" type="text" name="login" placeholder="Логін користувачів" required>
<select size="1" style="width: auto" name="group" class="custom-select"><option value="0">Користувач</option><option value="1">Модератор</option><option value="-1">Заблокований</option></select>
<button type="submit" name="change_group" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i></button>
</form>
	
			<table class="table">
  <thead class="thead bg-primary">
    <tr>
      <th scope="col"><b>ID номер</b></th>
      <th scope="col"><b>Логін</b></th>
      
      <th scope="col"><b>Ім`я</b></th>
	  <th scope="col"><b>Почта</b></th>
	  <th scope="col"><b>Дата реєстрації</b></th>
	  <th scope="col"><b>Статус</b></th>
    </tr>
  </thead>
  <tbody>
<?php
if(isset($_POST['user1'])) {
	$_SESSION['SEARCH'] = FormChars($_POST['text']);
	$user = mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `login` LIKE '%$_SESSION[SEARCH]%' AND `group` != 2");
}
else $user = mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `group` != 2");

if (mysqli_num_rows($user)){
while ($Users = mysqli_fetch_assoc($user)) {
    echo '
	<tr>
      <th scope="row">'.$Users['id'].'</th>
      <td>'.$Users['login'].'</td>

      <td>'.$Users['name'].'</td>
	  <td>'.$Users['email'].'</td>
	  <td>'.$Users['regdate'].'</td>
	  <td>'.UserGroup($Users['group']).'</td>

';
}}
else echo '<tr><td>Нічого не знайдено</td></tr>';
?>
  </tbody>
</table>
	
	
	<!--<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
</table>-->

	
    </div>
	
	
	
    <div id="menu1" class="container-fluid tab-pane fade"><br>
	
	<form method="post" action="">
	<div class="md-form mt-0">
  <input class="form-control" type="text" name="text2" placeholder="Пошук" aria-label="Search">
  <button type="submit" name="user2" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
  <button type="resest" class="btn btn-primary"><i class="fa fa-times" aria-hidden="true"></i></button>
</div>
	</form>
		<form method="POST" action="/admin/query">
<input style="width: 210px;" type="text" name="login" placeholder="Логін користувачів" required>
<select size="1" style="width: auto" name="group" class="custom-select"><option value="0">Користувач</option><option value="1">Модератор</option><option value="-1">Заблокований</option></select>
<button type="submit" name="change_group" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i></button>
</form>
				<table class="table">
  <thead class="thead bg-primary">
    <tr>
      <th scope="col"><b>ID номер</b></th>
      <th scope="col"><b>Логін</th>
     
      <th scope="col"><b>Ім`я</b></th>
	  <th scope="col"><b>Почта</b></th>
	  <th scope="col"><b>Дата реєстрації</b></th>
	  <th scope="col"><b>Статус</b></th>
    </tr>
  </thead>
  <tbody>
	
<?php
if(isset($_POST['user2'])) {
	$pp = FormChars($_POST['text2']);
	$user111 = mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `login` LIKE '%$pp%' AND `group` != 2 AND `group` = 0");
}
else $user111 = mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `group` != 2 AND `group` = 0");


if (mysqli_num_rows($user111)){
while ($Users11 = mysqli_fetch_assoc($user111)) {
    echo '
	<tr>
      <th scope="row">'.$Users11['id'].'</th>
      <td>'.$Users11['login'].'</td>

      <td>'.$Users11['name'].'</td>
	  <td>'.$Users11['email'].'</td>
	  <td>'.$Users11['regdate'].'</td>
	  <td>'.UserGroup($Users11['group']).'</td>
    </tr>

';
}}
else echo '<tr><td>Нічого не знайдено</td></tr>';
?>	
 </tbody>	
</table>
    </div>
	
	
    <div id="menu2" class="container-fluid tab-pane fade"><br>
				
	<form method="post" action="">
	<div class="md-form mt-0">
  <input class="form-control" type="text" name="text3" placeholder="Пошук" aria-label="Search">
  <button type="submit" name="user3" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
  <button type="resest" class="btn btn-primary"><i class="fa fa-times" aria-hidden="true"></i></button>
</div>
	</form>
		<form method="POST" action="/admin/query">
<input style="width: 210px;" type="text" name="login" placeholder="Логін користувачів" required>
<select size="1" style="width: auto" name="group" class="custom-select"><option value="0">Користувач</option><option value="1">Модератор</option><option value="-1">Заблокований</option></select>
<button type="submit" name="change_group" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i></button>
</form>
	
			<table class="table">
  <thead class="thead bg-primary">
    <tr>
      <th scope="col"><b>ID номер</b></th>
      <th scope="col"><b>Логін</b></th>
      
      <th scope="col"><b>Ім`я</b></th>
	  <th scope="col"><b>Почта</b></th>
	  <th scope="col"><b>Дата реєстрації</b></th>
	  <th scope="col"><b>Статус</b></th>
    </tr>
  </thead>
  <tbody>
<?php
if(isset($_POST['user3'])) {
	$ppp = FormChars($_POST['text3']);
	$user3 = mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `login` LIKE '%$ppp%' AND `group` != 2 AND `group` = 1");
}
else $user3 = mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `group` != 2 AND `group` = 1");


if (mysqli_num_rows($user3)){
while ($Users3 = mysqli_fetch_assoc($user3)) {
    echo '
	<tr>
      <th scope="row">'.$Users3['id'].'</th>
      <td>'.$Users3['login'].'</td>

      <td>'.$Users3['name'].'</td>
	  <td>'.$Users3['email'].'</td>
	  <td>'.$Users3['regdate'].'</td>
	  <td>'.UserGroup($Users3['group']).'</td>
    </tr>

';
}}
else echo '<tr><td>Нічого не знайдено</td></tr>';
?>
 </tbody>	
</table>

				
    </div>
	
	  <div id="menu3" class="container-fluid tab-pane fade"><br>
				
	<form method="post" action="">
	<div class="md-form mt-0">
  <input class="form-control" type="text" name="text4" placeholder="Пошук" aria-label="Search">
  <button type="submit" name="user4" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
  <button type="resest" class="btn btn-primary"><i class="fa fa-times" aria-hidden="true"></i></button>
</div>
	</form>
		<form method="POST" action="/admin/query">
<input style="width: 210px;" type="text" name="login" placeholder="Логін користувачів" required>
<select size="1" style="width: auto" name="group" class="custom-select"><option value="0">Користувач</option><option value="1">Модератор</option><option value="-1">Заблокований</option></select>
<button type="submit" name="change_group" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i></button>
</form>
	
			<table class="table">
  <thead class="thead bg-primary">
    <tr>
      <th scope="col"><b>ID номер</b></th>
      <th scope="col"><b>Логін</b></th>
      
      <th scope="col"><b>Ім`я</b></th>
	  <th scope="col"><b>Почта</b></th>
	  <th scope="col"><b>Дата реєстрації</b></th>
	  <th scope="col"><b>Статус</b></th>
    </tr>
  </thead>
  <tbody>
<?php
if(isset($_POST['user4'])) {
	$ppppp = FormChars($_POST['text4']);
	$user4 = mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `login` LIKE '%$ppppp%' AND `group` != 2 AND `group` = -1");
}
else $user4 = mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `group` != 2 AND `group` = -1");


if (mysqli_num_rows($user4)){
while ($Users4 = mysqli_fetch_assoc($user4)) {
    echo '
	<tr>
      <th scope="row">'.$Users4['id'].'</th>
      <td>'.$Users4['login'].'</td>

      <td>'.$Users4['name'].'</td>
	  <td>'.$Users4['email'].'</td>
	  <td>'.$Users4['regdate'].'</td>
	  <td>'.UserGroup($Users4['group']).'</td>
    </tr>

';
}}
else echo '<tr><td>Нічого не знайдено</td></tr>';
?>		
 </tbody>	
</table>

				
    </div>
	
  </div>






	   </div>
    </div>

    
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
</body>

</html>