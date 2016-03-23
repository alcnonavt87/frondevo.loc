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
		$content .= '<li class="crumbs__item crumbs__item-active">Редактирование записи('.$filtersItem['title'].')</li>';
	} else {
		$content .= '<li class="crumbs__item crumbs__item-active">Добавление записи</li>';
	}
$content .= '</ul>';
// Хлебные крошки КОНЕЦ



// Форма редактирования НАЧАЛО

$showViz = $filtersItem['show'] > 0 ? 'checked="checked"' : '';/* UpdateCode */



if ($idRecord) {
	$content .= '<form action="formupdate/'.$idPageGroup.'/'.$idRecord.'?pageLang='.$pageLang.'" method="post" id="form-edit-content">';
} else {
	$content .= '<form action="formupdate/'.$idPageGroup.'?newDoc=1&pageLang='.$pageLang.'" method="post" id="form-edit-content">';
}

$content .= '<!-- sectionPageData --><fieldset class="catalog__section">
	'.$this->createHeader('Основные данные страницы').'
	<div class="catalog__section-data">
		<!-- title -->'.$this->createInput(['id'=> 'title', 'text' => 'Заголовок страницы', 'placeholder' => '', 'width' => 400, 'name' => 'content[title]', 'value' => $filtersItem['title'], 'attr' => 'required']).'<!-- /title -->
		<!-- url -->'.$this->createInput(['id' => 'url', 'text' => 'Алиас страницы', 'width' => 400, 'name' => 'base[url]', 'value' => $filtersItem['url'], 'attr' => 'required', 'genUrl' => 'title', 'titleUrl' => 'Генерация с title']).'<!-- /url -->
		<!-- show -->'.$this->createCheckBoxRow(['id' => 'show', 'text' => 'Отображать страницу', 'name' => 'base[show]', 'value' => 1, 'attr' => $showViz]).'<!-- /show -->
	</div>
</fieldset><!-- /sectionPageData --><!-- /createFinish -->

</form>';
// Форма редактирования КОНЕЦ