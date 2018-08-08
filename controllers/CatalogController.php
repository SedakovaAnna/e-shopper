<?php
include_once '/models/Category.php';
include_once '/models/Product.php';
include_once '/components/Pagination.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CatalogController
 *
 * @author Мозг
 */
class CatalogController {

    public function actionIndex() {
        //список категорий
        $categories = array();
        $categories = Category::getCategoryList();
        
        //последние продукты
        $latestProducts = array();
        $latestProducts = Product::getLatestProducts(12);
        
        //подключаем вид
        require_once (ROOT . '/views/catalog/index.php');
        
        return true; 
    }
    
    public function actionCategory($categoryId, $page = 1) {
        
        echo $page;
        
        $categories = array();
        $categories = Category::getCategoryList();

        //список товаров по категориям
        $categoryProducts = array();
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);
        
        //количество продуктов в категории
        $total = Product::getTotalProductInCategory($categoryId);
        
        
        //$page - текущая страница
        //Product::SHOW_BY_DEFAULT - количество товаров на странице
        //"page-" - ключ, префикс страницы для навигации
        $pagination = new Pagination ($total, $page, Product::SHOW_BY_DEFAULT, 'page-');
        
        require_once (ROOT . '/views/catalog/category.php');
        
        return true;
        
    }
}
