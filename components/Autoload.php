<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Autoload
 * функция автозагрузки классов из папок models, components
 * @author Мозг
 */
function __autoload ($class_name) {
    
    //массив с папками, в которых могут находиться классы
    $array_paths = array(
        '/models/',
        '/components/'
    );
    
    //подключение вызванного класса
    foreach ($array_paths as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
}
