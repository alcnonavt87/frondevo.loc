<?php
namespace backend\controllers\settings\settings;

use Yii;
use backend\models\settings\settings\Mysettings;

class MysettingsupdateController extends \backend\controllers\AdminController {

    public function actionIndex()
    {
        $isAjax = Yii::$app->getRequest()->isAjax;

        if (!$isAjax) {
            throw new BadRequestHttpException();
        } else {
            $pageLang = Yii::$app->getRequest()->get('id3');

            $address = Yii::$app->getRequest()->post('address', '');
            $copyright = Yii::$app->getRequest()->post('copyright', '');
            $emailCall = Yii::$app->getRequest()->post('emailCall', '');
            $emailClaim = Yii::$app->getRequest()->post('emailClaim', '');
            $snVkontakte = Yii::$app->getRequest()->post('snVkontakte', '');
            $snFacebook = Yii::$app->getRequest()->post('snFacebook', '');
            $snTwitter = Yii::$app->getRequest()->post('snTwitter', '');

            $mySettings = new Mysettings();

            $fields = compact(
                'address',
                'copyright',
                'emailCall',
                'emailClaim',
                'snVkontakte',
                'snFacebook',
                'snTwitter'
            );
            $rowUpDate = $mySettings->upDateMySettings($fields, $pageLang);

            return json_encode(['code' => '0', 'message' => _('Данные успешно сохранены')]);
        }
    }
}
