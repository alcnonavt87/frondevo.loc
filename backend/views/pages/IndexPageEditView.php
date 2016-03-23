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
                <li class="crumbs__item"><a href="/'.$id1Uri.'/'.$defLang.'" data-href="formlist">'.$pageGroupData[0]['groupName'].'</a></li>
                <li class="crumbs__item crumbs__item-active">'.$textPageHeader.'</li>
            </ul>';
//Хлебные крошки КОНЕЦ

$content .= Html::beginForm($admPanelUri.'formupdate/'.$id1Uri.'/'.$page[0]['id'].'/'.$pageLang, 'post', ['id'=>"form-edit-content"]).
                '<fieldset class="catalog__section">
                '.$this->createHeader('Основные данные страницы').'
                    <div class="catalog__section-data">
                    '.$this->createInput(['id'=> 'pH1', 'text' => 'Заголовок новости H1', 'width' => 400, 'name' => 'pH1', 'value' => $page[0]['pH1'], 'attr' => 'required autofocus autocomplete="off"']).'
                    '.$this->createInput(['id'=> 'pTitle', 'text' => 'Заголовок страницы', 'placeholder' => 'В поисковой выдаче видно 60 символов', 'width' => 400, 'name' => 'pTitle', 'value' => $page[0]['pTitle'], 'attr' => 'required data-count="60"', 'dataCopy' => 'pH1', 'titleCopy' => 'Копия заголовка H1']).'
                    '.$this->createTextArea(['id'=> 'pDescription', 'text' => 'Meta description', 'placeholder' => 'В поисковой выдаче видно 140 символов', 'width' => '400x100', 'name' => 'pDescription', 'value' => $page[0]['pDescription'], 'attr' => 'data-count="140"']).'
                    '.$this->createInput(['id'=> 'pKeyWords', 'text' => 'Meta keywords', 'width' => 400, 'name' => 'pKeyWords', 'value' => $page[0]['pKeyWords'], 'attr' => '']).'
                    '.$this->createInput(['id'=> 'pMenuName', 'text' => 'Заголовок для главного меню', 'width' => 400, 'name' => 'pMenuName', 'value' => $page[0]['pMenuName'], 'attr' => 'required']).'
                    '.$this->createInput(['id'=> 'pBreadCrumbs', 'text' => 'Хлебные крошки', 'width' => 400, 'name' => 'pBreadCrumbs', 'value' => $page[0]['pBreadCrumbs'], 'attr' => 'required']).'
                    </div>
                </fieldset>

                <fieldset class="catalog__section">
                '.$this->createHeader('Редактирование контента страницы').'
                '.$this->createTextArea(['id'=> 'pContent', 'text' => '', 'width' => '400x100', 'name' => 'pContent', 'value' => $page[0]['pContent'], 'attr' => 'data-module="tinymce"']).'
                </fieldset>'.
            Html::endForm();