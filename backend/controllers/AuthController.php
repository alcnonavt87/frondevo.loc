<?php 
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\LoginForm;
use backend\models\AdminAccessControl;
use backend\models\AdminRememberPass;
use yii\helpers\ArrayHelper;

/**
 * Auth controller
 */
class AuthController extends Controller
{
    public $layout = 'auth';
    
    public function actionIndex()
    {
        if (!\Yii::$app->user->isGuest) {
            return Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl().'edit');
        }
        return $this->render('login');
    }
    
    public function actionLogin()
    {
        $postArray =Yii::$app->request->post();
        $model = new LoginForm();
        $model->username = ArrayHelper::getValue($postArray, 'authLogin', 'Unknown');
        $model->password = ArrayHelper::getValue($postArray, 'authPass', 'Unknown');
        $model->rememberMe = ArrayHelper::getValue($postArray, 'remember');
        if($model->rememberMe) {
            $model->rememberMe = TRUE;
        }
        else
        {
            $model->rememberMe = FALSE;
        }
        
        $modelAdminAccessControl = new AdminAccessControl();
        $ipAccessIsRestricted = $modelAdminAccessControl->ipAccess();
        
        if(YII_ENV != 'prod' || $ipAccessIsRestricted) {
            if($model->login()) {
                $adminRightsAccessIsRestricted = $modelAdminAccessControl->adminRightsAccess($model->role);
                if($adminRightsAccessIsRestricted) {        
                    $json_data = json_encode(array('code' => '0', 'message' => 'edit'));
                    echo $json_data;
                } else {
                    Yii::$app->user->logout();
                    $json_data = json_encode(array('code' => '00102', 'message' => 'Логин и/или пароль не правильный'));
                    echo $json_data;
                }
            } else {
                $json_data = json_encode(array('code' => '00101', 'message' => 'Логин и/или пароль не правильный'));
                echo $json_data;
            }
        } else {
            Yii::$app->user->logout();
            $json_data = json_encode(['code' => '00103', 'message' => _('Логин и/или пароль не правильный')]);
            echo $json_data;
        }        
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionRemember()
    {
        $isAjax = Yii::$app->request->isAjax;
                
        if ($isAjax) {
            $email = ArrayHelper::getValue(Yii::$app->request->post(), 'rememberEmail', '');

            if($email <> '') {
                $myPass = new AdminRememberPass();
                $user = $myPass->checkEmail($email);

                if(isset($user[0]['id'])) {
                    $newPass = $myPass->generatePassword(10);
                    $row = $myPass->updateUserPass($user[0]['id'], $newPass);

                    if($row) {
                        Yii::$app->mailer->htmlLayout = 'layouts/adminRememberPass';
                        $send = Yii::$app->mailer->compose('newAdminPass', ['user' => $user[0], 'newPass' => $newPass])
                        ->setFrom(['noreply@motorYii.com' => 'MOTOR Yii',])
                        ->setTo($email)
                        ->setSubject('Новый пароль')
                        ->send();
                      
                        if($send) {
                            $json_data = json_encode(array('code' => '0', 'message' => _('Ваш новый пароль был отправлен на указанный email')));
                            echo $json_data;
                        } else {
                            $json_data = json_encode(array('code' => '00106', 'message' => _('Ошибка отправки нового пароля на указанный email')));
                            echo $json_data;
                        }
                    } else {
                        $json_data = json_encode(array('code' => '00105', 'message' => _('Ошибка базы данных')));
                        echo $json_data;
                    }
                } else {
                    $json_data = json_encode(array('code' => '00104', 'message' => _('Указан не правильный email')));
                    echo $json_data;
                }
            } else {
                $json_data = json_encode(array('code' => '00103', 'message' => _('Не указан email')));
                echo $json_data;
            }
        }
    }
}
