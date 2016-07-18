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
            $pageData = $this->myRoot->getPageContent($this->secondUri);
            if ($pageData ['alias'] == 'portfolio'){
                return $this->actionInner();
            }
            $controller = Yii::$app->createControllerByID('error');
            return $controller->runAction('404');
        }
        $pageData = $this->myRoot->getPageContent($this->firstUri);//echo '<pre>';print_r($pageData);echo '</pre>';exit;
        // Функция для преобразования alias страницы в нужный action
        $action1 = explode("-", $pageData['alias']);
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
        $forLayout['sitesbykeysPage'] = 1;
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
        $forLayout['PageLangUa'] = $pageUaUrl = $urlProvider->getSitesByKeysUrl();
        $langMenu['ua'] = [
            'link' => $pageUaUrl,
            'text' => 'Укр'
        ];
        // eng
        $pagesContent = $this->myRoot->getPagesContent('en');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('en', $options);
        $forLayout['PageLangEn'] = $pageEnUrl = $urlProvider->getSitesByKeysUrl();
        $langMenu['en'] = [
            'link' => $pageEnUrl,
            'text' => 'Eng'
        ];
        // рус
        $pagesContent = $this->myRoot->getPagesContent('ru');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ru', $options);
        $forLayout['PageLangRu'] = $pageRuUrl = $urlProvider->getSitesByKeysUrl();
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
        return [
            'view' => 'sitesbykeys',
            'data' => $data,
            'layout' => $this->layout,
            'forLayout' => $forLayout,
        ];
    }
    /*Посадочная страница*/
    public function actionLandingPage()
    {
        $data = [];
        $forLayout = [];
        $params = [];
        $data = array_merge($this->data, $data);
        $forLayout = array_merge($this->forLayout, $forLayout);//echo '<pre>';print_r($data);echo '</pre>';exit;
        // Языковое меню
        $langMenu = [];

        $options = [];
        $options['joinUris'] = 1;

        // укр
        $pagesContent = $this->myRoot->getPagesContent('ua');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ua', $options);
        $forLayout['PageLangUa'] = $pageUaUrl = $urlProvider->getLandingpageUrl();
        $langMenu['ua'] = [
            'link' => $pageUaUrl,
            'text' => 'Укр'
        ];
        // eng
        $pagesContent = $this->myRoot->getPagesContent('en');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('en', $options);
        $forLayout['PageLangEn'] = $pageEnUrl = $urlProvider->getLandingpageUrl();
        $langMenu['en'] = [
            'link' => $pageEnUrl,
            'text' => 'Eng'
        ];
        // рус
        $pagesContent = $this->myRoot->getPagesContent('ru');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ru', $options);
        $forLayout['PageLangRu'] = $pageRuUrl = $urlProvider->getLandingpageUrl();
        $langMenu['ru'] = [
            'link' => $pageRuUrl,
            'text' => 'Рус'
        ];
        $forLayout['langMenu'] = $langMenu;
        // Добираем статические данные страницы

        $pageData = $this->myRoot->getPageContentByAlias($this->pageContent['alias'], [

        ], []);
        // Список ссылок для плашки сссылок в футере
        $links = $this->myWorks->getLinks($this->pageContent['alias']);
        $forLayout['links'] = $links;
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
        $forLayout['portfolioPage'] = 1;
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
        $forLayout['PageLangUa'] = $pageUaUrl = $urlProvider->getPortfolioUrl();
        $langMenu['ua'] = [
            'link' => $pageUaUrl,
            'text' => 'Укр'
        ];

        // eng
        $pagesContent = $this->myRoot->getPagesContent('en');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('en', $options);
        $forLayout['PageLangEn'] = $pageEnUrl = $urlProvider->getPortfolioUrl();
        $langMenu['en'] = [
            'link' => $pageEnUrl,
            'text' => 'Eng'
        ];
        // рус
        $pagesContent = $this->myRoot->getPagesContent('ru');
        $options['items'] = $pagesContent;
        $urlProvider = new TextPagesUrlProvider('ru', $options);
        $forLayout['PageLangRu'] = $pageRuUrl = $urlProvider->getPortfolioUrl();
        $langMenu['ru'] = [
            'link' => $pageRuUrl,
            'text' => 'Рус'
        ];

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
        $forLayout = array_merge($this->forLayout, $forLayout);//echo '<pre>';print_r($data);echo '</pre>';exit;

        return [
            'view' => 'portfolio',
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

                                    <div class=\"frame-input\">" ."http://". $url . "</div>
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
        $forLayout['pAlias'] =$worksItem['url'];

        // Список ссылок для плашки сссылок в футере
        $links = $this->myWorks->getLinksItem($worksItem['id']);
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
