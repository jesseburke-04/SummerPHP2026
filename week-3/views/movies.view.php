<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="This week we will be looking at API Integration & OOP">
        <meta name="robots" content="noindex, nofollow">
        <title>Week 3 | APIs & Intro to OOP</title>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Roboto:ital,wght@0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
    </head>
    <body>
        <main class="container py-4">
            
            <section class='row'>
                <h2>Popular Movies (Page <?php echo $lessonActivePage; ?>)</h2>
            </section>
            
            <section class="row">
            <?php
            // The loop now consumes the custom classroom variables and properties
            foreach ($lessonMovieRecords as $singleMovieObject) {
                $validatedTitle = htmlspecialchars($singleMovieObject->title ?? "Unknown Title");
                $validatedRelease = htmlspecialchars($singleMovieObject->release_date ?? "N/A");
                $extractedPoster = $singleMovieObject->poster_path ?? null;
                
                $resolvedImgUrl = $extractedPoster 
                    ? "https://image.tmdb.org/t/p/w500" . htmlspecialchars($extractedPoster) 
                    : "https://via.placeholder.com/100x150.png?text=No+Image";
            ?>
                <div class="sm-col-4 md-col-3 col-lg-3">
                    <img class='movie-img' src='<?php echo $resolvedImgUrl; ?>' alt='<?php echo $validatedTitle; ?> Poster'>
                    <h3><?php echo $validatedTitle; ?></h3>
                    <p>(<?php echo $validatedRelease; ?>)</p>
                </div>
            <?php
            }
            ?>
            </section>

            <!-- Semantic Pagination Container -->
            <section class="row mt-4">
                <div class="col-12">
                    <?php
                    $previousStep = max(1, $lessonActivePage - 1);
                    $nextStep = $lessonActivePage + 1;
                    
                    if ($lessonActivePage > 1) {
                        echo "<a href='?page={$previousStep}' class='btn btn-outline-primary'>&laquo; Previous Page</a> &nbsp;";
                    }
                    echo "<a href='?page={$nextStep}' class='btn btn-primary'>Next Page &raquo;</a>";
                    ?>
                </div>
            </section>

        </main>
    </body>
</html>