<?php 
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use backend\models\AdminMenu;

/**
 * Edit controller
 */
class EditController extends Controller
{
    public $layout = 'basic';
    public $quickButtons = '';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            if(Yii::$app->getUser()->getIdentity()->role < 50){
                                return TRUE;
                            }
                            Yii::$app->user->logout();
                            return $this->goHome();
                        }
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        $defLang = Yii::$app->params['defLang'];
        
        $myAdminMenu = new AdminMenu();

        $firstUri = Yii::$app->getRequest()->get('id');
        if ($firstUri) {
            throw new BadRequestHttpException();
        } else {
            $menu = $myAdminMenu->getPageGroup(Yii::$app->user->id);

			// Добавляем необходимые пункты вручную
			// Главная страница
			$menuItem = [];
			$menuItem['id'] = 1;
			$menuItem['secondUri'] = 1;
			$menuItem['groupName'] = 'Главная';
			$menuItem['cssKlass'] = 'home';
			$menuItem['addParam'] = 0;
			$menuItem['quickButton'] = 0;
			$menuItem['picking'] = 10;
			$menu[] = $menuItem;
			// страница Коммерческое
			$menuItem = [];
			$menuItem['id'] = 1;
			$menuItem['secondUri'] = 4;
			$menuItem['groupName'] = 'Коммерческое';
			$menuItem['cssKlass'] = 'suitcase';
			$menuItem['addParam'] = 0;
			$menuItem['quickButton'] = 0;
			$menuItem['picking'] = 50;
			$menu[] = $menuItem;
			// страница Контакты
			$menuItem = [];
			$menuItem['id'] = 1;
			$menuItem['secondUri'] = 5;
			$menuItem['groupName'] = 'Контакты';
			$menuItem['cssKlass'] = 'map-marker';
			$menuItem['addParam'] = 0;
			$menuItem['quickButton'] = 0;
			$menuItem['picking'] = 60;
			$menu[] = $menuItem;



            $menuItem = [];
            $menuItem['id'] = 7;
            $menuItem['groupName'] = 'Ссылки для подвала';
            $menuItem['cssKlass'] = 'link';
            $menuItem['addParam'] = 0;
            $menuItem['quickButton'] = 0;
            $menuItem['picking'] = 305;
            $menu[] = $menuItem;



            // Еще раз сортируем (с учетом добавленных вручную пунктов)
			usort($menu, function ($a, $b) {
				return ($a['picking'] < $b['picking']) ? -1 : 1;
			});//echo '<pre>';print_r($menu);echo '</pre>';exit;

            $menuList = [];
            $quickButtons = '';
            $count = count($menu);
            for ($i = 0; $i < $count; $i++) {
                //$toHide = [];
                //if (in_array($menu[$i]['groupName'], $toHide)) continue;

				// Вероятный добавочный uri, а также тип страницы перехода (списочная, редактирования)
				// (для добавленных вручную пунктов)
                $secondUri = isset($menu[$i]['secondUri']) ? '/'.$menu[$i]['secondUri'] : '';
                $dataHref = isset($menu[$i]['secondUri']) ? 'formedit' : 'formlist';

                if($menu[$i]['addParam']) {
                    array_push($menuList,
                        '<li class="sidebar-menu__item"><i class="fa fa-'.$menu[$i]['cssKlass'].'"></i><a data-href="formlist" href="/'.$menu[$i]['id'].'/'.$defLang.'" title="'.$menu[$i]['groupName'].'">'.$menu[$i]['groupName'].' <span class="menu__count">5</span></a></li>');
                } else {
                    $withoutLang = [];
                    if (in_array($menu[$i]['groupName'], $withoutLang)) {
                        array_push($menuList,
                            '<li class="sidebar-menu__item"><i class="fa fa-'.$menu[$i]['cssKlass'].'"></i><a data-href="formlist" href="/'.$menu[$i]['id'].'" title="'.$menu[$i]['groupName'].'">'.$menu[$i]['groupName'].' </a></li>');
                    } else {
                        array_push($menuList,
                            '<li class="sidebar-menu__item"><i class="fa fa-'.$menu[$i]['cssKlass'].'"></i><a data-href="'.$dataHref.'" href="/'.$menu[$i]['id'].$secondUri.'/'.$defLang.'" title="'.$menu[$i]['groupName'].'">'.$menu[$i]['groupName'].' </a></li>');
                    }
                }
                
                if($menu[$i]['quickButton']) {
                    $quickButtons .= '<li class="content__menu-item content__menu-item_'.$menu[$i]['cssKlass'].'"><a href="/'.$menu[$i]['id'].'/'.$defLang.'" data-href="formlist">'.$menu[$i]['groupName'].'</a></li>';
                }
            }                        
            
            $data['menu'] = $menuList;
            $data['quickButtons'] = $quickButtons;
            
            $this->quickButtons = $quickButtons;
            
            return $this->render('edit', $data);
        }
    }
}
