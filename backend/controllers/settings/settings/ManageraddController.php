<?php
namespace backend\controllers\settings\settings;

use Yii;

class ManageraddController extends \backend\controllers\AdminController {
        
    public function actionIndex()
    {
        $isAjax = Yii::$app->getRequest()->isAjax;

        if (!$isAjax) {
            throw new BadRequestHttpException();
        } else {
            $id1Uri = Yii::$app->request->get('id');
            $id2Uri = Yii::$app->request->get('id2');

            $admPanelUri = Yii::$app->homeUrl;
            $defLang = Yii::$app->params['defLang'];

            
            Yii::$app->getRequest()->setUrl($admPanelUri.'formedit/'.$id1Uri.'/'.$id2Uri.'/0/'.$defLang);
            $_GET = ['id'=>$id1Uri, 'id2'=> $id2Uri, 'id3'=> '0', 'id4'=>$defLang];
            
            $controller = Yii::$app->createControllerByID('formedit');
            echo $controller->runAction('index');
        }
    }
}
