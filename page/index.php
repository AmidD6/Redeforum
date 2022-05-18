<?php Head('Redeforum - Головна') ;

$Us = mysqli_query($CONNECT, "SELECT SUM(`active`) AS `one` FROM `users`");
$Users = mysqli_fetch_array($Us);
if(!$Users['one']) $Users['one'] = 0;

$Top = mysqli_query($CONNECT, "SELECT SUM(`active`) AS `two` FROM `forumtopic`");
$Topic = mysqli_fetch_array($Top);
if(!$Topic['two']) $Topic['two'] = 0;

$Mes = mysqli_query($CONNECT, "SELECT SUM(`one`) AS `therd` FROM `messages`");
$Mesm = mysqli_fetch_array($Mes);
if(!$Mesm['therd']) $Mesm['therd'] = 0;

$New = mysqli_query($CONNECT, "SELECT SUM(`active`) AS `hour` FROM `forum`");
$News= mysqli_fetch_array($New);
if(!$News['hour']) $News['hour'] = 0;

$Im = mysqli_query($CONNECT, "SELECT SUM(`active`) AS `five` FROM `loads` WHERE `img_or_video` = 1");
$Image= mysqli_fetch_array($Im);
if(!$Image['five']) $Image['five'] = 0;

$Vid = mysqli_query($CONNECT, "SELECT SUM(`active`) AS `six` FROM `loads` WHERE `img_or_video` = 2");
$Video= mysqli_fetch_array($Vid);
if (!$Video['six']) $Video['six'] = 0;
?>
<body>
<?php Menu($m1);
MessageShow() 
?>

<?php 
/*echo $_SESSION['USER_STORIS'];
$Query = mysqli_query($CONNECT, 'SELECT `id`, `dimg`, `name` FROM `loads` ORDER BY `date` DESC LIMIT 8'); 
while ($Row = mysqli_fetch_assoc($Query)) echo '<a href="/loads/material/id/'.$Row['id'].'"><img src="/catalog/mini/'.$Row['dimg'].'/'.$Row['id'].'.jpg" class="lm" alt="'.$Row['name'].'" title="'.$Row['name'].'"></a>';
*/

?>
<style>

.modal-body p {
	color: #fff;
	font-size: 120%;
}

.modal-body b {
	color: #8e24aa;
}

p {
	text-align: justify;
	text-shadow: 1px 1px 10px #000;
}
b {
	text-shadow: 1px 1px 10px #000;
}







.embed-responsive.embed-responsive-16by9 {
	padding-bottom: 56.25%;
}
 
.embed-responsive.embed-responsive-4by3 {
	padding-bottom: 75%;
}
 
.embed-responsive{
	position: relative;
	display: block;
	height: 0;
	padding: 0;
	overflow: hidden;
	width:100%;
}
 
.embed-responsive .embed-responsive-item, .embed-responsive iframe, .embed-responsive embed, .embed-responsive object{
	position: absolute;
	top: 0;
	bottom: 0;
	left: 0;
	width: 100%;
	height: 100%;
	border: 0;
}


</style>

<header style="margin-top: -24px">
  <div class="overlay"></div>
  <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="/resource/img/mainlogo/main.mp4" type="video/mp4">
  </video>
  <div class="container h-100">
    <div class="d-flex h-100 text-center align-items-center">
      
		<?php  if ($_SESSION['USER_LOGIN_IN'] == 1)	echo'<div class="carousel-caption" style="top: 56%;">
						
								<h1 class="display-3">Ласкаво просимо на Redeforum</h1>
								<!--<h3 class="display-5">ознайомтеся з правилами</h3>-->
								<button type="button" class="btn-outline-light btn-lg " data-toggle="modal" data-target="#regulations" style="">Правила</button>
								<button type="button" class="btn-purple btn-lg" style="background-color: #5d0c73">Допомога</button>
						</div>';
						else echo '
						<div class="carousel-caption" style="top: 56%;">
						
								<h1 class="display-3">Для повного занурення на веб-форум</h1>
								<h3 class="display-5">зареєструйтесь або ввійдіть у власну сторінку</h3>
								<button type="button" class="btn-outline-light btn-lg" data-toggle="modal" data-target="#open">Вхід</button>
								<button type="button" class="btn-purple btn-lg" data-toggle="modal" data-target="#reges">Реєстрація</button>
						</div>
						   
						
						';
      ?>
    </div>
  </div>
</header>




<!--_____Вхід_________-->
<div class="modal fade" id="open" tabindex="-1" role="dialog" aria-labelledby="open" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" style="background-color: #1a263c;">
				<div class="modal-header">
					<h1 class="modal-title" style="color: #8e24aa" id="open">Вхід у свій профіль</h1>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
				<form method="POST" action="/account/login">
				<input type="text" class="form-control" id="name-field" style="width: 97%" name="login" placeholder="Логін" maxlength="10" pattern="[A-Za-z-0-9]{3,20}" title="Не менш 3 і небільше 20 латинській символів або цифр." required>
				<input type="password" class="form-control" id="name-field" style="width: 97%" name="password" placeholder="Пароль" maxlength="15" pattern="[A-Za-z-0-9]{5,15}" title="Не менше 5 і небільше 15 латинській символів або цифр." required>
				<input type="text" class="form-control" id="name-field" style="width: 50%" name="captcha" placeholder="Капча" maxlength="10" pattern="[0-9]{1,5}" title="Тільки цифри." required><img src="/resource/captcha.php" class="capimg" alt="Каптча">
				<br><div style="margin-left: 22px"><input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1" ><h6 style="color: #9600c7;"><b>Запам'ятати мене</b></h6></div>
				</div>
				<div class="modal-footer">
				<a style="color: #fff" href="/restore">Забули пароль?</a>
				<button class="btn btn-md btn-secondary" data-dismiss="modal">Закрити</button>
				<input type="reset" class="btn btn-md btn-purple" value="Очистити">
				<input type="submit" name="logenter" class="btn btn-md btn-purple" value="Вхід">
				</div></form>
			</div>
		</div>
</div>

<!--_____Реєстрація_________-->
<div class="modal fade" id="reges" tabindex="-1" role="dialog" aria-labelledby="reges" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" style="background-color: #1a263c;">
				<div class="modal-header">
					<h1 class="modal-title" style="color: #8e24aa" id="reges">Реєстрація</h1>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
				<form method="POST" action="/account/register">
				<input type="text" class="form-control" id="name-field" style="width: 97%" name="login" placeholder="Логін" maxlength="10" pattern="[A-Za-z-0-9]{3,10}" title="Не менш 3 і небільше 10 латинській символів або цифр.">
				<input type="email" class="form-control" id="name-field" style="width: 97%" name="email" placeholder="Почта" required>
				<input type="password" class="form-control" id="name-field" style="width: 97%" name="password" placeholder="Пароль" maxlength="15" pattern="[A-Za-z-0-9]{5,15}" title="Не менше 5 і небільше 15 латинській символів або цифр." required>
				<input type="text" class="form-control" id="name-field" style="width: 97%" name="name" placeholder="Им`я" maxlength="10" pattern="[\D [^0-9]]{4,10}" title="Будь-який символ окрім цифр." required>
				
				   <select class="browser-default custom-select" style="cursor: pointer;" name="country">
      <option value="0" style="cursor: pointer;" selected>Не скажу</option>
      <option value="1" style="cursor: pointer;">Україна</option>
      <option value="2" style="cursor: pointer;">США</option>
      <option value="3" style="cursor: pointer;">Росія</option>
	  <option value="4" style="cursor: pointer;">Канада</option>
    </select>
				
				<input type="text" class="form-control" id="name-field" style="width: 50%" name="captcha" placeholder="Капча" maxlength="10" pattern="[0-9]{1,5}" title="Тільки цифри" required><img src="/resource/captcha.php" class="capimg" alt="Каптча">

				</div>
				<div class="modal-footer">
				<button class="btn btn-md btn-secondary" data-dismiss="modal">Закрити</button>
				<input type="reset" class="btn btn-md btn-purple" value="Очистити">
				<input type="submit" name="regenter" class="btn btn-md btn-purple" value="Реєстрація">
				</div></form>
			</div>
		</div>
</div>









<!--<div class="carousel slide" data-ride="carousel" id="slides" style="margin-top:-25px;">
<ul class="carousel-indicators">
	<li data-target="#slides" data-slide-to="0" class="active"></li>
	<li data-target="#slides" data-slide-to="1"></li>
	
</ul>
 	<div class="carousel-inner">
		<div class="carousel-item active">
					
						<video class="video_media" src="/resource/img/mainlogo/main.mp4" autoplay muted loop></video>
							<div class="carousel-caption">
						
								<h1 class="display-2">Ласкаво просимо</h1>
								<h3>на веб-форум</h3>
								<button type="button" class="btn-outline-light btn-lg " data-toggle="modal" data-target="#regulations" style="">Правила</button>
								<button type="button" class="btn-purple btn-lg" style="background-color: #5d0c73">Допомога</button>
						</div>
		</div>
		<div class="carousel-item">
						<video  class="video_media" src="/resource/img/mainlogo/space.mp4" autoplay muted loop></video>
						<div class="carousel-caption">
						
								<h1 class="display-2">Spase shooter</h1>
								<h3>на веб-форум</h3>
								<button type="button" class="btn-outline-light btn-lg">Правила гри</button>
								<button type="button" class="btn-danger btn-lg" style="background-color: #ff0000">Грати</button>
						</div>
		</div>
	</div>
</div>-->

 <?php  
echo '
<div class="container-fluid">
	<div class="row text-center padding" style="background-color: #111b2f; box-shadow: 1px 1px 10px #000;; padding-top: 25px;">
	
	<div style="margin-bottom: 50px; width: 100%"></div>
   
                  
	
		<div class="col-xs-12 col-sm-6 col-md-4">
			<img height="120" src="/resource/img/mainlogo/pep.png">
			<div class="benefits__inner">
			<h3 class="benefits__number" style="color: #9200c5; text-shadow: 1px 1px 10px #000; padding-bottom: 50px">'.$Users['one'].'</h3></div>
    
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<img height="120" src="/resource/img/mainlogo/news.png">
			 <div class="benefits__inner">
			<h3 class="benefits__number" style="color: #9200c5; text-shadow: 1px 1px 10px #000; padding-bottom: 50px">'.$News['hour'].'</h3></div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<img height="120" src="/resource/img/mainlogo/topic.png">
			<h3 class="benefits__number" style="color: #9200c5; text-shadow: 1px 1px 10px #000; padding-bottom: 50px">'.$Topic['two'].'</h3>
		</div>
	

	
		<div class="col-xs-12 col-sm-6 col-md-4">
			<img height="120" src="/resource/img/mainlogo/comm.png">
			<h3 class="benefits__number" style="color: #9200c5; text-shadow: 1px 1px 10px #000; padding-bottom: 50px">'.$Mesm['therd'].'</h3>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<img height="120" src="/resource/img/mainlogo/image.png">
			<h3 class="benefits__number" style="color: #9200c5; text-shadow: 1px 1px 10px #000; padding-bottom: 50px">'.$Image['five'].'</h3>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<img height="120" src="/resource/img/mainlogo/video.png">
			<h3 class="benefits__number" style="color: #9200c5; text-shadow: 1px 1px 10px #000; padding-bottom: 50px">'.$Video['six'].'</h3>
																		</div>
		
		</div>
	
		
	
</div>';


?>





<div class="modal fade" id="regulations" tabindex="-1" role="dialog" aria-labelledby="regulations" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" style="background-color: #1a263c;">
				<div class="modal-header">
					<h1 class="modal-title" style="color: #8e24aa" id="regulations">Правила форума</h1>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
				<b><span style="margin-left: 10px;">1. Загальні положення.</span></b>
<p><span style="margin-left: 50px;">1.</span> Форум призначений для обговорення питань IT-тематики і суміжних з нею. Обговорення політичних тем заборонено.</p>
<p><span style="margin-left: 50px;">2.</span> Кожен користувач погоджується з цими Правилами фактом реєстрації на форумі і участі в ньому. Незнання Правил не звільняє від відповідальності.</p>
<p><span style="margin-left: 50px;">3.</span> Якщо користувач відмовляється дотримуватися цих Правил, то він повинен або самостійно покинути форум, або його аккаунт буде заблокований.</p>
<p><span style="margin-left: 50px;">4.</span> Офіційними мовами форуму є українська та англійська мови. Розміщення повідомлень на інших мовах заборонено.</p>
<p><span style="margin-left: 50px;">5.</span> Адміністрація форуму не несе відповідальності за використання розміщеної користувачами або рекламодавцями інформації.</p>
<p><span style="margin-left: 50px;">6.</span> Дія Правил поширюється на весь форум, включаючи блоги, особисті повідомлення, а також на всіх його учасників.</p>
<p><span style="margin-left: 50px;">7.</span> Справжній форум є приватним ресурсом, тому Адміністрація форуму має виняткове право визначення політики щодо користувачів, їх обов'язків, правил поведінки і публікується ними контенту, а також має право відмовити в публікації і / або присутності на форумі кому б то не було.</p>
<p><span style="margin-left: 50px;">8.</span> Ці Правила можуть бути змінені адміністрацією форуму без повідомлення користувачів.</p>
<b><span style="margin-left: 10px;">2. Політика щодо користувачів і публікується ними контенту.</span></b>
<p><span style="margin-left: 50px;">1.</span> Ці Правила поширюються на всіх користувачів і весь контент, що публікується ними на форумі.</p>
<p><span style="margin-left: 50px;">2.</span> Акаунти користувачів форуму не видаляються.</p>
<p><span style="margin-left: 50px;">3.</span> Повідомлення і теми, а також інший контент, що розміщується на форумі, на прохання користувачів не видаляється і не закривається.</p>
<p><span style="margin-left: 50px;">4.</span>Теми, повідомлення і будь-який інший контент, розміщений на форумі, може бути відредагований або видалений Адміністрацією форуму без повідомлення їх автора.</p>
<b><span style="margin-left: 10px;">3. Правила поведінки на форумі.</span></b>
<p><span style="margin-left: 50px;">1.</span> Шанобливо ставитеся до інших учасників форуму.</p>
<p><span style="margin-left: 50px;">2.</span> Чи не втягуйтеся в конфлікти між користувачами: в цьому випадку Ви станете їх учасником і понесете рівну відповідальність з призвідниками конфлікту.</p>
<p><span style="margin-left: 50px;">3.</span> Не надсилайте інших користувачів в пошук і уникайте посилань на пошукові системи (Google, Yandex та ін.). Самостійно знайдіть відповідь на питання і розмістіть його на форумі.</p>
<p><span style="margin-left: 50px;">4.</span> Уникайте використання занадто великої кількості смайлів у повідомленнях в тематичних розділах форуму, а також "кричущого" виділення тексту, в тому числі CAPS LOCK.</p>
<p><span style="margin-left: 50px;">5.</span> Написання повідомлень латиницею слід застосовувати, тільки якщо немає ніякої можливості набирати текст в російськомовній розкладці.</p>
<p><span style="margin-left: 50px;">6.</span> Якщо який-небудь пост на форумі здався вам корисним, то ви можете висловити свою подяку, натиснувши кнопку "Дякую" внизу самого поста.</p>
<b><span style="margin-left: 10px;">4. Порядок створення тем.</span></b>
<p><span style="margin-left: 50px;">1.</span> Перш ніж поставити питання, скористайтеся пошуком - можливо, відповідь на нього вже було дано раніше.</p>
<p><span style="margin-left: 50px;">2.</span> Якщо збираєтеся створити нову тему, визначитеся з розділом або існуючої темою, в якій ведеться обговорення цього питання.</p>
<p><span style="margin-left: 50px;">3.</span> Створюйте теми з осмисленими і зрозумілими назвами - це серйозно підвищує шанси, що на ваше запитання дадуть відповідь.</p>
<p><span style="margin-left: 50px;">4.</span> На кожне питання створюйте по одній темі - це допомагає уникнути плутанини у відповідях і полегшує пошук.</p>
<p><span style="margin-left: 50px;">5.</span> Не варто очікувати, що на ваше запитання дадуть відповідь моментально. Відповідь може бути дано як відразу, так і через деякий час.</p>
<p><span style="margin-left: 50px;">6.</span> Обговорення питань - тільки в темі на форумі. Запрошення до обговорення ще де-небудь (в тому числі і за допомогою системи особистих повідомлень) заборонені, за винятком комерційних розділів.</p>
<p><span style="margin-left: 50px;">7.</span> Як можна більш повно описувати суть проблеми або питання, що було зроблено для її вирішення і які результати отримані.</p>
<p><span style="margin-left: 50px;">8.</span> Уникайте граматичних помилок при написанні повідомлень - поважайте себе та інших учасників форуму.</p>
<p><span style="margin-left: 50px;">9.</span> Використовуйте теги форматування тексту і редактор формул для зручності сприйняття ваших повідомлень іншими користувачами.</p>
<p><span style="margin-left: 50px;">10.</span> Якщо питання було вирішене вами самостійно, відпишіть про це в своїй темі - є й інші люди, які зіткнуться з тією ж проблемою, і їм допоможе ваш відповідь.</p>
<p><span style="margin-left: 50px;">11.</span> Картинки і будь-які інші файли завантажуйте на форум, щоб уникнути їх видалення або втрати на сторонніх ресурсах. З цієї ж причини коди програм також повинні перебувати на форумі.</p>
<p><span style="margin-left: 50px;">12.</span> Не варто просити або пропонувати вислати відповідь в icq, e-mail і інші засоби спілкування. Це прохання все одно не буде виконана, а повідомлення буде змінено модератором.</p>
<p><span style="margin-left: 50px;">13.</span> Якщо на ваше запитання довгий час немає відповіді, уточніть його, приведіть додаткові відомості, які можуть допомогти учасникам форуму вирішити вашу проблему.</p>
<p><span style="margin-left: 50px;">14.</span> Чтобы "поднять" тему в разделе и поиске по форуму, используйте осмысленные сообщения, например "Тема/проблема/задача актуальна". Если вы чего-то достигли в решении проблемы на этот момент, сообщите об этом.</p>
<b><span style="margin-left: 10px;">5. Заборони та обмеження.</span></b>
<p><span style="margin-left: 50px;">1.</span> Заборонено розміщувати і обговорювати інформацію, яка суперечить законодавству Російської Федерації, в тому числі що приводить до міжнаціональної ворожнечі і нетерпимості, а також матеріали еротичного змісту.</p>
<p><span style="margin-left: 50px;">2.</span> Заборонено використовувати нецензурні вирази в будь-якому вигляді, ображати інших учасників форуму, навмисне використовувати вирази, що суперечать правилам російської мови, в тому числі "олбанский" мову.</p>
<p><span style="margin-left: 50px;">3.</span> Заборонено розміщувати будь-які матеріали, що порушують авторські права (без згоди власника авторських прав), а також посилання на них.</p>
<p><span style="margin-left: 50px;">4.</span> Заборонено створювати теми з безглуздими назвами на кшталт "Допоможіть!", "Питання" і т.п.</p>
<p><span style="margin-left: 50px;">5.</span> Заборонено розміщувати тему в декількох підрозділах одного розділу одночасно (кросспостінг), а також дублювати тему в одному розділі.</p>
<p><span style="margin-left: 50px;">6.</span> Заборонено розміщувати контент рекламного змісту без згоди адміністрації форуму.</p>
<p><span style="margin-left: 50px;">7.</span> Заборонено створення і поширення шкідливого ПЗ, вірусів, кряков і злому ліцензійного софту, а також публікація посилань для їх скачування.</p>
<p><span style="margin-left: 50px;">8.</span> Заборонено публікувати посилання на інші форуми, а також їх пропаганда. Публікація посилань на форуми допустиме лише в розділі "Готові движки, cms і форуми" для вирішення технічних проблем і з попереднього схвалення адміністрації.</p>
<p><span style="margin-left: 50px;">9.</span> Заборонено надсилати користувачів з тематичних розділів в розділи фрілансу, а також рекламувати свої послуги або пропонувати / просити / вимагати оплату за допомогу, крім розділів для платних послуг.</p>
<p><span style="margin-left: 50px;">10.</span> Заборонено накручувати репутацію і іншу статистику користувача будь-яким способом, включаючи створення користувачів-клонів, а також схиляти (агітувати) інших користувачів до її зміни.</p>
<p><span style="margin-left: 50px;">11.</span> Заборонено давати посилання на скачування програм і книг з файлообмінників (рапида, депозит і т.п.) і інших сайтів (форумів), якщо є можливість їх завантажити з сайтів фірм-виробників.</p>
<p><span style="margin-left: 50px;">12.</span> Заборонено створювати кілька облікових записів (користувачів-клонів).</p>
<p><span style="margin-left: 50px;">13.</span> Заборонено використовувати ники, аватари, підписи та інші елементи профілю, що носять рекламний характер, ображають учасників форуму, які порушують ці Правила або законодавство Російської Федерації.</p>
<p><span style="margin-left: 50px;">14.</span> Заборонено здійснювати зловмисне втручання в роботу форуму з метою порушення його роботи або одержання доступу до особистих даних учасників форуму.</p>
<p><span style="margin-left: 50px;">15.</span> Заборонено розміщувати теми для оцінки сайтів (форумів) з посиланнями на оцінюваний сайт. Для оцінки прикрепляйте скріншот сайту.</p>
<p><span style="margin-left: 50px;">16.</span> Заборонено створювати теми з безліччю питань у всіх розділах, крім розділів платних послуг. Одне питання - одна тема.</p>
<p><span style="margin-left: 50px;">17.</span> Заборонено надмірне цитування. Цитуйте тільки необхідні частини повідомлень, на які відповідаєте.</p>
<p><span style="margin-left: 50px;">18.</span> Заборонено розміщувати завдання і рішення в вигляді графіку й інші компоненти з їх текстом.</p>
<p><span style="margin-left: 50px;">19.</span> Заборонено створювати теми у вигляді посилань на завдання або коди програм, розташовані на інших сайтах.</p>
<p><span style="margin-left: 50px;">20.</span> Заборонено публікувати відповіді на питання або вирішення завдань з форуму на інші сайти і давати на них посилання в якості відповіді.</p>
<p><span style="margin-left: 50px;">21.</span> Заборонено використовувати ники, аватари і статуси, дублюючі, що імітують або схожі на ники, аватари і статуси представників адміністрації форуму.</p>
<p><span style="margin-left: 50px;">22.</span> Заборонено навмисно вводити інших користувачів форуму в оману.</p>
<p><span style="margin-left: 50px;">23.</span> Заборонено публічне обговорення відгуків про репутацію. Обговорення може проводитися виключно за допомогою особистих повідомлень з адміністраторами форуму.</p>
<p><span style="margin-left: 50px;">24.</span> Заборонено давати відповіді у вигляді однієї посилання або списку посилань. В цьому випадку необхідно привести відповідь повністю і залишити посилання на джерело. Винятком є ​​посилання на сторінки самого форуму.</p>
<b><span style="margin-left: 10px;">6. Про Адміністрацію форуму.</span></b>
<p><span style="margin-left: 50px;">1.</span> До адміністрації форуму відносяться модератори і адміністратори.</p>
<p><span style="margin-left: 50px;">2.</span> Належність учасника форуму до адміністрації визначається кольором його ника і статусом.</p>
<p><span style="margin-left: 50px;">3.</span> Адміністрація форуму має виняткове право на оцінку дій учасників форуму, які порушили ці Правила, і застосування санкцій проти них.</p>
<p><span style="margin-left: 50px;">4.</span> У прямі обов'язки адміністрації форуму входить контроль за дотриманням цих Правил і підтримку поважних відносин між користувачами.</p>
<p><span style="margin-left: 50px;">5.</span> Заборонено публічно обговорювати дії адміністрації форуму, що стосуються їх прямих обов'язків.</p>
<p><span style="margin-left: 50px;">6.</span> Вимоги адміністрації форуму повинні виконуватися негайно і безумовно.</p>
<p><span style="margin-left: 50px;">7.</span> Санкції можуть бути застосовані без попередження на розсуд адміністрації форуму.</p>
<p><span style="margin-left: 50px;">8.</span> Будь-який учасник форуму має право знати причину, по якій до нього були застосовані санкції.</p>
<p><span style="margin-left: 50px;">9.</span> Образа, зневага і інші прояви неповаги до адміністрації форуму та її діям неприпустимі, і можуть спричинити застосування санкцій, аж до бана.</p>
<p><span style="margin-left: 50px;">10.</span> Ситуації, не описані в цих Правилах, вирішуються на розсуд адміністрації форуму.</p>
<p><span style="margin-left: 50px;">11.</span> Дії модераторів можуть бути оскаржені у адміністраторів форуму.</p>
<p><span style="margin-left: 50px;">12.</span> Представители администрации форума имеют право размещать в подписи активные ссылки на свои сайты или страницы (исключая форумы), рекламу своих услуг, а также графические изображения установленного размера.</p>
<b><span style="margin-left: 10px;">7. Політика конфіденційності.</span></b>
<p><span style="margin-left: 50px;">1.</span> Для показу оголошень на нашому веб-сайті ми користуємося послугами сторонніх рекламних компаній. Ці компанії можуть використовувати інформацію (за винятком вашого імені, адреси, адреси електронної пошти або номера телефону) про ваші відвідування цього веб-сайту та інших веб-сайтів з метою надання найбільш релевантних оголошень про товари і послуги.</p>
<p><span style="margin-left: 50px;">1.</span> Адміністрація форуму зберігає приватність особистих даних, зазначених користувачем при реєстрації. Однак, ці дані можуть бути використані для встановлення особи і місцезнаходження користувача в разі порушення ним цих Правил або законодавства Російської Федерації.</p>


				</div>
				<div class="modal-footer">
				<button class="btn btn-md btn-secondary" data-dismiss="modal">Закрити</button>
				</div>
			</div>
		</div>
</div>


<!--<div class="container-fluid">
	<div class="row jumbotron" style="background-color: #161d2c;">
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
			<p class="lead"><b>JGFKNLKFLFKNFLKFNLKGNLKGJ:FK <strong class="number" data-number="100">100</strong></b></p>
		</div>
	</div>
</div>-->
<?php 

//$Res1 =  mysqli_query($CONNECT, 'SELECT * FROM `forum`, `comments`'); 
	$Res1 = mysqli_query($CONNECT, 'SELECT * FROM `forum`, `comments`');
	$Row = mysqli_fetch_assoc($Res1);

	mysqli_query($CONNECT, 'SELECT SUM(`one`) AS `resuls` FROM `comments` WHERE `material` = 1 AND `module` = 2');
	echo $Row['resuls'];

	//if ($Row['id'] == $Row['material']) echo '<h1>'.$Row['id'],$Row['name'].'</h1>';}


?>


<?php //Footer() 
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="/resource/js/custom.js"></script>
<script src="/resource/js/jquery.spincrement.min.js"></script>

</body>
</html>