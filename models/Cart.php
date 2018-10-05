<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cart
 *
 * @author Мозг
 */
class Cart {
    public static function addProduct ($id) {
        $id = intval($id);
        
        //Пустой массив для товаров в массиве
        $productInCart = array();
        
        //Если в массиве уже есть товары (они хранятся в сессии)
        
        if (isset($_SESSION['products'])) {
            //то заполним наш массив товарами
            $productInCart = $_SESSION['products'];
        }
        
        //Если товар был в корзине, но был добавлен еще раз, то увеличим количество
        //array_key_exists — Проверяет, присутствует ли в массиве указанный ключ или индекс
        if (array_key_exists($id, $productInCart)){
            $productInCart[$id] ++;
        } else {
            //Добавляем новый товар в корзину
            $productInCart[$id] = 1;
        }
        
        $_SESSION['products'] = $productInCart;
        //echo '<pre>';print_r($_SESSION['products']);die();
        
        return self::countItem();
    }
    
    /**
     * Подсчет товаров в корзине из сессии
     * @return int Description
     */
    
    public static function countItem() {
        if(isset($_SESSION['products'])){
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else {
            return 0;
        }
    }
    
    public static function getProducts() {
        if (isset($_SESSION['products'])){
            return $_SESSION['products'];
        }
        return false;
    }
    
    public static function getTotalPrice($products) {
        $productsInCart = self::getProducts();
        
        if($productsInCart) {
            $total = 0;
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }
        return $total;
    }
}
