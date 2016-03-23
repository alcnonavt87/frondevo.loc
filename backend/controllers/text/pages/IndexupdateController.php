<?php
namespace backend\controllers\text\pages;

use Yii;
use backend\models\text\pages\Index;

class IndexupdateController extends \backend\controllers\AdminController {
    
    public function actionIndex()
    {
        $isAjax = Yii::$app->getRequest()->isAjax;

        if (!$isAjax)
        {
            throw new BadRequestHttpException();
        } else {
            $id = Yii::$app->getRequest()->get('id2');
            $pageLang = Yii::$app->getRequest()->get('id3');
            $myTextPage = new Index();

            $pBreadCrumbs = Yii::$app->getRequest()->post('pBreadCrumbs', '');
            $pMenuName = Yii::$app->getRequest()->post('pMenuName', '');
            $pTitle = Yii::$app->getRequest()->post('pTitle', '');
            $pH1 = Yii::$app->getRequest()->post('pH1', '');
            $pDescription = Yii::$app->getRequest()->post('pDescription', '');
            $pKeyWords = Yii::$app->getRequest()->post('pKeyWords', '');
            $pContent = Yii::$app->getRequest()->post('pContent', '');

            $pBreadCrumbs = $this->getCodeStr($pBreadCrumbs);
            $pMenuName = $this->getCodeStr($pMenuName);
            $pTitle = $this->getCodeStr($pTitle);
            $pH1 = $this->getCodeStr($pH1);
            $pDescription = $this->getCodeStr($pDescription);
            $pKeyWords = $this->getCodeStr($pKeyWords);

            //Начало: проверка есть ли контент на указанном языке
            $rowInCurrentLanguageCount = $myTextPage->getLangPageIs($id, $pageLang);
            if(!$rowInCurrentLanguageCount) {
                $addRowInCurrentLanguageCount = $myTextPage->addLangPage($id, $pageLang);
            }
            //Конец: проверка есть ли контент на указанном языке

            $rowUpDateCount = $myTextPage->editUpDatePage($id,
                    $pageLang, $pTitle, $pDescription, $pKeyWords, $pH1, $pMenuName, $pBreadCrumbs, $pContent);

            if ($rowUpDateCount >= 0) {
                $json_data = json_encode(['code' => '0', 'message' => 'Документ успешно сохранён']);
            } else {
                $json_data = json_encode(['code' => '00701', 'message' => 'Не внесены изменения в документ']);
            }
            // отправляем ответ
            echo $json_data;
        }
    }
}
