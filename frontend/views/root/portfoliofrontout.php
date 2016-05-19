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
            <   <?php
            if (Yii::$app->request->getAbsoluteUrl() == $textPagesUrlProvider->getPortfolifrontoutUrl()){
                echo "<h1>".$pH1."</h1>";}
            else foreach ($filters as $filter) {
                $params['item'] = $filter;
                $filterUrl = $textPagesUrlProvider->geteFilterUrl($params);
                $filterActive = ($filter['url'] == $filterUri);
                if ($filterActive)
                    echo " <h1>" . $filter['pTitle'] . ' | '. Yii::t('app', 'Frondevo — professional front end development')."</h1>";
            }
            ?>
            <address>
                <span>Украина, г. Киев</span>
                <a href="tel:+380671702727">+38 067 170 27 27</a>
                <a href="mailto:welcome@frondevo.com">welcome@frondevo.com</a>
            </address>

            <!-- fd  menu -->
            <ul class="fd__menu fd__menu_line">
                <?php
                $AllActive = (Yii::$app->request->getAbsoluteUrl() == $textPagesUrlProvider->getPortfolifrontoutUrl());
                if ($AllActive) {
                    ?>
                    <li class="m-item active">
                         <span><?php echo Yii::t('app', 'All'); ?><span>
                    </li>
                <?php } else { ?>
                    <li class='m-item'>
                        <a href="<?php echo($textPagesUrlProvider->getPortfolifrontoutUrl()) ?>" target="_parent"
                           rel="nofollow "><span><?php echo Yii::t('app', 'All'); ?></span></a>
                    </li>
                <?php } ?>
                <!-- m item -->

                <!--/m item -->

                <?php foreach ($filters as $filter) { ?>
                    <?php
                    $params['item'] = $filter;
                    $filterUrl = $textPagesUrlProvider->getFilterFrontOutUrl($params);
                    ?>

                    <?php
                    $filterActive = ($filter['url'] == $filterUri);
                    if ($filterActive) {
                        ?>
                        <li class="m-item active">
                         <span><?php echo $filter['pTitle']; ?><span>
                        </li>
                    <?php } else { ?>
                        <li class="m-item">
                            <a href="<?php echo $filterUrl; ?>" target="_parent"
                               rel="nofollow "><?php echo $filter['pTitle']; ?></a>
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

                <?php foreach ($works as $key => $work) { ?>
                    <?php if ($key%5 == 0)echo('</ul> <ul>') ?>
                    <li>
                        <?php
                        $params['item'] = $work;
                        $workUrl = $simpleModuleUrlProvider->geteWorksFrontOutItemUrl($params);
                        ?>
                        <a href="<?php echo $workUrl; ?>"><img src="<?php echo $work['imgPath']; ?>" alt="">

                            <div>
                                <!-- our works  descr -->
                                <div class="our-works__descr">
                                    <span><?php echo Yii::t('app', 'Front end development:'); ?></span>
                                    <span>
                                    <?php foreach ($work['desclist'] as $key => $item) { ?>
                                         <span><?php echo($item['text'])?></span>
                                     <?php } ?>

                                </div>
                                <!--/our works  descr -->
                            </div>
                        </a>
                    </li>
                <?php } ?>
            </ul>

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
                <span><?php echo Yii::t('app', 'request a free consultation and estimate of your project'); ?></span>
            </a>
            <!--/button -->

        </div>
        <!--/layout -->

    </div>
    <!--/offer -->

</div>
<!--/main wrap -->
