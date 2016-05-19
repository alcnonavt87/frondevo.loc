<?php
namespace backend\controllers\text\pages;

use Yii;
use backend\models\text\pages\Animations;
use backend\models\AdminOthers;
use backend\models\Imagick;
use Yii\helpers\ArrayHelper;

class AnimationsupdateController extends \backend\controllers\AdminController {
    
    public function actionIndex()
    {
        $isAjax = Yii::$app->getRequest()->isAjax;

        if (!$isAjax)
        {
            throw new BadRequestHttpException();
        } else {
            $id = $idRecord = Yii::$app->getRequest()->get('id2');
            $pageLang = Yii::$app->getRequest()->get('id3');
            $myTextPage = new Animations();
			$myOthers = new AdminOthers();
            $myImagick = new Imagick();
			
			$_POST['content'] = isset($_POST['content']) ? $_POST['content'] : [];

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


			// Многострочные поля без HTML
			if (isset($_POST['noHTML'])) {
				foreach ($_POST['noHTML'] as $item) {
					$_POST['content'][$item] = strip_tags($_POST['content'][$item]);
				}
			}/* UpdateCodeTop */
			
			if (!isset($_POST['base'])) {
				$_POST['base'] = [];
			}
			
			$row = $myTextPage->update($id, $_POST['base'], $_POST['content'], $pageLang);
			


			if ($rowUpDateCount !== false) {
                $json_data = json_encode(['code' => '0', 'message' => 'Документ успешно сохранён']);
            } else {
                $json_data = json_encode(['code' => '00701', 'message' => 'Не внесены изменения в документ']);
            }
			
			//$justAddedImages = array();
			// Изображения
			foreach ($_SESSION['images'] as $item) { //только что добавленные
				//$justAddedImages[] = $item['name'];
				$tmp_dir = $_SERVER['DOCUMENT_ROOT'].'/temp';
				
				$imgTitle = $item['value'];
				$uploader = $item['id'];
				$fileExtension = $item['fileExtension'];
				$name = $item['name'];
				$imgWidth = $item['imgWidth'];
				$imgHeight = $item['imgHeight'];
				$format = $item['format'];
				
				$uploader = explode('-', $uploader);
				$pathToFolder = $_SERVER['DOCUMENT_ROOT'].'/frontend/web/';

				if ($uploader[0] == 'uploader0') { // одно изображение
					// если после добавления тут же удалили, то не продолжаем
					//if (isset($_POST['images'][$uploader[1].'-one-'.$name]) && $_POST['images'][$uploader[1].'-one-'.$name]['deleted']) continue;
					
					$fileName = $idRecord.'-'.$uploader[1].$fileExtension;//echo '<pre>';print_r($fileName);echo '</pre>';exit;

					$fileNameGeneral = Yii::$app->params['pics']['pages']['path']."biganimationsbg-".$fileName;
					$imgGeneralWidth = Yii::$app->params['pics']['pages']['sizes']['imageanimationsbgbig']['width'];
					$imgGeneralHeight = Yii::$app->params['pics']['pages']['sizes']['imageanimationsbgbig']['height'];

					$fileNameSmall = Yii::$app->params['pics']['pages']['path']."smallanimationsbg-".$fileName;
					$imgSmallWidth = Yii::$app->params['pics']['pages']['sizes']['imageanimationsbgsmall']['width'];
					$imgSmallHeight = Yii::$app->params['pics']['pages']['sizes']['imageanimationsbgsmall']['height'];


						if ($uploader[1] == 'imageanimationsbgbig') {
							$myImagick->makeResizeImageWithOptimalCrop($imgGeneralWidth, $imgGeneralHeight, $pathToFolder.$fileNameGeneral,$tmp_dir.'/'.$name, $format, \imagick::FILTER_UNDEFINED, 1, 0, 0, \imagick::COMPRESSION_LZW, 87);
							$newRow = $myOthers->addImgOneMultiLangsSBK('pages', $uploader[1], $fileName, $imgTitle, $idRecord, 'pageId', $pageLang,1);
						} else if ($uploader[1] == 'imageanimationsbgsmall') {
							$myImagick->makeResizeImageWithOptimalCrop($imgSmallWidth, $imgSmallHeight, $pathToFolder.$fileNameSmall,$tmp_dir.'/'.$name, $format, \imagick::FILTER_UNDEFINED, 1, 0, 0, \imagick::COMPRESSION_LZW, 87);
							$newRow = $myOthers->addImgOneMultiLangsSBK('pages', $uploader[1], $fileName, $imgTitle, $idRecord, 'pageId', $pageLang,1);

						/*// Загружаем как есть
						copy($tmp_dir.'/'.$name, $pathToFolder.$fileNameMedium);
						$newRow = $myOthers->addImgOneMultiLangs('pages', $uploader[1], $fileName, $imgTitle, $imgWidth, $imgHeight, $idRecord);*/
						
						/*// Создаём файл нужного размера по ширине
						$h = $myImagick->makeResizeImageByWidth(200, $fileNameMedium, $tmp_dir.'/'.$name, $format, imagick::FILTER_HAMMING, 0.8, 0, 1, imagick::COMPRESSION_LZW, 87);
						$newRow = $myOthers->addImgOneMultiLangs('pages', $uploader[1], $fileName, $imgTitle, 200, $h, $idRecord, 'pageId', $pageLang, 1);*/
						
						/*// Создаём файл нужного размера по высоте
						$w = $myImagick->makeResizeImageByHeight(200, $fileNameMedium, $tmp_dir.'/'.$name, $format, imagick::FILTER_HAMMING, 0.8, 0, 1, imagick::COMPRESSION_LZW, 87);
						$newRow = $myOthers->addImgOneMultiLangs('pages', $uploader[1], $fileName, $imgTitle, $w, 200, $idRecord, 'pageId', $pageLang, 1);*/
						
						/*// Создаём файл нужного размера по минимальной стороне
						$sizes = $myImagick->makeResizeImageByMinSide(200, 200, $fileNameMedium, $tmp_dir.'/'.$name, $format, imagick::FILTER_HAMMING, 0.8, 0, 1, imagick::COMPRESSION_LZW, 87);
						$newRow = $myOthers->addImgOneMultiLangs('pages', $uploader[1], $fileName, $imgTitle, $sizes[0], $sizes[1], $idRecord, 'pageId', $pageLang, 1);*/
						
						/*// Создаём файл нужного размера без обрезания
						$myImagick->makeResizeImage(200, 200, $fileNameMedium, $tmp_dir.'/'.$name, $format, imagick::FILTER_HAMMING, 0.8, 0, 1, imagick::COMPRESSION_LZW, 87);
						$newRow = $myOthers->addImgOneMultiLangs('pages', $uploader[1], $fileName, $imgTitle, 200, 200, $idRecord, 'pageId', $pageLang, 1);*/
						
						/*// Создаём файл нужного размера с оптимальным обрезанием
						$myImagick->makeResizeImageWithOptimalCrop(200, 200, $fileNameMedium, $tmp_dir.'/'.$name, $format, imagick::FILTER_HAMMING, 0.8, 0, 1, imagick::COMPRESSION_LZW, 87);
						$newRow = $myOthers->addIaddImgOneMultiLangsmgOne('pages', $uploader[1], $fileName, $imgTitle, 200, 200, $idRecord, 'pageId', $pageLang, 1);*/
					}

					/*if ($newRow[1] >= 0)
					{   
						return json_encode(array('code' => '0', 'message' => 'Изображение успешно добавлено', 'id' => $uploader[1].'-one',
								'filepath' => '/'.$fileNameOriginal));
					}
					else
					{
						return json_encode(array('code' => '00307', 'message' => 'Ошибка сохранения в БД'));
					}*/
				} else { // несколько изображений
					// если после добавления тут же удалили, то не продолжаем
					//if (isset($_POST['images'][$uploader[1].'-'.$nextId.'-'.$name]) && $_POST['images'][$uploader[1].'-'.$nextId.'-'.$name]['deleted']) continue;
					
					$fileName = $idRecord.'-'.$uploader[1].'-'.microtime(true).$fileExtension;
					$fileNameOriginal = "p/pages/original-".$fileName;
					$fileNameMedium = "p/pages/medium-".$fileName;

					// Копируем файл оригинал
					copy($tmp_dir.'/'.$name, $pathToFolder.$fileNameOriginal);

					if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
						copy($tmp_dir.'/'.$name, $pathToFolder.$fileNameMedium);
						$newRow = $myOthers->addImgManyMultiLangs('pages_'.$uploader[1], 'idPages', $idRecord, $fileName, $imgTitle, $imgWidth, $imgHeight, $pageLang);
					} else {
						/*// Загружаем как есть
						copy($tmp_dir.'/'.$name, $pathToFolder.$fileNameMedium);
						$newRow = $myOthers->addImgManyMultiLangs('pages_'.$uploader[1], 'idAdvices2', $idRecord, $fileName, $imgTitle, $imgWidth, $imgHeight, $pageLang);*/
						
						/*// Создаём файл нужного размера по ширине
						$h = $myImagick->makeResizeImageByWidth(200, $fileNameMedium, $tmp_dir.'/'.$name, $format, imagick::FILTER_HAMMING, 0.8, 0, 1, imagick::COMPRESSION_LZW, 87);
						$newRow = $myOthers->addImgManyMultiLangs('pages_'.$uploader[1], 'idAdvices2', $idRecord, $fileName, $imgTitle, 200, $h, $pageLang);*/
						
						/*// Создаём файл нужного размера по высоте
						$w = $myImagick->makeResizeImageByHeight(200, $fileNameMedium, $tmp_dir.'/'.$name, $format, imagick::FILTER_HAMMING, 0.8, 0, 1, imagick::COMPRESSION_LZW, 87);
						$newRow = $myOthers->addImgManyMultiLangs('pages_'.$uploader[1], 'idAdvices2', $idRecord, $fileName, $imgTitle, $w, 200, $pageLang);*/
						
						/*// Создаём файл нужного размера по минимальной стороне
						$sizes = $myImagick->makeResizeImageByMinSide(200, 200, $fileNameMedium, $tmp_dir.'/'.$name, $format, imagick::FILTER_HAMMING, 0.8, 0, 1, imagick::COMPRESSION_LZW, 87);
						$newRow = $myOthers->addImgManyMultiLangs('pages_'.$uploader[1], 'idAdvices2', $idRecord, $fileName, $imgTitle, $sizes[0], $sizes[1], $pageLang);*/
						
						/*// Создаём файл нужного размера без обрезания
						$myImagick->makeResizeImage(200, 200, $fileNameMedium, $tmp_dir.'/'.$name, $format, imagick::FILTER_HAMMING, 0.8, 0, 1, imagick::COMPRESSION_LZW, 87);
						$newRow = $myOthers->addImgManyMultiLangs('pages_'.$uploader[1], 'idAdvices2', $idRecord, $fileName, $imgTitle, 200, 200, $pageLang);*/
						
						/*// Создаём файл нужного размера с оптимальным обрезанием
						$myImagick->makeResizeImageWithOptimalCrop(200, 200, $fileNameMedium, $tmp_dir.'/'.$name, $format, imagick::FILTER_HAMMING, 0.8, 0, 1, imagick::COMPRESSION_LZW, 87);
						$newRow = $myOthers->addImgManyMultiLangs('pages_'.$uploader[1], 'idAdvices2', $idRecord, $fileName, $imgTitle, 200, 200, $pageLang);*/
					}

					/*if ($newRow[1] >= 0)
					{   
						return json_encode(array('code' => '0', 'message' => 'Изображение успешно добавлено', 'id' => $uploader[1].'_'.$newRow[0],
								'filepath' => '/'.$fileNameOriginal));
					}
					else
					{
						return json_encode(array('code' => '00307', 'message' => 'Ошибка сохранения в БД'));
					}*/
				}
			}
			
			$images = ArrayHelper::getValue($_POST, 'images', []);//echo '<pre>';print_r($images);echo '</pre>';exit;
			if (isset($images)) {
				foreach ($images as $key => $item) { //существующие, а также только что добавленные
					$key = explode('-', $key);
					
					// только что добавленные изображения игнорируем
					//if (isset($key[2]) && in_array($key[2], $justAddedImages)) continue;
					
					if ($key[1] == 'one') { // одно изображение
						if (!$item['deleted']) {
							$myOthers->updateImgOneMultiLangs('pages', $key[0], $item['imgTitle'], $idRecord, 'pageId', $pageLang, 1);
						} else {
							$myOthers->deleteImgOneMultiLangs('pages', $key[0], $idRecord);
						}
					} else { // несколько изображений
						if (!$item['deleted']) {
							$myOthers->updateImgManyMultiLangs('pages_'.$key[0], $item['imgTitle'], $item['picking'], $key[1], $pageLang);
						} else {
							$myOthers->deleteImgMany('pages_'.$key[0], $key[1]);
						}
					}
				}
			}

			// Группа чекбоксов "Выбор ссылок отображаемых в футере"
			$linksIds = ArrayHelper::getValue($_POST, 'linksIds', []);
			$myOthers->updateChGrIds('pages_links', 'idPages', 'idLinks', $idRecord, $linksIds);

			// Группа чекбоксов "Выбор работ отображаемых на странице"
			$worksfrontoutIds = ArrayHelper::getValue($_POST, 'worksfrontoutIds', []);
			$myOthers->updateChGrIds('pages_worksfrontout', 'idPages', 'idWorksfrontout', $idRecord, $worksfrontoutIds);/* UpdateCodeBottom */
            
			// отправляем ответ
            echo $json_data;
        }
    }
}