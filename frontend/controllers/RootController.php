<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Common;
use frontend\models\Root;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use vendor\UrlProvider\UrlProvider;
use vendor\Menu\Menu;

/**
 * Root controller
 */
class RootController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                //'class' => 'frontend\controllers\ErrorAction',
                //'class' => 'frontend\controllers\RootController',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
		session_start();
		$forLayout = [];
		
		$myCommon = new Common();
		
		// Хост
        $hostName = $myCommon->getHostName();
		$forLayout['hostName'] = $hostName;
		
		// Язык
        $lang = $myCommon->getLang();
		$forLayout['lang'] = $lang;
		
		$myRoot = new Root($lang);
		
		// Uris
        $uris = $myCommon->getUris($lang);
		list($firstUri, $secondUri, $thirdUri) = $uris;
		
		// Настройка языкового окружения
		switch ($lang) {
            case 'en':
                Yii::$app->language = 'en-US';
                break;
            case 'ru':
                Yii::$app->language = 'ru-RU';
                break;
            case 'ua':
                Yii::$app->language = 'uk-UA';
                break;
            default :
                Yii::$app->language = 'en-US';
        }
		
		// Урл провайдеры
		$urlProvider = new UrlProvider($lang);
        $indexUrl = $urlProvider->getIndexUrl();
        $forLayout['indexUrl'] = $indexUrl;
        
        /* Находим нужный класс страницы */
        $indexPage = $myCommon->isIndexPage($firstUri);//echo '<pre>';print_r($firstUri);echo '</pre>';exit;
        if ($indexPage) {
			$indexUri = $myCommon->getDbIndexUri();
            $pageIdAndClassName = $myRoot->getPageIdAndClassName($indexUri);
        } else {
            $pageIdAndClassName = $myRoot->getPageIdAndClassName($firstUri);
        }//echo '<pre>';print_r($pageIdAndClassName);echo '</pre>';exit;
		
		if (isset($pageIdAndClassName['id'])) {
            $controllerID = $pageIdAndClassName['class'];
            $controller = Yii::$app->createControllerByID($controllerID);
            $ret = $controller->runAction('index');
        } else {
			$controller = Yii::$app->createControllerByID('error');
			$ret = $controller->runAction('404');
        }
		
		$this->layout = $ret['layout'];
		$forLayout = array_merge($forLayout, $ret['forLayout']);//echo '<pre>';print_r($forLayout);echo '</pre>';exit;
		
		// Список текстовых страниц
		//$pages = $myRoot->getPagesContent();
		
		// Главное меню
		//$mainMenu = $myRoot->getMainMenu($pages);
		$options = [];
		$options['currAlias'] = $forLayout['pAlias'];
		$menu = new Menu($lang, 'main', $options);
		$mainMenu = $menu->create();
		$forLayout['menu'] = $mainMenu;

        // Настройки сайта
        $settings = $myCommon->getSettings($lang);
        $forLayout['settings'] = $settings;
		
		//echo '<pre>';print_r($forLayout);echo '</pre>';exit;
		Yii::$app->params['forLayout'] = $forLayout;
		echo $this->render($ret['view'], $ret['data']);
    }
}
