<!-- This file is responsible for displaying the cat gallery. It loops through the cat data fetched by CatHandler.php. 
Each cat is displayed as a card with an image and a breed name. -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Browse popular and random cats using The Cat API">
        <meta name="robots" content="noindex, nofollow">
        <title>Cat Gallery</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <h1>Cat Gallery — Page <?php echo $page + 1; ?></h1>
        </header>
 
        <main>
            <section class="cat-grid">
                <!-- This loops through each cat and creates a card for it. -->
                <?php
                    foreach($cats as $singleCatObject){
                        $validatedBreed = htmlspecialchars($singleCatObject->breeds[0]->name ?? "");
                        $validatedUrl = htmlspecialchars($singleCatObject->url ?? "");
                        $altText = !empty($validatedBreed) ? $validatedBreed : "A cat";
                ?>
                <article class="cat-card">
                <!-- Couldn't find a better semantic element that we have learned yet. -->
                    <div>
                        <img src="<?php echo $validatedUrl; ?>" alt="<?php echo $altText; ?>">
                        <p><?php echo $validatedBreed; ?></p>
                    </div>
                </article>
                <?php } ?>
            </section>
        </main>
 
        <footer>
            <nav class="pagination">
                <?php
                    $prevPage = max(0, $page - 1);
                    $nextPage = $page + 1;
 
                    if($page > 0){
                        echo "<a href='?page={$prevPage}'>&laquo; Previous</a>";
                    }
                    echo "<a href='?page={$nextPage}'>Next &raquo;</a>";
                ?>
            </nav>
        </footer>
    </body>
</html>