<?php
namespace frontend\controllers;
use frontend\models\Root;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use Yii\helpers\ArrayHelper;
use frontend\models\Works;
use frontend\models\AdvantagesPsdHtml;
use frontend\models\AdvantagesJavascript;
use frontend\models\AdvantagesAnimations;
use frontend\models\AdvantagesGames;
use frontend\models\Filters;
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
        $this->myWorks = new Works($this->lang);
        $this->myFilters = new Filters($this->lang);
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
            // Функция для преобразования alias страницы в нужный action
            $action1 = explode("-", $pageData['alias']);
            $action2 = implode(" ", $action1);
            $action3 = ucwords($action2);
            $action4 = str_replace(" ", "", $action3);

            $action5 = 'action' . $action4;

            return $this->$action5();

        }
        $pageData = $this->myRoot->getPageContent($this->firstUri);
        // Функция для преобразования alias страницы в нужный action
        $action1 = explode("-", $pageData['alias']);
        $action2 = implode(" ", $action1);
        $action3 = ucwords($action2);
        $action4 = str_replace(" ", "", $action3);
        $action5 = 'action' . $action4;
        return $this->$action5();
    }


    public function actionOutsourcing()
    {
        $data = [];
        $forLayout = [];
        $params = [];
        $forLayout['outsourcingPage'] = 1;
        // Языковое меню
        $langMenu = [];
        $options = [];
        $options['joinUris'] = 1;

        // укр
        $pagesContent = $this->myRoot->getPagesContent('ua');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ua', $options);
        $forLayout['PageLangUa'] = $pageUaUrl = $urlProvider->getOutsourcingUrl();
        $langMenu['ua'] = [
            'link' => $pageUaUrl,
            'text' => 'Укр'
        ];
        // eng
        $pagesContent = $this->myRoot->getPagesContent('en');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('en', $options);
        $forLayout['PageLangEn'] = $pageEnUrl = $urlProvider->getOutsourcingUrl();
        $langMenu['en'] = [
            'link' => $pageEnUrl,
            'text' => 'Eng'
        ];
        // рус
        $pagesContent = $this->myRoot->getPagesContent('ru');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ru', $options);
        $forLayout['PageLangRu'] = $pageRuUrl = $urlProvider->getOutsourcingUrl();
        $langMenu['ru'] = [
            'link' => $pageRuUrl,
            'text' => 'Рус'
        ];
        $forLayout['langMenu'] = $langMenu;
        // Список ссылок для плашки сссылок в футере
        $links = $this->myWorks->getLinks($this->pageContent['alias']);
        $forLayout['links'] = $links;

        // Добираем статические данные страницы

        //Добираем статические данные со страницы
        $pageData = $this->myRoot->getPageContent($this->firstUri);
        $data['pageData'] = $pageData;
        $pageData2 = $this->myRoot->getPageContentByAlias($this->pageContent['alias'], [
            'sbkdescription', 'textforbackground', 'section1', 'section2', 'sbkworkstext', 'section3', 'sbksmalltitle3', 'sbktitlestep1', 'sbkdeskstep1', 'sbktitlestep2', 'sbkdeskstep2',
            'sbktitlestep3', 'sbkdeskstep3', 'sbktitlestep4', 'sbkdeskstep4', 'sbktitlestep5', 'sbkdeskstep5', 'sbktitlestep6', 'sbkdeskstep6', 'sbktitlestep7', 'sbkdeskstep7', 'section4',
            'sbksmalltitle', 'sbkstagetitle1', 'sbkstagetitle2', 'sbkstagetitle3', 'sbkstagetitle4', 'sbkstagetitle5', 'sbkstagetitle6', 'section5', 'imagebgsbk', 'imagebgsbklp', 'imagebgsbkmb'
        ], [], ['sbkstagelist1', 'sbkstagelist2', 'sbkstagelist3', 'sbkstagelist4', 'sbkstagelist5', 'sbkstagelist6', 'sbkpslist']);
        $data['pageData1'] = $pageData2;
        // Работы отобаржаемые на текстовой странице
        // Работы отобаржаемые на текстовой странице
        $works = $this->myWorks->getListForSitesByKeys($this->pageContent['alias']);//echo '<pre>';print_r($data);echo '</pre>';exit;
        $works2 = $this->myWorks->getWorksForSitesByKeys();
        $data['works'] = $works;
        $data['works2'] = $works2;

        $data = array_merge($this->data, $data);
        $forLayout = array_merge($this->forLayout, $forLayout);//echo '<pre>';print_r($this->forLayout);echo '</pre>';exit;

        return [
            'view' => 'frontendout',
            'data' => $data,
            'layout' => $this->layout,
            'forLayout' => $forLayout,
        ];
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
            'titlesmallfrontout','linkvideobgfrnout','titlesmallfrontout2','imagefrontoutbgbig','imagefrontoutbgsmall','frndoutsect2title','frndoutsect2data','frndoutsect3title',
        'othervariantstitle','othervariants1title','othervariants1text','othervariants2title','othervariants2text','frontendoutworkstitle','ourcompaniestitle','garantiesbgword','garanties1title','garanties2title'], [], ['ourclientslist','garanties1list','garanties2list'],['imageourclientslogo','imageourcompanieslogo']);
        $data['pageData1'] = $pageData2;
        // Работы отобаржаемые на текстовой странице
        // Работы отобаржаемые на текстовой странице

        $works = $this->myWorks->getWorksForFrontendOut($this->pageContent['alias']);//echo '<pre>';print_r($works);echo '</pre>';exit;

        $data['works'] = $works;


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
        $data = [];
        $forLayout = [];
        $params = [];
        $forLayout['Psd2html5Page'] = 1;
        // Языковое меню
        $langMenu = [];
        $options = [];
        $options['joinUris'] = 1;

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
        $works = $this->myWorks->getWorksForFrontendOut($this->pageContent['alias']);//echo '<pre>';print_r($works);echo '</pre>';exit;

        $data['works'] = $works;


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

        $works = $this->myWorks->getWorksForFrontendOut($this->pageContent['alias']);//echo '<pre>';print_r($works);echo '</pre>';exit;

        $data['works'] = $works;


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
        // Работы отобаржаемые на текстовой странице

        $works = $this->myWorks->getWorksForFrontendOut($this->pageContent['alias']);//echo '<pre>';print_r($pageData);echo '</pre>';exit;

        $data['works'] = $works;


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
        $works = $this->myWorks->getWorksForFrontendOut($this->pageContent['alias']);//echo '<pre>';print_r($works);echo '</pre>';exit;
        $data['works'] = $works;
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
        $works = $this->myWorks->getWorksForFrontendOut($this->pageContent['alias']);//echo '<pre>';print_r($works);echo '</pre>';exit;
        $data['works'] = $works;
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
       //формируем ссылку для кнопок пагинации для разные языков
       if ($this->lang == 'ru'){
           $urlpage = $pageRuUrl;
       }else if ($this->lang == 'ua'){
           $urlpage = $pageUaUrl;
       } else $urlpage = $pageEnUrl;
        //передаем это значение в класс pagination, создавая новый обьет класса
        $pagination = new Pagination($worksCount, $pageNum, $limit, '?page=', $urlpage);
        $data['pagination'] = $pagination;


        $textPagesUrlProvider = new TextPagesUrlProvider($this->lang);
        //вывод тайла фильтара вместо тайтла страницы портфолио
        foreach ($filters as $filter) {
            $params['item'] = $filter;
            $filterUrl = $textPagesUrlProvider->geteFilterUrl($params);
            $filterActive = ($filter['url'] == $this->thirdUri);//echo '<pre>';print_r($filterUri);echo '</pre>';
            if ($filterActive)
                $forLayout['pTitle'] =  $filter['title'] .' - '. Yii::t('app', 'internet-agency Frondevo') ;
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
        $forLayout['workPage'] = 1;
        $params = [];

        // Информация из таблицы множественных полей
        $data['multifields'] = $this->myWorks->getWorksContentFromMultiField($this->thirdUri, ['resultlist1']);//echo '<pre>';print_r($worksItem);echo '</pre>';exit;
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
        $forLayout['PageLangUa'] = $pageUaUrl = $urlProvider->geteWorksItemUrl($params);
        $langMenu['ua'] = [
            'link' => $pageUaUrl,
            'text' => 'Укр'
        ];
        // eng
        $urlProvider = new SimpleModuleUrlProvider('en', $params);
        $forLayout['PageLangEn'] = $pageEnUrl = $urlProvider->geteWorksItemUrl($params);
        $langMenu['en'] = [
            'link' => $pageEnUrl,
            'text' => 'Eng'
        ];
        // рус
        $urlProvider = new SimpleModuleUrlProvider('ru', $params);
        $forLayout['PageLangRu'] = $pageRuUrl = $urlProvider->geteWorksItemUrl($params);
        $langMenu['ru'] = [
            'link' => $pageRuUrl,
            'text' => 'Рус'
        ];
        $forLayout['langMenu'] = $langMenu;
        //Получаем pTitle для Layout  единцы работы
        $forLayout['pTitle'] = $data['worksItem']['pTitle'];


        //Сниппеты для кнопки на странице работ
        $workBtn = $worksItem['linkwork'];
        $workLink = 'http://' . $worksItem['linkwork'];
        $search[] = '//workBtn//';
        $search[] = '//workLink//';
        $replace[] = $workBtn;
        $replace[] = $workLink;
        $worksItem['solutions'] = str_replace($search, $replace, $worksItem['solutions']);
        $search = [];
        $replace = [];

        // Функция для загрузки изображений с фреймом на странице работы
        //$worksItem['solutions'] строка основного содержимого секции из базы данных
        $pattern = '/<img src=.*?\/>/';//шаблон для нахождения всеx елементов  img в $worksItem['solutions']
        $matched = preg_match_all($pattern, $worksItem['solutions'], $matches);//echo '<pre>';print_r($matches1);echo '</pre>';exit;
        foreach ($matches as $match) {// перебираем массив что бы отделить каждый img по отдельности
            foreach ($match as $pic) {
                if (preg_match('/alt=""/', $pic)) {//если alt img пустой то берем весь img из  $worksItem['solutions'и заменяем его на наш $pattern
                    $pattern = '<div class="align-center">' . $pic . '</div>';
                    $worksItem['solutions'] = str_replace($pic, $pattern, $worksItem['solutions']);
                } else if (preg_match('/alt=".*?"/', $pic)) {//если alt img не пустой то берем весь img из  $worksItem['solutions'и заменяем его на другой $pattern
                    $pattern = '/alt="(.*?)"/';
                    $matched = preg_match_all($pattern, $pic, $matches);//print_r ($matches[1]);exit();
                    foreach ($matches[1] as $url) {
                        $pattern1 = "<div class=\"image-frame\">
                                <div>

                                    <!-- frame controls -->
                                    <div class=\"frame-controls\">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <!--/frame controls -->

                                    <div class=\"frame-input\">" . "http://" . $url . "</div>
                                    <div class=\"frame-face-input\"></div>

                               </div>" . $pic . "</div>";

                        $worksItem['solutions'] = str_replace($pic, $pattern1, $worksItem['solutions']);
                    }
                }
            }
        }


        $data['worksItem'] = $worksItem;
        //Получаем pTitle для Layout  единцы работы
        $forLayout['pTitle'] = $data['worksItem']['pTitle'];
        $forLayout['pDescription'] = $data['worksItem']['pDescription'];

        $forLayout['pAlias'] = $worksItem['url'];
        // Список ссылок для плашки сссылок в футере
        $links = $this->myWorks->getLinks($this->pageContent['alias']);
        $forLayout['links'] = $links;
        $data = array_merge($this->data, $data);
        $forLayout = array_merge($this->forLayout, $forLayout); //echo '<pre>';print_r($data);echo '</pre>';exit;

        return [
            'view' => 'worksItem',
            'data' => $data,
            'layout' => $this->layout,
            'forLayout' => $forLayout,
        ];
    }
}