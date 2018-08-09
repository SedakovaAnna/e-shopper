<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Front controller

//1. Общие настройки

//Отображение ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

//2. Подключение файлов системы
define('ROOT', dirname(__FILE__));
//require_once (ROOT . '/components/Router.php');

//3. Установка соединения с БД
//require_once (ROOT . '/components/Db.php');

// 4. Автозагрузка классов
require_once (ROOT . '/components/Autoload.php');

// 5. Вызов Router
//создание объекта роутера
$router = new Router();
//вызов метода run объекта класса роутер, передать на него управление
$router->run();