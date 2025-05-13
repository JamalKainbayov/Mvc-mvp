<?php

class HomepageView{
    public static function Render($latestSale){
        ?>
        <h1>Welcome to the website!</h1>
        <p>I hope you enjoy this examples</p>
        <?php
        if($latestSale != null){
            ?>
            <h2>Latest sale</h2>
            <h3><?php echo $latestSale["title"]; ?></h3>
            <p><?php echo $latestSale["body"]; ?></p>
            <p>Now for just $<?php echo $latestSale["price"]; ?></p>
            <?php
        }
    }
}