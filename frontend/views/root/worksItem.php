<?php
use frontend\models\Common;
use vendor\UrlProvider\SimpleModuleUrlProvider;
use vendor\UrlProvider\TextPagesUrlProvider;

$options['joinUris'] = 1;
$simpleModuleUrlProvider = new SimpleModuleUrlProvider($lang, $options);
$textPagesUrlProvider = new TextPagesUrlProvider($lang);
?>

<!-- full height -->
<div class="full-height inner mesh">
    <picture>
        <source srcset="<?php echo $worksItem['imgPathbg']?>" media="(min-height: 900px)">
        <source srcset="<?php echo $worksItem['imgPathbgmd']?>" media="(min-height: 736px)">
        <source srcset="<?php echo $worksItem['imgPathbgsm']?>" media="(min-height: 480px)"><img src=""<?php echo $worksItem['imgPathbgsm']?>" alt="" data-fit="cover">
    </picture>

    <!-- full height  layout -->
    <div class="full-height__layout">

        <!-- middle text -->
        <div class="middle-text">
            <h1><?php echo $worksItem['pH1'];?></h1>
            <p><?php echo $worksItem['description'];?></p>
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
    <article class="article light">

        <!-- layout -->
        <div class="layout">
            <section>
                <aside>
                    <h3>клиент</h3>
                    <p><?php echo $worksItem['client']?></p>
                    <h3>услуги</h3>
                    <p><?php echo $worksItem['services']?></p>
                    <h3>LAUNCH</h3>
                    <p><?php echo $worksItem['launch']?></p>
                </aside>
                <aside>
                    <h3>проектная группа</h3>
                    <p>
                        <?php echo $worksItem['aboutProject']?>
                    </p>
                </aside>
            </section>
            <section>
                <h2>задача</h2>
                <?php echo $worksItem['task']?>

            </section>
            <section>
                <h2>решение</h2>
                <p><?php echo $worksItem['descrofsolut']?></p>
                <p>Главная страница:</p>

                <!-- image frame -->
                <div class="image-frame">
                    <div>

                        <!-- frame controls -->
                        <div class="frame-controls">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <!--/frame controls -->

                        <div class="frame-input"><?php echo $worksItem['linkwork']?></div>
                        <div class="frame-face-input"></div>
                    </div>
                    <picture>
                        <source srcset="<?php echo $worksItem['imgPathmp']?>" media="(min-width: 1280px)">
                        <source srcset="<?php echo $worksItem['imgPathmpbig']?>" media="(min-width: 748px)">
                        <source srcset="<?php echo $worksItem['imgPathmpmd']?>" media="(min-width: 414px)">
                        <source srcset="<?php echo $worksItem['imgPathmpsm']?>" media="(min-width: 320px)"><img src="<?php echo $worksItem['imgPathmpsm']?>" alt="">
                    </picture>
                </div>
                <!--/image frame -->

                <p>Лаконичный и строгий дизайн в сине-красных цветах подчеркивают серьезность и надежность компании, а промо блоки больших размеров – солидность и размах.</p>
                <p><?php echo $worksItem['add']?></p>
                <div class="align-center"><img src="<?php echo $worksItem['imgPathadd']?>" alt="" width="768" height="491"></div>

                <!-- align center -->
                <div class="align-center">
                    <p>посетить веб-сайт</p>

                    <!-- button -->
                    <a href="<?php echo 'http://'. $worksItem['linkwork']?>" target="_blank" rel="nofollow" class="button light">
                        <span><?php echo $worksItem['linkwork']?></span>
                    </a>
                    <!--/button -->

                </div>
                <!--/align center -->

            </section>


                   <?php if (!empty($worksItem['result'])) { ?>
                <section>
                    <h2>результаты</h2>
                    <p><?php echo $worksItem['result']?></p>
                    <?php foreach ($multifields['resultlist1'] as $key => $stagelist) { ?>
                        <?php if ($key % 2 == 0) { ?>  <aside> <?php } ?>

                        <p><?php echo $stagelist['text']?> </p>

                        <?php if ($key % 2 == 1) { ?>  </aside> <?php } ?>

                    <?php } ?>

                </section>
            <?php } ?>

        </div>
        <!--/layout -->

    </article>
    <!--/article -->


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



