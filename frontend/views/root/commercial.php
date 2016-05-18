


    <!-- full height -->
    <div class="full-height form">

        <!-- full height  layout -->
        <div class="full-height__layout">

            <!-- middle text -->
            <div class="middle-text">
                <h1><?php echo $pageData['commercialtitle']; ?></h1>
                <h2><?php echo $pageData['commercialtitle1']; ?></h2>

                <!-- action form -->
                <form id="form-application" action="/email/commercial" method="post" autocomplete="on" data-ajax novalidate class="action-form">

                    <!-- row -->
                    <div class="row">

                        <!-- input wrap -->
                        <div class="input-wrap">
                            <label for="input-name"><?php echo Yii::t('app', 'company name').'*'; ?></label>
                            <input id="input-name" type="text" name="name" data-fld-attr-required class="input">
                        </div>
                        <!--/input wrap -->


                        <!-- input wrap -->
                        <div class="input-wrap">
                            <label for="input-email"><?php echo Yii::t('app', 'your email').'*'; ?></label>
                            <input id="input-email" type="email" name="email" data-fld-attr-required class="input">
                        </div>
                        <!--/input wrap -->

                    </div>
                    <!--/row -->


                    <!-- row -->
                    <div class="row">

                        <!-- input wrap -->
                        <div class="input-wrap">
                            <label for="input-contact"><?php echo Yii::t('app', 'contact person').'*'; ?></label>
                            <input id="input-contact" type="text" name="contact" data-fld-attr-required class="input">
                        </div>
                        <!--/input wrap -->


                        <!-- input wrap -->
                        <div class="input-wrap">
                            <label for="input-phone"><?php echo Yii::t('app', 'your phone number').'*'; ?></label>
                            <input id="input-phone" type="tel" name="tel" class="input">
                        </div>
                        <!--/input wrap -->

                    </div>
                    <!--/row -->


                    <!-- row -->
                    <div class="row">

                        <!-- input wrap -->
                        <div class="input-wrap text">
                            <label for="input-desk"><?php echo Yii::t('app', 'how you see your future website?').'*'; ?></label>
                            <textarea placeholder="<?php echo Yii::t('app', 'write briefly: in what area you work, what are your goals, what and why you want to see on your website?'); ?>" name="desc"></textarea>
                        </div>
                        <!--/input wrap -->

                    </div>
                    <!--/row -->


                    <!-- align center -->
                    <div class="align-center">

                        <!-- button -->
                        <button type="submit" class="button dark">
                            <span><?php echo Yii::t('app', 'send'); ?></span>
                        </button>
                        <!--/button -->

                    </div>
                    <!--/align center -->

                </form>
                <!--/action form -->


                <!-- form answer -->
                <div class="form-answer">
                    <span></span>
                </div>
                <!--/form answer -->

            </div>
            <!--/middle text -->

            <div class="background-text">WWW</div>
        </div>
        <!--/full height  layout -->

    </div>
    <!--/full height -->


    <!-- main wrap -->
    <div class="main-wrap">
    </div>
    <!--/main wrap -->

<!--/ru -->
