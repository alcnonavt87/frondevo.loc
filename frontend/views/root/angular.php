<?php
use frontend\models\Common;
use vendor\UrlProvider\SimpleModuleUrlProvider;
use vendor\UrlProvider\TextPagesUrlProvider;

$options['joinUris'] = 1;
$simpleModuleUrlProvider = new SimpleModuleUrlProvider($lang, $options);
$textPagesUrlProvider = new TextPagesUrlProvider($lang);
?><!-- full height -->
<div class="full-height inner mesh">
    <picture>
        <source srcset="<?php echo('p/pages/bigangularbg-'.$pageData['imageangularbgbig']) ?>" media="(min-height: 900px)">
        <source srcset="<?php echo('p/pages/smallangularbg-'.$pageData['imageangularbgsmall']) ?>" media="(min-height: 480px)">
        <img src="<?php echo('p/pages/smallangularbg-'.$pageData['imageangularbgsmall']) ?>" alt="" data-fit="cover">
    </picture>


    <!-- full height  layout -->
    <div class="full-height__layout">

        <!-- middle text -->
        <div class="middle-text">

            <!-- fd  title type1 -->
            <h1 class="fd__title_type1">
                <?php echo($pageData['angularmainscreentitle']) ?>
            </h1>
            <!--/fd  title type1 -->

            <p><?php echo($pageData['angularmainscreentitle1']) ?></p>
        </div>
        <!--/middle text -->

        <div class="direct-line"></div>
        <div class="arrow"></div>
    </div>
    <!--/full height  layout -->

</div>
<!--/full height -->


<!-- main wrap -->
<div class="main-wrap">

    <!-- article -->
    <section class="article light why">
        <h2> <?php echo($pageData['causesAngulartitle']) ?></h2>

        <!-- layout -->
        <div class="layout">
            <div class="why-item">
                <ul>
            <?php foreach ($pageData['causesAngularlist'] as $item) { ?>
                <li><?php echo($item['text']) ?></li>
            <?php } ?>
                </ul>
            </div>

            <div class="why-item">
                <ul>
                    <?php foreach ($pageData['causesAngularlist1'] as $item) { ?>
                        <li><?php echo($item['text']) ?></li>
                    <?php } ?>
                </ul>
            </div>


        </div>
        <!--/layout -->

    </section>
    <!--/article -->


    <!-- our works -->
    <div class="our-works our-works_type2 our-works_vert">
        <h2>
            <span><?php echo($pageData['worksexamplesangulartitle']) ?></span>
        </h2>

        <!-- our works  wrap -->
        <!-- our works  wrap -->
        <div class="our-works__wrap">
            <ul>

                <?php foreach ($works as $key =>$work) { ?>
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

            <!-- our works footer -->
            <div class="our-works-footer">
                <div>

                    <!-- button -->
                    <a href="<?php echo $textPagesUrlProvider->getPortfolifrontoutUrl();?>" class="button light">
                        <span><?php echo Yii::t('app', 'to see a front end portfolio');?></span>
                    </a>
                    <!--/button -->

                </div>
                <p><?php echo $workscount .' '. Yii::t('app', 'works');?></p>
            </div>
            <!--/our works footer -->

        </div>
        <!--/our works  wrap -->

    </div>
    <!--/our works -->
    <!-- article -->
    <section class="article light warranty">

        <!-- warranty  background text -->
        <div class="warranty__background-text">
            <span><?php echo($pageData1['garantiesbgword']) ?></span>
        </div>
        <!--/warranty  background text -->


        <!-- layout -->
        <div class="layout">

            <!-- warranty item -->
            <div class="warranty-item">
                <h2><?php echo($pageData1['garanties1title']) ?></h2>
                <ul>
                    <?php foreach ($pageData1['garanties1list'] as $garanties) { ?>
                        <li>
                            <?php echo $garanties['text'] ?>
                        </li>
                    <?php } ?>

                </ul>
            </div>
            <!--/warranty item -->


            <!-- warranty item -->
            <div class="warranty-item">
                <h2><?php echo($pageData1['garanties2title']) ?></h2>
                <ul>
                    <?php foreach ($pageData1['garanties2list'] as $garanties) { ?>
                        <li>
                            <?php echo $garanties['text'] ?>
                        </li>
                    <?php } ?>

                </ul>
            </div>
            <!--/warranty item -->

        </div>
        <!--/layout -->

    </section>
    <!--/article -->

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

