<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CabinetController
 *
 * @author Мозг
 */
class CabinetController {
    
   public function actionIndex() {
        //проверка, что пользователь зашел на сайт
        $userId = User::checkLogged();
        
        //получаем информацию о пользователе из БД
        $user = User::getUserById($userId);

        //подключаем вид
        require_once (ROOT . '/views/cabinet/index.php');
        
        return true; 
    }
    
    public function actionEdit() {

        //проверка, что пользователь зашел на сайт
        $userId = User::checkLogged();
        
        //получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        
        
        $name = $user['name'];
        $password = $user['password'];
        
        $result = false;

        if (isset($_POST['submit'])){
            //htmlentities — Преобразует все возможные символы в соответствующие HTML-сущности
            $name = htmlentities($_POST['name']);
            $password = htmlentities($_POST['password']);
            
            $errors = false;
            
            //проверка на ошибки
            if (!User::checkName($name)){
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if (!User::checkPassword($password)){
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
                        
            if ($errors == false){
                $result = User::edit($userId, $name, $password);
            }
            
        }
        
        //подключаем вид
        require_once (ROOT . '/views/cabinet/edit.php');
        
        return true; 
    }
}
