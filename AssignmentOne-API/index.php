
<?php
    //This is the main controller for the Cat API.
    require_once "config.php";
    require_once "CatHandler.php";
    //This gets the current page from the URL, and creates the handler 
    //that fetches the cats for the current page.
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
    $handler = new CatHandler(CAT_BASE_URL, CAT_API_KEY);
    $cats = $handler->fetchCats($page);
 
    require_once "cats/cats.view.php";
?>