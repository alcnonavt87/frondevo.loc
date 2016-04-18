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
        <source srcset="<?php echo('p/pages/generalbgsbk-'.$pageData1['imagebgsbk']) ?>" media="(min-height: 900px)">
        <source srcset="<?php echo('p/pages/mediumbgsbk-'.$pageData1['imagebgsbklp']) ?>" media="(min-height: 736px)">
        <source srcset="<?php echo('p/pages/smallbgsbk-'.$pageData1['imagebgsbkmb']) ?>" media="(min-height: 480px)">
        <img src="<?php echo('p/pages/smallbgsbk-'.$pageData1['imagebgsbkmb']) ?>" alt="" data-fit="cover">
    </picture>

    <!-- full height  layout -->
    <div class="full-height__layout">

        <!-- middle text -->
        <div class="middle-text">

           <?php echo($pageData['pContent']) ?>

            <p><?php echo($pageData1['sbkdescription']) ?></p>
        </div>
        <!--/middle text -->

        <div class="direct-line"></div>
        <div class="arrow"></div>
        <div class="background-text"><?php echo($pageData1['textforbackground']) ?></div>
    </div>
    <!--/full height  layout -->

</div>
<!--/full height -->


<!-- main wrap -->
<div class="main-wrap">


    <?php echo($pageData1['section1']) ?>

    <!-- our works -->
    <div class="our-works">
        <h2>
            <?php echo($pageData1['section2']) ?>
        </h2>

        <h3>  <?php echo($pageData1['sbkworkstext']) ?></h3>

        <!-- our works  wrap -->
        <div class="our-works__wrap">
            <ul>
                <?php foreach ($works as $key => $work) { ?>
                    <?php
                    $params['item'] = $work;
                    $workUrl = $simpleModuleUrlProvider->geteWorksItemUrl($params);
                    ?>
                    <?php if ($key == 0) { ?>
                        <!--/(index === 0 ? long : ) -->
                        <li class="long">
                            <a href="<?php echo $workUrl; ?>"><img
                                    src="<?php echo 'p/works/bigsbk-' . $work['id'] . '-image.jpg' ?>"
                                    alt="">

                                <div>
                                    <span> <?php echo $work['worksdesсsbk']; ?></span>
                                </div>
                            </a>
                        </li>
                        <!--/(index === 0 ? long : ) -->
                    <?php } else if ($key <= 2) { ?>
                        <!--/(index === 0 ? long : ) -->
                        <li>
                            <a href="<?php echo $workUrl; ?>"><img src="<?php echo $work['imgPath'] ?>" alt="">

                                <div>
                                    <span> <?php echo $work['worksdesсsbk']; ?></span>
                                </div>
                            </a>
                        </li>
                        <!--/(index === 0 ? long : ) -->
                    <?php } ?>
                <?php } ?>
            </ul>
            <ul>
                <?php foreach ($works as $key => $work) { ?>
                    <?php
                    $params['item'] = $work;
                    $workUrl = $simpleModuleUrlProvider->geteWorksItemUrl($params);
                    ?>
                    <?php if ($key >= 3) { ?>
                        <!--/(index === 0 ? long : ) -->
                        <li>
                            <a href="<?php echo $workUrl; ?>"><img src="<?php echo $work['imgPath'] ?>" alt="">

                                <div>
                                    <span> <?php echo $work['worksdesсsbk']; ?></span>
                                </div>
                            </a>
                        </li>
                        <!--/(index === 0 ? long : ) -->
                    <?php } ?>
                <?php } ?>
            </ul>


        </div>
        <!--/our works  wrap -->

    </div>
    <!--/our works -->


    <!-- approach -->
    <div class="approach">

        <!-- layout -->
        <div class="layout">
            <h2>
                <?php echo($pageData1['section3']) ?>
            </h2>

            <h3> <?php echo($pageData1['sbksmalltitle3']) ?></h3>

            <!-- approach  list wrap -->
            <div class="approach__list-wrap">

                <!-- approach  list -->
                <div class="approach__list">

                    <!-- approach  item -->
                    <div class="approach__item">
                        <h3><?php echo($pageData1['sbktitlestep1']) ?></h3>

                        <p><?php echo($pageData1['sbkdeskstep1']) ?></p>
                    </div>
                    <!--/approach  item -->


                    <!-- approach  item -->
                    <div class="approach__item">
                        <h3><?php echo($pageData1['sbktitlestep2']) ?></h3>

                        <p><?php echo($pageData1['sbkdeskstep2']) ?></p>
                    </div>
                    <!--/approach  item -->


                    <!-- approach  item -->
                    <div class="approach__item">
                        <h3><?php echo($pageData1['sbktitlestep3']) ?></h3>

                        <p><?php echo($pageData1['sbkdeskstep3']) ?></p>
                    </div>
                    <!--/approach  item -->

                </div>
                <!--/approach  list -->


                <!-- approach  list -->
                <div class="approach__list">

                    <!-- layout -->
                    <div class="layout">

                        <!-- approach  item -->
                        <div class="approach__item">
                            <h3><?php echo($pageData1['sbktitlestep4']) ?></h3>

                            <p><?php echo($pageData1['sbkdeskstep4']) ?></p>
                        </div>
                        <!--/approach  item -->


                        <!-- approach  item -->
                        <div class="approach__item">
                            <h3><?php echo($pageData1['sbktitlestep5']) ?></h3>

                            <p><?php echo($pageData1['sbkdeskstep5']) ?></p>
                        </div>
                        <!--/approach  item -->


                        <!-- approach  item -->
                        <div class="approach__item">
                            <h3><?php echo($pageData1['sbktitlestep6']) ?></h3>

                            <p><?php echo($pageData1['sbkdeskstep6']) ?></p>
                        </div>
                        <!--/approach  item -->


                        <!-- approach  item -->
                        <div class="approach__item">
                            <h3><?php echo($pageData1['sbktitlestep7']) ?></h3>

                            <p><?php echo($pageData1['sbkdeskstep7']) ?></p>
                        </div>
                        <!--/approach  item -->

                    </div>
                    <!--/layout -->

                </div>
                <!--/approach  list -->

            </div>
            <!--/approach  list wrap -->

        </div>
        <!--/layout -->

    </div>
    <!--/approach -->


    <!-- stages -->
    <div id="indicators1" class="stages hor-indicators">

        <!-- stages  back -->
        <div class="stages__back">
            <div class="hor-ind"></div>
        </div>
        <!--/stages  back -->

        <div class="stages__back stages__back-2"><img src="markup/img/sites/frondevo.png" alt="Сайты"
                                                      width="4826" height="612" class="hor-ind"></div>

        <!-- stages  wrap -->
        <div class="stages__wrap">
            <h2><?php echo($pageData1['section4']) ?></h2>

            <h3><?php echo($pageData1['sbksmalltitle']) ?></h3>

            <!-- stages  layout -->
            <div data-indicators="indicators1" class="stages__layout hor-wrapper">

                <!-- stages  scroll -->
                <div class="stages__scroll hor-scroller hor-scrollbar hor-snap-mobile">

                    <!-- stages  list -->
                    <ul class="stages__list">

                        <!-- stages  item -->
                        <li class="stages__item hor-sizing hor-snap researching">
                            <h3><?php echo($pageData1['sbkstagetitle1']) ?></h3>

                            <div>
                                <ul>
                                    <?php foreach ($pageData1['sbkstagelist1'] as $stagelist) { ?>

                                        <li><?php echo $stagelist['text'] ?></li>

                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                        <!--/stages  item -->


                        <!-- stages  item -->
                        <li class="stages__item hor-sizing hor-snap projecting">
                            <h3><?php echo($pageData1['sbkstagetitle2']) ?></h3>

                            <div>
                                <ul>
                                    <?php foreach ($pageData1['sbkstagelist2'] as $stagelist) { ?>

                                        <li><?php echo $stagelist['text'] ?></li>

                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                        <!--/stages  item -->


                        <!-- stages  item -->
                        <li class="stages__item hor-sizing hor-snap designing">
                            <h3><?php echo($pageData1['sbkstagetitle3']) ?></h3>

                            <div>
                                <ul>
                                    <?php foreach ($pageData1['sbkstagelist3'] as $stagelist) { ?>

                                        <li><?php echo $stagelist['text'] ?></li>

                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                        <!--/stages  item -->


                        <!-- stages  item -->
                        <li class="stages__item hor-sizing hor-snap developing">
                            <h3><?php echo($pageData1['sbkstagetitle4']) ?></h3>

                            <div>
                                <ul>
                                    <?php foreach ($pageData1['sbkstagelist4'] as $stagelist) { ?>

                                        <li><?php echo $stagelist['text'] ?></li>

                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                        <!--/stages  item -->


                        <!-- stages  item -->
                        <li class="stages__item hor-sizing hor-snap contenting">
                            <h3><?php echo($pageData1['sbkstagetitle5']) ?></h3>

                            <div>
                                <ul>
                                    <?php foreach ($pageData1['sbkstagelist5'] as $stagelist) { ?>

                                        <li><?php echo $stagelist['text'] ?></li>

                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                        <!--/stages  item -->


                        <!-- stages  item -->
                        <li class="stages__item hor-sizing hor-snap supporting">
                            <h3><?php echo($pageData1['sbkstagetitle6']) ?></h3>

                            <div>
                                <ul>
                                    <?php foreach ($pageData1['sbkstagelist6'] as $stagelist) { ?>

                                        <li><?php echo $stagelist['text'] ?></li>

                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                        <!--/stages  item -->

                    </ul>
                    <!--/stages  list -->

                </div>
                <!--/stages  scroll -->

            </div>
            <!--/stages  layout -->

        </div>
        <!--/stages  wrap -->

    </div>
    <!--/stages -->


    <!-- customers -->
    <div class="customers">

        <!-- customers  background text -->
        <div class="customers__background-text">
            <span>P.S.</span>
        </div>
        <!--/customers  background text -->


        <!-- layout -->
        <div class="layout">
            <h2>
                <?php echo($pageData1['section5']) ?>
            </h2>
            <ul>
                <?php foreach ($pageData1['sbkpslist'] as $pslist) { ?>


                    <li><?php echo $pslist['text'] ?></li>

                <?php } ?>
            </ul>
        </div>
        <!--/layout -->

    </div>
    <!--/customers -->


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



