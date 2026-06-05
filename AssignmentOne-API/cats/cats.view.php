
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Browse random popular cats MEMEs, using The Cat API">
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
                <?php foreach ($cats as $cat): ?>
                    <?php
                        $breedName = !empty($cat->breeds[0]->name) ? $cat->breeds[0]->name : null;
                        $altText   = $breedName ? htmlspecialchars($breedName) : 'A cat';
                    ?>
                    <article class="cat-card">
                        <figure>
                            <img src="<?php echo htmlspecialchars($cat->url ?? ''); ?>" alt="<?php echo $altText; ?>">
                            <figcaption><?php echo $breedName ? htmlspecialchars($breedName) : ''; ?></figcaption>
                        </figure>
                    </article>
                <?php endforeach; ?>
            </section>
        </main>
 
        <footer>
            <nav class="pagination">
                <?php
                    $prevPage = max(0, $page - 1);
                    $nextPage = $page + 1;
 
                    if ($page > 0) {
                        echo "<a href='?page={$prevPage}'>&laquo; Previous</a>";
                    }
                    echo "<a href='?page={$nextPage}'>Next &raquo;</a>";
                ?>
            </nav>
        </footer>
    </body>
</html>