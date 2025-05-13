<?php
include_once __DIR__ . "/../models/sales.php";
include_once __DIR__ . "/../views/homepage.php";

class HomepageController{
    public static function execute(){
        SalesModel::initializeDatabase();
        $mainSale = SalesModel::getMainSale();
        HomepageView::Render($mainSale);
    }
}

HomepageController::execute();