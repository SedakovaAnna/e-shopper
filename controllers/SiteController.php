<?php

include_once '/models/Category.php';
include_once '/models/Product.php';

/**
 * Description of SiteController
 *
 * @author Мозг
 */

class SiteController {
    //put your code here
    public function actionIndex() {
        //список категорий
        $categories = array();
        $categories = Category::getCategoryList();
        
        //последние продукты
        $latestProducts = array();
        $latestProducts = Product::getLatestProducts(6);
        
        //подключаем вид
        require_once (ROOT . '/views/site/index.php');
        
        
        
        return true; 
    }
}
