<?php
    /*
    API Controller:
    */
    require_once "config.php";
    require_once "LessonMovieHandler.php";

    $lessonActivePage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $lessonHandlerInstance = new LessonMovieHandler(TMDB_BASE_URL, TMDB_API_KEY);
    $lessonMovieRecords = $lessonHandlerInstance->fetchCurrentPopular($lessonActivePage);

    require_once "views/movies.view.php";
?>