<?php
	// 
	// Шаблон страницы единицы работы
	// 
	// Принимаемые переменные:
	// $worksItem - единица работы (массив данных)
	// 
?>
template for works item page<br>
<?php echo $worksItem['pH1']; ?>

<img src="<?=$worksItem['imgPath']; ?>" alt="" width="<?= $worksItem['imgW']?>" height="<?=$worksItem['imgH']; ?>">