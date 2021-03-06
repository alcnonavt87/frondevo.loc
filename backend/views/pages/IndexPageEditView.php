<?php
use yii\helpers\Html;

//Навигационное меню НАЧАЛО
$navMenu = '<nav class="sidebar__menu">';
if (is_file(Yii::$app->basePath.'/views/parts/LangsView.php')) {
    require Yii::$app->basePath.'/views/parts/LangsView.php';
}
if (is_file(Yii::$app->basePath.'/views/parts/TwoButtonsSPView.php')) {
    require Yii::$app->basePath.'/views/parts/TwoButtonsSPView.php';
}
$navMenu .= '</nav>';
//Навигационное меню КОНЕЦ

//Хлебные крошки НАЧАЛО
$content = '<ul class="crumbs">
                <!--<li class="crumbs__item"><a href="/'.$id1Uri.'/'.$defLang.'" data-href="formlist">'.$pageGroupData[0]['groupName'].'</a></li>-->
                <li class="crumbs__item crumbs__item-active">'.$textPageHeader.'</li>
            </ul>';
//Хлебные крошки КОНЕЦ

$content .= Html::beginForm($admPanelUri.'formupdate/'.$id1Uri.'/'.$page[0]['id'].'/'.$pageLang, 'post', ['id'=>"form-edit-content"]).
                '<fieldset class="catalog__section">
                '.$this->createHeader('Основные данные страницы').'
                    <div class="catalog__section-data">
                    '.$this->createInput(['id'=> 'pH1', 'text' => 'Заголовок новости H1', 'width' => 400, 'name' => 'pH1', 'value' => $page[0]['pH1'], 'attr' => 'required autofocus autocomplete="off"']).'
                    '.$this->createInput(['id'=> 'pTitle', 'text' => 'Заголовок страницы', 'placeholder' => 'В поисковой выдаче видно 60 символов', 'width' => 400, 'name' => 'pTitle', 'value' => $page[0]['pTitle'], 'attr' => 'required data-count="60"', 'dataCopy' => 'pH1', 'titleCopy' => 'Копия заголовка H1']).'
                     <!-- pUrl -->'.$this->createInput(['id' => 'pUrl', 'text' => 'Алиас страницы', 'width' => 400, 'name' => 'base[Url]', 'value' => $page[0]['Url'], 'attr' => 'required', 'genUrl' => 'pH1', 'titleUrl' => 'Генерация с заголовка H1']).'<!-- /pUrl -->

                    <!-- pDescription -->'.$this->createTextArea(['id'=> 'pDescription', 'text' => 'Meta description', 'placeholder' => 'В поисковой выдаче видно 140 символов', 'width' => '400x100', 'name' => 'pDescription', 'value' => $page[0]['pDescription'], 'attr' => 'data-count="140"']).'<!-- /pDescription -->
                    '.$this->createInput(['id'=> 'pMenuName', 'text' => 'Заголовок для главного меню', 'width' => 400, 'name' => 'pMenuName', 'value' => $page[0]['pMenuName'], 'attr' => 'required']).'
                    </div>
                </fieldset>

                <fieldset class="catalog__section">
                '.$this->createHeader('Редактирование контента страницы').'
                 '.$this->createInput(['id'=> 'indexTextButton', 'text' => 'Текст в левой кнопке', 'width' => 400, 'name' => 'indexTextButton', 'value' => $page[0]['indexTextButton'], 'attr' => '']).'
                '.$this->createTextArea(['id'=> 'pContent', 'text' => 'Текст под левой кнопкой', 'width' => '400x100', 'name' => 'pContent', 'value' => $page[0]['pContent'],]).'
		        <!-- indexTextButton2 -->'.$this->createInput(['id'=> 'indexTextButton2', 'text' => 'Текст в провой кнопке', 'placeholder' => '', 'width' => 400, 'name' => 'indexTextButton2', 'value' => $page[0]['indexTextButton2'], 'attr' => '']).'<!-- /indexTextButton2 -->
                <!-- pContentbutton2 -->'.$this->createTextArea(['id'=> 'pContentbutton2', 'text' => 'Текст под правой кнопкой', 'width' => '400x100', 'name' => 'pContentbutton2', 'value' => $page[0]['pContentbutton2'], 'attr' => '']).'<!-- /pContentbutton2 -->
                '.$this->createInput(['id'=> 'indexAltName', 'text' => 'Текст alt названия', 'width' => 400, 'name' => 'indexAltName', 'value' => $page[0]['indexAltName'], 'attr' => '']).'
                </fieldset>'.
            Html::endForm();