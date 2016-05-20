<?php
use vendor\UrlProvider\SimpleModuleUrlProvider;
use vendor\UrlProvider\TextPagesUrlProvider;

$options['joinUris'] = 1;
$simpleModuleUrlProvider = new SimpleModuleUrlProvider($lang, $options);
$textPagesUrlProvider = new TextPagesUrlProvider($lang);
?>

<div class="black-layout portfolio-layout">

    <div class="full-height__layout">

            <ul class="fd__menu fd__menu_line">
                <?php
                $AllActive = (Yii::$app->request->getAbsoluteUrl() == $textPagesUrlProvider->getPortfolioUrl());
                if ($AllActive) {
                    ?>
                    <li class="m-item active">
                         <span><?php echo Yii::t('app', 'All'); ?><span>
                    </li>
                <?php } else { ?>
                    <li class='m-item'>
                        <a href="<?php echo($textPagesUrlProvider->getPortfolioUrl()) ?>" target="_parent"
                           rel="nofollow "><span><?php echo Yii::t('app', 'All'); ?></span></a>
                    </li>
                <?php } ?>

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
           

        </div>
       

    </div>
   

</div>

<div class="main-wrap">

    <div class="our-works our-works_type2 our-works_vert our-works_notitle">
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
                               
                                <div class="our-works__descr">
                                    <span> <?php echo $work['description']; ?></span>
                                </div>
                               
                            </div>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            -->
        </div>
       

        <?php echo $pagination->get() ?>
 </div>
  <div class="offer mesh">

       
        <div class="layout fd_align-center">

           
            <a href="<?php echo($textPagesUrlProvider->getCommercialUrl()) ?>" class="button dark">
                <span>Заказать бесплатную консультацию и оценку вашего проекта</span>
            </a>
           

        </div>
       

    </div>
   

</div>


