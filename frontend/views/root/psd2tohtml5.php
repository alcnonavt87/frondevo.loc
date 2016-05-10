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
            <source srcset="<?php echo('p/pages/bigpsd2html5bg-'.$pageData['imagepsd2html5bgbig']) ?>" media="(min-height: 900px)">
            <source srcset="<?php echo('p/pages/smallpsd2html5bg-'.$pageData['imagepsd2html5bgsmall']) ?>" media="(min-height: 480px)">
            <img src="<?php echo('p/pages/smallpsd2html5bg-'.$pageData['imagepsd2html5bgsmall']) ?>" alt="" data-fit="cover">
        </picture>

        <!-- full height  layout -->
        <div class="full-height__layout">

            <!-- middle text -->
            <div class="middle-text">

                <!-- fd  title type3 -->
                <h1 class="fd__title_type3">
                    <?php echo($pageData['psd2html5mainscreebtitle']) ?>
                </h1>
                <!--/fd  title type3 -->

                <!--p!= page.data.siteDescription-->
                <div class="start-screen-cats start-screen-cats_triple start-screen-cats_mob-block">

                    <!-- start screen cats list -->
                    <ul class="start-screen-cats-list">

                        <!-- start screen cats items -->
                        <li class="start-screen-cats-items">
                            <?php echo($pageData['psd2html5mainscreebtitle1']) ?>
                            <!-- start screen cats item content -->

                            <!--/start screen cats item content -->

                        </li>
                        <!--/start screen cats items -->


                        <!-- start screen cats items -->
                        <li class="start-screen-cats-items">

                            <?php echo($pageData['psd2html5mainscreebtitle2']) ?>

                        </li>
                        <!--/start screen cats items -->


                        <!-- start screen cats items -->
                        <li class="start-screen-cats-items">

                            <?php echo($pageData['psd2html5mainscreebtitle3']) ?>

                        </li>
                        <!--/start screen cats items -->

                    </ul>
                    <!--/start screen cats list -->

                </div>
                <div class="start-screen-cats start-screen-cats_tetra">

                    <!-- start screen cats list -->
                    <ul class="start-screen-cats-list">

                        <!-- start screen cats items -->
                        <li class="start-screen-cats-items">
                            <div class="start-screen-cats-item-footer"> <?php echo($pageData['psd2html5mainscreebtitle4']) ?></div>
                        </li>
                        <!--/start screen cats items -->


                        <!-- start screen cats items -->
                        <li class="start-screen-cats-items">
                            <div class="start-screen-cats-item-footer"> <?php echo($pageData['psd2html5mainscreebtitle5']) ?></div>
                        </li>
                        <!--/start screen cats items -->


                        <!-- start screen cats items -->
                        <li class="start-screen-cats-items">
                            <div class="start-screen-cats-item-footer"> <?php echo($pageData['psd2html5mainscreebtitle6']) ?></div>
                        </li>
                        <!--/start screen cats items -->


                        <!-- start screen cats items -->
                        <li class="start-screen-cats-items">
                            <div class="start-screen-cats-item-footer"> <?php echo($pageData['psd2html5mainscreebtitle7']) ?></div>
                        </li>
                        <!--/start screen cats items -->

                    </ul>
                    <!--/start screen cats list -->

                </div>
            </div>
            <!--/middle text -->

            <div class="direct-line hide hide-mob"></div>
            <div class="arrow"></div>
        </div>
        <!--/full height  layout -->

    </div>
    <!--/full height -->


    <!-- main wrap -->
    <div class="main-wrap">

        <!-- article -->
        <section class="article light why2">
            <!--h2
            span Увлекательный интерактив — это
            | мощный маркетинговый инструмент <br/>для проведения масштабных пиар компаний.
            -->

            <!-- layout -->
            <div class="layout">

                <!-- why dl -->
                <div class="why-dl">

                    <!-- why dl row -->
                    <div class="why-dl-row">
                        <div class="why-dt">Внимание к работе дизайнера</div>

                        <!-- why dd -->
                        <div class="why-dd">
                            <ul>
                                <li>стремление к максимальной передаче задумки</li>
                                <li>внимание к деталям</li>
                                <li>попиксельное соответствие дизайну</li>
                            </ul>
                        </div>
                        <!--/why dd -->

                    </div>
                    <!--/why dl row -->


                    <!-- why dl row -->
                    <div class="why-dl-row">
                        <div class="why-dt">Сэкономьте время <br/>своих back end разрабочиков</div>

                        <!-- why dd -->
                        <div class="why-dd">
                            <p>Быстрая интеграция верстки: <b>наш HTML код позволяет сосредоточиться на логике</b>, а не на привязке оформления.</p>
                            <ul>
                                <li>чистый код</li>
                                <li>пояснения и комментарии к HTML коду</li>
                                <li>консультации по ходу привязки</li>
                            </ul>
                        </div>
                        <!--/why dd -->

                    </div>
                    <!--/why dl row -->


                    <!-- why dl row -->
                    <div class="why-dl-row">
                        <div class="why-dt">Легкая интеграция <br/>с любой CMS</div>

                        <!-- why dd -->
                        <div class="why-dd">
                            <ul>
                                <li>верстка независимымми блоками / модулями</li>
                                <li>гибкий код</li>
                                <li>легкая адаптация под особенности вашей CMS</li>
                            </ul>
                        </div>
                        <!--/why dd -->

                    </div>
                    <!--/why dl row -->


                    <!-- why dl row -->
                    <div class="why-dl-row">
                        <div class="why-dt">Лучшие SEO результаты</div>

                        <!-- why dd -->
                        <div class="why-dd">
                            <p>Добивайтесь большего и в более сжатые сроки с оптимизированным HTML кодом:</p>
                            <ul>
                                <li>оптимизация скорости загрузки</li>
                                <li>хорошее usability на разных устройствах</li>
                                <li>оптимизированный семантический HTML5 код</li>
                                <li>применение HTML5 Microdata</li>
                            </ul>
                        </div>
                        <!--/why dd -->

                    </div>
                    <!--/why dl row -->


                    <!-- why dl row -->
                    <div class="why-dl-row">
                        <div class="why-dt">Больше <br/>довольных пользователей</div>

                        <!-- why dd -->
                        <div class="why-dd">
                            <p>Полная поддержка современных платформ и браузеров:</p>
                            <ul>
                                <li>MacOs, Windows, Ubuntu, iOs, Android</li>
                                <li>Chrome, Safari, Firefox, Internet Explorer, Opera, нативные браузеры для iOs и Android</li>
                                <li>Outlook, Gmail, Yahoo, Thunderbird, Mail Apps для iOs и Android, Yandex, Mail.ru</li>
                            </ul>
                        </div>
                        <!--/why dd -->

                    </div>
                    <!--/why dl row -->


                    <!-- why dl row -->
                    <div class="why-dl-row">
                        <div class="why-dt">Предсказуемый код</div>

                        <!-- why dd -->
                        <div class="why-dd">
                            <p>Полное соответствие веб стандартам W3C:</p>
                            <ul>
                                <li>HTML5</li>
                                <li>CSS3</li>
                                <li>Microdata</li>
                            </ul>
                        </div>
                        <!--/why dd -->

                    </div>
                    <!--/why dl row -->


                    <!-- why dl row -->
                    <div class="why-dl-row">
                        <div class="why-dt">Современные технологии <br/>разработки</div>

                        <!-- why dd -->
                        <div class="why-dd">
                            <ul>
                                <li>Jade</li>
                                <li>SASS / Compass</li>
                                <li>Gulp</li>
                                <li>Git</li>
                            </ul>
                        </div>
                        <!--/why dd -->

                    </div>
                    <!--/why dl row -->


                    <!-- why dl row -->
                    <div class="why-dl-row">
                        <div class="why-dt">Проверка качества</div>

                        <!-- why dd -->
                        <div class="why-dd">
                            <p>Каждый проект перед демонстрацией клиенту проходит внутреннее тестирование по более 40 критериям качества.</p>
                        </div>
                        <!--/why dd -->

                    </div>
                    <!--/why dl row -->

                </div>
                <!--/why dl -->

            </div>
            <!--/layout -->

        </section>
        <!--/article -->


        <!-- our works -->
        <div class="our-works our-works_type2 our-works_vert">
            <h2>
                <span>Примеры Javascript кода от нашей команды</span>
            </h2>

            <!-- our works menu -->
            <div class="our-works-menu">

                <!-- our works menu list -->
                <ul data-fd-works-menu-list="works" data-fd-works-action="server/works.json" class="our-works-menu-list">

                    <!-- our works menu item -->
                    <li data-fd-works-menu-item class="our-works-menu-item active">
                        <a href="#" data-fd-works-filter="adaptive">Адаптивность</a>
                    </li>
                    <!--/our works menu item -->


                    <!-- our works menu item -->
                    <li data-fd-works-menu-item class="our-works-menu-item">
                        <a href="#" data-fd-works-filter="landing">Landing pages</a>
                    </li>
                    <!--/our works menu item -->


                    <!-- our works menu item -->
                    <li data-fd-works-menu-item class="our-works-menu-item">
                        <a href="#" data-fd-works-filter="ecommerce">E-commerce</a>
                    </li>
                    <!--/our works menu item -->


                    <!-- our works menu item -->
                    <li data-fd-works-menu-item class="our-works-menu-item">
                        <a href="#" data-fd-works-filter="complex">Сложные дизайны</a>
                    </li>
                    <!--/our works menu item -->

                </ul>
                <!--/our works menu list -->

            </div>
            <!--/our works menu -->


            <!-- our works  wrap -->
            <div class="our-works__wrap">

                <!-- "works" -->
                <div data-fd-works-list="works">

                    <!-- static works -->
                    <div data-fd-static-works class="static_works">
                        <ul>

                            <!-- tEndElement2 -->
                            <li data-fd-works-item class="tEndElement2">

                                <!-- # -->
                                <a href="#"><img src="pic/our-works-front/work1.jpg" alt="">
                                    <div>

                                        <!-- our works  descr -->
                                        <div class="our-works__descr">
                                            <span>Responsive</span>
                                            <span>Animations</span>
                                            <span>Landing page</span>
                                            <span>Promo</span>
                                        </div>
                                        <!--/our works  descr -->

                                    </div>
                                </a>
                                <!--/# -->

                            </li>
                            <!--/tEndElement2 -->


                            <!-- tEndElement2 -->
                            <li data-fd-works-item class="tEndElement2">

                                <!-- # -->
                                <a href="#"><img src="pic/our-works-front/work2.jpg" alt="">
                                    <div>

                                        <!-- our works  descr -->
                                        <div class="our-works__descr">
                                            <span>Responsive</span>
                                            <span>Animations</span>
                                            <span>Landing page</span>
                                            <span>Promo</span>
                                        </div>
                                        <!--/our works  descr -->

                                    </div>
                                </a>
                                <!--/# -->

                            </li>
                            <!--/tEndElement2 -->


                            <!-- tEndElement2 -->
                            <li data-fd-works-item class="tEndElement2">

                                <!-- # -->
                                <a href="#"><img src="pic/our-works-front/work3.jpg" alt="">
                                    <div>

                                        <!-- our works  descr -->
                                        <div class="our-works__descr">
                                            <span>Responsive</span>
                                            <span>Animations</span>
                                        </div>
                                        <!--/our works  descr -->

                                    </div>
                                </a>
                                <!--/# -->

                            </li>
                            <!--/tEndElement2 -->


                            <!-- tEndElement2 -->
                            <li data-fd-works-item class="tEndElement2">

                                <!-- # -->
                                <a href="#"><img src="pic/our-works-front/work4.jpg" alt="">
                                    <div>

                                        <!-- our works  descr -->
                                        <div class="our-works__descr">
                                            <span>Responsive</span>
                                            <span>Animations</span>
                                            <span>Landing page</span>
                                        </div>
                                        <!--/our works  descr -->

                                    </div>
                                </a>
                                <!--/# -->

                            </li>
                            <!--/tEndElement2 -->


                            <!-- tEndElement2 -->
                            <li data-fd-works-item class="tEndElement2">

                                <!-- # -->
                                <a href="#"><img src="pic/our-works-front/work5.jpg" alt="">
                                    <div>

                                        <!-- our works  descr -->
                                        <div class="our-works__descr">
                                            <span>Responsive</span>
                                        </div>
                                        <!--/our works  descr -->

                                    </div>
                                </a>
                                <!--/# -->

                            </li>
                            <!--/tEndElement2 -->

                        </ul>
                        <ul>

                            <!-- tEndElement2 -->
                            <li data-fd-works-item class="tEndElement2">

                                <!-- # -->
                                <a href="#"><img src="pic/our-works-front/work3.jpg" alt="">
                                    <div>

                                        <!-- our works  descr -->
                                        <div class="our-works__descr">
                                            <span>Responsive</span>
                                            <span>Animations</span>
                                            <span>Landing page</span>
                                            <span>Promo</span>
                                        </div>
                                        <!--/our works  descr -->

                                    </div>
                                </a>
                                <!--/# -->

                            </li>
                            <!--/tEndElement2 -->


                            <!-- tEndElement2 -->
                            <li data-fd-works-item class="tEndElement2">

                                <!-- # -->
                                <a href="#"><img src="pic/our-works-front/work5.jpg" alt="">
                                    <div>

                                        <!-- our works  descr -->
                                        <div class="our-works__descr">
                                            <span>Responsive</span>
                                            <span>Animations</span>
                                            <span>Landing page</span>
                                            <span>Promo</span>
                                        </div>
                                        <!--/our works  descr -->

                                    </div>
                                </a>
                                <!--/# -->

                            </li>
                            <!--/tEndElement2 -->


                            <!-- tEndElement2 -->
                            <li data-fd-works-item class="tEndElement2">

                                <!-- # -->
                                <a href="#"><img src="pic/our-works-front/work4.jpg" alt="">
                                    <div>

                                        <!-- our works  descr -->
                                        <div class="our-works__descr">
                                            <span>Responsive</span>
                                            <span>Animations</span>
                                        </div>
                                        <!--/our works  descr -->

                                    </div>
                                </a>
                                <!--/# -->

                            </li>
                            <!--/tEndElement2 -->


                            <!-- tEndElement2 -->
                            <li data-fd-works-item class="tEndElement2">

                                <!-- # -->
                                <a href="#"><img src="pic/our-works-front/work2.jpg" alt="">
                                    <div>

                                        <!-- our works  descr -->
                                        <div class="our-works__descr">
                                            <span>Responsive</span>
                                            <span>Animations</span>
                                            <span>Landing page</span>
                                        </div>
                                        <!--/our works  descr -->

                                    </div>
                                </a>
                                <!--/# -->

                            </li>
                            <!--/tEndElement2 -->


                            <!-- tEndElement2 -->
                            <li data-fd-works-item class="tEndElement2">

                                <!-- # -->
                                <a href="#"><img src="pic/our-works-front/work1.jpg" alt="">
                                    <div>

                                        <!-- our works  descr -->
                                        <div class="our-works__descr">
                                            <span>Responsive</span>
                                        </div>
                                        <!--/our works  descr -->

                                    </div>
                                </a>
                                <!--/# -->

                            </li>
                            <!--/tEndElement2 -->

                        </ul>
                    </div>
                    <!--/static works -->

                </div>
                <!--/"works" -->


                <!-- our works footer -->
                <div class="our-works-footer">
                    <div>

                        <!-- button -->
                        <a href="#" class="button light">
                            <span>посмотреть front end портфолио</span>
                        </a>
                        <!--/button -->

                    </div>
                    <p>256 работ</p>
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








