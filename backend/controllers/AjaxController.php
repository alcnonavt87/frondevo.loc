<?php
namespace backend\controllers;

use Yii;

/**
 * Ajax controller
 */
class AjaxController extends AdminController {
    
    public function actionIndex() {
        throw new BadRequestHttpException();
    }
    
    public function actionTextpages() {
        $isAjax = Yii::$app->getRequest()->isAjax;
        if (!$isAjax) {
            throw new BadRequestHttpException();
        } else {
            $myForm = new \backend\models\text\Text();
            $httpMethod = Yii::$app->getRequest()->method;
            
            switch ($httpMethod) {
                case 'PUT':
                    $put = Yii::$app->getRequest()->bodyParams;
                    $countPut = count($put);
                    if($countPut) {
                        $id = explode("/", $put['id']);
                        $put['id'] = $id[0];
                        $updatedRecordsCount = $myForm->upDateProperty($put['id'], $put['name'], $put['value']);
                        
                        if($updatedRecordsCount) {
                            $json_data = json_encode(['code' => '0', 'message' => 'Запись обновлена успешно']);
                        } else {
                            $json_data = json_encode(['code' => '0', 'message' => 'Запись не обновлена']);
                        }
                        
                        echo $json_data;
                    }
                    break;
            }
        }
    }
    
    public function actionWorks() {
        $isAjax = Yii::$app->getRequest()->isAjax;
        if (!$isAjax) {
            throw new BadRequestHttpException();
        } else {
            $myForm = new \backend\models\works\Works();
            $httpMethod = Yii::$app->getRequest()->method;
            
            switch ($httpMethod) {
                case 'PUT':
                    $put = Yii::$app->getRequest()->bodyParams;
                    $countPut = count($put);
                    if($countPut) {
                        $id = explode("/", $put['id']);
                        $put['id'] = $id[0];
                        $updatedRecordsCount = $myForm->upDateProperty($put['id'], $put['name'], $put['value']);
                        
                        if($updatedRecordsCount) {
                            $json_data = json_encode(['code' => '0', 'message' => 'Запись обновлена успешно']);
                        } else {
                            $json_data = json_encode(['code' => '0', 'message' => 'Запись не обновлена']);
                        }
                        
                        echo $json_data;
                    }
                    break;
            }
        }
    }
}
