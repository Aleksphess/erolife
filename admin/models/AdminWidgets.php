<?php

class AdminWidgets
{
	
    private $stats = array();
	
    function __construct() {
      
        $this->stats['newReviews'] = $this->getNewReviews();
        $this->stats['newCompanyReviews'] = $this->getNewCompanyReviews();
        $this->stats['newOrders'] = $this->getNewOrders();
        $this->stats['newOneClickBuy'] = $this->getNewOneClickBuy();
        $this->stats['newConsultations'] = $this->getNewConsultations();
        $this->stats['newCallbacksRequests'] = $this->getNewCallbacksRequests();
        $this->stats['newCallbacks'] = $this->getNewCallbacks();
    }
    
    function renderWidgets() 
    {
        $res = 'Новых <a href="catalog.php?tabler=&tablei=orders" style="text-decoration:underline">заказов</a>: ' . $this->stats['newOrders'] . '<br/><br/>'
        .'Новых <a href="catalog.php?tabler=&tablei=one_click_buy" style="text-decoration:underline">заказов на покупку в 1 клик</a>: ' . $this->stats['newOneClickBuy'] . '<br/><br/>'
        .'Новых <a href="catalog.php?tabler=&tablei=feedbacks" style="text-decoration:underline">отзывов о товарах</a>: ' . $this->stats['newReviews'] . '<br/><br/>'
        .'Новых <a href="catalog.php?tabler=&tablei=company_feedbacks" style="text-decoration:underline">отзывов о компании</a>: ' . $this->stats['newCompanyReviews'] . '<br/><br/>'
        .'Новых <a href="catalog.php?tabler=&tablei=consultation_requests" style="text-decoration:underline">заказов на консультацию</a>: ' . $this->stats['newConsultations'] . '<br/><br/>'
        .'Новых <a href="catalog.php?tabler=&tablei=callback_requests" style="text-decoration:underline">заказов на обратную связь</a>: ' . $this->stats['newCallbacksRequests'] . '<br/><br/>'
        .'Новых <a href="catalog.php?tabler=&tablei=callbacks" style="text-decoration:underline">заказов обратного звонка</a>: ' . $this->stats['newCallbacks'] . '<br/><br/>';

        return $res;
    }
	
    // Новые отзывы о товарах
    function getNewReviews() 
    {
        $rows = pdoFetchAll("SELECT count(id) as num FROM feedbacks WHERE status = 0");
        return $rows[0]['num'];
    }
	
    // Новые отзывы о компании
    function getNewCompanyReviews() 
    {
        $rows = pdoFetchAll("SELECT count(id) as num FROM company_feedbacks WHERE status = 0");
        return $rows[0]['num'];
    }
	
    // Новые заказы
    function getNewOrders() 
    {
        $rows = pdoFetchAll("SELECT count(id) as num FROM orders WHERE status_id = 3");
        return $rows[0]['num'];
    }
	
    // Новые заказы на покупку в 1 клик
    function getNewOneClickBuy() 
    {
        $rows = pdoFetchAll("SELECT count(id) as num FROM one_click_buy WHERE status = 0");
        return $rows[0]['num'];
    }
	
    // Новые заказы на консультацию
    function getNewConsultations() 
    {
        $rows = pdoFetchAll("SELECT count(id) as num FROM consultation_requests WHERE status = 0");
        return $rows[0]['num'];
    }
	
    // Новые заказы обратной связи
    function getNewCallbacksRequests() 
    {
        $rows = pdoFetchAll("SELECT count(id) as num FROM callback_requests WHERE status = 0");
        return $rows[0]['num'];
    }
	
    // Новые заказы на обратный звонок
    function getNewCallbacks() 
    {
        $rows = pdoFetchAll("SELECT count(id) as num FROM callbacks WHERE status = 0");
        return $rows[0]['num'];
    }
}