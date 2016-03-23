<?php
namespace backend\controllers\settings\settings;

use Yii;
use backend\models\AdminOthers;
use backend\models\settings\settings\Manager;


/**
 * Manager controller
 */

class ManagerController extends \backend\controllers\AdminController {
        
    public function actionIndex()
    {
        $isAjax = Yii::$app->request->isAjax;

        if(!$isAjax) {
            throw new BadRequestHttpException();
        } else {   
            $id1Uri = Yii::$app->request->get('id');
            $settingsPageUri = Yii::$app->request->get('id2');
            $idManager = Yii::$app->request->get('id3');
            $pageLang = Yii::$app->request->get('id4');

            $admPanelUri = Yii::$app->homeUrl;
            $defLang = Yii::$app->params['defLang'];

            $myManager = new Manager();

            if(!isset($pageLang)) {
                $managers = $myManager->getAllManagers();

                //Хлебные крошки
                $myOthers = new AdminOthers();
                $pageGroupData = $myOthers->getPageGroupData($id1Uri);
                $settingsPageName = $myOthers->getSettingsPageName($settingsPageUri);

                $content = '';

                if (is_file(Yii::$app->basePath.'/views/pages/settings/ManagerView.php')) {
                    require Yii::$app->basePath.'/views/pages/settings/ManagerView.php';
                }
                
                return json_encode(['code' => '0', 'message' => 'ManagerController mit LANG', 'content' => $content]);
            } else {
                $manager = $myManager->getManager($idManager);
                if(!count($manager))
                {
                    $manager[0]['id'] = 0;
                    $manager[0]['email'] = "";
                    $manager[0]['username'] = "";
                    $manager[0]['name'] = "";
                    $manager[0]['surname'] = "";

                    $managerUserName = 'Новый менеджер';
                } else {
                     $managerUserName = $manager[0]['username'];
                }

                //Хлебные крошки
                $myOthers = new AdminOthers();
                $pageGroupData = $myOthers->getPageGroupData($id1Uri);
                $settingsPageName = $myOthers->getSettingsPageName($settingsPageUri);

                //Формирование списка доступа в группам страниц
                $accessList = $myManager->getManagerAccessList($manager[0]['id']);

                $content = '';
                $navMenu = '';

                if (is_file(Yii::$app->basePath.'/views/pages/settings/ManagerView.php')) {
                    require Yii::$app->basePath.'/views/pages/settings/ManagerView.php';
                }

                return json_encode(['code' => '0', 'message' => 'ManagerController ohne LANG', 'content' => $content, 'navMenu' => $navMenu]);
            }
        }
    }
}
