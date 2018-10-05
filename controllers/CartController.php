<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CartController
 *
 * @author Мозг
 */
class CartController {

    public function actionAdd($id) {
        
        //Добавляем товар в корзину
        Cart::addProduct($id);
        
        //Возвращаем пользователя на страницу
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }
    
    //Ajax
//     public function actionAddAjax($id) {
//        
//        //Добавляем товар в корзину
//        echo Cart::addProduct($id);
//        return true;
//    }
    
    public function actionIndex() {
        $categories = array();
        $categories = Category::getCategoryList();
        
        $productsInCart = false;
        
        //получим данные из корзины
        $productsInCart = Cart::getProducts();
        
        if ($productsInCart) {
            //получаем полную инфу о товарах из списка
            //array_keys — Возвращает все или некоторое подмножество ключей массива
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductByIds($productsIds);
            
            //получаем общую стоимость товаров
            $totalPrice = Cart::getTotalPrice($products);
        }
        
        require_once (ROOT . '/views/cart/index.php');
        
        return true;
    }
}
