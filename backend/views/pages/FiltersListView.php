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

	$content .= '<table class="table" data-action="/'.$idPageGroup.'" data-method="post" data-module="table" data-dragsort-url="formupdate">';

		$content .= '<thead>
			<tr>
				<!--<th>#</th>
				<th class="table__col-left">Id</th>-->
				<th class="table__col-left">Заголовок</th><!-- th -->
				<th class="table__col-left">Показать/скрыть</th>
				<th data-sorter="false" class="td__edit-cell2">&nbsp;</th>
			</tr>
		</thead>
		<tbody data-module="drag_sort">';

$countRecords = count($filters);
for($i = 0; $i < $countRecords; $i++)
{
	$content .= '<tr data-id = "'.$filters[$i]['id'].'/'.$pageLang.'" data-index="'.$filters[$i]['id'].'" draggable="draggable">';
				$content .= '<!--<td>'.($i + 1).'</td>
				<td class="table__col-left"><b>'.$filters[$i]['id'].'</b></td>-->
				<td class="table__col-left">'.$filters[$i]['title'].'</td><!-- td -->
				<td class="table__action-disabled">
					<div class="input__check-box-wrap">
						<input type="checkbox" class="check-box" id="show'.$i.'" name="show" value="1" action="filters" http-type="PUT"';
	if ($filters[$i]['show']) {
		$content .= ' checked';
	}
	$content .= '/>
						<label for="show'.$i.'" class="check-box__label"></label>
					</div>
				</td>
				<td class="td__edit-cell2">
					<div class="btn__wrap-inline">';
						$content .= '<a title="Редактировать запись" href="/'.$idPageGroup.'/'.$filters[$i]['id'].'/'.$pageLang.'" data-href="formedit" class="btn__edit catalogue-list_edit"></a>';
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