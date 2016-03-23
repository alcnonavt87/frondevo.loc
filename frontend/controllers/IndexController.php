<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use vendor\UrlProvider\TextPagesUrlProvider;

/**
 * Index controller
 */
class IndexController extends CommonController
{
    public function init() {
		parent::init();
	}
	
    public function actionIndex() {
        $data = [];
        $forLayout = [];
		
        $forLayout['indexPage'] = 1;
		$data = array_merge($this->data, $data);
		$forLayout = array_merge($this->forLayout, $forLayout);//echo '<pre>';print_r($forLayout);echo '</pre>';exit;
        // Языковое меню
        $langMenu = [];
        $pagesContent = $this->myRoot->getPagesContent();
        $options = [];
        $options['joinUris'] = 1;
        $options['items'] = $pagesContent;
        // укр
        $urlProvider = new TextPagesUrlProvider('ua', $options);
        $pageUaUrl = $urlProvider->getIndexUrl();
        $langMenu['ua'] = [
            'link' => $pageUaUrl,
            'text' => 'Укр'
        ];
        // eng
        $urlProvider = new TextPagesUrlProvider('en', $options);
        $pageEnUrl = $urlProvider->getIndexUrl();
        $langMenu['en'] = [
            'link' => $pageEnUrl,
            'text' => 'Eng'
        ];
        // рус
        $urlProvider = new TextPagesUrlProvider('ru', $options);
        $pageRuUrl = $urlProvider->getIndexUrl();
        $langMenu['ru'] = [
            'link' => $pageRuUrl,
            'text' => 'Рус'
        ];
        $forLayout['langMenu'] = $langMenu;
		return [
            'view' => 'index',
            'data' => $data,
            'layout' => $this->layout,
            'forLayout' => $forLayout,
        ];
    }
}
