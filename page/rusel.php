<?php 
ULogin(0);
Head('Регістрація') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page"><br>
<h2>Для продовження реєстрації ви повинні погодитися з наступними правилами:</h2><br/>
<div class="Rusel"><br/><h2 style="text-align: center;">Правила форума</h2><br/>
<p><span style="margin-left: 50px;">Реєстрація</span> на форумі абсолютно безкоштовна! Настійно рекомендуємо вам ознайомитися з правилами нашого проекту. Якщо ви згодні з усіма умовами, тоді поставте позначку біля "згоден" і натисніть 'Зареєструватися'. Якщо ви передумали реєструватися, натисніть тут, щоб повернутися на головну сторінку.</p>
<p><span style="margin-left: 50px;">Хоча</span> адміністрація, обслуговуючі Форум програмістів і сисадмінів Кіберфорум, намагається видаляти образливі і некоректні повідомлення з розділів на форумі, все одно всі повідомлення переглянути неможливо. Дописи відображають точку зору лише їх автора, а тому адміністрація форуму, відповідно, тільки автор несе відповідальність за зміст повідомлення.</p>
<p><span style="margin-left: 50px;">Погоджуючись</span> з нашими правилами, Ви зобов'язуєтеся дотримуватися вимог форуму в цілому, а також вимоги законодавства України.</p>
<p><span style="margin-left: 50px;">Адміністрація</span> форуму залишає за собою право видаляти, змінювати, переносити або закривати будь-яку тему або повідомлення на свій розсуд.</p></div>
<br><br><br><p style="text-align: center;"><button type="submit" onclick="window.location.href='/rusel_'">Повний список правил</button><br/><br/><button type="submit" onclick="window.location.href='/register'">Реєстрація</button></p>

</div>
</div>

<?php Footer(); ?>
</div>
</body>
</html>