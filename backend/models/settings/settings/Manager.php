<?php
namespace backend\models\settings\settings;

use Yii;
use yii\base\Model;

/**
 * Manager
 */

Class Manager extends Model {
    
    public function getAllManagers()
    {
        $query = Yii::$app->db->createCommand('SELECT
            u.id, u.email, u.username 
        FROM 
            user u
        WHERE 
            u.role = 20
         ORDER BY u.id ASC');
        
        return $query->queryAll();
    }
    
    public function addNewManager($email, $userName, $name, $surname)
    {
        $pass = $this->generatePassword(10);
        $hashPass =Yii::$app->security->generatePasswordHash($pass);
        Yii::$app->security->generateRandomString();
        
        $query = Yii::$app->db->createCommand('INSERT INTO `user`
            (`username`, `email`, `password_hash`, `auth_key`, `role`, `status`, `created_at`,     `updated_at`,      `name`, `surname`) 
            VALUES
            (:userName,  :email,  :password_hash,  :auth_key,  :role,  :status,   UNIX_TIMESTAMP(), UNIX_TIMESTAMP(), :name,  :surname)')
            ->bindValue(':name', $name)
            ->bindValue(':surname', $surname)
            ->bindValue(':userName', $userName)
            ->bindValue(':email', $email)
            ->bindValue(':password_hash', $hashPass)
            ->bindValue(':auth_key', Yii::$app->security->generateRandomString())
            ->bindValue(':role', 20)
            ->bindValue(':status', 10);
        
        if($query->execute()) {
            $send = $this->passToEmail($email, $userName, $pass, $name);
            return Yii::$app->db->lastInsertID;
        }
        return 0;
    }
    
    public function getManager($id) 
    {
        $query = Yii::$app->db->createCommand('SELECT
            u.id, u.email, u.username, u.name, u.surname
        FROM 
            user u
         WHERE 
            u.id = :id')
        ->bindValue(':id', $id);
        
        return $query->queryAll();
    }
    
    public function getEmalCount($id, $email)
    {
        if($id) {
            $query = Yii::$app->db->createCommand('SELECT count(*) AS `count`
            FROM user u
            WHERE u.id <> :id and u.email = :email')
            ->bindValue(':id', $id)
            ->bindValue(':email', $email);
                    
            $emailCount = $query->queryOne();
        } else {
            $query = Yii::$app->db->createCommand('SELECT count(*) AS `count`
            FROM user u
            WHERE u.email = :email')
            ->bindValue(':email', $email);
                    
            $emailCount = $query->queryOne();
        }
        
        return $emailCount['count'];
    }
    
    public function getUserNameCount($id, $userName)
    {
        if($id) {
            $query = Yii::$app->db->createCommand('SELECT count(*) AS `count`
            FROM user u
            WHERE u.id <> :id and u.username = :userName')
            ->bindValue(':id', $id)
            ->bindValue(':userName', $userName);
                    
            $userNameCount = $query->queryOne();
        } else {
            $query = Yii::$app->db->createCommand('SELECT count(*) AS `count`
            FROM user u
            WHERE u.username = :userName')
            ->bindValue(':userName', $userName);
                    
            $userNameCount = $query->queryOne();
        }
        
        return $userNameCount['count'];
    }
    
    public function upDateManager($id, $email, $userName, $name, $surname)
    {
        $query = Yii::$app->db->createCommand('UPDATE `user`
        SET `email` = :email,
            `username` = :userName,
            `name` = :name,
            `surname` = :surname
        WHERE `id` = :id')
        ->bindValue(':id', $id)
        ->bindValue(':email', $email)
        ->bindValue(':userName', $userName)
        ->bindValue(':name', $name)
        ->bindValue(':surname', $surname);
        
        return $query->execute();
    }
    
    protected function generatePassword($number)
    {
        //$number - кол-во символов в пароле
        $arr = array('a','b','c','d','e','f',
                    'g','h','i','j','k','l',
                    'm','n','o','p','r','s',
                    't','u','v','x','y','z',
                    'A','B','C','D','E','F',
                    'G','H','I','J','K','L',
                    'M','N','O','P','R','S',
                    'T','U','V','X','Y','Z',
                    '1','2','3','4','5','6',
                    '7','8','9','0','_','-',
                    '=','+','#','%','&','*');

        // Генерируем пароль
        $pass = "";
        for($i = 0; $i < $number; $i++) {
        // Вычисляем случайный индекс массива
            $index = rand(0, count($arr) - 1);
            $pass .= $arr[$index];
        }

        return $pass;
    }
    
    protected function passToEmail($email, $userName, $pass, $name)
    {  
        //$config = Kohana::$config->load('myconfig');
        $admPanelUri = Yii::$app->homeUrl;
                
        $title = 'Поздравляем, для Вас была создана административная учётная запись на сайте!';
        $mess =  'Уважаемый менеджер '.$name.'

Для Вас была создана административная учётная запись менеджера на сайте

Username: '.$userName.'
Password: '.$pass.'

По адресу http://'.$_SERVER['HTTP_HOST'].'/'.$admPanelUri.' Вы сможете войти в систему управления контентом сайта.

С наилучшими пожеланиями, администрация сайта.';
        // $to - кому отправляем
        $to = $email;

        // $from - от кого
        $from="motor2@motor2.com";

        $headers ="Content-type: text/plain; charset=utf-8"."\r\n" ;
        $headers.='From: '.$from. "\r\n";
        $headers.='MIME-Version: 1.0'."\r\n";
        $headers.='Date: '.date('D, d M Y h:i:s O')."\r\n";
        $headers.="Content-type: text/plain; charset=utf-8". "\r\n";
        // функция, которая отправляет наше письмо.
        return mail($to, $title, $mess, $headers);
    }
    
    public function getManagerAccessList($id)
    {
        $query = Yii::$app->db->createCommand('SELECT
            p.id, p.groupName, IFNULL(al.idPageGroup, 0) AS access FROM
            pagegroup p LEFT OUTER JOIN access_list al ON p.id = al.idPageGroup AND al.idUser = :id
            WHERE p.groupLevel = 1
			-- AND p.hide = 0')
        ->bindValue(':id', $id);
        
        return $query->queryAll();
    }
    
    public function delAccessList($id)
    {
        $query = Yii::$app->db->createCommand('DELETE FROM `access_list` WHERE `idUser`= :id')
        ->bindValue(':id', $id);    
        
        return $query->execute();
    }
    
    public function addAccessList($idUser, $idPageGroup)
    {
        $query = Yii::$app->db->createCommand('INSERT INTO `access_list`
        (`idUser`, `idPageGroup`) 
        VALUES
        (:idUser, :idPageGroup)')
        ->bindValue(':idUser', $idUser)
        ->bindValue(':idPageGroup', $idPageGroup); 
        
        return  $query->execute();
    }
    
    public function delManager($id)
    {
        $query = Yii::$app->db->createCommand('DELETE FROM `user` WHERE `id`= :id')
        ->bindValue(':id', $id);    
        
        return $query->execute();
    }
    
    public function changePwd($id, $newPassword)
    {
        $query = Yii::$app->db->createCommand('UPDATE user
                SET `password_hash` = :password
                where id = :id')
            ->bindValue(':id', $id)
            ->bindValue(':password', $newPassword); 
        
        return $query->execute();
    }
}
?>