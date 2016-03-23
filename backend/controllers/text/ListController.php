<?php
namespace backend\controllers\text;

use Yii;
use backend\models\AdminOthers;
use backend\models\text\Text;

/**
 * List controller
 */

class ListController extends \backend\controllers\AdminController
{
            
    public function actionIndex()
    {
        $isAjax = Yii::$app->getRequest()->isAjax;

        if (!$isAjax) {
            throw new BadRequestHttpException();
        } else {
            $id1Uri = Yii::$app->getRequest()->get('id');
            $pageLang = Yii::$app->getRequest()->get('id2');

            $myText = new Text();
            $allTextPages = $myText->getAllTextPages($pageLang, $id1Uri);

            $myOthers = new AdminOthers();
            $pageGroupData = $myOthers->getPageGroupData($id1Uri);

            $content = '';
            
            if (is_file(Yii::$app->basePath.'/views/pages/TextListView.php')) {
                require Yii::$app->basePath.'/views/pages/TextListView.php';
            }

            return json_encode(['code' => '0', 'message' => '', 'content' => $content]);
        }
    }
}        
