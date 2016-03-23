<?php
namespace backend\models\links;

use yii\base\Model;
use Yii;
use backend\models\AdminOthers;

Class Links extends Model
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
			`id`
			, `title`/*getManyListTableFields*/
		FROM
			`links`, `links_content`
		WHERE
			TRUE/*getManyFilterWhereClause*/ AND
			`idLinks` = `id` AND
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
        $query = Yii::$app->db->createCommand()->update('links', [$name => $value], 'id = :id', [':id' => $id]);
        return $query->execute();
    }

	public function add($postBase, $postContent, $lang) {
		//if (empty($postBase)) return false;

		$fields = [];
		$values = [];
		foreach ($postBase as $key => $item) {
			$fields[] = '`'.$key.'`';
			$values[] = '"'.addslashes($item).'"';
		}
		$fields = implode(',', $fields);
		$values = implode(',', $values);
		
		$query = Yii::$app->db->createCommand('INSERT INTO
			`links`
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
				`links_content`
					(`idLinks`, `lang`'.$fields.')
			VALUES
				(:idLinks, :lang'.$values.')')
			->bindValue(':idLinks', $rowId)
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
				`links_content`
					(`idLinks`, `lang`)
			VALUES
				(:idLinks, "'.$values[0].'"),
				(:idLinks, "'.$values[1].'")')
			->bindValue(':idLinks', $rowId)
			->execute();
		}

		return [
			$result,
			$rowId
		];
	}

	public function get($id, $lang) {
		$query = Yii::$app->db->createCommand('SELECT
			`id`, `idTextpages`
			, `title`/*get*/
		FROM
			`links`, `links_content`
		WHERE
			`id` = :id AND
			`idLinks` = `id` AND
			`lang` = :lang')
		->bindValue(':id', $id)
		->bindValue(':lang', $lang);
		
		return $query->queryOne();
	}

	public function getEmpty() {
		$result = [
			'idTextpages' => 0,
			 'title' => '',/*getEmpty*/
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
			`links`, `links_content`
		SET
			'.$set.'
		WHERE
			`id` = :id AND
			`idLinks` = `id` AND
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
				`links`
			WHERE
				`id` = :id')
			->bindValue(':id', $id);
			
			$fileNames = $query->queryAll();
			
			foreach ($fileNames[0] as $item) {
				$filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/links/original-'.$item;
				$this->myOthers->deleteImgFromDisk($filePath);
				
				$filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/links/medium-'.$item;
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
				`links_'.$item.'`
			WHERE
				`idLinks` = :id')
			->bindValue(':id', $id);
			
			$fileNames = $query->queryAll();
			
			foreach ($fileNames as $item) {
				$filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/links/original-'.$item['img'];
				$this->myOthers->deleteImgFromDisk($filePath);
				
				$filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/links/medium-'.$item['img'];
				$this->myOthers->deleteImgFromDisk($filePath);
			}
		}
			
		// удаляем запись
		$query = Yii::$app->db->createCommand('DELETE FROM
			`links`
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