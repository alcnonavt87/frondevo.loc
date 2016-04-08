<?php
namespace frontend\controllers;

use frontend\models\Root;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use Yii\helpers\ArrayHelper;
use frontend\models\Works;
use frontend\models\Filters;
use vendor\UrlProvider\TextPagesUrlProvider;
use vendor\UrlProvider\SimpleModuleUrlProvider;
use vendor\pagination\Pagination;

/**
 * SitesByKeysController controller
 */
class SitesByKeysController extends CommonController
{
    private $myWorks;
    private $myFilters;

    public function init()
    {
        parent::init();
        $this->myWorks = new Works($this->lang);
        $this->myFilters = new Filters($this->lang);
        $this->myRoot = new Root($this->lang);
    }

    /**
     * Стартовая страница
     */
    public function actionIndex()
    {
        // Если строка запроса содержит uri второго уровня,
        // переход на маршрутизацию второго уровня
        if ($this->secondUri) {
            return $this->actionInner();
        }

        $action1 = explode("-", $this->firstUri);
        $action2 = implode(" ", $action1);
        $action3 = ucwords($action2);
        $action4 = str_replace(" ", "", $action3);
        $action5 = 'action' . $action4;
        return $this->$action5();
    }


    public function actionSitesByKeys()
    {
        $data = [];
        $forLayout = [];
        $params = [];
        $data = array_merge($this->data, $data);
        $forLayout = array_merge($this->forLayout, $forLayout);//echo '<pre>';print_r($data);echo '</pre>';exit;
        // Языковое меню
        $langMenu = [];
        $pagesContent = $this->myRoot->getPagesContent();
        $options = [];
        $options['joinUris'] = 1;
        $options['items'] = $pagesContent;
        // укр
        $urlProvider = new TextPagesUrlProvider('ua', $options);
        $pageUaUrl = $urlProvider->getSitesByKeysUrl();
        $langMenu['ua'] = [
            'link' => $pageUaUrl,
            'text' => 'Укр'
        ];
        // eng
        $urlProvider = new TextPagesUrlProvider('en', $options);
        $pageEnUrl = $urlProvider->getSitesByKeysUrl();
        $langMenu['en'] = [
            'link' => $pageEnUrl,
            'text' => 'Eng'
        ];
        // рус
        $urlProvider = new TextPagesUrlProvider('ru', $options);
        $pageRuUrl = $urlProvider->getSitesByKeysUrl();
        $langMenu['ru'] = [
            'link' => $pageRuUrl,
            'text' => 'Рус'
        ];
        $forLayout['langMenu'] = $langMenu;
        // Список ссылок для плашки сссылок в футере
        $links = $this->myWorks->getLinks($this->pageContent['alias']);
        $forLayout['links'] = $links;

        // Добираем статические данные страницы

        $pageData = $this->myRoot->getPageContentByAlias($this->pageContent['alias'], [
            'section1', 'section2', 'section3', 'section4', 'section5'
        ], []);
        $data['pageData'] = $pageData;

        // Работы отобаржаемые на текстовой странице
        // Работы отобаржаемые на текстовой странице
        $works = $this->myWorks->getListForSitesByKeys($this->pageContent['alias']);//echo '<pre>';print_r($works);echo '</pre>';exit;
        $data['works'] = $works;
        return [
            'view' => 'sitesbykeys',
            'data' => $data,
            'layout' => $this->layout,
            'forLayout' => $forLayout,
        ];
    }

    public function actionLandingPage()
    {
        $data = [];
        $forLayout = [];
        $params = [];
        $data = array_merge($this->data, $data);
        $forLayout = array_merge($this->forLayout, $forLayout);//echo '<pre>';print_r($data);echo '</pre>';exit;
        // Языковое меню
        $langMenu = [];
        $pagesContent = $this->myRoot->getPagesContent();
        $options = [];
        $options['joinUris'] = 1;
        $options['items'] = $pagesContent;
        // укр
        $urlProvider = new TextPagesUrlProvider('ua', $options);
        $pageUaUrl = $urlProvider->getLandingpageUrl();
        $langMenu['ua'] = [
            'link' => $pageUaUrl,
            'text' => 'Укр'
        ];
        // eng
        $urlProvider = new TextPagesUrlProvider('en', $options);
        $pageEnUrl = $urlProvider->getLandingpageUrl();
        $langMenu['en'] = [
            'link' => $pageEnUrl,
            'text' => 'Eng'
        ];
        // рус
        $urlProvider = new TextPagesUrlProvider('ru', $options);
        $pageRuUrl = $urlProvider->getLandingpageUrl();
        $langMenu['ru'] = [
            'link' => $pageRuUrl,
            'text' => 'Рус'
        ];
        $forLayout['langMenu'] = $langMenu;
        // Добираем статические данные страницы

        $pageData = $this->myRoot->getPageContentByAlias($this->pageContent['alias'], [

        ], []);
        $data['pageData'] = $pageData; //echo '<pre>';print_r($pageData);echo '</pre>';exit;

        return [
            'view' => 'landingpage',
            'data' => $data,
            'layout' => $this->layout,
            'forLayout' => $forLayout,
        ];
    }

    /**
     * Внутренняя страница
     */
    public function actionInner()
    {
        return $this->actionPortfolio();
    }

    /**
     * Страница портфолио
     */
    public function actionPortfolio()
    {
        // Проверяем является ли uri третьего уровня uri фильтра
        $filterUri = $this->myFilters->isFilterUri($this->thirdUri);

        // Если строка запроса содержит uri третьего уровня и этот uri не равен фильтру,
        // переход на единицу работы
        if ($this->thirdUri && $this->thirdUri != $filterUri) {
            return $this->actionItem();
        }

        $data = [];
        $forLayout = [];

        // Список фильтров
        $params = [];
        $filters = $this->myFilters->getList($params);
        $data['filters'] = $filters;
        $data['filterUri'] = $this->thirdUri;

        // Пагинация
        // получаем из GET-массива номер страницы
        $pageNum = ArrayHelper::getValue($_GET, 'page', 1);
        $data['pageNum'] = $pageNum;

        // общее кол-во работ
        $params = [];
        if ($filterUri) {
            $params['filter'] = $this->thirdUri;
        }
        $worksCount = $this->myWorks->getListCount($params);

        // кол-во работ на страницу
        $limit = Yii::$app->params['works']['countPerPage'];

        // кол-во страниц
        $pagesCount = ceil($worksCount / $limit);
        $data['pagesCount'] = $pagesCount;

        // краевые условия (номер страницы некорректно мал или велик или кол-во страниц равно нулю)
        if ($pageNum <= 0 || $pagesCount == 0) {
            $pageNum = 1;
        } else if ($pageNum > $pagesCount) {
            $pageNum = $pagesCount;
        }

        // Список работ
        $params = [];
        if ($filterUri) {
            $params['filter'] = $this->thirdUri;
        }
        //$params['sorting'] = 'createdDesc';
        $params['limit'] = $limit;
        // смещение записей (в зависимости от страницы)
        $offset = $limit * ($pageNum - 1);
        $params['offset'] = $offset;
        $works = $this->myWorks->getListForPortfolio($params);//echo '<pre>';print_r($works);echo '</pre>';exit;
        $data['works'] = $works;

        $pagination = new Pagination($worksCount, $pageNum, $limit, '?page=');
        $data['pagination'] = $pagination;

        // Список ссылок для плашки сссылок в футере
        $links = $this->myWorks->getLinks($this->pageContent['alias']);
        $forLayout['links'] = $links;

        $data["portfolioUri"] = $this->secondUri;

        // Языковое меню
        $langMenu = [];
        $pagesContent = $this->myRoot->getPagesContent();
        $options = [];
        $options['joinUris'] = 1;
        $options['items'] = $pagesContent;
        // укр
        $urlProvider = new TextPagesUrlProvider('ua', $options);
        $pageUaUrl = $urlProvider->getPortfolioUrl();
        $langMenu['ua'] = [
            'link' => $pageUaUrl,
            'text' => 'Укр'
        ];
        // eng
        $urlProvider = new TextPagesUrlProvider('en', $options);
        $pageEnUrl = $urlProvider->getPortfolioUrl();
        $langMenu['en'] = [
            'link' => $pageEnUrl,
            'text' => 'Eng'
        ];
        // рус
        $urlProvider = new TextPagesUrlProvider('ru', $options);
        $pageRuUrl = $urlProvider->getPortfolioUrl();
        $langMenu['ru'] = [
            'link' => $pageRuUrl,
            'text' => 'Рус'
        ];
        $forLayout['langMenu'] = $langMenu;


        $data = array_merge($this->data, $data);
        $forLayout = array_merge($this->forLayout, $forLayout);//echo '<pre>';print_r($data);echo '</pre>';exit;

        return [
            'view' => 'portfolio',
            'data' => $data,
            'layout' => $this->layout,
            'forLayout' => $forLayout,

        ];
        /*Посадочная страница*/
    }

    /**
     * Страница единицы работы
     */
    public function actionItem()
    {
        $data = [];
        $forLayout = [];
        $pUrl = '';

        $params = [];

        // Информация о странице (единица работы)

        $pageContent = $worksItem = $this->myWorks->getItem($this->thirdUri);//echo '<pre>';print_r($worksItem);echo '</pre>';exit;

        // Проверка существования работы
        if (!$pageContent) {
            $controller = Yii::$app->createControllerByID('error');
            return $controller->runAction('404');
        }

        $data['worksItem'] = $worksItem;


        // Языковое меню для страницы одной новости
        $langMenu = [];

        $params = [];
        $params['joinUris'] = 1;
        $params['item'] = $pageContent;

        // укр
        $urlProvider = new SimpleModuleUrlProvider('ua', $params);
        $pageUaUrl = $urlProvider->geteWorksItemUrl($params);
        $langMenu['ua'] = [
            'link' => $pageUaUrl,
            'text' => 'Укр'
        ];
        // eng
        $urlProvider = new SimpleModuleUrlProvider('en', $params);
        $pageEnUrl = $urlProvider->geteWorksItemUrl($params);
        $langMenu['en'] = [
            'link' => $pageEnUrl,
            'text' => 'Eng'
        ];
        // рус
        $urlProvider = new SimpleModuleUrlProvider('ru', $params);
        $pageRuUrl = $urlProvider->geteWorksItemUrl($params);
        $langMenu['ru'] = [
            'link' => $pageRuUrl,
            'text' => 'Рус'
        ];
        $forLayout['langMenu'] = $langMenu;


        //Получаем pTitle для Layout  единцы работы
        $forLayout['pTitle'] = $data['worksItem']['pTitle'];
        // Список ссылок для плашки сссылок в футере
        $links = $this->myWorks->getLinks($this->pageContent['alias']);
        $forLayout['links'] = $links;
        $data = array_merge($this->data, $data);
        $forLayout = array_merge($this->forLayout, $forLayout);// echo '<pre>';print_r($forLayout);echo '</pre>';exit;

        return [
            'view' => 'worksItem',
            'data' => $data,
            'layout' => $this->layout,
            'forLayout' => $forLayout,
        ];
    }
}
