<?php 
namespace backend\controllers\settings\settings;

use Yii;
use backend\models\settings\settings\Manager;

class PrivateofficeupdateController extends \backend\controllers\AdminController {
        
    public function actionIndex()
    {
        $isAjax = Yii::$app->getRequest()->isAjax;

        if (!$isAjax) {
            throw new BadRequestHttpException();
        } else {
            $email = Yii::$app->getRequest()->post('email', '');
            $name = Yii::$app->getRequest()->post('name', '');
            $surname = Yii::$app->getRequest()->post('surname', '');
            $userName = Yii::$app->getRequest()->post('username', '');
            $pass = Yii::$app->getRequest()->post('pass', '');
            $newPass1 = Yii::$app->getRequest()->post('newPass1', '');
            $newPass2 = Yii::$app->getRequest()->post('newPass2', '');

            $myManager = new Manager();

            $emailCount = $myManager->getEmalCount(Yii::$app->user->id, $email);

            if($emailCount > 0) {
                return json_encode(['code' => '01305', 'message' => _('Не допустимый email')]);
            }

            $userNameCount = $myManager->getUserNameCount(Yii::$app->user->id, $userName);

            if($userNameCount > 0) {
                return json_encode(['code' => '01306', 'message' => _('Не допустимое имя пользователя')]);
            }

            if(!($newPass1 == '' AND  $newPass2 == '' AND $pass == '')) {
                if($newPass1 <> $newPass2) {
                    return json_encode(['code' => '01307', 'message' => _('Новые пароли не совпадают')]);
                }

                if(strlen($newPass1) < 6) {
                    return json_encode(['code' => '01308', 'message' => _('Новый пароль слишком короткий')]);
                }

                if(strlen($newPass1) > 20) {
                    return json_encode(['code' => '01309', 'message' => _('Новый пароль слишком длинный')]);
                }

                if(!Yii::$app->security->validatePassword($pass, Yii::$app->getUser()->getIdentity()->password_hash))
                {
                    return json_encode(['code' => '01310', 'message' => _('Текущий пароль не совпадает')]);
                }

                $change = $myManager->changePwd(Yii::$app->user->id, Yii::$app->security->generatePasswordHash($newPass1));
            }

            $rowUpDate = $myManager->upDateManager(Yii::$app->user->id, $email, $userName, $name, $surname);

            return json_encode(['code' => '0', 'message' => _('Данные успешно сохранены')]);
        }
    }
}
