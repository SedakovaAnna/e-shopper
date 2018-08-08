<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Category
 *
 * @author Мозг
 */
class Category {
    
     /**
     * Returns an array of Categories
     */
    public static function getCategoryList() {
        
        $db = Db::getConnection();
        
        $categoryList = array();
        
        $result = $db->query('SELECT id, name FROM category '
                . 'ORDER BY sort_order ASC');
        
        $i = 0;
        
        //fetch — Извлечение следующей строки из результирующего набора
        while($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
        
        return $categoryList;
    }
}
