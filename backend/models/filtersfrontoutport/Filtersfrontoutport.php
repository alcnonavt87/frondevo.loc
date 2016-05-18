<?php
namespace backend\models\filtersfrontoutport;

use yii\base\Model;
use Yii;
use backend\models\AdminOthers;

Class Filtersfrontoutport extends Model
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
			`id`, `pTitle`, `show`
			/*getManyListTableFields*/
		FROM
			`filtersfrontoutport`, `filtersfrontoutport_content`
		WHERE
			TRUE/*getManyFilterWhereClause*/ AND
			`idFiltersfrontoutport` = `id` AND
			`lang` = :lang
		ORDER BY
			`order` ASC'
		.$limit
		.$offset)
		->bindValue(':lang', $lang);
		
		return $query->queryAll();
	}

	/*getFilterWhere*/

	public function upDateProperty($id, $name, $value) {
        $query = Yii::$app->db->createCommand()->update('filtersfrontoutport', [$name => $value], 'id = :id', [':id' => $id]);
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
			`filtersfrontoutport`
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
				`filtersfrontoutport_content`
					(`idFiltersfrontoutport`, `lang`'.$fields.')
			VALUES
				(:idFiltersfrontoutport, :lang'.$values.')')
			->bindValue(':idFiltersfrontoutport', $rowId)
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
				`filtersfrontoutport_content`
					(`idFiltersfrontoutport`, `lang`)
			VALUES
				(:idFiltersfrontoutport, "'.$values[0].'"),
				(:idFiltersfrontoutport, "'.$values[1].'")')
			->bindValue(':idFiltersfrontoutport', $rowId)
			->execute();
		}

		return [
			$result,
			$rowId
		];
	}

	public function get($id, $lang) {
		$query = Yii::$app->db->createCommand('SELECT
			`id`, `pTitle`, `show`,`url`
			/*get*/
		FROM
			`filtersfrontoutport`, `filtersfrontoutport_content`
		WHERE
			`id` = :id AND
			`idFiltersfrontoutport` = `id` AND
			`lang` = :lang')
		->bindValue(':id', $id)
		->bindValue(':lang', $lang);
		
		return $query->queryOne();
	}

	public function getEmpty() {
		$result = [
			 'pTitle' => '', 'url' => '', 'show' => 0,
			/*getEmpty*/
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
			`filtersfrontoutport`, `filtersfrontoutport_content`
		SET
			'.$set.'
		WHERE
			`id` = :id AND
			`idFiltersfrontoutport` = `id` AND
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
				`filtersfrontoutport`
			WHERE
				`id` = :id')
			->bindValue(':id', $id);
			
			$fileNames = $query->queryAll();
			
			foreach ($fileNames[0] as $item) {
				$filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/filtersfrontoutport/original-'.$item;
				$this->myOthers->deleteImgFromDisk($filePath);
				
				$filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/filtersfrontoutport/medium-'.$item;
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
				`filtersfrontoutport_'.$item.'`
			WHERE
				`idFiltersfrontoutport` = :id')
			->bindValue(':id', $id);
			
			$fileNames = $query->queryAll();
			
			foreach ($fileNames as $item) {
				$filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/filtersfrontoutport/original-'.$item['img'];
				$this->myOthers->deleteImgFromDisk($filePath);
				
				$filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/filtersfrontoutport/medium-'.$item['img'];
				$this->myOthers->deleteImgFromDisk($filePath);
			}
		}
			
		// удаляем запись
		$query = Yii::$app->db->createCommand('DELETE FROM
			`filtersfrontoutport`
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