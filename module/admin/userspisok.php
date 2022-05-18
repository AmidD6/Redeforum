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
			
				 <li>
                    <a href="/admin">Користувачі</a>
                </li>
				
				 <li class="active">
                    <a href="/admin/userspisok">Модерація</a>
                </li>
				
                <li>
                    <a href="#">Скарга</a>
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
           
		   
		   
		   
 <ul class="nav nav-tabs nav-justified">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" style="color: #000;" href="#home">Каталоги</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab"  style="color: #000;" href="#menu1">Теми</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab"  style="color: #000;" href="#menu2">Новини</a>
    </li>
	
  </ul>



  <div class="tab-content">
    <div id="home" class="container-fluid tab-pane active"><br>

	
	
	
	<table class="table">
  <thead class="thead bg-primary">
    <tr>
      <th scope="col"></th>
      <th scope="col"><b>Назва</b></th>
      <th scope="col"><b>Автор</b></th>
      <th scope="col"><b>Почта</b></th>
	  <th scope="col">    </th>
	  <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php

$cat = mysqli_query($CONNECT, "SELECT * FROM `catagoryforum` WHERE `active` = 0");

if (mysqli_num_rows($cat)){
while ($Cata = mysqli_fetch_assoc($cat)) {
    echo '
	<tr>
      <th scope="row"><i class="fa fa-folder"></i></th>

      <td>'.$Cata['name'].'</td>
	  <td>'.$Cata['author'].'</td>
	  <td>'.$Cata['date'].'</td>';
	  
	  if ($Cata['active'] == 1) echo '<td></td>';
	  else echo '<td><a href="/admin/control/id/'.$Cata['id'].'/command/active" class="lol">Активувати каталог</a></td>
	
';
}}
else echo '<tr><td>Усі каталоги активовані</td></tr>';
?>
  </tbody>
</table>
	
	
	
    </div>
	
	
	
    <div id="menu1" class="container-fluid tab-pane fade"><br>
	
	
		   
		   
		   

				
    </div>
	
	<div id="menu1" class="container-fluid tab-pane fade"><br>
	
	
		   
		   
		   

				
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