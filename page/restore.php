<?php 
ULogin(0);
Head('Відновити пароль') ?>
<body>

<?php Menu();
MessageShow() 
?>


<header style="margin-top: -24px">
  <div class="overlay"></div>
  <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="/resource/img/mainlogo/main.mp4" type="video/mp4">
  </video>
  <div class="container h-100">
    <div class="d-flex h-100 text-center align-items-center">
      
		<div class="container" style="background-color: #111b2f; padding: 10px; box-shadow: 1px 1px 10px #000;">
<form method="POST" action="/account/restore">
<br><input style="margin-bottom: 20px" type="text" name="login" placeholder="Логін" maxlength="10" pattern="[A-Za-z-0-9]{3,10}" title="Не менш 3 і небільше 10 латинській символів або цифр." required>
<br><input type="text" class="form-control" id="name-field" style="width: 50%" name="captcha" placeholder="Капча" maxlength="10" pattern="[0-9]{1,5}" title="Тільки цифри." required><img src="/resource/captcha.php" class="capimg" alt="Каптча">
<br><input type="submit" name="enter" value="Відновити"> <input type="reset" value="Очистити">
</form>

</div>
    </div>
  </div>
</header>

<?php Footer() ?>

</body>
</html>