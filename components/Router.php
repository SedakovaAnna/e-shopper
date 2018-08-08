<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Router
 *
 * @author Anna
 */
class Router {
    
    //$routes - массив, в котором хранятся маршруты
    //из файла routes.php с маршрутами в виде массива в папке config
    private $routes;
    
    //конструктор класса
    public function __construct() {
        //путь к роутам
        $routesPatch = ROOT . '/config/routes.php';
        //свойству присваиваем массив с роутами
        $this->routes = include ($routesPatch);
    }
    
    /**
     * метод для получения URI
     * Returns request string
     * @return string
     */
    private function getURI(){
        if (!empty($_SERVER['REQUEST_URI'])) {
       //trim — Удаляет пробелы (или другие символы) из начала и конца строки 
           return trim($_SERVER['REQUEST_URI'], '/');
       }
    }

    //метод, принимает управление от front controller
    public function run() {
        
        //1.Получить строку запроса из закрытого метода
        $uri = $this->getURI();
       
        //2.Проверить наличие такого запроса в routes.php
        //$this->routes - массив с роутами
        //$uriPattern - ключ news
        //$path - значение new/index
        foreach ($this->routes as $uriPattern => $path) {
            
            //preg_match — Выполняет проверку на соответствие регулярному выражению
            // ~ - разделители в регулярном выражении
            if (preg_match("~$uriPattern~", $uri)) {
                
                //Получаем внутренний путь из внешнего согласно правилу
                //preg_replace — Выполняет поиск и замену по регулярному выражению
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                //3.Если есть совпадение, определить какой контроллер
                //и action обрабатывают запрос
                
                //explode — Разбивает строку с помощью разделителя, вернет массив
                $segments = explode('/', $internalRoute);
                
                //array_shift — Извлекает первый элемент массива и удаляет его
                $controllerName = array_shift($segments).'Controller';
                
                //ucfirst — Преобразует первый символ строки в верхний регистр
                $controllerName = ucfirst($controllerName);
                $actionName = 'action' .ucfirst(array_shift($segments));
                
                $parameters = $segments;
                
                //4.Подключить файл класса контроллера

                $controllerFile = ROOT . '/controllers/' .
                        $controllerName . '.php';
                
                //file_exists — Проверяет существование указанного
                //файла или каталога
                if (file_exists($controllerFile)) {
                    include_once ($controllerFile); 
                }

                //5.Создать объект, вызвать метод action класса controler

                $controllerObject = new $controllerName; //создать объект
                
                //call_user_func_array — Вызывает callback-функцию с массивом параметров
                //Вызывает метод $actionName в классе $controllerObject 
                //и передает в метод параметры из массива $parameters
                //$controllerObject->actionName($param1, $param2,...)
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                
//                $result = $controllerObject->$actionName();
                //метод возвращает true и выход из цикла
                if($result != NULL){
                    break;
                }
                
            }

        }
        
    }
    
}
