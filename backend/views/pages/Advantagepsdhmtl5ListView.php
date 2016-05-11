<?php

// Хлебные крошки НАЧАЛО
$content .= '<ul class="crumbs">';
	$content .= '<li class="crumbs__item crumbs__item-active">'.$pageGroupData['groupName'].'</li>';
$content .= '</ul>';
// Хлебные крошки КОНЕЦ



// Количество записей на странице НАЧАЛО
if (is_file(Yii::$app->basePath.'/views/parts/PagesLimitView.php'))
{
    require Yii::$app->basePath.'/views/parts/PagesLimitView.php';
}
// Количество записей на странице КОНЕЦ/* UpdateCode */



// Кнопка "Добавить" НАЧАЛО
$content .= '<div class="content__filter">';
$content .= '<a href="/'.$idPageGroup.'/'.$pageLang.'" data-href="formadd" class="button btn__add" action="" http-type="POST">Добавить запись</a>';
	$content .= '<!-- filter -->';
$content .= '</div>';
// Кнопка "Добавить" КОНЕЦ



// Таблица записей НАЧАЛО
$content .= '<div id="content__table" class="content__table">';

	$content .= '<!-- pagination -->';

	$content .= '<table class="table" data-action="/'.$idPageGroup.'" data-method="post" data-module="table" data-href="formedit">';

		$content .= '<thead>
			<tr>
				<!--<th>#</th>
				<th class="table__col-left">Id</th>--><!-- th -->
				<th class="table__col-left">Заголовок</th>
				<!-- visibilityCheckboxTh -->
				<th data-sorter="false" class="td__edit-cell2">&nbsp;</th>
			</tr>
		</thead>
		<tbody>';

$countRecords = count($advantagepsdhmtl5);
for($i = 0; $i < $countRecords; $i++)
{
	$content .= '<tr data-id = "'.$advantagepsdhmtl5[$i]['id'].'/'.$pageLang.'">';
				$content .= '<!--<td>'.($i + 1).'</td>
				<td class="table__col-left"><b>'.$advantagepsdhmtl5[$i]['id'].'</b></td>--><!-- td -->
					<td class="table__col-left">'.$advantagepsdhmtl5[$i]['title'].'</td>
				<!-- visibilityCheckboxTd -->

				<td class="td__edit-cell2">
					<div class="btn__wrap-inline">';
						$content .= '<a title="Редактировать запись" href="/'.$idPageGroup.'/'.$advantagepsdhmtl5[$i]['id'].'/'.$pageLang.'" data-href="formedit" class="btn__edit catalogue-list_edit"></a>';
						$content .= '<div title="Удалить запись" class="btn__delete"></div>
					</div>
				</td>
			</tr>';
}

$content .= '</tbody>
	</table>';

$content .= '<!-- pagination -->';

$content .= '</div>';
// Таблица записей КОНЕЦ