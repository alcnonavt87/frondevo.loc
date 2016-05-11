<?php
namespace backend\controllers\advantagepsdhmtl5;

use Yii;
use backend\models\advantagepsdhmtl5\Advantagepsdhmtl5;

class DelController extends  \backend\controllers\AdminController
{
    public function actionIndex()
	{
		$isAjax = Yii::$app->getRequest()->isAjax;
			
		if ($isAjax) {
			$id2Uri = $idRecord = Yii::$app->getRequest()->get('id2');
							
			$myAdvantagepsdhmtl5 = new Advantagepsdhmtl5();
			

			// Удаляем запись
			$rowDelCount = $myAdvantagepsdhmtl5->delete($idRecord);


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