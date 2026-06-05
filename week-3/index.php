<?php
/**
 * API Controller
 */

require_once "config.php";
require_once "LessonMovieHandler.php";

// Modified variables to explicitly state "lesson" context
$lessonActivePage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Instantiate using the newly named classroom class
$lessonHandlerInstance = new LessonMovieHandler(TMDB_BASE_URL, TMDB_API_KEY);
$lessonMovieRecords = $lessonHandlerInstance->fetchCurrentPopular($lessonActivePage);

// Include the isolated markup layer
require_once "views/movies.view.php";