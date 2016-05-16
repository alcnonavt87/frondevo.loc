<?php
namespace backend\controllers\advantageanimations;

use Yii;
use backend\models\advantageanimations\Advantageanimations;

class DelController extends  \backend\controllers\AdminController
{
    public function actionIndex()
	{
		$isAjax = Yii::$app->getRequest()->isAjax;
			
		if ($isAjax) {
			$id2Uri = $idRecord = Yii::$app->getRequest()->get('id2');
							
			$myAdvantageanimations = new Advantageanimations();
			

			// Удаляем запись
			$rowDelCount = $myAdvantageanimations->delete($idRecord);


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