<?php
use yii\helpers\Html;

//Навигационное меню НАЧАЛО
$navMenu = '<nav class="sidebar__menu">';
if (is_file(Yii::$app->basePath.'/views/parts/LangsView.php')) {
    require Yii::$app->basePath.'/views/parts/LangsView.php';
}
if (is_file(Yii::$app->basePath.'/views/parts/OneButtonsSView.php')) {
    require Yii::$app->basePath.'/views/parts/OneButtonsSView.php';
}
$navMenu .= '</nav>';
//Навигационное меню КОНЕЦ

//Хлебные крошки НАЧАЛО
$content = '<ul class="crumbs">
                <li class="crumbs__item"><a href="/'.$id1Uri.'/'.$pageLang.'" data-href="formlist">'.$pageGroupData[0]['groupName'].'</a></li>
                <li class="crumbs__item crumbs__item-active">'.$settingsPageName.'</li>
            </ul>';
//Хлебные крошки КОНЕЦ

$content .= Html::beginForm($admPanelUri.'formupdate/'.$id1Uri.'/'.$settingsPageUri.'/'.$pageLang, 'post', ['id'=>"form-edit-content"]).
    '<fieldset class="catalog__section">
                '.$this->createHeader('Общие настройки').'
                    <div class="catalog__section-data">
                    '.$this->createInput(array('id'=> 'address', 'text' => 'Адрес', 'width' => 400, 'name' => 'address', 'value' => $mySettings['address'], 'attr' => '')).'
                    </div>
                    <div class="catalog__section-data">
                    '.$this->createTextArea(array('id'=> 'copyright', 'text' => 'Копирайт для футера', 'width' => '400x100', 'name' => 'copyright', 'value' => $mySettings['copyright'], 'attr' => '')).'
                    </div>


                </fieldset>

				<fieldset class="catalog__section">
                '.$this->createHeader('Emails').'
                    <div class="catalog__section-data">
                    '.$this->createInput(array('id'=> 'emailClaim', 'text' => 'Для заявок', 'width' => 400, 'name' => 'emailClaim', 'value' => $mySettings['emailClaim'], 'attr' => '')).'
                    </div>
                </fieldset>

				'.
    Html::endForm();