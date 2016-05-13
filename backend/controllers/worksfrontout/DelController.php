<?php
namespace backend\controllers\worksfrontout;

use Yii;
use backend\models\worksfrontout\Worksfrontout;

class DelController extends  \backend\controllers\AdminController
{
    public function actionIndex()
	{
		$isAjax = Yii::$app->getRequest()->isAjax;
			
		if ($isAjax) {
			$id2Uri = $idRecord = Yii::$app->getRequest()->get('id2');
							
			$myWorksfrontout = new Worksfrontout();
			

			// Удаляем запись
			$rowDelCount = $myWorksfrontout->delete($idRecord);


			if ($rowDelCount) {
				$json_data = json_encode(['code' => '0', 'message' => 'Запись успешно удалена']);
			} else {
				$json_data = json_encode(['code' => '00303', 'message' => 'Ошибка удаления записи из базы данных']);
			}
			
			echo $json_data;
		} else {
			throw new HTTP_Exception_404('Нет такой страницы.');
        }
	}
}