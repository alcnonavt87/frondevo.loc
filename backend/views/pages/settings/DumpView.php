<?php
$content = '<ul class="crumbs">
                        <li class="crumbs__item"><a href="/'.$id1Uri.'/'.$pageLang.'" data-href="formlist">'.$pageGroupData[0]['groupName'].'</a></li>
                        <li class="crumbs__item crumbs__item-active">'.$settingsPageName.'</li>
                    </ul>';

$content.='<div class="content__filter">
                        <a class="button btn__add" href="'.$hostName.$admPanelUri.'formdump/dump" start="'.$hostName.$admPanelUri.'settings/dump/stat">Создать дамп БД</a>
                    </div>

                <div class="content__table">
                <table class="table" data-action="/'.$id1Uri.'" data-method="post" data-module="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="table__col-left">Таблица</th>
                            <th class="table__col-left">Записи</th>
                            <th class="table__col-left">Тип таблицы</th>
                            <th class="table__col-left">Механизм</th>
                            <th class="table__col-left">Размер</th>
                        </tr>
                    </thead>
                    <tbody>';

$countAllTables = count($allTablesData);
for($i = 0; $i < $countAllTables; $i++) {
    $content.='<tr>
                    <td>'.($i + 1).'</td>
                    <td class="table__col-left">'.$allTablesData[$i]['name'].'</td>
                    <td class="table__col-left">'.$allTablesData[$i]['rows'].'</td>
                    <td class="table__col-left">'.$allTablesData[$i]['tableType'].'</td>
                    <td class="table__col-left">'.$allTablesData[$i]['engine'].'</td>
                    <td class="table__col-left">'.$allTablesData[$i]['tableSize'].'</td>
                    </tr>';
}

$content .= '</tbody>
                    </table>
                </div>';