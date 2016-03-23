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
            $menuList = [];
            $quickButtons = '';
            $count = count($menu);
            for ($i = 0; $i < $count; $i++) {
                $toHide = [];
                if (in_array($menu[$i]['groupName'], $toHide)) continue;

                if($menu[$i]['addParam']) {
                    array_push($menuList, 
                        '<li class="sidebar-menu__item sidebar-menu__item-'.$menu[$i]['cssKlass'].'"><a data-href="formlist" href="/'.$menu[$i]['id'].'/'.$defLang.'" title="'.$menu[$i]['groupName'].'">'.$menu[$i]['groupName'].' <span class="menu__count">5</span></a></li>');
                } else {
                    $withoutLang = [];
                    if (in_array($menu[$i]['groupName'], $withoutLang)) {
                        array_push($menuList,
                            '<li class="sidebar-menu__item sidebar-menu__item-'.$menu[$i]['cssKlass'].'"><a data-href="formlist" href="/'.$menu[$i]['id'].'" title="'.$menu[$i]['groupName'].'">'.$menu[$i]['groupName'].' </a></li>');
                    } else {
                        array_push($menuList, 
                            '<li class="sidebar-menu__item sidebar-menu__item-'.$menu[$i]['cssKlass'].'"><a data-href="formlist" href="/'.$menu[$i]['id'].'/'.$defLang.'" title="'.$menu[$i]['groupName'].'">'.$menu[$i]['groupName'].' </a></li>');
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
