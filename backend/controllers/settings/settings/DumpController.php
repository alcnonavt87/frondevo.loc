<?php 
namespace backend\controllers\settings\settings;

use Yii;
use backend\models\AdminOthers;
use backend\models\settings\settings\Dump;

/**
 * Dump controller
 */
class DumpController extends \backend\controllers\AdminController
{
            
    public function actionIndex()
    {
        $isAjax = Yii::$app->getRequest()->isAjax;

        if (!$isAjax) {
            throw new BadRequestHttpException();
        } else {   
            $id1Uri = Yii::$app->getRequest()->get('id');
            $settingsPageUri = Yii::$app->getRequest()->get('id2');
            $pageLang = Yii::$app->getRequest()->get('id3');

            $hostName = Yii::$app->params['hostName'];
            $admPanelUri = Yii::$app->homeUrl;
            $nameDB = Yii::$app->params['nameDB'];

            $myDump = new Dump();
            $allTablesData = $myDump->getAllTablesData($nameDB);

            $myOthers = new AdminOthers();
            $pageGroupData = $myOthers->getPageGroupData($id1Uri);
            $settingsPageName = $myOthers->getSettingsPageName($settingsPageUri);

            $content = '';
            
            if (is_file(Yii::$app->basePath.'/views/pages/settings/DumpView.php')) {
                require Yii::$app->basePath.'/views/pages/settings/DumpView.php';
            }

            return json_encode(['code' => '0', 'message' => '', 'content' => $content]);
        }
    }

    public function actionDump()
    {               
        $myDump = new Dump();
        
        $myDump->getNewDump();
    }

    public function actionStat()
    {
        $startDump = Yii::$app->session->get('startDump',FALSE);
        if(!$startDump) {
            $answer = [];
            $answer['siseAll'] = Yii::$app->session->get('siseAll',0);
            $answer['tableName'] = Yii::$app->session->get('tableName',0);
            $answer['processed'] = Yii::$app->session->get('processed',0) + Yii::$app->session->get('sumDeltaSize',0);
            $answer['precent'] = Yii::$app->session->get('precent',0);
            $answer['name'] = Yii::$app->session->name;
            $answer['id'] = Yii::$app->session->id;

            echo json_encode($answer);
        } else {
            $answer = [];
            $answer['siseAll'] = 0;
            $answer['tableName'] = 0;
            $answer['processed'] = 0;
            $answer['precent'] = 0;
            $answer['name'] = Yii::$app->session->name;
            $answer['id'] = Yii::$app->session->id;

            echo json_encode($answer);
        }
    }

    public function actionDel()
    {
        Yii::$app->session->remove('siseAll');        //сумма размеров всех таблиц
        Yii::$app->session->remove('tableName');      //имя текущей талицы
        Yii::$app->session->remove('processed');      //сумма размеров обработанных таблиц
        Yii::$app->session->remove('precent');        //процент обработанного дампа
        Yii::$app->session->remove('sumDeltaSize');   //сумма размеров частей таблицы которая находится в обработке
        Yii::$app->session->remove('iterations');     //Приблизительное колличество иттераций по текуцей таблице
        Yii::$app->session->remove('deltaSize');      //размер одной части обрабатываемой таблицы
        Yii::$app->session->remove('tableSize');      //размер текущей таблицы
        Yii::$app->session->remove('startDump');      //Скрипт дампа запущен на выполнение 
    }
}