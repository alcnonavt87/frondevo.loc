<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use backend\models\AdminOthers;

/**
 * Imgupload controller
 */
class ImguploadController extends Controller {
        
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            if(Yii::$app->getUser()->getIdentity()->role < 50){
                                return TRUE;
                            }
                            Yii::$app->user->logout();
                            return $this->goHome();
                        }
                    ],
                ],
            ],
        ];
    }
    

    public function actionIndex()
    {
        $pageId = Yii::$app->getRequest()->get('id');

        if ($pageId) {
            $myAdminOthers = new AdminOthers();
            $adminDataPage = $myAdminOthers->getPageGroupAdminClassName($pageId);
        } else {
            throw new BadRequestHttpException();
        }

        if (isset($adminDataPage)) {
            $controller = Yii::$app->createControllerByID($adminDataPage.'imgupload');
            echo $controller->runAction('index');
        } else {
            throw new BadRequestHttpException();
        }
    }

} // End Welcome
