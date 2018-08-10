<?php

return array(
    //для строки news/sport/123/ 
    //$1, $2 - ссылки на подмаски из регулярного выражения
    //$1 - ([a-z]+) - категория, $2 - ([0-9]+) - новость
//    'news/([a-z]+)/([0-9]+)' => 'news/view/$1/$2', //actionView в NewsController

//    'news/([0-9]+)' => 'news/view/$1', //actionView в NewsController

//    'news' => 'news/index', //actionIndex в NewsController
//    'products' => 'product/list', //actionList в ProductController
    
    
    'product/([0-9]+)' => 'product/view/$1', //actionView в ProductController
    
    'catalog' => 'catalog/index', //actionIndex в CatalogController
    
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', //actionCatalog в CatalogController
    'category/([0-9]+)' => 'catalog/category/$1', //actionCategory в CatalogController

    'user/register' => 'user/register', //actionRegister в UserController
    'user/login' => 'user/login', //actionLogin в UserController
    'user/logout' => 'user/logout', //actionLogout в UserController
    
    'cabinet/edit' => 'cabinet/edit',//actionEdit в CabinetController
    'cabinet' => 'cabinet/index',//actionIndex в CabinetController
    
    '' => 'site/index', //actionIndex в SiteController
    
);
