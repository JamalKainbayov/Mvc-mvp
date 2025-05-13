<?php
include_once __DIR__ . "/../models/sales.php";
include_once __DIR__ . "/../views/homepage.php";

function execute(){
    initializeDatabase();
    $mainSale = getMainSale();
    HomepageView::Render($mainSale);
}

execute();