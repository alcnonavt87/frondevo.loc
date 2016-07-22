<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use frontend\models\Common;
use frontend\models\Root;
use frontend\models\WorksFrontOut;
use vendor\UrlProvider\SimpleModuleUrlProvider;



/**
 * Api controller
 */
class ApiController extends Controller
{
	private $lang;
	private $myCommon;
	private $firstUri;
	private $secondUri;
	private $thirdUri;
	private $myWorks;


	public function init() {
		//session_start();
		$session = Yii::$app->session;
        $session->open();
		
        $myCommon = new Common();
		$this->myCommon = new Common();
		$this->myWorks = new WorksFrontOut($this->lang);
		// Язык
        $this->lang = $this->myCommon->getLang();
        // Uris
        $uris = $this->myCommon->getUris($this->lang);
		list($this->firstUri, $this->secondUri, $this->thirdUri) = $uris;
        
		// Настройка языкового окружения
        switch ($this->lang) {
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
	}
	
    public function actionIndex() {
		$options['joinUris'] = 1;
		$simpleModuleUrlProvider = new SimpleModuleUrlProvider($this->lang, $options);
		$request = ((file_get_contents('php://input')));

		$request = json_decode($request);
		$request = $request->{'type'};
		$works = $this->myWorks->getWorksForPsdhtmlPage($request);

		foreach ($works as $key => $work){
			$params['item'] = $work;
			$workjson[$key]['href'] = $simpleModuleUrlProvider->geteWorksFrontOutItemUrl($params);
			$workjson[$key]['img'] = $work['imgPath'];
			foreach($work['desclist'] as $keys => $desk) {
				$workjson[$key]['items'][$keys] = $desk['text'];
					}
		}

		$array = array_chunk($workjson, 5);
		echo json_encode($array);exit();
	}
}
