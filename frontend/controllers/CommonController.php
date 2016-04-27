<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use frontend\models\Common;
use frontend\models\Root;

/**
 * Common controller
 */
class CommonController extends Controller
{
    public $layout;
    
	protected $myCommon;
    protected $myRoot;

    protected $hostName;
    protected $lang;
    protected $langUri;
    protected $firstUri;
    protected $secondUri;
    protected $thirdUri;
	
    protected $pagesUrls;
    protected $pageContent;
    protected $forLayout;
    protected $data;
	
	public function init() {
        $this->forLayout = [];
		$this->data = [];
		
		// Основной шаблон
        $this->layout = 'basic';
		
		$this->myCommon = new Common();
		
		// Хост
        $this->hostName = $this->myCommon->getHostName();
        $this->data['hostName'] = $this->hostName;
		
		// Язык
        $this->lang = $this->myCommon->getLang();
        $this->data['lang'] = $this->lang;
		
        $this->myRoot = new Root($this->lang);
		
		// Uris
        $uris = $this->myCommon->getUris($this->lang);
        $this->langUri = $this->myCommon->getLangUri($this->lang);
		list($this->firstUri, $this->secondUri, $this->thirdUri) = $uris;
        $this->data['langUri'] = $this->langUri;
		
		// Информация о странице (текстовой)
        $pagesUrls = $this->myRoot->getPagesUrls();
        $this->pagesUrls = $pagesUrls;
        $pageUri = $this->myCommon->getPageUri($pagesUrls, [
			'firstUri' => $this->firstUri,
			'secondUri' => $this->secondUri,
		]);
		if ($pageUri) {
			$this->pageContent = $this->myRoot->getPageContent($pageUri);
		}//echo '<pre>';print_r($this->pageContent);echo '</pre>';exit;
		
		// Мета-теги
		if ($this->pageContent) {
			$this->forLayout['pTitle'] = $this->pageContent['pTitle'];
			$this->forLayout['pDescription'] = $this->pageContent['pDescription'];
			$this->forLayout['pAlias'] = $this->pageContent['alias'];
			$this->data['alias'] = $this->pageContent['alias'];
			$this->data['pH1'] = $this->pageContent['pH1'];
		}//echo '<pre>';print_r($this->forLayout);echo '</pre>';exit;
	}
}
