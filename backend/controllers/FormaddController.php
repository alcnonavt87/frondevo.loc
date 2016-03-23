<?php 
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use backend\models\AdminOthers;

/**
 * FormAdd controller
 */
class FormaddController extends Controller
{
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
        $id1Uri = Yii::$app->getRequest()->get('id');
     
        if ($id1Uri) {
            $myAdminOthers = new AdminOthers();
            $adminClassName = $myAdminOthers->getPageGroupAdminClassName($id1Uri);
        } else {
            throw new BadRequestHttpException();
        }

        if ($adminClassName)
        {
            $controller = Yii::$app->createControllerByID($adminClassName.'add');
            echo $controller->runAction('index');
        } else {
            throw new BadRequestHttpException();
        }
    }
}
