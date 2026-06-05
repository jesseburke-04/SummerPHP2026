<?php 
  require_once "config.php";
  require_once "Database.php";
  require_once "MovieCrud.php";
  $lessonActivePage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  // 1. Instantiate our Database manage tool using the constants from config.php
  $dbEngine = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
  // 2. Ask the database manager to run its connect action and save its connection output
  $activeConnection = $dbEngine->connect();
  // 3. Create our CRUD worker class, and inject the connection directly into its hands
  $movieWorker = new MovieCrud($activeConnection);
  // 4. Tell the worker class to fetch the rows for the specific page requested
  $lessonMovieRecords = $movieWorker->readAllPopular($lessonActivePage);
  // 5. Now show our work
  require "templates/header.php";
  require "views/movies.view.php";
  require "templates/footer.php";
?>