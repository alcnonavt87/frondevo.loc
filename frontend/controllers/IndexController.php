<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use vendor\UrlProvider\TextPagesUrlProvider;
use corpsepk\yii2emt\EMTypograph;
/**
 * Index controller
 */
class IndexController extends CommonController
{
    protected $text;


    public function init() {
		parent::init();
	}

    public function actionIndex() {
        $this->layout='index';
        $data = [];
        $forLayout = [];
        $forLayout['indexPage'] = 1;
		$data = array_merge($this->data, $data);
		$forLayout = array_merge($this->forLayout, $forLayout);//echo '<pre>';print_r($forLayout);echo '</pre>';exit;
        // Языковое меню
        $langMenu = [];

        $options = [];
        $options['joinUris'] = 1;

        // укр
        $pagesContent = $this->myRoot->getPagesContent('ua');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ua', $options);
        $forLayout['PageLangUa'] = $pageUaUrl = $urlProvider->getIndexUrl();
        $langMenu['ua'] = [
            'link' => $pageUaUrl,
            'text' => 'Укр'
        ];
        // eng
        $pagesContent = $this->myRoot->getPagesContent('en');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('en', $options);
        $forLayout['PageLangEn'] = $pageEnUrl = $urlProvider->getIndexUrl();
        $langMenu['en'] = [
            'link' => $pageEnUrl,
            'text' => 'Eng'
        ];
        // рус
        $pagesContent = $this->myRoot->getPagesContent('ru');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ru', $options);
        $forLayout['PageLangRu'] = $pageRuUrl = $urlProvider->getIndexUrl();
        $langMenu['ru'] = [
            'link' => $pageRuUrl,
            'text' => 'Рус'
        ];
        //Добираем статические данные со страницы
        $pageData = $this->myRoot->getPageContent();
        $data['pageData'] = $pageData;
        $forLayout['langMenu'] = $langMenu;//echo '<pre>';print_r($data);echo '</pre>';exit;
		return [
            'view' => 'index',
            'data' => $data,
            'layout' => $this->layout,
            'forLayout' => $forLayout,
        ];
    }
}
