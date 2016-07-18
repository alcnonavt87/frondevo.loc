<?php

// Навигационное меню НАЧАЛО
$navMenu .= '<nav class="sidebar__menu">';
	/*$countLangs = count($langs);
	if($countLangs) {
		$navMenu .= '<fieldset class="select-wrap sidebar_select"><select class="select" name="language" data-module="select">';
		for ($i = 0; $i < $countLangs; $i++) {
			$selected = '';
			if($pageLang == $langs[$i]['sName']) {
				$selected = 'selected';
			}

			if ($idRecord) {
				$navMenu .= '<option data-href="formedit" data-action="/'.$id1Uri.'/'.$idRecord.'/'.$langs[$i]['sName'].'" '.$selected.' value="'.$langs[$i]['sName'].'">'.$langs[$i]['fullName'].'</option>';
			} else {
				$navMenu .= '<option data-href="formadd" data-action="/'.$id1Uri.'/'.$langs[$i]['sName'].'" '.$selected.' value="'.$langs[$i]['sName'].'">'.$langs[$i]['fullName'].'</option>';
			}
		}
		$navMenu .= '</select></fieldset>';
	}*/

	$navMenu .= '<ul class="sidebar-menu__list">
		<li class="sidebar-menu__item sidebar-menu__item-save">Сохранить</li>';
		if ($idRecord) {
			$navMenu .= '<li class="sidebar-menu__item sidebar-menu__item-remove" data-id="formdel/'.$idPageGroup.'/'.$idRecord.'">Удалить</li>';
		}
	$navMenu .= '</ul>
</nav>';
// Навигационное меню КОНЕЦ



// Хлебные крошки НАЧАЛО
$content .= '<ul class="crumbs">';
	$content .= '<li class="crumbs__item"><a href="/'.$idPageGroup.'/'.$pageLang.'" data-href="formlist">Список записей</a></li>';
	if ($idRecord) {
		$content .= '<li class="crumbs__item crumbs__item-active">Редактирование записи('.$worksfrontoutItem['pH1'].')</li>';
	} else {
		$content .= '<li class="crumbs__item crumbs__item-active">Добавление записи</li>';
	}
$content .= '</ul>';
// Хлебные крошки КОНЕЦ



// Форма редактирования НАЧАЛО

$showViz = $worksfrontoutItem['show'] > 0 ? 'checked="checked"' : '';



// Вывод одного изображения "Одиночное изображение для страницы портфолио (297x381)" НАЧАЛО
$imageworksfrontoutOne = '<fieldset class="catalog__section">'.
$this->createHeader('Одиночное изображение для страницы портфолио (297x381)');
if ($worksfrontoutItem['imageworksfrontout'] <> '') {
	$imageworksfrontoutOne .= '<div class="fa__uploader single" id="uploader0-imageworksfrontout" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/p/worksfrontout/original-'.$worksfrontoutItem['imageworksfrontout'].'" title="'.$worksfrontoutItem['imageworksfrontoutTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/p/worksfrontout/medium-'.$worksfrontoutItem['imageworksfrontout'].'" width="100%" height="auto" alt="'.$worksfrontoutItem['imageworksfrontoutTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[imageworksfrontout-one][imgTitle]" value="'.$this->getCodeStr($worksfrontoutItem['imageworksfrontoutTitle']).'">
								<input class="item-deleted" type="hidden" name="images[imageworksfrontout-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$worksfrontoutItem['imageworksfrontoutTitle'].'</span>
						</a>
						<input class="button button_small button_edit" type="button" title="Редактировать" value="Редактировать">
						<input class="button button_small button_delete" type="button" title="Удалить" value="Удалить">
					</div>
				</div>
				<div class="fa__file-edit-wrap">
					<h2 class="catalog__section-header-text" data-load="Загрузка" data-edit="Редактирование">Загрузка</h2>
					<ul class="fa__file-edit-list"></ul>
				</div>
		</div>';
} else {
	$imageworksfrontoutOne .= '<div class="fa__uploader single" id="uploader0-imageworksfrontout" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list"></div>
				<div class="fa__file-edit-wrap">
					<h2 class="catalog__section-header-text" data-load="Загрузка" data-edit="Редактирование">Загрузка</h2>
					<ul class="fa__file-edit-list"></ul>
				</div>
		</div>';
}
$imageworksfrontoutOne .= '</fieldset>';
// Вывод одного изображения "Одиночное изображение для страницы портфолио (297x381)" КОНЕЦ



// Вывод одного изображения "Одиночное изображение для страницы портфолио (297x381)" НАЧАЛО
$imageworksfrontoutOne = '<fieldset class="catalog__section">'.
$this->createHeader('Одиночное изображение для страницы портфолио (297x381)');
if ($worksfrontoutItem['imageworksfrontout'] <> '') {
	$imageworksfrontoutOne .= '<div class="fa__uploader single" id="uploader0-imageworksfrontout" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/frontend/web/p/worksfrontout/general-'.$worksfrontoutItem['imageworksfrontout'].'" title="'.$worksfrontoutItem['imageworksfrontoutTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/worksfrontout/general-'.$worksfrontoutItem['imageworksfrontout'].'" width="100%" height="auto" alt="'.$worksfrontoutItem['imageworksfrontoutTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[imageworksfrontout-one][imgTitle]" value="'.$this->getCodeStr($worksfrontoutItem['imageworksfrontoutTitle']).'">
								<input class="item-deleted" type="hidden" name="images[imageworksfrontout-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$worksfrontoutItem['imageworksfrontoutTitle'].'</span>
						</a>
						<input class="button button_small button_edit" type="button" title="Редактировать" value="Редактировать">
						<input class="button button_small button_delete" type="button" title="Удалить" value="Удалить">
					</div>
				</div>
				<div class="fa__file-edit-wrap">
					<h2 class="catalog__section-header-text" data-load="Загрузка" data-edit="Редактирование">Загрузка</h2>
					<ul class="fa__file-edit-list"></ul>
				</div>
		</div>';
} else {
	$imageworksfrontoutOne .= '<div class="fa__uploader single" id="uploader0-imageworksfrontout" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list"></div>
				<div class="fa__file-edit-wrap">
					<h2 class="catalog__section-header-text" data-load="Загрузка" data-edit="Редактирование">Загрузка</h2>
					<ul class="fa__file-edit-list"></ul>
				</div>
		</div>';
}
$imageworksfrontoutOne .= '</fieldset>';
// Вывод одного изображения "Одиночное изображение для страницы портфолио (297x381)" КОНЕЦ



// Селект "Фильтр для аутсорсинг-фронтенд-портфолио"
$filtersfrontoutportOptions = '<option value="0">Выберите вариант</option>';
foreach ($filtersfrontoutport as $item) {
	if ($item['id'] == $worksfrontoutItem['idFiltersfrontoutport']) {
		$filtersfrontoutportOptions .= '<option value="'.$item['id'].'"  selected>'.$item['pTitle'].'</option>';
		continue;
	}

	$filtersfrontoutportOptions .= '<option value="'.$item['id'].'" >'.$item['pTitle'].'</option>';
}/* UpdateCode */



if ($idRecord) {
	$content .= '<form action="formupdate/'.$idPageGroup.'/'.$idRecord.'?pageLang='.$pageLang.'" method="post" id="form-edit-content">';
} else {
	$content .= '<form action="formupdate/'.$idPageGroup.'?newDoc=1&pageLang='.$pageLang.'" method="post" id="form-edit-content">';
}

$content .= '<!-- sectionPageData --><fieldset class="catalog__section">
	'.$this->createHeader('Основные данные страницы').'
	<div class="catalog__section-data">
		<!-- pH1 -->'.$this->createInput(['id'=> 'pH1', 'text' => 'Заголовок H1', 'placeholder' => '', 'width' => 400, 'name' => 'content[pH1]', 'value' => $worksfrontoutItem['pH1'], 'attr' => 'required']).'<!-- /pH1 -->
		<!-- linkworksfrontout -->'.$this->createInput(['id'=> 'linkworksfrontout', 'text' => 'Ссылка (относительная) на директорию с работой ', 'placeholder' => '', 'width' => 400, 'name' => 'content[linkworksfrontout]', 'value' => $worksfrontoutItem['linkworksfrontout'], 'attr' => '']).'<!-- /linkworksfrontout -->
		<!-- filtersfrontoutport -->'.$this->createSelect(['id'=> 'idFiltersfrontoutport', 'text' => 'Фильтр для аутсорсинг-фронтенд-портфолио', 'width' => 400,  'name' => 'base[idFiltersfrontoutport]', 'value' => $filtersfrontoutportOptions, 'attr' => '']).'<!-- /filtersfrontoutport -->
 '.$this->createCheckBoxRow(['id' => 'show', 'text' => 'Отображать страницу', 'name' => 'base[show]', 'value' => 1, 'attr' => $showViz]).'
	</div>





</fieldset><!-- /sectionPageData --><!-- /createFinish -->
<!-- commonData --><fieldset class="catalog__section">
	'.$this->createHeader('Основные данные').'
	<div class="catalog__section-data">
		<!-- imageworksfrontout -->'.$imageworksfrontoutOne.'<!-- /imageworksfrontout -->
		<!-- descrworksfrontoutlist --><div class="input-row__group-wrap">';
			for ($i = 0; $i < count($descrworksfrontoutlist); $i++) {
				if ($i == count($descrworksfrontoutlist)-1) {
					$content .= '<div class="input-row input-wrap input-row__group">
						<label class="input__label" for="' . $i . '">Пункт перечня</label>
						<input placeholder="" id="' . $i . '" name="descrworksfrontoutlist[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($descrworksfrontoutlist[$i]['text']) . '" />
						<div class="button button__block button_copy-block"></div>
					</div>';
					continue;
				}
				
				$content .= '<div class="input-row input-wrap input-row__group">
					<label class="input__label" for="' . $i . '">Пункт перечня</label>
					<input placeholder="" id="' . $i . '" name="descrworksfrontoutlist[]" class="input catalog_input input-width_400" type="text" value="' . $this->getCodeStr($descrworksfrontoutlist[$i]['text']) . '" />
					<div class="button button__block button_remove-block"></div>
				</div>';
			}
		$content .= '</div><!-- /descrworksfrontoutlist -->
	</div>
</fieldset><!-- /commonData -->
	</div>


</form>';
// Форма редактирования КОНЕЦ