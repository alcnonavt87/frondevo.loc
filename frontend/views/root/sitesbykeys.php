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
        <source srcset="/frontend/web/markup/img/bg/site-bg-1200.jpg" media="(min-height: 900px)">
        <source srcset="/frontend/web/markup/img/bg/site-bg-736.jpg" media="(min-height: 736px)">
        <source srcset="/frontend/web/markup/img/bg/site-bg-480.jpg" media="(min-height: 480px)">
        <img src="/frontend/web/markup/img/bg/site-bg-480.jpg" alt="" data-fit="cover">
    </picture>

    <!-- full height  layout -->
    <div class="full-height__layout">

        <!-- middle text -->
        <div class="middle-text">
            <h1>
                            <span>
                                <span>разрабатываем</span>
                                <span>сайты, которые</span>
                            </span>
                            <span>
                                <span class="ru-lt-1">у</span>
                                <span class="ru-lt-2">б</span>
                                <span class="ru-lt-3">е</span>
                                <span class="ru-lt-4">ж</span>
                                <span class="ru-lt-5">д</span>
                                <span class="ru-lt-6">а</span>
                                <span class="ru-lt-7">ю</span>
                                <span class="ru-lt-8">т</span>
                            </span>
                            <span>
                                <span>приобретать ваши продукты</span>
                            </span>
            </h1>

            <p>Современные интернет-решения с высоким уровнем конверсий<br> и мощной внутренней SEO оптимизацией</p>
        </div>
        <!--/middle text -->

        <div class="direct-line"></div>
        <div class="arrow"></div>
        <div class="background-text">Сайты</div>
    </div>
    <!--/full height  layout -->

</div>
<!--/full height -->


<!-- main wrap -->
<div class="main-wrap">

    <!-- choose  reason -->
    <div class="choose__reason">

        <!-- layout -->
        <div class="layout">

            <!-- choose  reason t1 -->
            <div class="choose__reason_t1">
                <span>причины,<br> по которым</span>
                <span>стоит<br> обратиться именно к нам</span>
            </div>
            <!--/choose  reason t1 -->


            <!-- choose  reason t2 -->

            <div class="choose__reason_t2 frame">
                <input type="radio" name="reason-list" id="input-reason-1" checked="checked">
                <input type="radio" name="reason-list" id="input-reason-2">
                <input type="radio" name="reason-list" id="input-reason-3">
                <input type="radio" name="reason-list" id="input-reason-4">
                <input type="radio" name="reason-list" id="input-reason-5">
                <ul>
                    <li>
                        <div>
                                        <span>

                                            <!-- (i + 1) -->
                                            <span data-step='1'>
                                                <span>Бизнес-мышление</span>
                                            </span>
                                            <!--/(i + 1) -->

                                        </span>

                            <div>
                                <p class="white">Сначала думаем как будем продавать. Потом — как это будет выглядеть и
                                    работать.</p>

                                <p>Используя хорошее понимание бизнеса клиента, его рыночной ниши и целевой аудитории,
                                    можно обеспечить существенное конкурентное преимущество любому бизнес-проекту.</p>

                                <p>Поэтому мы особое внимание уделяем маркетинговому исследованию и подготовке
                                    маркетинговой стратегии до начала разработки сайта.</p>

                                <!-- choose  reason button wrap -->
                                <label for="input-reason-2" class="choose__reason-button-wrap">
                                    <span>1</span>

                                    <div class="choose__reason-next"></div>
                                </label>
                                <!--/choose  reason button wrap -->

                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                                        <span>

                                            <!-- (i + 1) -->
                                            <span data-step='2'>
                                                <span>Больше, чем разработка сайта</span>
                                            </span>
                                            <!--/(i + 1) -->

                                        </span>

                            <div>
                                <p>Сможем помочь понять особенности интернет-рынка и его тенденции, разработать
                                    оптимальный план развития проекта с учетом выбранной маркетинговой стратегии и
                                    имеющихся ресурсов.</p>

                                <!-- choose  reason button wrap -->
                                <label for="input-reason-3" class="choose__reason-button-wrap">
                                    <span>2</span>

                                    <div class="choose__reason-next"></div>
                                </label>
                                <!--/choose  reason button wrap -->

                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                                        <span>

                                            <!-- (i + 1) -->
                                            <span data-step='3'>
                                                <span>Высокая эффективность </span>
                                            </span>
                                            <!--/(i + 1) -->

                                        </span>

                            <div>
                                <p>Мы не используем шаблонные решения. Наши проекты разрабатываются индивидуально под
                                    задачи клиента. Это позволяет создавать максимально эффективные продукты.</p>

                                <!-- choose  reason button wrap -->
                                <label for="input-reason-4" class="choose__reason-button-wrap">
                                    <span>3</span>

                                    <div class="choose__reason-next"></div>
                                </label>
                                <!--/choose  reason button wrap -->

                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                                        <span>

                                            <!-- (i + 1) -->
                                            <span data-step='4'>
                                                <span>На шаг впереди</span>
                                            </span>
                                            <!--/(i + 1) -->

                                        </span>

                            <div>
                                <p>Применение новейших технологий веб-разработки, современных трендов в дизайне,
                                    эффективных методик рекламы позволяет нашим клиентам быть на шаг впереди
                                    конкурентов.</p>

                                <!-- choose  reason button wrap -->
                                <label for="input-reason-5" class="choose__reason-button-wrap">
                                    <span>4</span>

                                    <div class="choose__reason-next"></div>
                                </label>
                                <!--/choose  reason button wrap -->

                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                                        <span>

                                            <!-- (i + 1) -->
                                            <span data-step='5'>
                                                <span>знание закулисья</span>
                                            </span>
                                            <!--/(i + 1) -->

                                        </span>

                            <div>
                                <p>У нас есть опыт создания и развития собственных интернет проектов. Это бесценные
                                    знания, которые не получить просто разрабатывая сайты на аутсорсе.</p>

                                <!-- choose  reason button wrap -->
                                <label for="input-reason-1" class="choose__reason-button-wrap">
                                    <span>5</span>

                                    <div class="choose__reason-next"></div>
                                </label>
                                <!--/choose  reason button wrap -->

                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!--/choose  reason t2 -->


            <!-- choose  reason t3 -->
            <div class="choose__reason_t3">
                <span>разделяем точку зрения, что<br></span>
                <span>пренебрежение качеством сегодня, <br>приводит к потере клиентов завтра.</span>
            </div>
            <!--/choose  reason t3 -->

        </div>
        <!--/layout -->

    </div>
    <!--/choose  reason -->
    <?php /*echo htmlspecialchars_decode($pageData['section1'])*/ ?>

    <!-- our works -->
    <div class="our-works">
        <h2>
            <span>качество сайта измеряется</span>достижением поставленных бизнес-целей
        </h2>

        <h3>примеры наших работ</h3>

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
                                    src="<?php echo '/frontend/web/p/works/bigsbk-' . $work['id'] . '-image.jpg' ?>"
                                    alt="">
                                <div>
                                        <span> <?php echo $work['description']; ?></span>
                                </div>
                            </a>
                        </li>
                        <!--/(index === 0 ? long : ) -->
                    <?php } else if ($key <= 2) { ?>
                        <!--/(index === 0 ? long : ) -->
                        <li>
                            <a href="<?php echo $workUrl; ?>"><img src="<?php echo $work['imgPath'] ?>" alt="">
                                <div>
                                    <span> <?php echo $work['description']; ?></span>
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
                                        <span> <?php echo $work['description']; ?></span>
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
                <span>Успех коммерческого сайта<br> — это результат закалки</span>несколькими итерациями улучшений
            </h2>

            <h3>наш подход к разработке сайтов</h3>

            <!-- approach  list wrap -->
            <div class="approach__list-wrap">

                <!-- approach  list -->
                <div class="approach__list">

                    <!-- approach  item -->
                    <div class="approach__item">
                        <h3>обсуждение</h3>

                        <p>Каким вы видите свой будущий сайт. <br>Согласование целей и задач, общего <br>порядка
                            предстоящих работ.</p>
                    </div>
                    <!--/approach  item -->


                    <!-- approach  item -->
                    <div class="approach__item">
                        <h3>исследование</h3>

                        <p>Знакомство с вашей отраслью и вашим продуктом. Изучение конъюктуры рынка. Определение и
                            детальное изучение целевой аудитории. Разбор сильных и слабых сторон вашего предложения.</p>
                    </div>
                    <!--/approach  item -->


                    <!-- approach  item -->
                    <div class="approach__item">
                        <h3>стратегия</h3>

                        <p>Подготовка маркетинговой стратегии и <br>этапов развития проекта с учетом текущей <br>конкуренции,
                            динамики развития рынка и имеющихся у вас ресурсов.</p>
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
                            <h3>проектирование</h3>

                            <p>UI/UX дизайн. Разработка согласно целям проекта. Корректировка по результатам
                                аналитики.</p>
                        </div>
                        <!--/approach  item -->


                        <!-- approach  item -->
                        <div class="approach__item">
                            <h3>разработка</h3>

                            <p>Копирайтинг. Дизайн. Техническая часть. Наполнение контентом. Тестирование.</p>
                        </div>
                        <!--/approach  item -->


                        <!-- approach  item -->
                        <div class="approach__item">
                            <h3>маркетинг</h3>

                            <p>Разработка структуры сайта и прототипирование типвых страниц полагаясь на полученные
                                исследования.</p>
                        </div>
                        <!--/approach  item -->


                        <!-- approach  item -->
                        <div class="approach__item">
                            <h3>аналитика</h3>

                            <p>Разработка структуры сайта и прототипирование типвых страниц полагаясь на полученные
                                исследования.</p>
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
    <?php /*echo htmlspecialchars_decode($pageData['section1'])*/ ?>

    <!-- stages -->
    <div id="indicators1" class="stages hor-indicators">

        <!-- stages  back -->
        <div class="stages__back">
            <div class="hor-ind"></div>
        </div>
        <!--/stages  back -->

        <div class="stages__back stages__back-2"><img src="/frontend/web/markup/img/sites/frondevo.png" alt="Сайты"
                                                      width="4826" height="612" class="hor-ind"></div>

        <!-- stages  wrap -->
        <div class="stages__wrap">
            <h2>в среднем разработка сайта длится 3 месяца <br>и задействует 8 специалистов</h2>

            <h3>результаты каждого этапа демонстрируются и обсуждаются с клиентом</h3>

            <!-- stages  layout -->
            <div data-indicators="indicators1" class="stages__layout hor-wrapper">

                <!-- stages  scroll -->
                <div class="stages__scroll hor-scroller hor-scrollbar hor-snap-mobile">

                    <!-- stages  list -->
                    <ul class="stages__list">

                        <!-- stages  item -->
                        <li class="stages__item hor-sizing hor-snap researching">
                            <h3>Исследования</h3>

                            <div>
                                <ul>
                                    <li>определение задач и целей проекта</li>
                                    <li>анализ Вашей бизнес-модели</li>
                                    <li>аудит Вашей отрасли в Интернет</li>
                                    <li>определение и исследование целевой адуитории</li>
                                    <li>аудит Вашего сайта</li>
                                    <li>анализ сайтов конкурентов</li>
                                    <li>разработка перечня маркетинговых рекомендаций для будущего сайта</li>
                                </ul>
                            </div>
                        </li>
                        <!--/stages  item -->


                        <!-- stages  item -->
                        <li class="stages__item hor-sizing hor-snap projecting">
                            <h3>Проектирование</h3>

                            <div>
                                <ul>
                                    <li>определение необходимых технических требований</li>
                                    <li>проектирование схем воронок продаж</li>
                                    <li>проектирование схем привлечения трафика</li>
                                    <li>разработка стурктуры сайта</li>
                                    <li>проектирование интерфейсов с учетом множества доступных устройств пользователю
                                    </li>
                                    <li>подготовка технических заданий для проектной группы</li>
                                </ul>
                            </div>
                        </li>
                        <!--/stages  item -->


                        <!-- stages  item -->
                        <li class="stages__item hor-sizing hor-snap designing">
                            <h3>Дизайн</h3>

                            <div>
                                <ul>
                                    <li>современные графические и интерактивные решения</li>
                                    <li>эмоциональное воздействие на целевую аудиторию</li>
                                    <li>разработка сценариев для интерактивных элементов и анимационных эффектов</li>
                                    <li>применение практик повышения уровня конверсии</li>
                                    <li>использование методик по улучшению степени удобности использования сайтом</li>
                                </ul>
                            </div>
                        </li>
                        <!--/stages  item -->


                        <!-- stages  item -->
                        <li class="stages__item hor-sizing hor-snap developing">
                            <h3>Разработка</h3>

                            <div>
                                <ul>
                                    <li>современные технологии веб разработки</li>
                                    <li>индивидуальные решения под Ваши задачи</li>
                                    <li>оптимизация работы операторов сайта</li>
                                    <li>максимальная внутренняя SEO оптимизация проекта</li>
                                    <li>высококачественная оптимизация скорости загрузки сайта и его работы</li>
                                    <li>12 уровней защиты от взлома сайта</li>
                                    <li>высокие стандарты качества кода</li>
                                </ul>
                            </div>
                        </li>
                        <!--/stages  item -->


                        <!-- stages  item -->
                        <li class="stages__item hor-sizing hor-snap contenting">
                            <h3>Контент</h3>

                            <div>
                                <ul>
                                    <li>разработка контент стратегии</li>
                                    <li>текстовые и графические материалы. подготовка, обработка, размещение на сайте
                                    </li>
                                    <li>составление эмоциональных промо и продающих текстов</li>
                                    <li>подготовка SEO оптимизированных текстов</li>
                                </ul>
                            </div>
                        </li>
                        <!--/stages  item -->


                        <!-- stages  item -->
                        <li class="stages__item hor-sizing hor-snap supporting">
                            <h3>Поддержка</h3>

                            <div>
                                <ul>
                                    <li>все виды работ с контентом</li>
                                    <li>аудит эффективности SEO продвижения</li>
                                    <li>анализ поведения посетителей на сайте</li>
                                    <li>мониторинг работоспособности сайта и устранение технических проблем</li>
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
                <span>что получает</span> наш клиент
            </h2>
            <ul>
                <li>консультацию по особенностям интернет-продаж</li>
                <li>гарантию защиты конфиденциальных данных</li>
                <li>сайт с высоким процентом конверсий и серьезным уровнем SEO оптимизации</li>
                <li>умеренную цену</li>
                <li>техническое и маркетинговое сопровождение</li>
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
<?php
//
// Шаблон страницы для Сайты под ключ
//
// Принимаемые переменные:
// $alias - алиас страницы
// $pH1 - заголовок h1
//
?>
template for page sitesbykeys<br>
<?php echo $pH1; ?>


