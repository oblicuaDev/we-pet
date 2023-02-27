<?php 
    include '../includes/config.php';
    $news = $wp->get_news();
    echo 'Get_News';
?>