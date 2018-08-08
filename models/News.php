<?php

/**
 * Models of News
 *
 * @author Мозг
 */
class News {
    //put your code here
    /**
     * Returns single news item wish specified id
     * @param integer $id
     */
    public static function getNewsItemById($id) {
       
        $id = intval($id);
        
        if ($id){
            //подключение к БД
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM `news` WHERE id = '. $id);

            //возвращает только ассоциативный массив
            $result->setFetchMode(PDO::FETCH_ASSOC);
            //возвращает только нумерованый массив
            //$result->setFetchMode(PDO::FETCH_NUM);


            //fetch — Извлечение строки из результирующего набора
            $newsItem = $result->fetch();

            return $newsItem;
        }
    }
    
    /**
     * Returns an array of news items
     */
    public static function getNewsList() {
//        $host = 'localhost';
//        $dbname = 'mvc_site';
//        $user = 'root';
//        $password = '';
//        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
//        
        //подключение к БД
        $db = Db::getConnection();
            
        $newsList = array();
        
        $result = $db->query('SELECT id, title, date, short_content, author_name '
                . 'FROM news '
                . 'ORDER BY date DESC '
                . 'LIMIT 10');
        
        $i = 0;
        //fetch — Извлечение следующей строки из результирующего набора
        while($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['short_content'] = $row['short_content'];
            $newsList[$i]['author_name'] = $row['author_name'];

            $i++;
        }
        
        return $newsList;
    }
    
    
}
