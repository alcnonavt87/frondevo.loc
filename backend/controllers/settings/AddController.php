<?php
namespace backend\controllers\settings;

use Yii;
use yii\filters\AccessControl;
use backend\models\settings\Settings;

/**
 * Add controller
 */

class AddController extends \backend\controllers\AdminController {
        
    public function actionIndex()
    {
        $isAjax = Yii::$app->getRequest()->isAjax;

        if (!$isAjax) {
            throw new BadRequestHttpException();
        } else {
            $id1Uri = Yii::$app->getRequest()->get('id');
            $idSettingsPage = Yii::$app->getRequest()->get('id2');

            $mySettings = new Settings();

            $settingsPageAdminClass = $mySettings->getSettingsPageAdminClass($idSettingsPage);

            if($settingsPageAdminClass) {   
                $controller = Yii::$app->createControllerByID($settingsPageAdminClass.'add');
                echo $controller->runAction('index');
            }
        }
    }
}
