<?php
use vendor\UrlProvider\SimpleModuleUrlProvider;
use vendor\UrlProvider\TextPagesUrlProvider;

$options['joinUris'] = 1;
$simpleModuleUrlProvider = new SimpleModuleUrlProvider($lang, $options);
$textPagesUrlProvider = new TextPagesUrlProvider($lang);
?>


<!-- black layout -->
<div class="black-layout portfolio-layout">

    <!-- full height  layout -->
    <div class="full-height__layout">

        <!-- middle text -->
        <div class="middle-text">
            <h1>Портфолио front end разработок</h1>
            <address>
                <span>Украина, г. Киев</span>
                <a href="tel:+380671702727">+38 067 170 27 27</a>
                <a href="mailto:welcome@frondevo.com">welcome@frondevo.com</a>
            </address>

            <!-- fd  menu -->
            <ul class="fd__menu fd__menu_line">
                <?php
                $AllActive = (Yii::$app->request->getAbsoluteUrl() == $textPagesUrlProvider->getPortfolioUrl());
                if ($AllActive) {
                    ?>
                    <li class="m-item active">
                         <span> Все <span>
                    </li>
                <?php } else { ?>
                    <li class='m-item'>
                        <a href="<?php echo($textPagesUrlProvider->getPortfolioUrl()) ?>" target="_parent"
                           rel="nofollow "><span>Все</span></a>
                    </li>
                <?php } ?>
                <!-- m item -->


                <!--/m item -->


                <?php foreach ($filters as $filter) { ?>
                    <?php
                    $params['item'] = $filter;
                    $filterUrl = $textPagesUrlProvider->geteFilterUrl($params);
                    ?>

                    <?php
                    $filterActive = ($filter['url'] == $filterUri);
                    if ($filterActive) {
                        ?>
                        <li class="m-item active">
                         <span><?php echo $filter['title']; ?><span>
                        </li>
                    <?php } else { ?>
                        <li class="m-item">
                            <a href="<?php echo $filterUrl; ?>" target="_parent"
                               rel="nofollow "><?php echo $filter['title']; ?></a>
                        </li>
                    <?php } ?>
                <?php } ?>

            </ul>
            <!--/fd  menu -->

        </div>
        <!--/middle text -->

    </div>
    <!--/full height  layout -->

</div>
<!--/black layout -->


<!-- main wrap -->
<div class="main-wrap">

    <!-- our works -->
    <div class="our-works our-works_type2 our-works_vert our-works_notitle">

        <!-- our works  wrap -->
        <div class="our-works__wrap">
            <ul>

                <?php foreach ($works as $work) { ?>

                    <li>
                        <?php
                        $params['item'] = $work;
                        $workUrl = $simpleModuleUrlProvider->geteWorksItemUrl($params);
                        ?>
                        <a href="<?php echo $workUrl; ?>"><img src="<?php echo $work['imgPath']; ?>" alt="">

                            <div>
                                <!-- our works  descr -->
                                <div class="our-works__descr">
                                    <span> <?php echo $work['description']; ?></span>
                                </div>
                                <!--/our works  descr -->
                            </div>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            -->
        </div>
        <!--/our works  wrap -->

        <?php echo $pagination->get() ?>

        <!--/pager -->

    </div>
    <!--/our works -->


    <!-- offer -->
    <div class="offer mesh">

        <!-- layout -->
        <div class="layout fd_align-center">

            <!-- button -->
            <a href="<?php echo($textPagesUrlProvider->getCommercialUrl()) ?>" class="button dark">
                <span>Заказать бесплатную консультацию и оценку вашего проекта</span>
            </a>
            <!--/button -->

        </div>
        <!--/layout -->

    </div>
    <!--/offer -->

</div>
<!--/main wrap -->

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
/**/ ?><!--
<?php
/*use frontend\models\Common;
use vendor\UrlProvider\SimpleModuleUrlProvider;
use vendor\UrlProvider\TextPagesUrlProvider;

$options['joinUris'] = 1;
$simpleModuleUrlProvider = new SimpleModuleUrlProvider($lang, $options);
$textPagesUrlProvider = new TextPagesUrlProvider($lang);
*/ ?>
template for page portfolio<br>
<?php /*echo $pH1; */ ?>
<ul>
	<?php /*foreach ($filters as $filter) { */ ?>
		<?php
/*			$params['item'] = $filter;
			$filterUrl = $textPagesUrlProvider->geteFilterUrl($params);
		*/ ?>
		<li>
			<?php
/*				$filterActive = ($filter['url'] == $filterUri);
				if ($filterActive) {
			*/ ?>
				<?php /*echo $filter['title']; */ ?>
			<?php /*} else { */ ?>
				<a href="<?php /*echo $filterUrl; */ ?>"><?php /*echo $filter['title']; */ ?></a>
			<?php /*} */ ?>
		</li>
	<?php /*} */ ?>
</ul>
<ul>
	<?php /*foreach ($works as $work) { */ ?>

		<?php
/*			$params['item'] = $work;
			$workUrl = $simpleModuleUrlProvider->geteWorksItemUrl($params);
		*/ ?>
		    <li><a href="<?php /*echo $workUrl; */ ?>"><?php /*echo $work['title']; */ ?><img src=" <?php /*echo $work['imgPath']; */ ?>" alt=" " width="<?php /*echo $work['imgW']*/ ?>" height="<?php /*echo $work['imgH'] */ ?>" </a> <?php /*echo $work['description']; */ ?>
			 </li>
	<?php /*} */ ?>
</ul>-->