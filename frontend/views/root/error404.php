<?php
	// 
	// Шаблон страницы 404
	// 
	// Принимаемые переменные:
	// $hostName - имя хоста
	// $lang - язык
	// $indexUrl - урл главной страницы
	// 
?>
<div style="text-align:center;color:#555;font-size:18px;margin-top:100px;">
	<span style="display:block;color:#444;font-size:78px;margin-bottom:30px;">404</span>
	Извините, запрашиваемая страница не найдена.<br>
	Чтобы вернуться на главную, нажмите <a href="<?php echo $indexUrl; ?>">сюда</a>
</div>