<?php
$content = '<ul class="crumbs">
                    <li class="crumbs__item crumbs__item-active">'.$pageGroupData[0]['groupName'].'</li>
                </ul>';

if (isset($textPageData)) {
	$content .= $this->createLink([
		'text' => 'Редактировать страницу',
		'href' => '/'.$textPageData['idPageGroup'].'/'.$textPageData['id'].'/'.$pageLang,
		'type' => 'linkGray',
		'attrs' => [
			'data-href' => 'formedit',
		],
	])."\n";
}

$content.='<div class="content__table content__table_filter some-table">
            <table class="table" data-action="/'.$id1Uri.'" data-method="post" data-module="table">
                <thead>
                    <tr>
                        <!--<th>#</th>-->
                        <th class="table__col-left">Заголовок страницы</th>
                        <th>Активность</th>
                        <th data-sorter="false" class="td__remove-button-cell"></th>
                    </tr>
                </thead>
                <tbody>';

$countTextPages = count($allTextPages);
for($i = 0; $i < $countTextPages; $i++) {
    // Вероятное отсутствие первого uri, а также тип страницы перехода (списочная, редактирования)
	// (для добавленных вручную пунктов)
	$firstUri = isset($allTextPages[$i]['pageGroup']) ? '' : '/'.$id1Uri;
	$dataHref = isset($allTextPages[$i]['pageGroup']) ? 'formlist' : 'formedit';

	$content.='<tr data-id = "'.$allTextPages[$i]['id'].'/'.$pageLang.'">
                    <!--<td>'.($i + 1).'</td>-->
                    <td class="table__col-left">'.$allTextPages[$i]['pH1'].'</td>
                    <td>
                        <div class="input__check-box-wrap">
                            <input type="checkbox" class="check-box" id="pShow'.$i.'" name="pShow" value="1" action="textpages" http-type="PUT"';
    if ($allTextPages[$i]['pShow']) {
        $content.=' checked';
    }
    $content .= '/>
                            <label for="pShow' . $i . '" class="check-box__label"></label>
                        </div>
                    </td>
                    <td class="td__remove-button-cell">
                        <div class="btn__modify-wrap">
                            <a title="Редактировать запись" href="'.$firstUri.'/'.$allTextPages[$i]['id'].'/'.$pageLang.'" data-href="'.$dataHref.'" class="btn__edit catalogue-list_edit"></a>
                        </div>
                    </td>
                    </tr>';
}

$content .= '</tbody>
                </table>
            </div>';