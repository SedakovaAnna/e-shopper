<?php

/**
 * Description of NewsController
 *
 * @author Мозг
 */
class NewsController {

    //Список новостей
    public function actionIndex() {
        $newsList = array();
        //вызов метода для получения списка новостей из модели
        $newsList = News::getNewsList();
        //подключение шаблона
        require_once (ROOT. '/views/news/index.php');
        
//        print_r($newsList);
        return TRUE;
    }
    
    //Просмотр одной новости
    public function actionView($id) {
        //вызов метода для получения новости по id из модели
        $newsItem = News::getNewsItemById($id);
        //подключение шаблона
        require_once (ROOT. '/views/news/view.php');

        
//        print_r($newsItem);
        return TRUE;
    }
}
