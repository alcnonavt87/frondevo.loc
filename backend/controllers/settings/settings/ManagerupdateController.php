<?php
namespace backend\controllers\settings\settings;

use Yii;
use backend\models\settings\settings\Manager;

class ManagerupdateController extends \backend\controllers\AdminController {
        
    public function actionIndex()
    {
        $isAjax = Yii::$app->getRequest()->isAjax;

        if (!$isAjax) {
            throw new BadRequestHttpException();
        } else {
            $id1Uri = Yii::$app->getRequest()->get('id');
            $id2Uri = Yii::$app->getRequest()->get('id2');
            $idManager = Yii::$app->getRequest()->get('id3', 0);

            $email = Yii::$app->getRequest()->post('email', '');
            $name = Yii::$app->getRequest()->post('name', '');
            $surname = Yii::$app->getRequest()->post('surname', '');
            $userName = Yii::$app->getRequest()->post('username', '');
            $accessList = Yii::$app->getRequest()->post('accessList', []);

            $myManager = new Manager();
            $emailCount = $myManager->getEmalCount($idManager, $email);

            if($idManager == 0 AND $emailCount > 0) {
                //Если новый менеджер
                $json_data = json_encode(['code' => '01301', 'message' => 'Не допустимый email']);
                return $json_data;
            }
            if($idManager <> 0 AND $emailCount > 1) {
                //Если запись существуюет
                $json_data = json_encode(['code' => '01301', 'message' => 'Не допустимый email']);
                return $json_data;
            }

            $userNameCount = $myManager->getUserNameCount($idManager, $userName);

            if($idManager == 0 AND $userNameCount > 0) {
                //Если новый менеджер
                $json_data = json_encode(['code' => '01302', 'message' => 'Не допустимое имя пользователя']);
                return $json_data;
            }
            if($idManager <> 0 AND $userNameCount > 1) {
                //Если запись существуюет
                $json_data = json_encode(['code' => '01302', 'message' => 'Не допустимое имя пользователя']);
                return $json_data;
            }

            if($idManager) {
                $rowUpDate = $myManager->upDateManager($idManager, $email, $userName, $name, $surname);
            } else {
                $idManager = $myManager->addNewManager($email, $userName, $name, $surname);
                if($idManager < 1) {
                    $json_data = json_encode(['code' => '01303', 'message' => 'Запись не создана']);
                    return $json_data;
                }
            }

            $countAccessList = count($accessList);
            if($countAccessList) {
                $rowDelAccessListCount = $myManager->delAccessList($idManager);
                foreach ($accessList as $keyAccessList => $idPageGroup) {
                    $rowAddAccessListCount = $myManager->addAccessList($idManager, $idPageGroup);
                }
            }

            $json_data = json_encode(['code' => '0', 'message' => 'Документ успешно сохранён']);
            return $json_data;
        }
    }
}
