<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use vendor\UrlProvider\UrlProvider;

/**
 * Error controller
 */
class ErrorController extends CommonController
{
    private $urlProvider;
	
	public function init() {
        parent::init();
		
		$this->urlProvider = new UrlProvider($this->lang);
	}
	
    public function actionIndex() {
    }
	
	/**
	 * Страница 404
	 */
    public function action404() {
		$data = [];
        $forLayout = [];
		
		// Информация о странице
        $pageContent = $this->myRoot->getPageContent('error404');
		
		// Мета-теги
        $forLayout['pTitle'] = $pageContent['pTitle'];
        $forLayout['pDescription'] = $pageContent['pDescription'];
        $forLayout['pAlias'] = $pageContent['alias'];
		
		// Урл индексной страницы
		$indexUrl = $this->urlProvider->getIndexUrl();
		$data['indexUrl'] = $indexUrl;
		
		$data = array_merge($this->data, $data);
		$forLayout = array_merge($this->forLayout, $forLayout);//echo '<pre>';print_r($data);echo '</pre>';exit;
		
		header ('HTTP/1.0 404 Not Found');
		
        return [
            'view' => 'error404',
            'data' => $data,
            'layout' => $this->layout,
            'forLayout' => $forLayout,
        ];
    }
}
