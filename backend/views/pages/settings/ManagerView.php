<?php
use yii\helpers\Html;

if(!isset($pageLang)) {
    //Хлебные крошки начало
    $content = '<ul class="crumbs">
                    <li class="crumbs__item"><a href="/'.$id1Uri.'/'.$defLang.'" data-href="formlist">'.$pageGroupData[0]['groupName'].'</a></li>
                    <li class="crumbs__item crumbs__item-active">'.$settingsPageName.'</li>
                </ul>';
    //Хлебны крошки КОНЕЦ

    $content .= '<div id="content__table" class="content__table content__table_filter">
                    <div class="content__filter">
                        <a href="/'.$id1Uri.'/'.$settingsPageUri.'" data-href="formadd" class="button btn__add" action="" http-type="POST">Добавить менеджера</a>
                    </div>
                    <table class="table" data-action="/'.$id1Uri.'" data-method="post" data-module="table" data-href="formedit">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Имя пользователя</th>
                                <th>E-mail пользователя</th>
                                <th data-sorter="false" class="td__edit-cell2">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>';
    $countManagers = count($managers);
    for($i = 0; $i < $countManagers; $i++) {
        $content.='<tr data-id = "'.$settingsPageUri.'/'.$managers[$i]['id'].'/'.$defLang.'">
                        <td>'.($i + 1).'</td>
                        <td>'.$managers[$i]['username'].'</td>
                        <td>'.$managers[$i]['email'].'</td>
                        <td class="td__edit-cell2">
                            <div class="btn__wrap-inline">
                                <a title="Редактировать запись" href="/'.$id1Uri.'/'.$settingsPageUri.'/'.$managers[$i]['id'].'/'.$defLang.'" data-href="formedit" class="btn__edit catalogue-list_edit"></a>
                                <div title="Удалить запись" class="btn__delete"></div>
                            </div>
                        </td>
                    </tr>';
    }
    $content .='</tbody>
                    </table>
                    </div>';
} else {
    //Навигационное меню НАЧАЛО
    $navMenu = '<nav class="sidebar__menu">';
    if (is_file(Yii::$app->basePath.'/views/parts/TwoButtonsSDView.php')) {
        require Yii::$app->basePath.'/views/parts/TwoButtonsSDView.php';
    }
    $navMenu .= '</nav>';
    //Навигационное меню КОНЕЦ

    //Хлебные крошки НАЧАЛО
    $content = '<ul class="crumbs">
                        <li class="crumbs__item"><a href="/'.$id1Uri.'/'.$defLang.'" data-href="formlist">'.$pageGroupData[0]['groupName'].'</a></li>
                        <li class="crumbs__item"><a href="/'.$id1Uri.'/'.$settingsPageUri.'/'.$defLang.'" data-href="formedit">'.$settingsPageName.'</a></li>
                        <li class="crumbs__item crumbs__item-active">'.$managerUserName.'</li>
                    </ul>';
    //Хлебные крошки КОНЕЦ

    $content .= Html::beginForm($admPanelUri.'formupdate/'.$id1Uri.'/'.$settingsPageUri.'/'.$idManager.'/'.$pageLang, 'post', ['id'=>"form-edit-content"]).
                '<!--<form action="'.$admPanelUri.'update/'.$id1Uri.'/'.$settingsPageUri.'/'.$idManager.'/'.$pageLang.'" method="post" id="form-edit-content">-->
                    <fieldset class="catalog__section">
                    '.$this->createHeader('Оснвные данные менеджера').'
                        <div class="catalog__section-data">
                        '.$this->createInput(['id'=> 'email', 'text' => 'Email менеджера', 'width' => 400, 'name' => 'email', 'value' => $manager[0]['email'], 'attr' => 'required autofocus autocomplete="off"']).'
                        '.$this->createInput(['id'=> 'username', 'text' => 'Имя пользователя', 'width' => 400, 'name' => 'username', 'value' => $manager[0]['username'], 'attr' => 'required']).'
                        '.$this->createInput(['id'=> 'name', 'text' => 'Имя', 'width' => 400, 'name' => 'name', 'value' => $manager[0]['name'], 'attr' => 'required']).'
                        '.$this->createInput(['id'=> 'surname', 'text' => 'Фамилия', 'width' => 400, 'name' => 'surname', 'value' => $manager[0]['surname'], 'attr' => 'required']).'
                        </div>
                    </fieldset>';

    //Формирование списка доступа в группам страниц НАЧАЛО
    if(count($accessList)) {
        $content .= '<fieldset class="catalog__section">'
            .$this->createHeader('Доступ к группам страниц');

        $list = [];
        for($i = 0; $i < count($accessList); $i++) {
            if($accessList[$i]['access'] > 0) {
                $chekSet =  'checked="checked"';
            } else {
                $chekSet =  '';
            }

            $list[$i] = [
                'id'=> 'accessList['.($i).']',
                'text' => $accessList[$i]['groupName'],
                'name' => 'accessList['.($i).']',
                'value' => $accessList[$i]['id'],
                'attr' => $chekSet
            ];
        }

        $content .= $this->createCheckBoxGroup(array(
                'list' => $list
            )).Html::endForm();
    } else {
        $content .= Html::endForm();
    }
}