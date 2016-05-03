<!-- full height -->
<div class="full-height contacts">

    <!-- full height  layout -->
    <div class="full-height__layout">

        <!-- middle text -->
        <div class="middle-text">
            <h1>контактная информация</h1>
            <address>
                <span>Украина, г. Киев</span>
                <a href="tel:+380671702727">+38 067 170 27 27</a>
                <a href="mailto:welcome@frondevo.com">welcome@frondevo.com</a>
            </address>

            <!-- social network -->
            <ul class="social-network">
                <?php

                foreach ($pageData as $key => $item) {
                    $pagesData['en'] = $pageData[0];
                    $pagesData['ru'] = $pageData[1];
                    $pagesData['ua'] = $pageData[2];


                    if ($key == $lang && !empty($pagesData[$lang]['snFacebook'])) { ?>
                        <li class="fb">
                            <a href="<?php echo $pagesData[$lang]['snFacebook'] ?>" target="_blank" rel="nofollow"></a>
                        </li>
                    <?php } else if ($key == $lang && !empty($pagesData['ru']['snFacebook'])) { ?>

                        <li class="fb">
                            <a href="<?php echo $pagesData['ru']['snFacebook'] ?>" target="_blank" rel="nofollow"></a>
                        </li>
                    <?php } else if ($key == $lang) { ?>

                        <?php echo "" ?>




                    <?php } if ($key == $lang && !empty($pagesData[$lang]['snTwitter'])) { ?>
                        <li class="tw">
                            <a href="<?php echo $pagesData[$lang]['snTwitter'] ?>" target="_blank" rel="nofollow"></a>
                        </li>
                    <?php } else if ($key == $lang && !empty($pagesData['ru']['snTwitter'])) { ?>

                        <li class="tw">
                            <a href="<?php echo $pagesData['ru']['snTwitter'] ?>" target="_blank" rel="nofollow"></a>
                        </li>
                    <?php } else if ($key == $lang) { ?>

                        <?php echo "" ?>




                    <?php } if ($key == $lang && !empty($pagesData[$lang]['snVkontakte'])) { ?>
                        <li class="b">
                            <a href="<?php echo $pagesData[$lang]['snVkontakte'] ?>" target="_blank" rel="nofollow"></a>
                        </li>
                    <?php } else if ($key == $lang && !empty($pagesData['ru']['snTwitter'])) { ?>

                        <li class="b">
                            <a href="<?php echo $pagesData['ru']['snVkontakte'] ?>" target="_blank" rel="nofollow"></a>
                        </li>
                    <?php } else if ($key == $lang) { ?>

                        <?php echo "" ?>




                    <?php }  if ($key == $lang && !empty($pagesData[$lang]['snBahance'])) { ?>
                        <li class="be">
                            <a href="<?php echo $pagesData[$lang]['snBahance'] ?>" target="_blank" rel="nofollow"></a>
                        </li>
                    <?php } else if ($key == $lang && !empty($pagesData['ru']['snBahance'])) { ?>

                        <li class="be">
                            <a href="<?php echo $pagesData['ru']['snBahance'] ?>" target="_blank" rel="nofollow"></a>
                        </li>
                    <?php } else if ($key == $lang) { ?>

                        <?php echo "" ?>





                    <?php }  if ($key == $lang && !empty($pagesData[$lang]['snInstagram'])) { ?>
                        <li class="in">
                            <a href="<?php echo $pagesData[$lang]['snInstagram'] ?>" target="_blank" rel="nofollow"></a>
                        </li>
                    <?php } else if ($key == $lang && !empty($pagesData['ru']['snInstagram'])) { ?>

                        <li class="in">
                            <a href="<?php echo $pagesData['ru']['snInstagram'] ?>" target="_blank" rel="nofollow"></a>
                        </li>
                    <?php } else if ($key == $lang) { ?>

                        <?php echo "" ?>






                    <?php } if ($key == $lang && !empty($pagesData[$lang]['snBall'])) { ?>
                        <li class="ball">
                            <a href="<?php echo $pagesData[$lang]['snBall'] ?>" target="_blank" rel="nofollow"></a>
                        </li>
                    <?php } else if ($key == $lang && !empty($pagesData['ru']['snBall'])) { ?>

                        <li class="ball">
                            <a href="<?php echo $pagesData['ru']['snTwitter'] ?>" target="_blank" rel="nofollow"></a>
                        </li>
                    <?php } else if ($key == $lang) { ?>

                        <?php echo "" ?>





                    <?php } if ($key == $lang && !empty($pagesData[$lang]['snPinterest'])) { ?>
                        <li class="pin">
                            <a href="<?php echo $pagesData[$lang]['snPinterest'] ?>" target="_blank" rel="nofollow"></a>
                        </li>
                    <?php } else if ($key == $lang && !empty($pagesData['ru']['snPinterest'])) { ?>

                        <li class="pin">
                            <a href="<?php echo $pagesData['ru']['snPinterest'] ?>" target="_blank" rel="nofollow"></a>
                        </li>
                    <?php } else if ($key == $lang) { ?>

                        <?php echo "" ?>
                    <?php } ?>


                <?php } ?>


            </ul>




                <!-- item -->
                <li class="be">
                    <a href="#" target="_blank" rel="nofollow"></a>
                </li>
                <!--/item -->


                <!-- item -->
                <li class="ball">
                    <a href="#" target="_blank" rel="nofollow"></a>
                </li>
                <!--/item -->


                <!-- item -->
                <li class="pin">
                    <a href="#" target="_blank" rel="nofollow"></a>
                </li>
                <!--/item -->


                <!-- item -->
                <li class="in">
                    <a href="#" target="_blank" rel="nofollow"></a>
                </li>
                <!--/item -->


                <!-- item -->
                <li class="b">
                    <a href="#" target="_blank" rel="nofollow"></a>
                </li>
                <!--/item -->

            </ul>
            <!--/social network -->
            ?>
        </div>
        <!--/middle text -->

    </div>
    <!--/full height  layout -->

</div>
<!--/full height -->


<!-- main wrap -->
<div class="main-wrap">
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
