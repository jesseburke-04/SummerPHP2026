<?php
    require_once "config.php";
    require_once "CatHandler.php";

    $lessonActivePage = isset($_GET['page']) ? (int)$_GET['page'] : 0;
    $lessonHandlerInstance = new CatHandler(CAT_BASE_URL, CAT_API_KEY);
    $lessonCatRecords = $lessonHandlerInstance->fetchCats($lessonActivePage);

    require_once "views/cats.view.php";
?>