<?php
namespace frontend\controllers;
use frontend\models\Root;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use Yii\helpers\ArrayHelper;
use frontend\models\WorksFrontOut;
use frontend\models\AdvantagesPsdHtml;
use frontend\models\AdvantagesJavascript;
use frontend\models\AdvantagesAnimations;
use frontend\models\AdvantagesGames;
use frontend\models\Filters;
use frontend\models\FiltersFrontOut;
use vendor\UrlProvider\TextPagesUrlProvider;
use vendor\UrlProvider\SimpleModuleUrlProvider;
use vendor\pagination\Pagination;
/**
 * OutsourcingController controller
 */
class OutsourcingController extends CommonController
{
    private $myWorks;
    private $myFilters;
    private $myAdvantagePsdHtml;
    private $myAdvantageJavascript;
    private $myAdvantageAnimations;
    private $myAdvantageGames;

    public function init()
    {
        parent::init();
        $this->myWorks = new WorksFrontOut($this->lang);
        $this->myFilters = new FiltersFrontOut($this->lang);
        $this->myRoot = new Root($this->lang);
        $this->myAdvantagePsdHtml = new AdvantagesPsdHtml($this->lang);
        $this->myAdvantageJavascript = new AdvantagesJavascript($this->lang);
        $this->myAdvantageAnimations = new AdvantagesAnimations($this->lang);
        $this->myAdvantageGames = new AdvantagesGames($this->lang);
    }

    /**
     * Стартовая страница
     */
    public function actionIndex()
    {
        // Если строка запроса содержит uri второго уровня,
        // переход на маршрутизацию второго уровня
        if ($this->secondUri) {
            $pageData = $this->myRoot->getPageContent($this->secondUri);

            if (!$pageData){
                $controller = Yii::$app->createControllerByID('error');
                return $controller->runAction('404');
            }
            // Функция для преобразования alias страницы в нужный action
            $action1 = explode("-", $pageData['alias']);
            $action2 = implode(" ", $action1);
            $action3 = ucwords($action2);
            $action4 = str_replace(" ", "", $action3);
            $action5 = 'action' . $action4;
            return $this->$action5();


        }
        $controller = Yii::$app->createControllerByID('error');
        return $controller->runAction('404');


    }


    public function actionFrontendOut()
    {
        $data = [];
        $forLayout = [];
        $params = [];
        $forLayout['frontendoutPage'] = 1;
        $data = array_merge($this->data, $data);
        $forLayout = array_merge($this->forLayout, $forLayout);//echo '<pre>';print_r($this->forLayout);echo '</pre>';exit;
        // Языковое меню
        $langMenu = [];
        $options = [];
        $options['joinUris'] = 1;



        if ($this->thirdUri) {
            $controller = Yii::$app->createControllerByID('error');
            return $controller->runAction('404');
        }


        // укр
        $pagesContent = $this->myRoot->getPagesContent('ua');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ua', $options);
        $forLayout['PageLangUa'] = $pageUaUrl = $urlProvider->getFrontendOutUrl();
        $langMenu['ua'] = [
            'link' => $pageUaUrl,
            'text' => 'Укр'
        ];
        // eng
        $pagesContent = $this->myRoot->getPagesContent('en');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('en', $options);
        $forLayout['PageLangEn'] = $pageEnUrl = $urlProvider->getFrontendOutUrl();
        $langMenu['en'] = [
            'link' => $pageEnUrl,
            'text' => 'Eng'
        ];
        // рус
        $pagesContent = $this->myRoot->getPagesContent('ru');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ru', $options);
        $forLayout['PageLangRu'] = $pageRuUrl = $urlProvider->getFrontendOutUrl();
        $langMenu['ru'] = [
            'link' => $pageRuUrl,
            'text' => 'Рус'
        ];
        $forLayout['langMenu'] = $langMenu;

        //Добираем статические данные со страницы
        $pageData = $this->myRoot->getPageContent($this->firstUri);
        $data['pageData'] = $pageData;
        $pageData2 = $this->myRoot->getPageContentByAlias($this->pageContent['alias'], ['titlefrontout','titlemiddlefrontout',
            'titlesmallfrontout','worksexamplesfrontendouttitle','linkvideobgfrnout','titlesmallfrontout2','imagefrontoutbgbig','imagefrontoutbgsmall','frndoutsect2title','frndoutsect2data','frndoutsect3title',
        'othervariantstitle','othervariants1title','othervariants1text','othervariants2title','othervariants2text','frontendoutworkstitle','ourcompaniestitle','garantiesbgword','garanties1title','garanties2title'], [], ['ourclientslist','garanties1list','garanties2list'],['imageourclientslogo','imageourcompanieslogo']);
        $data['pageData1'] = $pageData2;


        // Работы отобаржаемые на текстовой странице

        $works = $this->myWorks->getWorksForTextPages($this->pageContent['alias']);
        $data['works'] = $works;


        //количество работ в таблице для фронтендаутсорсинг

        $workscount = $this->myWorks->getListCount();
        $data['workscount'] = $workscount;

        // Список ссылок для плашки сссылок в футере
        $links = $this->myWorks->getLinks($this->pageContent['alias']);
        $forLayout['links'] = $links;
        $data['pageData'] = $pageData; //echo '<pre>';print_r($pageData);echo '</pre>';exit;

        $data = array_merge($this->data, $data);
        $forLayout = array_merge($this->forLayout, $forLayout);//echo '<pre>';print_r($this->forLayout);echo '</pre>';exit;


        return [
            'view' => 'frontendout',
            'data' => $data,
            'layout' => $this->layout,
            'forLayout' => $forLayout,
        ];
    }


    public function actionPsd2html5()
    {
        // Проверяем является ли uri третьего уровня uri фильтра
        $filterUri = $this->myFilters->isFilterUriPdshtml($this->thirdUri);

        // Если строка запроса содержит uri третьего уровня и этот uri не равен фильтру,
        // переход на единицу работы
        if ($this->thirdUri && $this->thirdUri != $filterUri) {
            return $this->actionItem();
        }

        $data = [];
        $forLayout = [];
        $params = [];
        $forLayout['Psd2html5Page'] = 1;
        // Языковое меню
        $langMenu = [];
        $options = [];
        $options['joinUris'] = 1;
        // Список фильтров
        $params = [];
        if ($filterUri) {
            $params['filter'] = $this->thirdUri;
        }
        $filters = $this->myFilters->getListforPsdHtml($params);//echo '<pre>';print_r($filters);echo '</pre>';exit;
        $data['filters'] = $filters;
        $data['filterUri'] = $this->thirdUri;
        // укр
        $pagesContent = $this->myRoot->getPagesContent('ua');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ua', $options);
        $forLayout['PageLangUa'] = $pageUaUrl = $urlProvider->getPsd2html5Url();
        $langMenu['ua'] = [
            'link' => $pageUaUrl,
            'text' => 'Укр'
        ];
        // eng
        $pagesContent = $this->myRoot->getPagesContent('en');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('en', $options);
        $forLayout['PageLangEn'] = $pageEnUrl = $urlProvider->getPsd2html5Url();
        $langMenu['en'] = [
            'link' => $pageEnUrl,
            'text' => 'Eng'
        ];
        // рус
        $pagesContent = $this->myRoot->getPagesContent('ru');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ru', $options);
        $forLayout['PageLangRu'] = $pageRuUrl = $urlProvider->getPsd2html5Url();
        $langMenu['ru'] = [
            'link' => $pageRuUrl,
            'text' => 'Рус'
        ];
        $forLayout['langMenu'] = $langMenu;




        //Добираем статические данные со страницы
        $pageData = $this->myRoot->getPageContentByAlias($this->pageContent['alias'], ['imagepsd2html5bgbig','imagepsd2html5bgsmall','psd2html5mainscreebtitle',
        'psd2html5mainscreebtitle1','psd2html5mainscreebtitle2','psd2html5mainscreebtitle3','psd2html5mainscreebtitle4','psd2html5mainscreebtitle5','psd2html5mainscreebtitle6','psd2html5mainscreebtitle7','worksexamplespsd2html5title'], [], [],[]);
        $data['pageData'] = $pageData;
        $pageData2 = $this->myRoot->getPageContentByAlias('frontendout', ['garantiesbgword','garanties1title','garanties2title'], [], ['garanties1list','garanties2list']);
        $data['pageData1'] = $pageData2;
        $pageData3 = $this->myAdvantagePsdHtml->getAdvantagesFromMultiField(['advantagepsdhmtl5']);
        $data['pageData2'] = $pageData3;


        // Работы отобаржаемые на текстовой странице

        $works = $this->myWorks->getWorksForPsdhtmlPage($this->thirdUri);
        $data['works'] = $works;

        //количество работ в таблице для фронтендаутсорсинг

        $workscount = $this->myWorks->getListCount();
        $data['workscount'] = $workscount;


        // Список ссылок для плашки сссылок в футере
        $links = $this->myWorks->getLinks($this->pageContent['alias']);
        $forLayout['links'] = $links;


        $data = array_merge($this->data, $data);
        $forLayout = array_merge($this->forLayout, $forLayout);//echo '<pre>';print_r($this->forLayout);echo '</pre>';exit;
        return [
            'view' => 'psd2tohtml5',
            'data' => $data,
            'layout' => $this->layout,
            'forLayout' => $forLayout,
        ];
    }


    public function actionJavascript()
    {
        // Если строка запроса содержит uri третьего уровня переход на единицу работы
        if ($this->thirdUri) {
            return $this->actionItem();
        }
        $data = [];
        $forLayout = [];
        $params = [];
        $forLayout['JavascriptPage'] = 1;

        // Языковое меню
        $langMenu = [];
        $options = [];
        $options['joinUris'] = 1;

        // укр
        $pagesContent = $this->myRoot->getPagesContent('ua');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ua', $options);
        $forLayout['PageLangUa'] = $pageUaUrl = $urlProvider->getJavascriptUrl();
        $langMenu['ua'] = [
            'link' => $pageUaUrl,
            'text' => 'Укр'
        ];
        // eng
        $pagesContent = $this->myRoot->getPagesContent('en');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('en', $options);
        $forLayout['PageLangEn'] = $pageEnUrl = $urlProvider->getJavascriptUrl();
        $langMenu['en'] = [
            'link' => $pageEnUrl,
            'text' => 'Eng'
        ];
        // рус
        $pagesContent = $this->myRoot->getPagesContent('ru');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ru', $options);
        $forLayout['PageLangRu'] = $pageRuUrl = $urlProvider->getJavascriptUrl();
        $langMenu['ru'] = [
            'link' => $pageRuUrl,
            'text' => 'Рус'
        ];
        $forLayout['langMenu'] = $langMenu;




        //Добираем статические данные со страницы
        $pageData = $this->myRoot->getPageContentByAlias($this->pageContent['alias'], ['imagejavascript5bgbig','imagejavascriptbgsmall','javascriptmainscreentitle','javascriptmainscreentitle1',
        'javascriptmainscreentitle2','javascriptmainscreentitle3','worksexamplesjavascripttitle'], [], [],[]);
        $data['pageData'] = $pageData;

        $pageData2 = $this->myRoot->getPageContentByAlias('frontendout', ['garantiesbgword','garanties1title','garanties2title'], [], ['garanties1list','garanties2list']);
        $data['pageData1'] = $pageData2;

        $pageData3 = $this->myAdvantageJavascript->getAdvantagesFromMultiField(['advantagejavascript']);
        $data['pageData2'] = $pageData3;


        // Работы отобаржаемые на текстовой странице

        $works = $this->myWorks->getWorksForTextPages($this->pageContent['alias']);
        $data['works'] = $works;

        //количество работ в таблице для фронтендаутсорсинг

        $workscount = $this->myWorks->getListCount();
        $data['workscount'] = $workscount;

        // Список ссылок для плашки сссылок в футере
        $links = $this->myWorks->getLinks($this->pageContent['alias']);
        $forLayout['links'] = $links;

        $data = array_merge($this->data, $data);
        $forLayout = array_merge($this->forLayout, $forLayout);//echo '<pre>';print_r($this->forLayout);echo '</pre>';exit;

        return [
            'view' => 'javascript',
            'data' => $data,
            'layout' => $this->layout,
            'forLayout' => $forLayout,
        ];
    }


    public function actionAngular()
    {

        // Если строка запроса содержит uri третьего уровня переход на единицу работы
        if ($this->thirdUri) {
            return $this->actionItem();
        }

        $data = [];
        $forLayout = [];
        $params = [];
        $forLayout['AngularPage'] = 1;

        // Языковое меню
        $langMenu = [];
        $options = [];
        $options['joinUris'] = 1;

        // укр
        $pagesContent = $this->myRoot->getPagesContent('ua');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ua', $options);
        $forLayout['PageLangUa'] = $pageUaUrl = $urlProvider->getAngularUrl();
        $langMenu['ua'] = [
            'link' => $pageUaUrl,
            'text' => 'Укр'
        ];
        // eng
        $pagesContent = $this->myRoot->getPagesContent('en');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('en', $options);
        $forLayout['PageLangEn'] = $pageEnUrl = $urlProvider->getAngularUrl();
        $langMenu['en'] = [
            'link' => $pageEnUrl,
            'text' => 'Eng'
        ];
        // рус
        $pagesContent = $this->myRoot->getPagesContent('ru');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ru', $options);
        $forLayout['PageLangRu'] = $pageRuUrl = $urlProvider->getAngularUrl();
        $langMenu['ru'] = [
            'link' => $pageRuUrl,
            'text' => 'Рус'
        ];
        $forLayout['langMenu'] = $langMenu;

        //Добираем статические данные со страницы
        $pageData = $this->myRoot->getPageContentByAlias($this->pageContent['alias'], ['imageangularbgbig','imageangularbgsmall','angularmainscreentitle','angularmainscreentitle1','causesAngulartitle','worksexamplesangulartitle'], [], ['causesAngularlist','causesAngularlist1'],[]);
        $data['pageData'] = $pageData;

        $pageData2 = $this->myRoot->getPageContentByAlias('frontendout', ['garantiesbgword','garanties1title','garanties2title'], [], ['garanties1list','garanties2list']);
        $data['pageData1'] = $pageData2;

        // Работы отобаржаемые на текстовой странице

        $works = $this->myWorks->getWorksForTextPages($this->pageContent['alias']);
        $data['works'] = $works;

        //количество работ в таблице для фронтендаутсорсинг

        $workscount = $this->myWorks->getListCount();
        $data['workscount'] = $workscount;



        // Список ссылок для плашки сссылок в футере
        $links = $this->myWorks->getLinks($this->pageContent['alias']);
        $forLayout['links'] = $links;


        $data = array_merge($this->data, $data);
        $forLayout = array_merge($this->forLayout, $forLayout);//echo '<pre>';print_r($this->forLayout);echo '</pre>';exit;
        return [
            'view' => 'angular',
            'data' => $data,
            'layout' => $this->layout,
            'forLayout' => $forLayout,
        ];
    }
    /*Посадочная страница*/
    public function actionGames()
    {
        // Если строка запроса содержит uri третьего уровня переход на единицу работы
        if ($this->thirdUri) {
            return $this->actionItem();
        }

        $data = [];
        $forLayout = [];
        $params = [];
        $forLayout['GamesPage'] = 1;

        // Языковое меню
        $langMenu = [];
        $options = [];
        $options['joinUris'] = 1;

        // укр
        $pagesContent = $this->myRoot->getPagesContent('ua');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ua', $options);
        $forLayout['PageLangUa'] = $pageUaUrl = $urlProvider->getGamesUrl();
        $langMenu['ua'] = [
            'link' => $pageUaUrl,
            'text' => 'Укр'
        ];
        // eng
        $pagesContent = $this->myRoot->getPagesContent('en');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('en', $options);
        $forLayout['PageLangEn'] = $pageEnUrl = $urlProvider->getGamesUrl();
        $langMenu['en'] = [
            'link' => $pageEnUrl,
            'text' => 'Eng'
        ];
        // рус
        $pagesContent = $this->myRoot->getPagesContent('ru');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ru', $options);
        $forLayout['PageLangRu'] = $pageRuUrl = $urlProvider->getGamesUrl();
        $langMenu['ru'] = [
            'link' => $pageRuUrl,
            'text' => 'Рус'
        ];
        $forLayout['langMenu'] = $langMenu;


        //Добираем статические данные со страницы
        $pageData = $this->myRoot->getPageContentByAlias($this->pageContent['alias'], ['imagegamesbgbig','imagegamesbgsmall','gamesmainscreentitle','gamesmainscreentitle1',
            'gamesadvtitle','worksexamplesgamestitle'], [], [],[]);
        $data['pageData'] = $pageData;

        $pageData2 = $this->myRoot->getPageContentByAlias('frontendout', ['garantiesbgword','garanties1title','garanties2title'], [], ['garanties1list','garanties2list']);
        $data['pageData1'] = $pageData2;

        $pageData3 = $this->myAdvantageGames->getAdvantagesFromMultiField(['advantagegames']);
        $data['pageData2'] = $pageData3;


        // Работы отобаржаемые на текстовой странице

        $works = $this->myWorks->getWorksForTextPages($this->pageContent['alias']);
        $data['works'] = $works;

        //количество работ в таблице для фронтендаутсорсинг

        $workscount = $this->myWorks->getListCount();
        $data['workscount'] = $workscount;

        // Список ссылок для плашки сссылок в футере
        $links = $this->myWorks->getLinks($this->pageContent['alias']);
        $forLayout['links'] = $links;


        $data = array_merge($this->data, $data);
        $forLayout = array_merge($this->forLayout, $forLayout);//echo '<pre>';print_r($data);echo '</pre>';exit;

        return [
            'view' => 'games',
            'data' => $data,
            'layout' => $this->layout,
            'forLayout' => $forLayout,
        ];
    }
    /*Посадочная страница*/
    public function actionAnimations()
    {
        // Если строка запроса содержит uri третьего уровня переход на единицу работы
        if ($this->thirdUri) {
            return $this->actionItem();
        }

        $data = [];
        $forLayout = [];
        $params = [];
        $forLayout['GamesPage'] = 1;

        // Языковое меню
        $langMenu = [];
        $options = [];
        $options['joinUris'] = 1;

        // укр
        $pagesContent = $this->myRoot->getPagesContent('ua');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ua', $options);
        $forLayout['PageLangUa'] = $pageUaUrl = $urlProvider->getAnimationsUrl();
        $langMenu['ua'] = [
            'link' => $pageUaUrl,
            'text' => 'Укр'
        ];
        // eng
        $pagesContent = $this->myRoot->getPagesContent('en');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('en', $options);
        $forLayout['PageLangEn'] = $pageEnUrl = $urlProvider->getAnimationsUrl();
        $langMenu['en'] = [
            'link' => $pageEnUrl,
            'text' => 'Eng'
        ];
        // рус
        $pagesContent = $this->myRoot->getPagesContent('ru');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ru', $options);
        $forLayout['PageLangRu'] = $pageRuUrl = $urlProvider->getAnimationsUrl();
        $langMenu['ru'] = [
            'link' => $pageRuUrl,
            'text' => 'Рус'
        ];
        $forLayout['langMenu'] = $langMenu;


        //Добираем статические данные со страницы
        $pageData = $this->myRoot->getPageContentByAlias($this->pageContent['alias'], ['imageanimationsbgbig','imageanimationsbgsmall','animationssmainscreentitle','animationsmainscreentitle1',
            'animationsadvtitle','worksexamplesanimationstitle'], [], [],[]);
        $data['pageData'] = $pageData;

        $pageData2 = $this->myRoot->getPageContentByAlias('frontendout', ['garantiesbgword','garanties1title','garanties2title'], [], ['garanties1list','garanties2list']);
        $data['pageData1'] = $pageData2;

        $pageData3 = $this->myAdvantageAnimations->getAdvantagesFromMultiField(['advantageanimations']);
        $data['pageData2'] = $pageData3;


        // Работы отобаржаемые на текстовой странице

        $works = $this->myWorks->getWorksForTextPages($this->pageContent['alias']);
        $data['works'] = $works;

        //количество работ в таблице для фронтендаутсорсинг

        $workscount = $this->myWorks->getListCount();
        $data['workscount'] = $workscount;

        // Список ссылок для плашки сссылок в футере
        $links = $this->myWorks->getLinks($this->pageContent['alias']);
        $forLayout['links'] = $links;


        $data = array_merge($this->data, $data);
        $forLayout = array_merge($this->forLayout, $forLayout);//echo '<pre>';print_r($data);echo '</pre>';exit;

        return [
            'view' => 'animations',
            'data' => $data,
            'layout' => $this->layout,
            'forLayout' => $forLayout,
        ];
    }

    /**
     * Страница портфолио
     */
    public function actionPortfoliofrontout()
    {
        $urlProvider = new TextPagesUrlProvider($this->lang);
        $Porfoliofrontout = $urlProvider->getPortfolifrontoutUrl();
        if( preg_match_all('/page=1/', Yii::$app->request->absoluteUrl) && empty($this->thirdUri))  {
            header("HTTP/1.1 301 Moved Permanently");
            header("Location:".$Porfoliofrontout);
        }
        // Проверяем является ли uri третьего уровня uri фильтра
        $filterUri = $this->myFilters->isFilterUri($this->thirdUri);

        // Если строка запроса содержит uri третьего уровня и этот uri не равен фильтру,
        // переход на единицу работы

        if ($this->thirdUri && $this->thirdUri != $filterUri) {

            return $this->actionItem();
        }

        $data = [];
        $forLayout = [];
        $forLayout['PortfoliofrontoutPage'] = 1;
        // Список фильтров
        $params = [];
        $filters = $this->myFilters->getList($params);//echo '<pre>';print_r($filters);echo '</pre>';exit;
        $data['filters'] = $filters;
        $data['filterUri'] = $this->thirdUri;
        $pageData = $this->myRoot->getPageContent($this->secondUri);//echo '<pre>';print_r($pageData);echo '</pre>';exit;
        $data['$pageData'] = $pageData;
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
        $works = $this->myWorks->getListForPortfolio($params);//
        $data['works'] = $works;


        //количество работ в таблице для фронтендаутсорсинг

        $workscount = $this->myWorks->getListCount();
        $data['workscount'] = $workscount;



        // Список ссылок для плашки сссылок в футере
        $links = $this->myWorks->getLinks($this->pageContent['alias']);
        $forLayout['links'] = $links;

        $data["portfolioUri"] = $this->secondUri;

        // Языковое меню
        $langMenu = [];
        $options = [];
        $options['joinUris'] = 1;


        // укр
        $pagesContent = $this->myRoot->getPagesContent('ua');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ua', $options);
        $forLayout['PageLangUa'] = $pageUaUrl = $urlProvider->getPortfolifrontoutUrl();
        $langMenu['ua'] = [
            'link' => $pageUaUrl,
            'text' => 'Укр'
        ];

        // eng
        $pagesContent = $this->myRoot->getPagesContent('en');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('en', $options);
        $forLayout['PageLangEn'] = $pageEnUrl = $urlProvider->getPortfolifrontoutUrl();
        $langMenu['en'] = [
            'link' => $pageEnUrl,
            'text' => 'Eng'
        ];
        // рус
        $pagesContent = $this->myRoot->getPagesContent('ru');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ru', $options);
        $forLayout['PageLangRu'] = $pageRuUrl = $urlProvider->getPortfolifrontoutUrl();
        $langMenu['ru'] = [
            'link' => $pageRuUrl,
            'text' => 'Рус'
        ];
       //формируем ссылку для кнопок пагинации для разных языков
       if ($this->lang == 'ru'){
           $urlpage = $pageRuUrl;
       }else if ($this->lang == 'ua'){
           $urlpage = $pageUaUrl;
       } else $urlpage = $pageEnUrl;

        //передаем это значение в класс pagination, создавая новый обьет класса
        $pagination = new Pagination($worksCount, $pageNum, $limit, '?page=', $urlpage,$this->thirdUri);
        $data['pagination'] = $pagination;
        $textPagesUrlProvider = new TextPagesUrlProvider($this->lang);
        //вывод тайла фильтара вместо тайтла страницы портфолио
        foreach ($filters as $filter) {
            $params['item'] = $filter;
            $filterUrl = $textPagesUrlProvider->geteFilterUrl($params);
            $filterActive = ($filter['url'] == $this->thirdUri);
            if ($filterActive)
                $forLayout['pTitle'] =  $filter['pTitle'] .' | '. Yii::t('app', 'Professional front end development') ;

        }
        foreach ($filters as $filter) {
            $params['item'] = $filter;
            $filterUrl = $textPagesUrlProvider->geteFilterUrl($params);
            $filterActive = ($filter['url'] == $this->thirdUri);
            if ($filterActive) {
                $forLayout['pDescription'] = $filter['pTitle'] . '. ' . Yii::t('app', 'Examples of our work');
            }

        }

        $forLayout['langMenu'] = $langMenu;
        $data = array_merge($this->data, $data);
        $forLayout = array_merge($this->forLayout, $forLayout);//echo '<pre>';print_r($forLayout);echo '</pre>';exit;

        return [
            'view' => 'portfoliofrontout',
            'data' => $data,
            'layout' => $this->layout,
            'forLayout' => $forLayout,

        ];

    }

    /**
     * Страница единицы работы
     */
    public function actionItem()
    {
        $data = [];
        $forLayout = [];
        $pUrl = '';
        $forLayout['worksfrontoutPage'] = 1;
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
        $forLayout['PageLangUa'] = $pageUaUrl = $urlProvider->geteWorksFrontOutItemUrl($params);
        $langMenu['ua'] = [
            'link' => $pageUaUrl,
            'text' => 'Укр'
        ];
        // eng
        $urlProvider = new SimpleModuleUrlProvider('en', $params);
        $forLayout['PageLangEn'] = $pageEnUrl = $urlProvider->geteWorksFrontOutItemUrl($params);
        $langMenu['en'] = [
            'link' => $pageEnUrl,
            'text' => 'Eng'
        ];
        // рус
        $urlProvider = new SimpleModuleUrlProvider('ru', $params);
        $forLayout['PageLangRu'] = $pageRuUrl = $urlProvider->geteWorksFrontOutItemUrl($params);
        $langMenu['ru'] = [
            'link' => $pageRuUrl,
            'text' => 'Рус'
        ];
        $forLayout['langMenu'] = $langMenu;
       //Для формирования тайтла выбераем один из пунктов описания работы
        //Рандомный ключ массива списка описания
        $p = (array_rand($pageContent['desclist']));

        //Получаем pTitle для Layout  единцы работы

        if (!empty($data['worksItem']['pH1'])){
            $forLayout['pTitle'] = $data['worksItem']['pH1'].' | '.Yii::t('app', 'Frondevo - front end development').' '.mb_strtolower($pageContent['desclist'][$p]['text']);
}

//для формирования мета дискрипшин полученные двумерный массив преобразовываем в одномерный
        if(!empty($data['worksItem']['desclist'])) {
            foreach ($data['worksItem']['desclist'] as $key => $item) {
                $desclist[$key] = $item['text'];
            }
//преборазовываем одномерный массив в строку
            $descstring = implode(',', $desclist);
            $fulldescstring = Yii::t('app', 'Front end development:') . $descstring;


            $forLayout['pDescription'] = $fulldescstring;
        }
            else
            $forLayout['pDescription'] = Yii::t('app', 'Front end development:');



        $forLayout['pAlias'] = $worksItem['url'];
        // Список ссылок для плашки сссылок в футере
        $links = $this->myWorks->getLinks($this->pageContent['alias']);
        $forLayout['links'] = $links;
        $data = array_merge($this->data, $data);
        $forLayout = array_merge($this->forLayout, $forLayout);$p = (array_rand($pageContent['desclist']));
        return [
            'view' => 'worksfrontoutitem',
            'data' => $data,
            'layout' => $this->layout,
            'forLayout' => $forLayout,
        ];

    }
}