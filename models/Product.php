<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author Мозг
 */
class Product {

    const SHOW_BY_DEFAULT = 9;
    
    /**
     * Все продукты
     * Returns an array of products
     */
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT) {
        //приведение к int
        $count = intval($count);
        //подключение к БД
        $db = Db::getConnection();
        
        $productList = array();
        
        $result = $db->query('SELECT id, name, price, image, is_new FROM product '
                . 'WHERE status = "1" '
                . 'ORDER BY id DESC '
                . 'LIMIT ' . $count);
        
        $i = 0;
        //fetch — Извлечение следующей строки из результирующего набора
        while($row = $result->fetch()) {
            $productList[$i]['id'] = $row['id'];
            $productList[$i]['name'] = $row['name'];
            $productList[$i]['image'] = $row['image'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        
        return $productList;
    }
    
    
    /**
     * Выбрать все продукты из заданной категории, постранично
     * @param type $categoryId
     * @param type $page
     * @return type
     */
    public static function getProductsListByCategory($categoryId = false, $page = 1) {
        
        if ($categoryId) {
            
        $page = intval($page);
        //смещение для постраничной навигиции
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        
             //подключение к БД
        $db = Db::getConnection();
        
        $products = array();
        
        $result = $db->query("SELECT id, name, price, image, is_new FROM product "
                . "WHERE status = '1' AND category_id = '$categoryId' " 
                . "ORDER BY id DESC "
                . "LIMIT " . self::SHOW_BY_DEFAULT
                . ' OFFSET ' . $offset);
        
        $i = 0;
        //fetch — Извлечение следующей строки из результирующего набора
        while($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['image'] = $row['image'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        
        }
        return $products;
    }
    
    /**
     * Продукт с выбранным id
     * @param int $id
     */
    public static function getProductById($id) {
        
        $id = intval($id);
        
        if($id){
             //подключение к БД
        $db = Db::getConnection();
        
        $result = $db->query('SELECT * FROM product WHERE id = ' . $id);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        return $result->fetch();
        }
        
    }
    
    
    /**
     * Количество товаров в категории
     * @param int $categoryId
     * @return type
     */
    public static function getTotalProductInCategory($categoryId) {
        
             //подключение к БД
        $db = Db::getConnection();
        
        $result = $db->query('SELECT count(id) AS count FROM product '
                . 'WHERE status = 1 AND category_id = "' . $categoryId . '"');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $row = $result->fetch();
        
        return $row['count'];
    
    }

}