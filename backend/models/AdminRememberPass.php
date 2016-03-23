<?php
namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * AdminRememberPass
 */
class AdminRememberPass extends Model
{
    
    public function checkEmail($email)
    {
        $query = Yii::$app->db->createCommand('SELECT u.id, u.username, u.`name`, u.surname 
            FROM user u
            WHERE u.email = :email AND u.role = :role')
           ->bindValue(':email', $email)
           ->bindValue(':role', 10);
        
        return $query->queryAll();
    }
    
    
    
    public function generatePassword($number)
    {
        //$number - кол-во символов в пароле
        $arr = ['a','b','c','d','e','f',
                'g','h','i','j','k','l',
                'm','n','o','p','r','s',
                't','u','v','x','y','z',
                'A','B','C','D','E','F',
                'G','H','I','J','K','L',
                'M','N','O','P','R','S',
                'T','U','V','X','Y','Z',
                '1','2','3','4','5','6',
                '7','8','9','0','_','-',
                '=','+','#','%','&','*'];

        // Генерируем пароль
        $pass = "";
        for($i = 0; $i < $number; $i++) {
        // Вычисляем случайный индекс массива
                $index = rand(0, count($arr) - 1);
                $pass .= $arr[$index];
        }

        return $pass;
    }
    
    public function updateUserPass($userId, $pass)
    {
        $newPass = Yii::$app->security->generatePasswordHash($pass);
        
        $query = Yii::$app->db->createCommand('UPDATE `user`
            SET `password_hash` = :newPass
            WHERE `id` = :id')
           ->bindValue(':id', $userId)
           ->bindValue(':newPass', $newPass);
        
        return $query->execute();
    }
}
