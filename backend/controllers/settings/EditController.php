<?php 
namespace backend\controllers\settings;

use Yii;
use backend\models\settings\Settings;

/**
 * Edit controller
 */
class EditController extends \backend\controllers\AdminController
{    
    public function actionIndex()
    {
        $isAjax = Yii::$app->getRequest()->isAjax;
                
        if (!$isAjax) {
            throw new BadRequestHttpException();
        } else {
            $id1Uri = Yii::$app->getRequest()->get('id');
            $idSettingsPage = Yii::$app->getRequest()->get('id2');
            $pageLang = Yii::$app->getRequest()->get('id3');

            $mySettings = new Settings();

            $settingsPageAdminClass = $mySettings->getSettingsPageAdminClass($idSettingsPage);

            if($settingsPageAdminClass) {   
                $controller = Yii::$app->createControllerByID($settingsPageAdminClass);
                echo $controller->runAction('index');
            }
        }
    }
}
