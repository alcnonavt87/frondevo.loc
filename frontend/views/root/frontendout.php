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
                <?php
                if (!empty($pageData1['linkvideobgfrnout'])) {
                    ?>
                    <video autoplay loop muted poster="video/poster.jpg" class="fs-bg-video">
                        <source src="<?php echo $pageData1['linkvideobgfrnout'] ?>" >
                    </video>
                <?php } else { ?>
                    <picture>
                        <source srcset="<?php echo('p/pages/bigfrontoutbg-'.$pageData1['imagefrontoutbgbig']) ?>" media="(min-height: 900px)">
                        <source srcset="<?php echo('p/pages/smallfrontoutbg-'.$pageData1['imagefrontoutbgsmall']) ?>" media="(min-height: 480px)">
                        <img src="<?php echo('p/pages/smallfrontoutbg-'.$pageData1['imagefrontoutbgsmall']) ?>" alt="" data-fit="cover">
                    </picture>
                <?php } ?>

                <!-- full height  layout -->
                <div class="full-height__layout">

                    <!-- middle text -->
                    <div class="middle-text">

                        <!-- fd  title type2 -->
                        <h1 class="fd__title_type2">
                            <?php echo($pageData1['titlefrontout']) ?>
                        </h1>
                        <!--/fd  title type2 -->

                        <div class="start-screen-cats start-screen-cats_mob-sheight">

                            <!-- start screen cats list -->
                            <ul class="start-screen-cats-list">

                                <!-- start screen cats items -->
                                <li class="start-screen-cats-items">

                                    <!-- start screen cats item content -->
                                    <?php echo($pageData1['titlemiddlefrontout']) ?>
                                </li>
                                <!--/start screen cats items -->


                                <!-- start screen cats items -->
                                <li class="start-screen-cats-items">

                                    <!-- start screen cats item content -->
                                    <?php echo($pageData1['titlesmallfrontout']) ?>
                                </li>
                                <!--/start screen cats items -->


                                <!-- start screen cats items -->
                                <li class="start-screen-cats-items">

                                    <!-- start screen cats item content -->
                                    <?php echo($pageData1['titlesmallfrontout2']) ?>
                                </li>
                                <!--/start screen cats items -->

                            </ul>
                            <!--/start screen cats list -->

                        </div>
                    </div>
                    <!--/middle text -->

                    <div class="direct-line hide"></div>
                    <div class="arrow"></div>
                </div>
                <!--/full height  layout -->

            </div>
            <!--/full height -->


            <!-- main wrap -->
            <div class="main-wrap">

                <!-- article -->
                <section class="article fd__digits">
                    <h2><?php echo($pageData1['frndoutsect2title']) ?></h2>
                         <?php echo($pageData1['frndoutsect2data']) ?>
                </section>
                <!--/article -->


                <!-- stages -->
                <div id="indicators1" class="stages stages_five-items hor-indicators">

                    <!-- stages  back -->
                    <div class="stages__back">
                        <div class="hor-ind"></div>
                    </div>
                    <!--/stages  back -->

                    <div class="stages__back stages__back-2"><img src="markup/img/sites/frondevo.png" alt="Сайты" width="4826" height="612" class="hor-ind"></div>

                    <!-- stages  wrap -->
                    <div class="stages__wrap">
                        <h2><?php echo($pageData1['frndoutsect3title']) ?></h2>
                        <h3>
                            <?php foreach ($pageData1['ourclientslist'] as $pslist) { ?>

                                <span><?php echo $pslist['text'] ?></span>

                            <?php } ?>

                        </h3>

                        <!-- fd  logos -->
                        <div class="fd__logos">

                            <!-- fd  logos list -->
                            <ul class="fd__logos-list">


                                <?php foreach ($pageData1['imageourclientslogo'] as $clientlogo) { ?>
                                <li class="fd__logos-item">
                                    <span><img src="<?php echo $clientlogo['img'] ?>" alt=""</span>
                                </li>
                                <?php } ?>

                            </ul>
                            <!--/fd  logos list -->

                        </div>

                    </div>
                    <!--/stages  wrap -->

                </div>
                <!--/stages -->


                <!-- cooperation -->
                <div class="cooperation">

                    <!-- layout -->
                    <div class="layout">
                        <h2>
                            <?php echo($pageData1['othervariantstitle']) ?>
                        </h2>

                        <!-- cooperation  list wrap -->
                        <div class="cooperation__list-wrap">

                            <!-- cooperation  list -->
                            <div class="cooperation__list">

                                <!-- cooperation  item -->
                                <div class="cooperation__item">
                                    <h3><?php echo($pageData1['othervariants1title']) ?>  </h3>
                                    <p><?php echo($pageData1['othervariants1text']) ?></p>
                                </div>
                                <!--/cooperation  item -->


                                <!-- cooperation  item -->
                                <div class="cooperation__item">
                                    <h3><?php echo($pageData1['othervariants2title']) ?></h3>
                                    <p><?php echo($pageData1['othervariants2text']) ?></p>
                                </div>
                                <!--/cooperation  item -->

                            </div>
                            <!--/cooperation  list -->

                        </div>
                        <!--/cooperation  list wrap -->

                    </div>
                    <!--/layout -->

                </div>
                <!--/cooperation -->


                <!-- stages -->
                <div class="stages stages_type2">

                    <!-- stages  back -->
                    <div class="stages__back">
                        <div class="hor-ind"></div>
                    </div>
                    <!--/stages  back -->

                    <div class="stages__back stages__back-3"><img src="markup/img/sites/frondevo.png" alt="Сайты" width="4826" height="612" class="hor-ind"></div>

                    <!-- stages  wrap -->
                    <div class="stages__wrap">
                        <h2><?php echo($pageData1['ourcompaniestitle']) ?></h2>

                        <!-- fd  logos -->
                        <div class="fd__logos">

                            <!-- fd  logos list -->
                            <ul class="fd__logos-list">
                                <?php foreach ($pageData1['imageourcompanieslogo'] as $clientlogo) { ?>
                                    <li class="fd__logos-item">
                                        <span><img src="<?php echo $clientlogo['img'] ?>" alt=""</span>
                                    </li>
                                <?php } ?>

                            </ul>
                            <!--/fd  logos list -->

                        </div>
                        <!--/fd  logos -->

                    </div>
                    <!--/stages  wrap -->

                </div>
                <!--/stages -->


                <!-- our works -->
                <div class="our-works our-works_type2 our-works_vert">
                    <h2>
                        <span><?php echo($pageData1['worksexamplesfrontendouttitle']) ?></span>
                    </h2>

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
