<?php
	// 
	// Шаблон страницы для Портфолио
	// 
	// Принимаемые переменные:
	// $alias - алиас страницы
	// $pH1 - заголовок h1
	// $works - список работ
	// $filters - список фильтров
	// $filterUri - uri текущего фильтра
	// 
?>
<?php
use frontend\models\Common;
use vendor\UrlProvider\SimpleModuleUrlProvider;
use vendor\UrlProvider\TextPagesUrlProvider;

$options['joinUris'] = 1;
$simpleModuleUrlProvider = new SimpleModuleUrlProvider($lang, $options);
$textPagesUrlProvider = new TextPagesUrlProvider($lang);
?>
template for page portfolio<br>
<?php echo $pH1; ?>
<ul>
	<?php foreach ($filters as $filter) { ?>
		<?php
			$params['item'] = $filter;
			$filterUrl = $textPagesUrlProvider->geteFilterUrl($params);
		?>
		<li>
			<?php
				$filterActive = ($filter['url'] == $filterUri);
				if ($filterActive) {
			?>
				<?php echo $filter['title']; ?>
			<?php } else { ?>
				<a href="<?php echo $filterUrl; ?>"><?php echo $filter['title']; ?></a>
			<?php } ?>
		</li>
	<?php } ?>
</ul>
<ul>
	<?php foreach ($works as $work) { ?>
		<?php
			$params['item'] = $work;
			$workUrl = $simpleModuleUrlProvider->geteWorksItemUrl($params);
		?>
		<li><a href="<?php echo $workUrl; ?>"><?php echo $work['title']; ?></a> <?php echo $work['description']; ?></li>
	<?php } ?>
</ul>