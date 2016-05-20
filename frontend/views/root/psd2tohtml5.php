<?php
use frontend\models\Common;
use vendor\UrlProvider\SimpleModuleUrlProvider;
use vendor\UrlProvider\TextPagesUrlProvider;

$options['joinUris'] = 1;
$simpleModuleUrlProvider = new SimpleModuleUrlProvider($lang, $options);
$textPagesUrlProvider = new TextPagesUrlProvider($lang);
?>
<div class="full-height inner mesh">
    <picture>
        <source srcset="<?php echo('p/pages/bigpsd2html5bg-' . $pageData['imagepsd2html5bgbig']) ?>"
                media="(min-height: 900px)">
        <source srcset="<?php echo('p/pages/smallpsd2html5bg-' . $pageData['imagepsd2html5bgsmall']) ?>"
                media="(min-height: 480px)">
        <img src="<?php echo('p/pages/smallpsd2html5bg-' . $pageData['imagepsd2html5bgsmall']) ?>" alt=""
             data-fit="cover">
    </picture>

    <div class="full-height__layout">

        <div class="middle-text">

            <h1 class="fd__title_type3">
                <?php echo($pageData['psd2html5mainscreebtitle']) ?>
            </h1>

            <div class="start-screen-cats start-screen-cats_triple start-screen-cats_mob-block">

               
                <ul class="start-screen-cats-list">

                   
                    <li class="start-screen-cats-items">
                        <?php echo($pageData['psd2html5mainscreebtitle1']) ?>

                    </li>

                    <li class="start-screen-cats-items">

                        <?php echo($pageData['psd2html5mainscreebtitle2']) ?>

                    </li>

                    <li class="start-screen-cats-items">

                        <?php echo($pageData['psd2html5mainscreebtitle3']) ?>

                    </li>
                   

                </ul>
               

            </div>
            <div class="start-screen-cats start-screen-cats_tetra">

               
                <ul class="start-screen-cats-list">
                   
                    <li class="start-screen-cats-items">
                        <div class="start-screen-cats-item-footer"><?php echo($pageData['psd2html5mainscreebtitle4'])?></div>
                    </li>
                   

                   
                    <li class="start-screen-cats-items">
                        <div class="start-screen-cats-item-footer"><?php echo($pageData['psd2html5mainscreebtitle5'])?></div>
                    </li>
                   

                   
                    <li class="start-screen-cats-items">
                        <div class="start-screen-cats-item-footer"><?php echo($pageData['psd2html5mainscreebtitle6'])?></div>
                    </li>
                   

                   
                    <li class="start-screen-cats-items">
                        <div
                            class="start-screen-cats-item-footer"><?php echo($pageData['psd2html5mainscreebtitle7'])?></div>
                    </li>
                   
                </ul>
               
            </div>
        </div>
       

        <div class="direct-line hide hide-mob"></div>
        <div class="arrow"></div>
    </div>
   

</div>

<div class="main-wrap">

   
    <section class="article light why2">

        <div class="layout">

           
            <div class="why-dl">
                <?php foreach ($pageData2 as $advantages) { ?>
                    <div class="why-dl-row">
                        <div class="why-dt"><?php echo($advantages['title']) ?></div>
                        <div class="why-dd">
                            <?php if (!empty($advantages['paragraph'])) { ?>
                                <p><?php echo($advantages['paragraph']) ?></p><?php } ?>
                            <ul>
                                <?php foreach ($advantages['advlist'] as $key => $item) { ?>
                                    <li><?php echo($item['text']) ?> </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                <?php } ?>

            </div>
           

        </div>
       

    </section>
   


   
    <div class="our-works our-works_type2 our-works_vert">
        <h2>
            <span><?php echo($pageData['worksexamplespsd2html5title']) ?></span>
        </h2>

       
        <div class="our-works-menu">

           
            <ul data-fd-works-menu-list="works" data-fd-works-action="server/works.json" class="our-works-menu-list">
                <?php foreach ($filters as $filter) { ?>
                    <?php
                    $params['item'] = $filter;
                    $filterUrl = $textPagesUrlProvider->getFilterPsdhtmlUrl($params);
                    ?>

                    <?php

                    $filterActive = ($filter['url'] == $filterUri);
                    if ($filterActive) {
                        ?>
                        <li data-fd-works-menu-item class="our-works-menu-item active">
                            <a href="<?php echo $filterUrl; ?>" target="_parent"
                               rel="nofollow "><?php echo $filter['title']; ?></a>
                        </li>
                    <?php } else { ?>
                        <li data-fd-works-menu-item class="our-works-menu-item">
                            <a href="<?php echo $filterUrl; ?>" target="_parent"
                               rel="nofollow "><?php echo $filter['title']; ?></a>
                        </li>
                    <?php } ?>
                <?php } ?>


            </ul>
           

        </div>
       


       
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
                               
                                <div class="our-works__descr">
                                    <span><?php echo Yii::t('app', 'Front end development:'); ?></span>
                                    <span>
                                    <?php foreach ($work['desclist'] as $key => $item) { ?>
                                        <span><?php echo($item['text'])?></span>
                                    <?php } ?>

                                </div>
                               
                            </div>
                        </a>
                    </li>
                <?php } ?>
            </ul>

        </div>
       
    </div>
   

   
    <section class="article light warranty">

       
        <div class="warranty__background-text">
            <span><?php echo($pageData1['garantiesbgword']) ?></span>
        </div>
       


       
        <div class="layout">

           
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
           

        </div>
       

    </section>
   

   
    <div class="offer mesh">

       
        <div class="layout fd_align-center">

           
            <a href="<?php echo($textPagesUrlProvider->getCommercialUrl()) ?>" class="button dark">
                <span><?php echo Yii::t('app', 'request a free consultation and estimate of your project'); ?></span>
            </a>
           

        </div>
       

    </div>
   


</div>









