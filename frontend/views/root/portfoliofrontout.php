<?php
use vendor\UrlProvider\SimpleModuleUrlProvider;
use vendor\UrlProvider\TextPagesUrlProvider;

$options['joinUris'] = 1;
$simpleModuleUrlProvider = new SimpleModuleUrlProvider($lang, $options);
$textPagesUrlProvider = new TextPagesUrlProvider($lang);
?>

<div class="black-layout portfolio-layout">


    <div class="full-height__layout">


        <div class="middle-text">
            < <?php
            if (Yii::$app->request->getAbsoluteUrl() == $textPagesUrlProvider->getPortfolifrontoutUrl()) {
                echo "<h1>" . $pH1 . "</h1>";
            } else foreach ($filters as $filter) {
                $params['item'] = $filter;
                $filterUrl = $textPagesUrlProvider->geteFilterUrl($params);
                $filterActive = ($filter['url'] == $filterUri);
                if ($filterActive)
                    echo " <h1>" . $filter['pTitle'] . ' | ' . Yii::t('app', 'Frondevo — professional front end development') . "</h1>";
            }
            ?>

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


        </div>


    </div>


</div>

<div class="main-wrap">


    <div class="our-works our-works_type2 our-works_vert our-works_notitle">


        <div class="our-works__wrap">

            <ul>

                <?php foreach ($works as $key => $work) { ?>
                    <?php if ($key % 5 == 0) echo('</ul> <ul>') ?>
                    <li>
                        <?php
                        $params['item'] = $work;
                        $workUrl = $simpleModuleUrlProvider->geteWorksFrontOutItemUrl($params);
                        ?>
                        <a href="<?php echo $workUrl; ?>"><img src="<?php echo $work['imgPath']; ?>" alt="">

                            <div>

                                <div class="our-works__descr">
                                    <span><?php echo Yii::t('app', 'Front end development:'); ?></span>
                                    <span>
                                    <?php foreach ($work['desclist'] as $key => $item) { ?>
                                        <span><?php echo($item['text']) ?></span>
                                    <?php } ?>

                                </div>

                            </div>
                        </a>
                    </li>
                <?php } ?>
            </ul>

        </div>

        <?php echo $pagination->get() ?>
    </div>

    <div class="offer mesh">

        <div class="layout fd_align-center">
            <a href="<?php echo($textPagesUrlProvider->getCommercialUrl()) ?>" class="button dark">
                <span><?php echo Yii::t('app', 'request a free consultation and estimate of your project'); ?></span>
            </a>

        </div>
    </div>

</div>

