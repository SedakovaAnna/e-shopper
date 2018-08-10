<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author Мозг
 */
class UserController {

    public function actionRegister() {
        
        $name = '';
        $email = '';
        $password = '';
        
        //если форма отправлена
        if (isset($_POST['submit'])){
            //htmlentities — Преобразует все возможные символы в соответствующие HTML-сущности
            $name = htmlentities($_POST['name']);
            $email = htmlentities($_POST['email']);
            $password = htmlentities($_POST['password']);
            
            $errors = false;
            $result = false;
            
            //проверка на ошибки
            if (!User::checkName($name)){
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if (!User::checkEmail($email)){
                $errors[] = 'Неправильный E-mail';
            }
            if (!User::checkPassword($password)){
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            if (User::checkEmailExists($email)){
                $errors[] = 'Такой E-mail уже существует';
            }
            
            if ($errors == false){
                $result = User::register($name, $email, $password);
            }
            
        }
            
        require_once (ROOT . '/views/user/register.php');
        
        return true;
    }   
    
    
    public function actionLogin() {
        $email = '';
        $password = '';
        
        //если форма отправлена
        if (isset($_POST['submit'])){
            //htmlentities — Преобразует все возможные символы в соответствующие HTML-сущности
            $email = htmlentities($_POST['email']);
            $password = htmlentities($_POST['password']);
            
            $errors = false;
            
            //проверка на ошибки
            if (!User::checkEmail($email)){
                $errors[] = 'Неправильный E-mail';
            }
            if (!User::checkPassword($password)){
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }


            //Проверяем существует ли пользователь
            
            $userId = User::checkUserData($email, $password);
            
            if ($userId == false){
                //Если данные неверные - ошибка
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                User::auth($userId);
                
                //Перенаправляем пользователя в закрытую часть сайта - кабинет
                header("Location: /cabinet/");
            }

        }
            
        require_once (ROOT . '/views/user/login.php');
        
        return true;
        
    }
    /**
     * Удалить данные о пользователе из сессии
     */
    public function actionLogout() {
        unset($_SESSION['user']);
        header("Location: /");
    }
}
