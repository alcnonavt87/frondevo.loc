<?php
namespace backend\controllers\text\pages;

use Yii;
use backend\models\AdminOthers;
use Yii\helpers\ArrayHelper;

class FrontendoutImguploadController extends  \backend\controllers\AdminController
{
	public function actionIndex()
	{
		$isAjax = Yii::$app->getRequest()->isAjax;
			
		if ($isAjax) {//echo '<pre>';print_r($_POST);echo '</pre>';exit;
			$place = ArrayHelper::getValue($_POST, 'place', 0);
			$uploader = ArrayHelper::getValue($_POST, 'id', '');
			
			$sizeLimit = 1024*10*1024; //10 Mb
					   
			if($_FILES['files']['error'][0]) {
				return json_encode(['code' => '00304', 'message' => 'Ошибка при загрузке файла']);
			}
			
			if($_FILES['files']['size'][0] > $sizeLimit) {
				return json_encode(['code' => '00305', 'message' => 'Превышен максимально допустимый размер файла']);
			}
			
			// Определяем тип файла
			$imgData = getimagesize($_FILES['files']['tmp_name'][0]);
			$imgWidth = $imgData[0];
			$imgHeight = $imgData[1];

			switch($imgData['mime'])
			{
				case 'image/png':
					$mimeTrue = true;
					$fileExtension = '.png';
					$format = 'png';
				break;
				case 'image/jpeg':
					$mimeTrue = true;
					$fileExtension = '.jpg';
					$format = 'jpg';
				break;
				case 'image/gif': 
					$mimeTrue = true;
					$fileExtension = '.gif';
					$format = 'gif';
				break;
				default:
					$mimeTrue = false;
				break;
			}
			
			if(!$mimeTrue) {
				return json_encode(['code' => '00306', 'message' => 'Недопустимый формат файла']);
			}
			
			
			$myOthers = new AdminOthers();
			
			$tmp_name = $_FILES['files']['tmp_name'][0];
			
			// присоединяем к имени метку времени
			$name = explode('.', $_FILES['files']['name'][0]);
			array_pop($name);
			$name = implode('.', $name);
			$name = $name.'_'.time().$fileExtension;
			
			// сохраняем во временной директории
			$moved = $myOthers->moveToTempDir($tmp_name, $name);
			
			// сохраняем данные по изображению в сессии
			// для использования в Update-контроллере
			$post = $_POST;
			$post['fileExtension'] = $fileExtension;
			$post['name'] = $name;
			$post['imgWidth'] = $imgWidth;
			$post['imgHeight'] = $imgHeight;
			$post['format'] = $format;
			$_SESSION['images'][] = $post;

			if ($moved) {
				$uploader = explode('-', $uploader);
				if ($uploader[0] == 'uploader0') {
					return json_encode(['code' => '0', 'message' => 'Изображение успешно добавлено', 'id' => $uploader[1].'-one-'.$name,
						'filepath' => '/temp/'.$name]);
				} else {
					// определяем следующий id в таблице множкственных изображений
					$nextId = $myOthers->getNextTableId('pages_'.$uploader[1]) + $place;
					
					return json_encode(['code' => '0', 'message' => 'Изображение успешно добавлено', 'id' => $uploader[1].'-'.$nextId.'-'.$name,
						'filepath' => '/temp/'.$name]);
				}
			} else {
				return json_encode(['code' => '00307', 'message' => 'Ошибка сохранения во временной директории']);
			}
		} else {
			throw new HTTP_Exception_404('Нет такой страницы.');
		}
	}
}