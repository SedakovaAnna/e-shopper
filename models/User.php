<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Мозг
 */
class User {

    public static function register($name, $email, $password) {
        //password_hash — Создает хеш пароля
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO user (name, email, password) '
                . 'VALUES (:name, :email, :password)';
        
        //подготовленный запрос от sql инъекций
        $result = $db->prepare($sql);
        $result -> bindParam(':name', $name, PDO::PARAM_STR);
        $result -> bindParam(':email', $email, PDO::PARAM_STR);
        $result -> bindParam(':password', $password, PDO::PARAM_STR);
        $result -> execute();
        
        return true;
    }
    
    //проверка имени, больше 2 символов
    public static function checkName($name) {
        if(strlen($name)>=2){
            return true;
        }
        return false;
    }
    
    //проверка пароля, больше 6 символов
    public static function checkPassword($password) {
        if(strlen($password)>=6){
            return true;
        }
        return false;
    }
    
    //проверка электронной почты
    public static function checkEmail($email) {
        //filter_var — Фильтрует переменную с помощью определенного фильтра
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }
    
     //проверка электронной почты на существование
    public static function checkEmailExists($email) {

        $db = Db::getConnection();
        
        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';
        
        //подготовленный запрос от sql инъекций
        $result = $db->prepare($sql);
        $result -> bindParam(':email', $email, PDO::PARAM_STR);
        $result -> execute();
        

        if($result->fetchColumn()){
            return true;
        } else {
        return false;
        }
    }
}
