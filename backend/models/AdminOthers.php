<?php
namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * AdminOthers
 */
class AdminOthers extends Model
{
    var $frontendPath;

    function __construct() {
        $this->frontendPath = '/frontend/web/';
	}
	
	public function getPageIdAndAdminClassName($pageId) {
        $query = Yii::$app->db->createCommand('SELECT `id`, `adminClass` FROM `pages` WHERE `id`= :pageId')
        ->bindValue(':pageId', $pageId);    
        
        return $query->queryAll();
    }
    
    public function getPageGroupAdminClassName($id)
    {
        $query = Yii::$app->db->createCommand('SELECT p.adminClass
        FROM pagegroup p 
        WHERE p.id = :id')
        ->bindValue(':id', $id);   

        $adminClass = $query->queryOne();
        if(isset($adminClass['adminClass'])) {
            return $adminClass['adminClass'];
        }
        return 0;
    }
    
    public function getPageGroupIdForTextPage()
    {
        $query = Yii::$app->db->createCommand('SELECT p.id
        FROM pagegroup p 
        WHERE p.idTextPage = 0');   

        $id = $query->queryOne();
        if(isset($id['id'])) {
            return $id['id'];
        }
        return 0;
    }
    
    public function userHaveRole($user_id, $role_id)
    {
        $query = Yii::$app->db->createCommand('SELECT COUNT(*) AS `count`
        FROM roles_users ru 
        WHERE ru.user_id = :user_id AND ru.role_id = :role_id')
        ->bindValue(':user_id', $user_id)
        ->bindValue(':role_id', $role_id);   

        $count = $query->queryOne();
        if(isset($count['count'])) {
            return $count['count'];
        }
        return 0;
    }
    
    public function getPageGroupData($id)
    {
        $query = Yii::$app->db->createCommand('SELECT p.groupName, p.adminClass, p.idTextPage FROM pagegroup p WHERE p.id = :id')
        ->bindValue(':id', $id);   

        return $query->queryAll();
    }
    
    public function getPageGroupDataI($id, $fields)
    {
        $dbFields = array_map(array($this, 'wrapDBQuotes'), $fields);
		$dbFields = implode(',', $dbFields);
		
		$query = Yii::$app->db->createCommand('SELECT
			'.$dbFields.'
		FROM	
			`pagegroup`
		WHERE
			`id` = :id')
        ->bindValue(':id', $id);

        return $query->queryOne();
    }
    public function getPageGroupDataByMarkI($groupMark, $fields)
    {
        $dbFields = array_map(array($this, 'wrapDBQuotes'), $fields);
		$dbFields = implode(',', $dbFields);
		
		$query = Yii::$app->db->createCommand('SELECT
			'.$dbFields.'
		FROM	
			`pagegroup`
		WHERE
			`groupMark` = :groupMark')
        ->bindValue(':groupMark', $groupMark);

        return $query->queryOne();
    }
    
    public function getTextPageDataByMarkI($pageMark, $fields)
    {
        $dbFields = array_map(array($this, 'wrapDBQuotes'), $fields);
		$dbFields = implode(',', $dbFields);
		
		$query = Yii::$app->db->createCommand('SELECT
			'.$dbFields.'
		FROM	
			`pages`, `content`
		WHERE
			`pageMark` = :pageMark AND
			`pageId` = `id`')
        ->bindValue(':pageMark', $pageMark);

        return $query->queryOne();
    }
	
	private function wrapDBQuotes($field) {
		return '`'.$field.'`';
	}
	
    
	
	public function getPageGroupIdByGroupName($groupName) {
        $query = Yii::$app->db->createCommand('SELECT
			`id`
		FROM
			`pagegroup`
		WHERE
			`groupName` = :groupName')
        ->bindValue(':groupName', $groupName);

        $id = $query->queryOne();
        if(isset($id['id'])) {
            return $id['id'];
        }
        return 0;
    }
	
    public function getPageGroupIdByGroupMark($groupMark) {
        $query = Yii::$app->db->createCommand('SELECT
			`id`
		FROM
			`pagegroup`
		WHERE
			`groupMark` = :groupMark')
        ->bindValue(':groupMark', $groupMark);

        return (int)$query->queryScalar();
    }
	
    public function getPageGroupNameByGroupId($groupId) {
        $query = Yii::$app->db->createCommand('SELECT
			`groupName`
		FROM
			`pagegroup`
		WHERE
			`id` = :groupId')
        ->bindValue(':groupId', $groupId);

        $groupName = $query->queryOne();
        if(isset($groupName['groupName'])) {
            return $groupName['groupName'];
        }
        return 0;
    }
    
	
	
    public function getCataloItemData($idCat, $lang, $cat)
    {
        $query = Yii::$app->db->createCommand('SELECT 
            cc.lang, IF(cc.cName <> "", cc.cName, IF(cc.pMenuName <> "", cc.pMenuName, cc.pH1)) AS `name`
        FROM
            '.$cat.'_content cc
        WHERE
            cc.idCat = :idCat AND cc.lang = :lang')
        ->bindValue(':idCat', $idCat)   
        ->bindValue(':lang', $lang);

        return $query->queryAll();
    }
    
    public function getTextPageHeader($idPage, $lang)
    {
        $query = Yii::$app->db->createCommand('SELECT
            c.pH1 
        FROM 
            content c 
        WHERE 
            c.pageId = :idPage AND c.lang = :lang')
        ->bindValue(':idPage', $idPage)   
        ->bindValue(':lang', $lang);
        
        $pH1 = $query->queryOne();
        if(isset($pH1['pH1'])) {
            return $pH1['pH1'];
        }
        return 0;
    }
    
    public function getSettingsPageName($id)
    {
        $query = Yii::$app->db->createCommand('SELECT sp.settingsName FROM settings_pages sp WHERE sp.id = :id')
        ->bindValue(':id', $id);
        
        $settingsName = $query->queryOne();
        if(isset($settingsName['settingsName'])) {
            return $settingsName['settingsName'];
        }
        return 0;
    }
    
    public function getUserAccess($id, $idPageGroup)
    {
        $idPageGroup = (int)$idPageGroup;
		if($idPageGroup)
        {
            $query = Yii::$app->db->createCommand('SELECT COUNT(*) AS `count` FROM `user` u WHERE u.id = :id AND (u.role > 10 AND u.role < 50)')
            ->bindValue(':id', $id);

            $userRole = $query->queryOne();

            if($userRole['count']) {
                // Если имеется доступ к каталогу, то также даем доступ и к продуктам НАЧАЛО
                $query = Yii::$app->db->createCommand('select `groupLevel`, `idParentGroup` FROM pagegroup pg WHERE pg.id = :idPageGroup')
                ->bindValue(':idPageGroup', $idPageGroup);

                $pageGroupInfo = $query->queryAll();

                if ($pageGroupInfo[0]['groupLevel'] == 2) {
                        $idPageGroup = $pageGroupInfo[0]['idParentGroup'];
                }
                // Если имеется доступ к каталогу, то также даем доступ и к продуктам КОНЕЦ

                $query = Yii::$app->db->createCommand('SELECT COUNT(*) `count` FROM access_list al WHERE al.idUser = :id AND al.idPageGroup = :idPageGroup')
                ->bindValue(':id', $id)   
                ->bindValue(':idPageGroup', $idPageGroup);
                
                $access = $query->queryOne();
                
                if(!$access['count'])
                {
                    $query = Yii::$app->db->createCommand('select count(*) AS `count` FROM pagegroup pg WHERE pg.id = :idPageGroup AND pg.adminClass = "Controller_Admin_Settings"')
                    ->bindValue(':idPageGroup', $idPageGroup);

                    $settings = $query->queryOne();

                    if($settings['count']) return true;

                    return false;
                }
                    
            }
            return true;
        }
        return true;
    }
    
    public function getAllLangs()
    {
        $query = Yii::$app->db->createCommand('SELECT l.sName, l.bName, l.fullName FROM langs l ORDER BY l.id ASC');
        return $query->queryAll();
    }
	
	
	
	/* Сортировка перетаскиванием в таблице админки */
	public function sortTable($table, $idField, $newIndexes) {
		foreach ($newIndexes as $newIndex) {
			$query = Yii::$app->db->createCommand('UPDATE `'.$table.'`
				SET
					`order` = :order
				WHERE
					`'.$idField.'` = :id')
				->bindValue(':order', $newIndex->position)
				->bindValue(':id', $newIndex->index);
				$query->execute();
		}
	}
	
	
	
    /* Работа с изображениями - начало */

    public function clearTempDir() {
            $tmp_dir = $_SERVER['DOCUMENT_ROOT'].'/temp';

            $tmp_files = scandir($tmp_dir);
            foreach ($tmp_files as $item) {
                    if (!is_file($tmp_dir.'/'.$item) || $item == '.' || $item == '..') continue;

                    unlink($tmp_dir.'/'.$item);
            }
    }

    public function moveToTempDir($tmp_name, $name) {
            $tmp_dir = $_SERVER['DOCUMENT_ROOT'].'/temp';
            return move_uploaded_file($tmp_name, $tmp_dir.'/'.$name);
    }

    public function addImgOne($table, $field, $img, $imgTitle, $imgWidth, $imgHeight, $id) {
            $query = Yii::$app->db->createCommand('UPDATE
                    `'.$table.'`
            SET
                    `'.$field.'` = :img,
                    `'.$field.'Title` = :imgTitle,
                    `'.$field.'Width` = :imgWidth,
                    `'.$field.'Height` = :imgHeight
            WHERE
                    `id` = :id')
            ->bindValue(':img', $img)
            ->bindValue(':imgTitle', $imgTitle)
            ->bindValue(':imgWidth', $imgWidth)
            ->bindValue(':imgHeight', $imgHeight)
            ->bindValue(':id', $id);

            return $query->execute();
    }
    public function addImgOneMultiLangs($table, $field, $img, $imgTitle, $imgWidth, $imgHeight, $id, $idRelField, $lang, $textpage=0) {
            if ($textpage) {
				$tableContent = 'content';
			} else {
				$tableContent = $table.'_content';
			}
			
			$query = Yii::$app->db->createCommand('UPDATE
                    `'.$table.'`, `'.$tableContent.'`
            SET
                    `'.$field.'` = :img,
                    `'.$field.'Title` = :imgTitle,
                    `'.$field.'Width` = :imgWidth,
                    `'.$field.'Height` = :imgHeight
            WHERE
                    `id` = :id AND
                    `'.$idRelField.'` = `id` AND
					`lang` = :lang')
            ->bindValue(':img', $img)
            ->bindValue(':imgTitle', $imgTitle)
            ->bindValue(':imgWidth', $imgWidth)
            ->bindValue(':imgHeight', $imgHeight)
            ->bindValue(':id', $id)
            ->bindValue(':lang', $lang);

            return $query->execute();
    }
    public function addImgOneMultiLangsI($table, $field, $img, $imgTitle, $imgWidth, $imgHeight, $imgWidth2, $imgHeight2, $id, $idRelField, $lang, $textpage=0) {
            if ($textpage) {
				$tableContent = 'content';
			} else {
				$tableContent = $table.'_content';
			}
			
			$query = Yii::$app->db->createCommand('UPDATE
                    `'.$table.'`, `'.$tableContent.'`
            SET
                    `'.$field.'` = :img,
                    `'.$field.'Title` = :imgTitle,
                    `'.$field.'Width` = :imgWidth,
                    `'.$field.'Height` = :imgHeight,
                    `'.$field.'Width2` = :imgWidth2,
                    `'.$field.'Height2` = :imgHeight2
            WHERE
                    `id` = :id AND
                    `'.$idRelField.'` = `id` AND
					`lang` = :lang')
            ->bindValue(':img', $img)
            ->bindValue(':imgTitle', $imgTitle)
            ->bindValue(':imgWidth', $imgWidth)
            ->bindValue(':imgHeight', $imgHeight)
            ->bindValue(':imgWidth2', $imgWidth2)
            ->bindValue(':imgHeight2', $imgHeight2)
            ->bindValue(':id', $id)
            ->bindValue(':lang', $lang);

            return $query->execute();
    }
    public function addImgOneMultiLangsII($table, $field, $img, $imgTitle, $imgWidth, $imgHeight, $imgWidth2, $imgHeight2, $imgWidth3, $imgHeight3, $id, $idRelField, $lang, $textpage=0) {
            if ($textpage) {
				$tableContent = 'content';
			} else {
				$tableContent = $table.'_content';
			}
			
			$query = Yii::$app->db->createCommand('UPDATE
                    `'.$table.'`, `'.$tableContent.'`
            SET
                    `'.$field.'` = :img,
                    `'.$field.'Title` = :imgTitle,
                    `'.$field.'Width` = :imgWidth,
                    `'.$field.'Height` = :imgHeight,
                    `'.$field.'Width2` = :imgWidth2,
                    `'.$field.'Height2` = :imgHeight2,
                    `'.$field.'Width3` = :imgWidth3,
                    `'.$field.'Height3` = :imgHeight3
            WHERE
                    `id` = :id AND
                    `'.$idRelField.'` = `id` AND
					`lang` = :lang')
            ->bindValue(':img', $img)
            ->bindValue(':imgTitle', $imgTitle)
            ->bindValue(':imgWidth', $imgWidth)
            ->bindValue(':imgHeight', $imgHeight)
            ->bindValue(':imgWidth2', $imgWidth2)
            ->bindValue(':imgHeight2', $imgHeight2)
            ->bindValue(':imgWidth3', $imgWidth3)
            ->bindValue(':imgHeight3', $imgHeight3)
            ->bindValue(':id', $id)
            ->bindValue(':lang', $lang);

            return $query->execute();
    }
    public function addImgOneMultiLangsSBKII($table, $field, $img, $imgTitle, $imgWidth, $imgHeight,$id, $idRelField, $lang, $textpage=0) {
        if ($textpage) {
            $tableContent = 'content';
        } else {
            $tableContent = $table.'_content';
        }

        $query = Yii::$app->db->createCommand('UPDATE
                    `'.$table.'`, `'.$tableContent.'`
            SET
                    `'.$field.'` = :img,
                    `'.$field.'Title` = :imgTitle,
                    `'.$field.'Width` = :imgWidth,
                    `'.$field.'Height` = :imgHeight

            WHERE
                    `id` = :id AND
                    `'.$idRelField.'` = `id` AND
					`lang` = :lang')
            ->bindValue(':img', $img)
            ->bindValue(':imgTitle', $imgTitle)
            ->bindValue(':imgWidth', $imgWidth)
            ->bindValue(':imgHeight', $imgHeight)

            ->bindValue(':id', $id)
            ->bindValue(':lang', $lang);

        return $query->execute();
    }


    public function addImgOneMultiLangsIII($table, $field, $img, $imgTitle, $imgWidth, $imgHeight, $imgWidth2, $imgHeight2, $imgWidth3, $imgHeight3,$imgWidth4, $imgHeight4, $id, $idRelField, $lang, $textpage=0) {
        if ($textpage) {
            $tableContent = 'content';
        } else {
            $tableContent = $table.'_content';
        }

        $query = Yii::$app->db->createCommand('UPDATE
                    `'.$table.'`, `'.$tableContent.'`
            SET
                    `'.$field.'` = :img,
                    `'.$field.'Title` = :imgTitle,
                    `'.$field.'Width` = :imgWidth,
                    `'.$field.'Height` = :imgHeight,
                    `'.$field.'Width2` = :imgWidth2,
                    `'.$field.'Height2` = :imgHeight2,
                    `'.$field.'Width3` = :imgWidth3,
                    `'.$field.'Height3` = :imgHeight3,
                    `'.$field.'Width3` = :imgWidth4,
                    `'.$field.'Height3` = :imgHeight4
            WHERE
                    `id` = :id AND
                    `'.$idRelField.'` = `id` AND
					`lang` = :lang')
            ->bindValue(':img', $img)
            ->bindValue(':imgTitle', $imgTitle)
            ->bindValue(':imgWidth', $imgWidth)
            ->bindValue(':imgHeight', $imgHeight)
            ->bindValue(':imgWidth2', $imgWidth2)
            ->bindValue(':imgHeight2', $imgHeight2)
            ->bindValue(':imgWidth3', $imgWidth3)
            ->bindValue(':imgHeight3', $imgHeight3)
            ->bindValue(':imgWidth4', $imgWidth4)
            ->bindValue(':imgHeight4', $imgHeight4)
            ->bindValue(':id', $id)
            ->bindValue(':lang', $lang);

        return $query->execute();
    }
    public function addDocFileMultiLangs($table, $field, $file, $fileTitle, $id, $idRelField, $lang, $textpage=0) {
            if ($textpage) {
				$tableContent = 'content';
			} else {
				$tableContent = $table.'_content';
			}
			
			$query = Yii::$app->db->createCommand('UPDATE
                    `'.$table.'`, `'.$tableContent.'`
            SET
                    `'.$field.'` = :file,
                    `'.$field.'Title` = :fileTitle
            WHERE
                    `id` = :id AND
                    `'.$idRelField.'` = `id` AND
					`lang` = :lang')
            ->bindValue(':file', $file)
            ->bindValue(':fileTitle', $fileTitle)
            ->bindValue(':id', $id)
            ->bindValue(':lang', $lang);

            return $query->execute();
    }

    public function updateImgOne($table, $field, $imgTitle, $id) {
            $query = Yii::$app->db->createCommand('UPDATE
                    `'.$table.'`
            SET
                    `'.$field.'Title` = :imgTitle
            WHERE
                    `id` = :id')
            ->bindValue(':imgTitle', $imgTitle)
            ->bindValue(':id', $id);

            return $query->execute();
    }
    public function updateImgOneMultiLangs($table, $field, $imgTitle, $id, $idRelField, $lang, $textpage=0) {
            if ($textpage) {
				$tableContent = 'content';
			} else {
				$tableContent = $table.'_content';
			}
			
			$query = Yii::$app->db->createCommand('UPDATE
                    `'.$tableContent.'`
            SET
                    `'.$field.'Title` = :imgTitle
            WHERE
                    `'.$idRelField.'` = :id AND
					`lang` = :lang')
            ->bindValue(':imgTitle', $imgTitle)
            ->bindValue(':id', $id)
            ->bindValue(':lang', $lang);

            return $query->execute();
    }

    public function deleteImgOne($table, $field, $id) {
            // удаляем с диска
            $query = Yii::$app->db->createCommand('SELECT
                    `'.$field.'`
            FROM
                    `'.$table.'`
            WHERE
                    `id` = :id')
            ->bindValue(':id', $id);

            $fileName = $query->queryScalar();

            $filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/'.$table.'/original-'.$fileName;
            $this->deleteImgFromDisk($filePath);

            $filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/'.$table.'/medium-'.$fileName;
            $this->deleteImgFromDisk($filePath);

            // обновляем данные в БД
            $query = Yii::$app->db->createCommand('UPDATE
                    `'.$table.'`
            SET
                    `'.$field.'` = "",
                    `'.$field.'Title` = "",
                    `'.$field.'Width` = 0,
                    `'.$field.'Height` = 0
            WHERE
                    `id` = :id')
            ->bindValue(':id', $id);

            return $query->execute();
    }
    public function deleteImgOneMultiLangs($table, $field, $id) {
            // удаляем с диска
            $query = Yii::$app->db->createCommand('SELECT
                    `'.$field.'`
            FROM
                    `'.$table.'`
            WHERE
                    `id` = :id')
            ->bindValue(':id', $id);

            $fileName = $query->queryScalar();

            //$filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/'.$table.'/original-'.$fileName;
            //$this->deleteImgFromDisk($filePath);

            $filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/'.$table.'/general-'.$fileName;
            $this->deleteImgFromDisk($filePath);

            $filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/'.$table.'/preview-'.$fileName;
            $this->deleteImgFromDisk($filePath);

            $filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/'.$table.'/searchPreview-'.$fileName;
            $this->deleteImgFromDisk($filePath);

            // обновляем данные в БД
            $query = Yii::$app->db->createCommand('UPDATE
                    `'.$table.'`
            SET
                    `'.$field.'` = "",
                    `'.$field.'Width` = 0,
                    `'.$field.'Height` = 0
            WHERE
                    `id` = :id')
            ->bindValue(':id', $id);

            return $query->execute();
    }
    public function deleteDocOneMultiLangs($table, $field, $id) {
            // удаляем с диска
            $query = Yii::$app->db->createCommand('SELECT
                    `'.$field.'`
            FROM
                    `'.$table.'`
            WHERE
                    `id` = :id')
            ->bindValue(':id', $id);

            $fileName = $query->queryScalar();

            $filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/'.$table.'/original-'.$fileName;
            $this->deleteImgFromDisk($filePath);

            // обновляем данные в БД
            $query = Yii::$app->db->createCommand('UPDATE
                    `'.$table.'`
            SET
                    `'.$field.'` = ""
            WHERE
                    `id` = :id')
            ->bindValue(':id', $id);

            return $query->execute();
    }

    public function getImgMany($table, $idRelField, $idRelValue) {
            $query = Yii::$app->db->createCommand('SELECT
                    `id`, `img`, `imgTitle`, `order`
            FROM
                    `'.$table.'`
            WHERE
                    `'.$idRelField.'` = :idRelValue
            ORDER BY
                    `order`')
            ->bindValue(':idRelValue', $idRelValue);

            return $query->queryAll();
    }
    public function getImgManyMultiLangs($table, $idRelField, $idRelValue, $lang, $noOrder=0) {
            $order = 'ORDER BY
                    `order`';
			
			if ($noOrder) {
				$order='';
			}
			
			$query = Yii::$app->db->createCommand('SELECT
                    `id`, `img`, `imgTitle`, `order`
            FROM
                    `'.$table.'`, `'.$table.'_content`
            WHERE
                    `'.$idRelField.'` = :idRelValue AND
                    `idImg` = `id` AND
					`lang` = :lang
            '.$order)
            ->bindValue(':idRelValue', $idRelValue)
            ->bindValue(':lang', $lang);

            return $query->queryAll();
    }

    public function addImgMany($table, $idRelField, $idRelValue, $img, $imgTitle, $imgWidth, $imgHeight) {
            $query = Yii::$app->db->createCommand('INSERT INTO
                    `'.$table.'`
                            (`'.$idRelField.'`, `img`, `imgTitle`, `imgWidth`, `imgHeight`)
            VALUES
                    (:idRelValue, :img, :imgTitle, :imgWidth, :imgHeight)')
            ->bindValue(':idRelValue', $idRelValue)
            ->bindValue(':img', $img)
            ->bindValue(':imgTitle', $imgTitle)
            ->bindValue(':imgWidth', $imgWidth)
            ->bindValue(':imgHeight', $imgHeight);

            return $query->execute();
    }
    public function addImgManyMultiLangs($table, $idRelField, $idRelValue, $img, $imgTitle, $imgWidth, $imgHeight, $lang) {
            $query = Yii::$app->db->createCommand('INSERT IGNORE INTO
                    `'.$table.'`
                            (`'.$idRelField.'`, `img`, `imgWidth`, `imgHeight`)
            VALUES
                    (:idRelValue, :img, :imgWidth, :imgHeight)')
            ->bindValue(':idRelValue', $idRelValue)
            ->bindValue(':img', $img)
            ->bindValue(':imgWidth', $imgWidth)
            ->bindValue(':imgHeight', $imgHeight);

            $result = $query->execute();

			$lastInsertId = (int)Yii::$app->db->lastInsertID;
			
            if ($lastInsertId) {
				$query = Yii::$app->db->createCommand('INSERT INTO
                    `'.$table.'_content`
                            (`idImg`, `lang`, `imgTitle`)
				VALUES
						(:idImg, :lang, :imgTitle)')
				->bindValue(':idImg', $lastInsertId)
				->bindValue(':lang', $lang)
				->bindValue(':imgTitle', $imgTitle);

				$result1 = $query->execute();
				
				// пустые записи для оставшихся языков
				$allLangs = $this->getAllLangs();
				$values = [];
				foreach ($allLangs as $item) {
					$values[] = $item['sName'];
				}
				array_splice($values, array_search($lang, $values), 1);
				
				$query = Yii::$app->db->createCommand('INSERT INTO
					`'.$table.'_content`
						(`idImg`, `lang`)
				VALUES
					(:idImg, "'.$values[0].'"),
					(:idImg, "'.$values[1].'")')
				->bindValue(':idImg', $lastInsertId)
				->execute();
			}

            return $result;
    }
    public function addImgManyMultiLangsI($table, $idRelField, $idRelValue, $img, $imgTitle, $imgAlt,
		$imgWidth, $imgHeight, $imgWidth2, $imgHeight2, $imgWidth3, $imgHeight3, $imgWidth4, $imgHeight4, $lang) {
            $query = Yii::$app->db->createCommand('INSERT IGNORE INTO
                    `'.$table.'`
                            (`'.$idRelField.'`, `img`, `imgWidth`, `imgHeight`, `imgWidth2`, `imgHeight2`, `imgWidth3`, `imgHeight3`, `imgWidth4`, `imgHeight4`)
            VALUES
                    (:idRelValue, :img, :imgWidth, :imgHeight, :imgWidth2, :imgHeight2, :imgWidth3, :imgHeight3, :imgWidth4, :imgHeight4)')
            ->bindValue(':idRelValue', $idRelValue)
            ->bindValue(':img', $img)
            ->bindValue(':imgWidth', $imgWidth)
            ->bindValue(':imgHeight', $imgHeight)
            ->bindValue(':imgWidth2', $imgWidth2)
            ->bindValue(':imgHeight2', $imgHeight2)
            ->bindValue(':imgWidth3', $imgWidth3)
            ->bindValue(':imgHeight3', $imgHeight3)
            ->bindValue(':imgWidth4', $imgWidth4)
            ->bindValue(':imgHeight4', $imgHeight4);

            $result = $query->execute();

			$lastInsertId = (int)Yii::$app->db->lastInsertID;
			
            if ($lastInsertId) {
				$query = Yii::$app->db->createCommand('INSERT INTO
                    `'.$table.'_content`
                            (`idImg`, `lang`, `imgTitle`, `imgAlt`)
				VALUES
						(:idImg, :lang, :imgTitle, :imgAlt)')
				->bindValue(':idImg', $lastInsertId)
				->bindValue(':lang', $lang)
				->bindValue(':imgTitle', $imgTitle)
				->bindValue(':imgAlt', $imgAlt);

				$result1 = $query->execute();
				
				// пустые записи для оставшихся языков
				$allLangs = $this->getAllLangs();
				$values = [];
				foreach ($allLangs as $item) {
					$values[] = $item['sName'];
				}
				array_splice($values, array_search($lang, $values), 1);
				
				$query = Yii::$app->db->createCommand('INSERT INTO
					`'.$table.'_content`
						(`idImg`, `lang`, `imgAlt`)
				VALUES
					(:idImg, "'.$values[0].'", :imgAlt),
					(:idImg, "'.$values[1].'", :imgAlt)')
				->bindValue(':idImg', $lastInsertId)
				->bindValue(':imgAlt', $imgAlt)
				->execute();
			}

            return $result;
    }
    public function addDocFilesMultiLangs($table, $idRelField, $idRelValue, $img, $imgTitle, $lang) {
            $query = Yii::$app->db->createCommand('INSERT IGNORE INTO
                    `'.$table.'`
                            (`'.$idRelField.'`, `img`)
            VALUES
                    (:idRelValue, :img)')
            ->bindValue(':idRelValue', $idRelValue)
            ->bindValue(':img', $img);

            $result = $query->execute();

			$lastInsertId = (int)Yii::$app->db->lastInsertID;
			
            if ($lastInsertId) {
				$query = Yii::$app->db->createCommand('INSERT INTO
                    `'.$table.'_content`
                            (`idImg`, `lang`, `imgTitle`)
				VALUES
						(:idImg, :lang, :imgTitle)')
				->bindValue(':idImg', $lastInsertId)
				->bindValue(':lang', $lang)
				->bindValue(':imgTitle', $imgTitle);

				$result1 = $query->execute();
				
				// пустые записи для оставшихся языков
				$allLangs = $this->getAllLangs();
				$values = [];
				foreach ($allLangs as $item) {
					$values[] = $item['sName'];
				}
				array_splice($values, array_search($lang, $values), 1);
				
				$query = Yii::$app->db->createCommand('INSERT INTO
					`'.$table.'_content`
						(`idImg`, `lang`)
				VALUES
					(:idImg, "'.$values[0].'"),
					(:idImg, "'.$values[1].'")')
				->bindValue(':idImg', $lastInsertId)
				->execute();
			}

            return $result;
    }

    public function updateImgMany($table, $imgTitle, $order, $id) {
            $query = Yii::$app->db->createCommand('UPDATE
                    `'.$table.'`
            SET
                    `imgTitle` = :imgTitle,
                    `order` = :order
            WHERE
                    `id` = :id')
            ->bindValue(':imgTitle', $imgTitle)
            ->bindValue(':order', $order)
            ->bindValue(':id', $id);

            return $query->execute();
    }
    public function updateImgManyMultiLangs($table, $imgTitle, $order, $id, $lang) {
            $query = Yii::$app->db->createCommand('UPDATE
                    `'.$table.'`, `'.$table.'_content`
            SET
                    `imgTitle` = :imgTitle,
                    `order` = :order
            WHERE
                    `id` = :id AND
                    `idImg` = `id` AND
					`lang` = :lang')
            ->bindValue(':imgTitle', $imgTitle)
            ->bindValue(':order', $order)
            ->bindValue(':id', $id)
            ->bindValue(':lang', $lang);

            return $query->execute();
    }

    public function deleteImgMany($table, $id) {
            // удаляем с диска
            $query = Yii::$app->db->createCommand('SELECT
                    `img`
            FROM
                    `'.$table.'`
            WHERE
                    `id` = :id')
            ->bindValue(':id', $id);

            $fileName = $query->queryScalar();
            $folder = explode('_', $table);
            $folder = $folder[0];

            //$filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/'.$folder.'/original-'.$fileName;
            //$this->deleteImgFromDisk($filePath);

            $filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/'.$folder.'/medium-'.$fileName;
            $this->deleteImgFromDisk($filePath);

            $filePath = $_SERVER['DOCUMENT_ROOT'].$this->frontendPath.'p/'.$folder.'/preview-'.$fileName;
            $this->deleteImgFromDisk($filePath);

            // обновляем данные в БД
            $query = Yii::$app->db->createCommand('DELETE FROM
                    `'.$table.'`
            WHERE
                    `id` = :id')
            ->bindValue(':id', $id);

            return $query->execute();
    }

    public function deleteImgFromDisk($path) {
            if (is_file($path)) {
                    unlink($path);
            }
    }

    /* Работа с изображениями - конец */



    /* Работа с селектами - начало */

    public function getSelectOptions($table, $field) {
            $query = Yii::$app->db->createCommand('SELECT
                    `id`, `'.$field.'`
            FROM `'.$table.'`');

            return $query->queryAll();
    }
    public function getSelectOptionsMultiLangs($table, $field, $lang, $moreFields=[]) {
            if (!empty($moreFields)) {
				$moreFieldsStr = '';
				foreach ($moreFields as $moreField) {
					$moreFieldsStr .= ', `'.$moreField.'`';
				}
			} else {
				$moreFieldsStr = '';
			}
			
			$query = Yii::$app->db->createCommand('SELECT
                    `id`, `'.$field.'`'.$moreFieldsStr.'
            FROM
					`'.$table.'`, `'.$table.'_content`
			WHERE
					`id'.ucfirst($table).'` = `id` AND
					`lang` = :lang
			ORDER BY
				`id`')
			->bindValue(':lang', $lang);

            return $query->queryAll();
    }
    public function getSelectTextpagesOptionsMultiLangs($table, $field, $lang, $moreFields=[]) {
        if (!empty($moreFields)) {
            $moreFieldsStr = '';
            foreach ($moreFields as $moreField) {
                $moreFieldsStr .= ', `'.$moreField.'`';
            }
        } else {
            $moreFieldsStr = '';
        }

        $query = Yii::$app->db->createCommand('SELECT
                    `id`, `'.$field.'`'.$moreFieldsStr.'
            FROM
					`pages`, `content`
			WHERE
					`pageId` = `id` AND
					`lang` = :lang
			ORDER BY
				`id`')
            ->bindValue(':lang', $lang);

        return $query->queryAll();
    }
    public function getSelectOptionsBrandsMultiLangs($table, $field, $lang, $order=0) {
            $order = $order ? 'ORDER BY `order`' : '';
			
			$query = Yii::$app->db->createCommand('SELECT
                    `id`, `'.$field.'`
            FROM
					`'.$table.'`, `'.$table.'_content`
			WHERE
					`id'.ucfirst($table).'` = `id` AND
					`lang` = :lang
			'.$order)
			->bindValue(':lang', $lang);

            return $query->queryAll();
    }

    /* Работа с селектами - конец */



    /* Работа со множественными полями - начало */

    public function addManyFieldsElement($table, $idRel) {
            $query = Yii::$app->db->createCommand('INSERT INTO `'.$table.'`
                    (`idRel`, `text`)
            VALUES
                    ('.$idRel.', \'change me\')')->execute();
    }
    public function addManyFieldsElementMultiLangs($table, $idRel, $defLang) {
        $query = Yii::$app->db->createCommand('INSERT INTO `'.$table.'`
            (`idRel`) VALUES (:idRel)')
        ->bindValue(':idRel', $idRel)
        ->execute();

        $lastInsertId = $query[0];

        $query = Yii::$app->db->createCommand('INSERT INTO `'.$table.'_content`
            (`id`, `lang`, `textRel`)
            VALUES (:lastInsertId, :lang, "change me")')
        ->bindValue(':lastInsertId', $lastInsertId)
        ->bindValue(':lang', $defLang)
        ->execute();
    }

    public function getManyFieldsElement($table, $idRel) {
            $query = Yii::$app->db->createCommand('SELECT
                    `text`
            FROM `'.$table.'`
            WHERE `idRel` = '.$idRel);

            return $query->queryAll();
    }
    public function getManyFieldsElementMultiLangs($table, $idRel, $lang, $flatten=null) {
            $query = Yii::$app->db->createCommand('SELECT
                    `text`
            FROM
					`'.$table.'`
            WHERE
					`idRel` = '.$idRel.' AND
					`lang` = :lang')
			->bindValue(':lang', $lang);

            $result = $query->queryAll();
			
			$arr = [];
			if (isset($flatten)) {
				foreach ($result as $item) {
					$arr[] = $item['text'];
				}
				$result = $arr;
			}
			
            return $result;
    }
    public function getManyFieldsElementMultiLangsTags($table, $idRel, $lang) {
            $query = Yii::$app->db->createCommand('SELECT
                    `text`
            FROM
					`'.$table.'`
            WHERE
					`idRel` = '.$idRel.' AND
					`lang` = :lang')
			->bindValue(':lang', $lang);

            return $query->queryAll();
    }
    public function getManyFieldsElementMultiLangsI($table, $idRel, $defLang) {
            $query = Yii::$app->db->createCommand('SELECT a.id, IFNULL(b.textRel, "") AS `text`
            FROM `'.$table.'` a LEFT JOIN `'.$table.'_content` b ON (a.id = b.id AND b.lang = :lang)
            WHERE a.idRel = :id')
            ->bindValue(':id', $idRel)
            ->bindValue(':lang', $defLang);

            return $query->queryAll();
    }

    public function getManyFieldsElementEmpty() {
            return array(
                    array(
                            'text' => 'change me',
                    ),
            );
    }

    public function updateManyFieldsElementI($table, $idRel, $fields) {
            // удаляем
            Yii::$app->db->createCommand('DELETE	FROM `'.$table.'` WHERE `idRel` = '.$idRel)
                    ->execute();

            // обновляем
            $values = array();
            foreach ($fields as $field) {
                    $values[] = '('.$idRel.', \''.addslashes($field).'\')';
            }
            $values = implode(', ', $values);

            if (!$values) return;

            Yii::$app->db->createCommand('INSERT INTO `'.$table.'`
                    (`idRel`, `text`)
            VALUES
                    '.$values)
            ->execute();
    }
    public function updateManyFieldsElementIMultiLangsSimple($table, $idRel, $fields, $lang) {
            // удаляем
            Yii::$app->db->createCommand('DELETE FROM
					`'.$table.'`
			WHERE
					`idRel` = '.$idRel.' AND
					`lang` = :lang')
			->bindValue(':lang', $lang)
             ->execute();

            // обновляем
            $values = array();
            foreach ($fields as $field) {
                    $values[] = '('.$idRel.', :lang, \''.addslashes($field).'\')';
            }
            $values = implode(', ', $values);

            if (!$values) return;

            Yii::$app->db->createCommand('INSERT INTO `'.$table.'`
                    (`idRel`, `lang`, `text`)
            VALUES
                    '.$values)
			->bindValue(':lang', $lang)
            ->execute();
    }
    public function updateManyFieldsElementIMultiLangsTags($table, $idRel, $fields, $lang) {
            // удаляем
            Yii::$app->db->createCommand('DELETE FROM
					`'.$table.'`
			WHERE
					`idRel` = '.$idRel.' AND
					`lang` = :lang')
			->bindValue(':lang', $lang)
             ->execute();

            // обновляем
			$ruAliases = Yii::$app->db->createCommand('SELECT
					`alias`
			FROM
					`'.$table.'`
            WHERE
                    `idRel` = '.$idRel.' AND
					`lang` = "ru"')
            ->queryAll();
			
			$values = array();
            foreach ($fields as $key => $field) {
					if ($lang == 'ru') {
						$alias = $this->transliterate(addslashes($field));
					} else if (isset($ruAliases[$key])) {
						$alias = $ruAliases[$key]['alias'];
					} else {
						$alias = '';
					}
                    $values[] = '('.$idRel.', :lang, "'.addslashes($field).'", "'.$alias.'")';
            }
            $values = implode(', ', $values);

            if (!$values) return;

            Yii::$app->db->createCommand('INSERT INTO `'.$table.'`
                    (`idRel`, `lang`, `text`, `alias`)
            VALUES
                    '.$values)
			->bindValue(':lang', $lang)
            ->execute();
    }
    public function updateManyFieldsElementIMultiLangs($defLang, $table, $idRel, $fields) {
            // удаляем
            Yii::$app->db->createCommand('DELETE FROM `'.$table.'_content` WHERE id = :id AND lang = :lang')
            ->bindValue(':id', $idRel)
            ->bindValue(':lang', $defLang)
            ->execute();

            // обновляем
            $values = array();
            foreach ($fields as $field) {
                    $values[] = '('.$idRel.', "'.$defLang.'",\''.$field.'\')';
            }
            $values = implode(', ', $values);

            if (!$values) return;

            Yii::$app->db->createCommand('INSERT INTO `'.$table.'_content`
                    (`id`, `lang`, `textRel`)
            VALUES
                    '.$values)
            ->execute();
    }

    /* Работа со множественными полями - конец */



    /* Работа с группой чекбоксов, объединенных промежуточной таблицей
       (связь "многие-ко-многим")
       ChGr:CheckboxGroup - начало */

    public function getChGrSourceIds($table, $field) {
            $query = Yii::$app->db->createCommand('SELECT
                    `id`, `'.$field.'`
            FROM
                    `'.$table.'`');

            return $query->queryAll();
    }
    public function getChGrSourceIdsMultiLangs($table, $field, $lang) {
            $query = Yii::$app->db->createCommand('SELECT
                    `id`, `'.$field.'`
            FROM
                    `'.$table.'`, `'.$table.'_content`
			WHERE
					`id'.ucfirst($table).'` = `id` AND
					`lang` = :lang
			ORDER BY
					`id`')
			->bindValue(':lang', $lang);

            return $query->queryAll();
    }

    public function getChGrTargetIds($table, $fieldTargetName, $fieldSourceName, $fieldTargetVal) {
            $query = Yii::$app->db->createCommand('SELECT
                    `'.$fieldSourceName.'`
            FROM
                    `'.$table.'`
            WHERE
                    `'.$fieldTargetName.'` = '.$fieldTargetVal);

            $result = $query->queryAll();

            $ids = array();
            foreach ($result as $item) {
                    $ids[] = $item[$fieldSourceName];
            }

            return $ids;
    }

    public function updateChGrIds($table, $fieldTargetName, $fieldSourceName, $fieldTargetVal, $fieldSourceVals) {
            // удаляем
            $query = Yii::$app->db->createCommand('DELETE FROM
                    `'.$table.'`
            WHERE
                    `'.$fieldTargetName.'` = '.$fieldTargetVal);

            $query->execute();

            if (empty($fieldSourceVals)) return;

            // обновляем
            $values = array();
            foreach ($fieldSourceVals as $item) {
                    $values[] = '('.$fieldTargetVal.', '.$item.')';
            }
            $values = implode(', ', $values);

            $query = Yii::$app->db->createCommand('INSERT INTO
                    `'.$table.'`
                    (`'.$fieldTargetName.'`, `'.$fieldSourceName.'`)
            VALUES
                    '.$values);

            $query->execute();
    }

    /* Работа с группой чекбоксов, объединенных промежуточной таблицей
       (связь "многие-ко-многим")
       ChGr:CheckboxGroup - конец */



    public function getNextTableId($table) {
		$nameDB = Yii::$app->params['nameDB'][YII_ENV];

            $query = Yii::$app->db->createCommand('SHOW TABLE STATUS
            FROM
                    '.$nameDB.'
            WHERE
                    Name = "'.$table.'"');

            $result = $query->queryOne();
			
			return $result['Auto_increment'];
    }
	
	function transliterate($str) {
		$arrRu = ['А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Е', 'е', 'Ё', 'ё',
			'Ж', 'ж', 'З', 'з', 'И', 'и', 'Й', 'й', 'К', 'к', 'Л', 'л', 'М', 'м', 'Н', 'н',
			'О', 'о', 'П', 'п', 'Р', 'р', 'С', 'с', 'Т', 'т', 'У', 'у', 'Ф', 'ф', 'Х', 'х',
			'Ц', 'ц', 'Ч', 'ч', 'Ш', 'ш', 'Щ', 'щ', 'Ъ', 'ъ', 'Ы', 'ы', 'Ь', 'ь', 'Э', 'э',
			'Ю', 'ю', 'Я', 'я', ' '];
		
		$arrEn = ['A', 'a', 'B', 'b', 'V', 'v', 'G', 'g', 'D', 'd', 'E', 'e', 'E', 'e',
			'Zh', 'zh', 'Z', 'z', 'I', 'i', 'Y', 'y', 'K', 'k', 'L', 'l', 'M', 'm', 'N', 'n',
			'O', 'o', 'P', 'p', 'R', 'r', 'S', 's', 'T', 't', 'U', 'u', 'Ph', 'f', 'H', 'h',
			'C', 'c', 'Ch', 'ch', 'Sh', 'sh', 'Sh', 'sh', '', '', 'I', 'i', '', '', 'E', 'e',
			'Yu', 'yu', 'Ya', 'ya', '-'];

		$str = str_replace($arrRu, $arrEn, $str);
		$str = strtolower($str);
		
		return $str;
	}
	
	function underscore2Camelcase($str) {
		$words = explode('_', strtolower($str));

		$camelizedStr = '';
		foreach ($words as $key => $word) {
			if ($key != 0) {
				$camelizedStr .= ucfirst(trim($word));
			} else {
				$camelizedStr .= trim($word);
			}
		}

		return $camelizedStr;
	}
	
	public function updateSitemap() {
		$url = Yii::$app->params['hostName'].'/'.Yii::$app->params['serviceUrls']['api']['self'].'/'.Yii::$app->params['serviceUrls']['api']['sitemap'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
	}
    
}
