<?php
namespace backend\controllers\text;

use Yii;
use backend\models\text\Text;

/**
 * Update controller
 */

class ImguploadController extends \backend\controllers\AdminController {
        
    public function actionIndex()
    {
        $isAjax = Yii::$app->getRequest()->isAjax;

        if (!$isAjax)
        {
            throw new HTTP_Exception_404('Нет такой страницы.');
        }
        else
        {
            $id1Uri = Yii::$app->getRequest()->get('id');
            $idTextPage = Yii::$app->getRequest()->get('id2');
            $pageLang = Yii::$app->getRequest()->get('id3');

            $myText = new Text();

            $textPageAdminClass = $myText->getTextPageAdminClass($idTextPage);

            if($textPageAdminClass)
            {   
                $controller = Yii::$app->createControllerByID($textPageAdminClass.'imgupload');
                $ret = $controller->runAction('index');
                echo $ret;
            }
        }
    }
}
