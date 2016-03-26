<?php
	// 
	// Базовый шаблон сайта
	// 
	// Принимаемые переменные:
	// $hostName - имя хоста
	// $lang - язык
	// $indexUrl - урл главной страницы
	// $pTitle - мета-заголовок страницы
	// $pDescription - мета-описание страницы
	// $indexPage - флаг главной страницы
	// $menu - контент меню
	// $content - контент внутренней страницы
	// 
?>
<?php
use yii\helpers\Html;
use vendor\UrlProvider\TextPagesUrlProvider;

extract(Yii::$app->params['forLayout']);
$textPagesUrlProvider = new TextPagesUrlProvider($lang);
?>
template for basic layout<br>
<?php echo $content; ?>
<ul>
	<?php if (!empty($links)) { ?>
		<?php foreach ($links as $link) { ?>
			<?php
				$linkUrl = $textPagesUrlProvider->{$link['urlMethod']}();
			?>
			<li><a href="<?php echo $linkUrl; ?>"><?php echo $link['title']; ?></a></li>
		<?php } ?>
	<?php } ?><br>

	<?php foreach ($langMenu as $menuItemLang => $menuItem) {
		$sameLang = ($menuItemLang == $lang);
	?>
		<li>
			<?php if ($sameLang) { ?>
				<?php echo $menuItem['text']; ?>
			<?php } else { ?>
				<a href="<?php echo $menuItem['link']; ?>"><?php echo $menuItem['text']; ?></a>
			<?php } ?>
		</li>
	<?php } ?>
</ul>

<?php echo $menu; ?><br>
<?php echo $settings['copyright']; ?><br>
<?php echo $settings['address']; ?><br>

