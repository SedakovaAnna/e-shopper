<?php

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
    
    public function actionContact() {
        $userEmail = '';
        $userText = '';
        $result = '';
        
        if (isset($_POST['submit'])) {
            $userEmail = htmlentities($_POST['userEmail']);
            $userText = htmlentities($_POST['userText']);

            $errors = false;
            
            //Валидация полей
            
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный Email';
            }
            
            if ($errors == false) {
                $mail = 'tuzik198@mail.ru';
                $subject = 'Сообщение с сайта e-shopper';
                $message = "Текст: {$userText}. От {$userEmail}";
                $result = mail($message, $subject, $mail);
                $result = true;
            }
        }
        
        require_once (ROOT . '/views/site/contact.php');
        
        return true;
        
    }
}
