<?php 
namespace backend\controllers\settings;

use Yii;
use backend\models\AdminOthers;
use backend\models\settings\Settings;

/**
 * List controller
 */

class ListController extends \backend\controllers\AdminController
{   
    public function actionIndex()
    {
        $isAjax = Yii::$app->getRequest()->isAjax;
                
        if (!$isAjax) {
            throw new BadRequestHttpException();
        } else {
            
            $id1Uri = Yii::$app->getRequest()->get('id');
            $pageLang = Yii::$app->getRequest()->get('id2');

            $mySettings = new Settings();
            $allSettingsPages = $mySettings->getAllSettingsPages(Yii::$app->user->id, $id1Uri);

            $myOthers = new AdminOthers();
            $pageGroupData = $myOthers->getPageGroupData($id1Uri);

            $content = '';

            if (is_file(Yii::$app->basePath.'/views/pages/SettingsListView.php')) {
                require Yii::$app->basePath.'/views/pages/SettingsListView.php';
            }

            return json_encode(['code' => '0', 'message' => '', 'content' => $content]);
        }
    }
}
