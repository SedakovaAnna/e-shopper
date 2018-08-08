<?php
include_once '/models/Category.php';
include_once '/models/Product.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductController
 *
 * @author Мозг
 */
class ProductController {
    
    public function actionView($productId) {

        $categories = array();
        $categories = Category::getCategoryList();
        
        $product = Product::getProductById($productId);

        require_once (ROOT . '/views/product/view.php');
        
        return true;
    }
}
