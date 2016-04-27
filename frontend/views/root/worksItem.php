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
        <source srcset="<?php echo $worksItem['imgPathbg'] ?>" media="(min-height: 900px)">
        <source srcset="<?php echo $worksItem['imgPathbgmd'] ?>" media="(min-height: 736px)">
        <source srcset="<?php echo $worksItem['imgPathbgsm'] ?>" media="(min-height: 480px)">
        <img src="<?php echo $worksItem['imgPathbgsm'] ?>" alt="" data-fit="cover">
    </picture>
    <!-- full height  layout -->
    <div class="full-height__layout">
        <!-- middle text -->
        <div class="middle-text">
            <h1><?php echo $worksItem['pH1']; ?></h1>

            <p><?php echo $worksItem['description']; ?></p>
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

                    <p><?php echo $worksItem['client'] ?></p>

                    <h3>услуги</h3>

                    <p><?php echo $worksItem['services'] ?></p>

                    <h3>год запуска</h3>

                    <p><?php echo $worksItem['launch'] ?></p>
                </aside>
            </section>
            <section>
                <h2>задача</h2>
                <?php echo $worksItem['task'] ?>

            </section>
            //Секция работ
            <section>
                <h2>решение</h2>
                <?php echo $worksItem['solutions']; ?>
            </section>
            // Секция результатов
            <?php if (!empty($worksItem['result'])) { ?>
                <section>
                    <h2>результаты</h2>

                    <p><?php echo $worksItem['result'] ?></p>
                    <?php foreach ($multifields['resultlist1'] as $key => $stagelist) { ?>
                        <?php if ($key % 2 == 0) { ?>  <aside> <?php } ?>

                        <p><?php echo $stagelist['text'] ?> </p>

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



