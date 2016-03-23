<?php
$content = '<ul class="crumbs">
                <li class="crumbs__item crumbs__item-active">'.$pageGroupData[0]['groupName'].'</li>
            </ul>';

$content.='<div class="content__table">
            <table class="table" data-action="/'.$id1Uri.'" data-method="post" data-module="table" data-href="formedit">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="table__col-left">Название</th>
                        <th data-sorter="false" class="td__remove-button-cell"></th>
                    </tr>
                </thead>
                <tbody>';

$countSettingsPages = count($allSettingsPages);
for($i = 0; $i < $countSettingsPages; $i++) {
    // временно скрываем "Базу иконок" и "Управление сложностью" из настроек
	//if ($i == 5 || $i == 4) continue;
	
    $content.='<tr data-id = "'.$allSettingsPages[$i]['id'].'/'.$pageLang.'">
                <td>'.($i + 1).'</td>
                <td class="table__col-left">'.$allSettingsPages[$i]['settingsName'].'</td>
                <td class="td__remove-button-cell">
                    <div class="btn__modify-wrap">';

    if ($i == 0) {
        $content .= '<a title="Выполнить" href="/'.$id1Uri.'/'.$allSettingsPages[$i]['id'].'/'.$pageLang.'" data-href="formedit" class="btn__edit catalogue-list_edit"></a>';
    } else if ($i == 1) {
        $content .= '<a title="Выполнить" href="/'.$id1Uri.'/'.$allSettingsPages[$i]['id'].'/'.$pageLang.'" data-href="formedit" class="btn__edit catalogue-list_save" data-type="not-refresh"></a>';
    } else if ($i == 3) {
        $content .= '<a title="Выполнить" href="/'.$id1Uri.'/'.$allSettingsPages[$i]['id'].'/'.$pageLang.'" data-href="formedit" class="btn__edit catalogue-list_edit"></a>';
    } else if ($i == 4) {
        $content .= '<a title="Выполнить" href="/'.$id1Uri.'/'.$allSettingsPages[$i]['id'].'/'.$pageLang.'" data-href="formedit" class="btn__edit catalogue-list_edit"></a>';
    } else if ($i == 6) {
        $content .= '<a title="Выполнить" href="/'.$id1Uri.'/'.$allSettingsPages[$i]['id'].'/'.$pageLang.'" data-href="formedit" class="btn__edit catalogue-list_edit"></a>';
    } else if ($i == 7) {
        $content .= '<a title="Выполнить" href="/'.$id1Uri.'/'.$allSettingsPages[$i]['id'].'/'.$pageLang.'" data-href="formedit" class="btn__edit catalogue-list_edit"></a>';
    } else {
        $content .= '<a title="Выполнить" href="/'.$id1Uri.'/'.$allSettingsPages[$i]['id'].'/'.$pageLang.'" data-href="formedit" class="btn__edit catalogue-list_save"></a>';
    }

    $content.='</div>
                    </td>
                    </tr>';
}

$content .= '</tbody>
                </table>
            </div>';