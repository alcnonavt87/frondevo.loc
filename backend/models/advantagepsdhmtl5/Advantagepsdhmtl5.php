<?php
namespace backend\models\advantagepsdhmtl5;

use yii\base\Model;
use Yii;
use backend\models\AdminOthers;

Class Advantagepsdhmtl5 extends Model
{
	var $frontendPath;
	var $myOthers;

    function __construct() {
        $this->frontendPath = '/frontend/web/';
		$this->myOthers = new AdminOthers();
	}

	/*getCount*/

	public function getMany($filters, $limit, $offset, $lang) {
		/*getManyFilterGet*/
		
		// пагинация
		if ($limit) {
			$limit = ' LIMIT '.(int)$limit;
			$offset = ' OFFSET '.(int)$offset;
		}
		
		// основной запрос
		$query = Yii::$app->db->createCommand('SELECT
			`id`,`title`
			/*getManyListTableFields*/
		FROM
			`advantagepsdhmtl5`, `advantagepsdhmtl5_content`
		WHERE
			TRUE/*getManyFilterWhereClause*/ AND
			`idAdvantagepsdhmtl5` = `id` AND
			`lang` = :lang
		ORDER BY
			`id` ASC'
		.$limit
		.$offset)
		->bindValue(':lang', $lang);
		
		return $query->queryAll();
	}

	/*getFilterWhere*/

	public function upDateProperty($id, $name, $value) {
        $query = Yii::$app->db->createCommand()->update('advantagepsdhmtl5', [$name => $value], 'id = :id', [':id' => $id]);
        return $query->execute();
    }

	public function add($postBase, $postContent, $lang) {


		$fields = [];
		$values = [];
		foreach ($postBase as $key => $item) {
			$fields[] = '`'.$key.'`';
			$values[] = '"'.addslashes($item).'"';
		}
		$fields = implode(',', $fields);
		$values = implode(',', $values);
		
		$query = Yii::$app->db->createCommand('INSERT INTO
			`advantagepsdhmtl5`
				('.$fields.')
		VALUES
			('.$values.')');

		$result = $query->execute();
        $rowId = (int)Yii::$app->db->lastInsertID;

		// таблица контента
		if ($result) {
			$fields = array();
			$values = array();
			foreach ($postContent as $key => $item) {
				$fields[] = '`'.$key.'`';
				$values[] = '"'.addslashes($item).'"';
			}
			$fields = !empty($fields) ? ', '.implode(',', $fields) : '';
			$values = !empty($values) ? ', '.implode(',', $values) : '';
			
			$query = Yii::$app->db->createCommand('INSERT INTO
				`advantagepsdhmtl5_content`
					(`idAdvantagepsdhmtl5`, `lang`'.$fields.')
			VALUES
				(:idAdvantagepsdhmtl5, :lang'.$values.')')
			->bindValue(':idAdvantagepsdhmtl5', $rowId)
			->bindValue(':lang', $lang)
			->execute();
			
			// пустые записи для оставшихся языков
			$allLangs = $this->myOthers->getAllLangs();
			$values = [];
			foreach ($allLangs as $item) {
				$values[] = $item['sName'];
			}
			array_splice($values, array_search($lang, $values), 1);
			
			$query = Yii::$app->db->createCommand('INSERT INTO
				`advantagepsdhmtl5_content`
					(`idAdvantagepsdhmtl5`, `lang`)
			VALUES
				(:idAdvantagepsdhmtl5, "'.$values[0].'"),
				(:idAdvantagepsdhmtl5, "'.$values[1].'")')
			->bindValue(':idAdvantagepsdhmtl5', $rowId)
			->execute();
		}

		return [
			$result,
			$rowId
		];
	}

	public function get($id, $lang) {
		$query = Yii::$app->db->createCommand('SELECT
			`id`
			, `title`, `paragraph`/*get*/
		FROM
			`advantagepsdhmtl5`, `advantagepsdhmtl5_content`
		WHERE
			`id` = :id AND
			`idAdvantagepsdhmtl5` = `id` AND
			`lang` = :lang')
		->bindValue(':id', $id)
		->bindValue(':lang', $lang);
		
		return $query->queryOne();
	}

	public function getEmpty() {
		$result = [
			
			 'title' => '', 'paragraph' => '',/*getEmpty*/
		];
		
		return $result;
	}

	public function update($id, $postBase, $postContent, $lang) {
		$data = $postBase;
		
		if (isset($postContent)) {
			$data = array_merge($data, $postContent);
		}
		
		if (empty($data)) return false;
		
		$set = [];
		foreach ($data as $key => $item) {
			$set[] = '`'.$key.'`="'.addslashes($item).'"';
		}
		$set = implode(',', $set);
		
		$query = Yii::$app->db->createCommand('UPDATE
			`advantagepsdhmtl5`, `advantagepsdhmtl5_content`
		SET
			'.$set.'
		WHERE
			`id` = :id AND
			`idAdvantagepsdhmtl5` = `id` AND
			`lang` = :lang')
		->bindValue(':id', $id)
		->bindValue(':lang', $lang);
		
		return $query->execute();
	}

	public function delete($id) {
		// удаляем с диска одиночные изображения
		$imagesOne = [
			/*deleteImagesOne*/
		];
		$imagesOne = array_unique($imagesOne);
		if ($imagesOne) {
			$imagesOne = implode(',', $imagesOne);
		
			$query = Yii::$app->db->createCommand('SELECT
				'.$imagesOne.'
			FROM
				`advantagepsdhmtl5`
			WHERE
				`id` = :id')
			->bindValue(':id', $id);
			
			$fileNames = $query->queryAll();
			
			foreach ($fileNames[0] as $item) {
				$filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/advantagepsdhmtl5/original-'.$item;
				$this->myOthers->deleteImgFromDisk($filePath);
				
				$filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/advantagepsdhmtl5/medium-'.$item;
				$this->myOthers->deleteImgFromDisk($filePath);
			}
		}
		
		// удаляем с диска множественные изображения
		$imagesMany = [
			/*deleteImagesMany*/
		];
		$imagesMany = array_unique($imagesMany);
		foreach ($imagesMany as $item) {
			$query = Yii::$app->db->createCommand('SELECT
				`img`
			FROM
				`advantagepsdhmtl5_'.$item.'`
			WHERE
				`idAdvantagepsdhmtl5` = :id')
			->bindValue(':id', $id);
			
			$fileNames = $query->queryAll();
			
			foreach ($fileNames as $item) {
				$filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/advantagepsdhmtl5/original-'.$item['img'];
				$this->myOthers->deleteImgFromDisk($filePath);
				
				$filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/advantagepsdhmtl5/medium-'.$item['img'];
				$this->myOthers->deleteImgFromDisk($filePath);
			}
		}
			
		// удаляем запись
		$query = Yii::$app->db->createCommand('DELETE FROM
			`advantagepsdhmtl5`
		WHERE
			`id` = :id')
		->bindValue(':id', $id);
		
		return $query->execute();
	}



	public function getStatuses() {
		return [
			'В наличии' => 1,
			'Под заказ' => 2,
		];
	}
	
}