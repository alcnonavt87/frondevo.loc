<?php
namespace backend\controllers\settings\settings;

use Yii;
use backend\models\AdminOthers;
use backend\models\settings\settings\Mysettings;
use backend\models\text\pages\Index;

/**
 * Mysettings controller
 */

class MysettingsController extends \backend\controllers\AdminController {

    public function actionIndex()
    {
        $isAjax = Yii::$app->getRequest()->isAjax;

        if (!$isAjax) {
            throw new BadRequestHttpException();
        } else {
            $id1Uri = Yii::$app->getRequest()->get('id');
            $settingsPageUri = $idPage = Yii::$app->getRequest()->get('id2');
            $pageLang = Yii::$app->getRequest()->get('id3');

            $mySettings = new Mysettings();
            $myTextPage = new Index();

            $admPanelUri = Yii::$app->homeUrl;
            $defLang = Yii::$app->params['defLang'];

            //Навигационное меню
            $langs = $myTextPage->getAllLangs();

            //Хлебные крошки
            $myOthers = new AdminOthers();
            $pageGroupData = $myOthers->getPageGroupData($id1Uri);
            $settingsPageName = $myOthers->getSettingsPageName($settingsPageUri);

            $mySettings = $mySettings->getSettings($pageLang);//echo '<pre>';print_r($mySettings);echo '</pre>';exit;

            $content = '';
            $navMenu = '';

            if (is_file(Yii::$app->basePath.'/views/pages/settings/MysettingsListView.php')) {
                require Yii::$app->basePath.'/views/pages/settings/MysettingsListView.php';
            }

            return json_encode(['code' => '0', 'message' => '', 'content' => $content, 'navMenu' => $navMenu]);
        }
    }
}
