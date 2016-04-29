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
            <?php
            if (Yii::$app->request->getAbsoluteUrl() == $textPagesUrlProvider->getPortfolioUrl()){
                echo "<h1>".$pH1."</h1>";}
            else foreach ($filters as $filter) {
                $params['item'] = $filter;
                $filterUrl = $textPagesUrlProvider->geteFilterUrl($params);
                $filterActive = ($filter['url'] == $filterUri);
                if ($filterActive)
                    echo " <h1>" . $filter['title'] . "</h1>";
            }
           ?>
            <address>
                <span>Украина, г. Киев</span>
                <a href="tel:+380671702727">+38 067 170 27 27</a>
                <a href="mailto:welcome@frondevo.com">welcome@frondevo.com</a>
            </address>
             <!-- fd  menu -->
            <div data-module="projectsfilter" data-filter-list="filter1" class="fd__menu filter-menu fd__menu_line">
                <div>

                    <ul class="fd__menu fd__menu_line">
                        <?php
                        $AllActive = (Yii::$app->request->getAbsoluteUrl() == $textPagesUrlProvider->getPortfolioUrl());
                        if ($AllActive) {
                            ?>
                            <li class="m-item active">
                         <span> <?php echo Yii::t('app', 'All'); ?> <span>
                            </li>
                        <?php } else { ?>
                            <li class='m-item'>
                                <a href="<?php echo($textPagesUrlProvider->getPortfolioUrl()) ?>" target="_parent"
                                   rel="nofollow "><span><?php echo Yii::t('app', 'All'); ?></span></a>
                            </li>
                        <?php } ?>
                        <!-- m item -->


                        <!--/m item -->


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
            <!--/fd  menu -->

        </div>
        <!--/middle text -->

    </div>
    <!--/full height  layout -->

</div>
<!--/black layout -->


<!-- fd  project list -->
<div class="fd__project-list">

    <!-- pl list -->
    <div data-filter-id="filter1" data-module="listscroll" class="pl-list hidden">
        <?php foreach ($works as $work) { ?>
        <?php
        $params['item'] = $work;
        $workUrl = $simpleModuleUrlProvider->geteWorksItemUrl($params);
        ?>
        <!-- pl item -->
        <section data-listscroll-item="true" data-project-type="sites" class="pl-item visible no-animation">

            <!-- pl cell -->
            <div class="pl-cell">

                <!-- pl cell wrap -->
                <div class="pl-cell-wrap">

                    <!-- pl header -->
                    <div class="pl-header">
                        <h2 class="pl-title"><?php echo $work['title']; ?></h2>

                        <div class="pl-description g_text"><?php echo $work['pDescription']; ?></div>
                    </div>
                    <!--/pl header -->


                    <!-- pl btns set -->
                    <div class="pl-btns-set">

                        <!-- button -->
                        <a href="<?php echo $workUrl; ?>" class="button dark">
                            <span>Детали</span>
                        </a>
                        <!--/button -->

                        <!--span.pl-btns-set-rowa.btn(href="project-inner.html") Детали
                        -->
                        <!--span.pl-btns-set-rowa.btn(href="#") Посмотреть демо
                        -->
                    </div>
                    <!--/pl btns set -->

                </div>
                <!--/pl cell wrap -->

            </div>
            <!--/pl cell -->

            <div class="pl-image-wrap"><img src="<?php echo $work['imgPath']; ?>" alt="<?php echo $work['title']; ?>" data-fd-object-fit></div>
        </section>
        <!--/pl item -->

        <!--/pl list -->
        <?php } ?>
    </div>
    <!--/fd  project list -->

</div>