<?php
namespace backend\controllers\settings\settings;

use Yii;
use backend\models\settings\settings\Manager;

class ManagerdelController extends \backend\controllers\AdminController {
        
    public function actionIndex()
    {
        $isAjax = Yii::$app->getRequest()->isAjax;

        if (!$isAjax) {
            throw new BadRequestHttpException();
        } else {
            $idManager = Yii::$app->request->get('id3');

            $myManager = new Manager();

            $rowDelCount = $myManager->delManager($idManager);                

            if($rowDelCount) {
                $json_data = json_encode(['code' => '0', 'message' => 'Запись успешно удалена']);
            } else {
                $json_data = json_encode(['code' => '01304', 'message' => 'Ошибка удаления записи из базы данных']);
            }

            // отправляем ответ
            echo $json_data;
        }
    }
}
