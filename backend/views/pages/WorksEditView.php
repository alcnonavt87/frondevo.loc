<?php

// Навигационное меню НАЧАЛО
$navMenu .= '<nav class="sidebar__menu">';
	$countLangs = count($langs);
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
	}
	
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
		$content .= '<li class="crumbs__item crumbs__item-active">Редактирование записи('.$worksItem['pH1'].')</li>';
	} else {
		$content .= '<li class="crumbs__item crumbs__item-active">Добавление записи</li>';
	}
$content .= '</ul>';
// Хлебные крошки КОНЕЦ



// Форма редактирования НАЧАЛО

$showViz = $worksItem['show'] > 0 ? 'checked="checked"' : '';



// Селект "Фильтр"
$filtersOptions = '<option value="0">Выберите вариант</option>';
foreach ($filters as $item) {
	if ($item['id'] == $worksItem['idFilters']) {
		$filtersOptions .= '<option value="'.$item['id'].'"  selected>'.$item['title'].'</option>';
		continue;
	}

	$filtersOptions .= '<option value="'.$item['id'].'" >'.$item['title'].'</option>';
}



// Вывод одного изображения "Одиночное изображение" НАЧАЛО
$imageOne = '<fieldset class="catalog__section">'.
$this->createHeader('Одиночное изображение для страницы сайты под ключ');
if ($worksItem['image'] <> '') {
	$imageOne .= '<div class="fa__uploader single" id="uploader0-image" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/frontend/web/p/works/original-'.$worksItem['image'].'" title="'.$worksItem['imageTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/works/preview-'.$worksItem['image'].'" width="100%" height="auto" alt="'.$worksItem['imageTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[image-one][imgTitle]" value="'.$this->getCodeStr($worksItem['imageTitle']).'">
								<input class="item-deleted" type="hidden" name="images[image-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$worksItem['imageTitle'].'</span>
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
	$imageOne .= '<div class="fa__uploader single" id="uploader0-image" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'">
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
$imageOne .= '</fieldset>';
// Вывод одного изображения "Одиночное изображение" КОНЕЦ



// Вывод одного изображения "Одиночное изображение для страницы портфолио" НАЧАЛО
$imageprtfOne = '<fieldset class="catalog__section">'.
$this->createHeader('Одиночное изображение для страницы портфолио (1920x345)');
if ($worksItem['imageprtf'] <> '') {
	$imageprtfOne .= '<div class="fa__uploader single" id="uploader0-imageprtf" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/p/works/original-'.$worksItem['imageprtf'].'" title="'.$worksItem['imageprtfTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/works/generalprtf-'.$worksItem['imageprtf'].'" width="100%" height="auto" alt="'.$worksItem['imageprtfTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[imageprtf-one][imgTitle]" value="'.$this->getCodeStr($worksItem['imageprtfTitle']).'">
								<input class="item-deleted" type="hidden" name="images[imageprtf-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$worksItem['imageprtfTitle'].'</span>
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
	$imageprtfOne .= '<div class="fa__uploader single" id="uploader0-imageprtf" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'">
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
$imageprtfOne .= '</fieldset>';
// Вывод одного изображения "Одиночное изображение для страницы портфолио" КОНЕЦ



// Вывод одного изображения "Изображение для background" НАЧАЛО
$imagebgOne = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение для background (1920x1200)');
if ($worksItem['imagebg'] <> '') {
	$imagebgOne .= '<div class="fa__uploader single" id="uploader0-imagebg" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/p/works/original-'.$worksItem['imagebg'].'" title="'.$worksItem['imagebgTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/works/smallbg-'.$worksItem['imagebg'].'" width="100%" height="auto" alt="'.$worksItem['imagebgTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[imagebg-one][imgTitle]" value="'.$this->getCodeStr($worksItem['imagebgTitle']).'">
								<input class="item-deleted" type="hidden" name="images[imagebg-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$worksItem['imagebgTitle'].'</span>
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
	$imagebgOne .= '<div class="fa__uploader single" id="uploader0-imagebg" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'">
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
$imagebgOne .= '</fieldset>';
// Вывод одного изображения "Изображение для background" КОНЕЦ



// Вывод одного изображения "Изображение главной страницы" НАЧАЛО
$mainpageOne = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение главной страницы');
if ($worksItem['mainpage'] <> '') {
	$mainpageOne .= '<div class="fa__uploader single" id="uploader0-mainpage" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/p/works/original-'.$worksItem['mainpage'].'" title="'.$worksItem['mainpageTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/works/mediummp-'.$worksItem['mainpage'].'" width="100%" height="auto" alt="'.$worksItem['mainpageTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[mainpage-one][imgTitle]" value="'.$this->getCodeStr($worksItem['mainpageTitle']).'">
								<input class="item-deleted" type="hidden" name="images[mainpage-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$worksItem['mainpageTitle'].'</span>
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
	$mainpageOne .= '<div class="fa__uploader single" id="uploader0-mainpage" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'">
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
$mainpageOne .= '</fieldset>';
// Вывод одного изображения "Изображение главной страницы" КОНЕЦ



// Вывод одного изображения "Изображение доп.возможностей" НАЧАЛО
$addpageOne = '<fieldset class="catalog__section">'.
$this->createHeader('Изображение доп.возможностей');
if ($worksItem['addpage'] <> '') {
	$addpageOne .= '<div class="fa__uploader single" id="uploader0-addpage" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'">
				<span class="content__menu-item content__menu-item_upload">
					Загрузить файл
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<div class="progress">
					<div class="progress-bar progress-bar-success"></div>
				</div>
				<div class="fa__file-list">
					<div class="fa__file">
						<a href="/frontend/web/p/works/generaladd-'.$worksItem['addpage'].'" title="'.$worksItem['addpageTitle'].'" class="cboxElement" rel="uploader0">
							<span class="fa__file-img">
								<span class="fa__file-cell">
									<img src="/frontend/web/p/works/generaladd-'.$worksItem['addpage'].'" width="100%" height="auto" alt="'.$worksItem['addpageTitle'].'">
								</span>
								<input class="title-fld" type="hidden" name="images[addpage-one][imgTitle]" value="'.$this->getCodeStr($worksItem['addpageTitle']).'">
								<input class="item-deleted" type="hidden" name="images[addpage-one][deleted]" value="0">
							</span>
							<span class="fa__file-title">'.$worksItem['addpageTitle'].'</span>
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
	$addpageOne .= '<div class="fa__uploader single" id="uploader0-addpage" data-module="FAUploader" data-href="imgupload" data-action="/'.$idPageGroup.'">
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
$addpageOne .= '</fieldset>';
// Вывод одного изображения "Изображение доп.возможностей" КОНЕЦ/* UpdateCode */



if ($idRecord) {
	$content .= '<form action="formupdate/'.$idPageGroup.'/'.$idRecord.'?pageLang='.$pageLang.'" method="post" id="form-edit-content">';
} else {
	$content .= '<form action="formupdate/'.$idPageGroup.'?newDoc=1&pageLang='.$pageLang.'" method="post" id="form-edit-content">';
}

$content .= '<!-- sectionPageData --><fieldset class="catalog__section">
	'.$this->createHeader('Основные данные страницы').'
	<div class="catalog__section-data">
		<!-- pH1 -->'.$this->createInput(['id'=> 'pH1', 'text' => 'Заголовок H1', 'placeholder' => '', 'width' => 400, 'name' => 'content[pH1]', 'value' => $worksItem['pH1'], 'attr' => 'required']).'<!-- /pH1 -->
		<!-- pTitle -->'.$this->createInput(['id'=> 'pTitle', 'text' => 'Заголовок страницы', 'placeholder' => 'В поисковой выдаче видно 60 символов', 'width' => 400, 'name' => 'content[pTitle]', 'value' => $worksItem['pTitle'], 'attr' => 'required data-count="60"', 'dataCopy' => 'pH1', 'titleCopy' => 'Копия заголовка H1']).'<!-- /pTitle -->
		<!-- pUrl -->'.$this->createInput(['id' => 'pUrl', 'text' => 'Алиас страницы', 'width' => 400, 'name' => 'base[Url]', 'value' => $worksItem['Url'], 'attr' => 'required', 'genUrl' => 'pH1', 'titleUrl' => 'Генерация с заголовка H1']).'<!-- /pUrl -->
		<!-- pDescription -->'.$this->createTextArea(['id'=> 'pDescription', 'text' => 'Meta description', 'placeholder' => 'В поисковой выдаче видно 140 символов', 'width' => '400x100', 'name' => 'content[pDescription]', 'value' => $worksItem['pDescription'], 'attr' => 'data-count="140"']).'<!-- /pDescription -->

		<!-- show -->'.$this->createCheckBoxRow(['id' => 'show', 'text' => 'Отображать страницу', 'name' => 'base[show]', 'value' => 1, 'attr' => $showViz]).'
	</div>
</fieldset><!-- /sectionPageData -->

<!-- commonData --><fieldset class="catalog__section">
	'.$this->createHeader('Основные данные').'
	<div class="catalog__section-data">
		<!-- description -->'.$this->createTextArea(['id'=> 'description', 'text' => 'Описание', 'width' => '400x100', 'name' => 'content[description]', 'value' => $worksItem['description'], 'attr' => '']).'<!-- /description -->
		<!-- filters -->'.$this->createSelect(['id'=> 'idFilters', 'text' => 'Фильтр', 'width' => 400,  'name' => 'base[idFilters]', 'value' => $filtersOptions, 'attr' => '']).'<!-- /filters -->
		<!-- imagebg -->'.$imagebgOne.'<!-- /imagebg -->
		<!-- imageprtf -->'.$imageprtfOne.'<!-- /imageprtf -->
	</div>
</fieldset><!-- /commonData -->

<!-- aboutProject --><fieldset class="catalog__section">
	'.$this->createHeader('О проекте').'
	<div class="catalog__section-data">
		<!-- client -->'.$this->createInput(['id'=> 'client', 'text' => 'Клиент', 'placeholder' => '', 'width' => 400, 'name' => 'content[client]', 'value' => $worksItem['client'], 'attr' => '']).'<!-- /client -->
		<!-- services -->'.$this->createInput(['id'=> 'services', 'text' => 'Услуги', 'placeholder' => '', 'width' => 400, 'name' => 'content[services]', 'value' => $worksItem['services'], 'attr' => '']).'<!-- /services -->
		<!-- launch -->'.$this->createInput(['id'=> 'launch', 'text' => 'Год запуска', 'placeholder' => '', 'width' => 400, 'name' => 'content[launch]', 'value' => $worksItem['launch'], 'attr' => '']).'<!-- /launch -->


<!-- task --><fieldset class="catalog__section">
	'.$this->createHeader('Задача').'
	<div class="catalog__section-data">
		<!-- task -->'.$this->createTextArea(['id'=> 'task', 'text' => 'Задача', 'width' => '400x100', 'name' => 'content[task]', 'value' => $worksItem['task'], 'attr' => 'data-module="tinymce"']).'<!-- /task -->

</fieldset><!-- /task -->

<!-- solution --><fieldset class="catalog__section">
	'.$this->createHeader('Решение').'
	<div class="catalog__section-data">
		<!-- solutions -->'.$this->createTextArea(['id'=> 'solutions', 'text' => 'Решение', 'width' => '400x100', 'name' => 'content[solutions]', 'value' => $worksItem['solutions'], 'attr' => 'data-module="tinymce"']).'<!-- /solutions -->
		<!-- linkwork -->'.$this->createInput(['id'=> 'linkwork', 'text' => 'Ссылка на работу', 'placeholder' => '', 'width' => 400, 'name' => 'content[linkwork]', 'value' => $worksItem['linkwork'], 'attr' => '']).'<!-- /linkwork -->
	</div>
</fieldset><!-- /solution -->

<!-- results --><fieldset class="catalog__section">
	'.$this->createHeader('Результаты').'
	<div class="catalog__section-data">
		<!-- results -->'.$this->createTextArea(['id'=> 'results', 'text' => 'Результаты', 'width' => '400x100', 'name' => 'content[results]', 'value' => $worksItem['results'], 'attr' => '']).'<!-- /results -->
		<!-- resultlist1 --><div class="input-row__group-wrap">';
			for ($i = 0; $i < count($resultlist1); $i++) {
				if ($i == count($resultlist1)-1) {
					$content .= '<div class="input-row input-wrap input-row__group">
						<label class="input__label" for="' . $i . '">Перечень результатов</label>
						<input placeholder="" id="' . $i . '" name="resultlist1[]" class="input catalog_input input-width_400" type="text" value="' .$resultlist1[$i]['text'] . '" />
						<div class="button button__block button_copy-block"></div>
					</div>';
					continue;
				}
				
				$content .= '<div class="input-row input-wrap input-row__group">
					<label class="input__label" for="' . $i . '">Перечень резултатов</label>
					<input placeholder="" id="' . $i . '" name="resultlist1[]" class="input catalog_input input-width_400" type="text" value="' .$resultlist1[$i]['text'] . '" />
					<div class="button button__block button_remove-block"></div>
				</div>';
			}
		$content .= '</div><!-- /resultlist1 -->
	</div>


</form>';
// Форма редактирования КОНЕЦ