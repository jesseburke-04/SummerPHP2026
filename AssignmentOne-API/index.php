
<?php
    require_once "config.php";
    require_once "CatHandler.php";
 
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
    $handler = new CatHandler(CAT_BASE_URL, CAT_API_KEY);
    $cats = $handler->fetchCats($page);
 
    require_once "cats/cats.view.php";
?>