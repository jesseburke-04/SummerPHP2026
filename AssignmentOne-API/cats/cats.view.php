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
            <h1>Cat Gallery — Page <?php echo $lessonActivePage; ?></h1>
        </header>

        <main>
            <section class="cat-grid">
                <?php foreach ($lessonCatRecords as $singleCatObject): ?>
                    <?php 
                        $rawBreed = $singleCatObject->breeds[0]->name ?? null;
                        $breedName = !empty($rawBreed) ? $rawBreed : null;
                    ?>

                    <article class="cat-card">
                        <?php if ($breedName): ?>
                             <figure>
                                <img src="<?php echo htmlspecialchars($singleCatObject->url ?? ''); ?>" alt="A cat">
                                <figcaption><?php echo htmlspecialchars($breedName); ?></figcaption>
                            </figure>
                        <?php else: ?>
                            <img src="<?php echo htmlspecialchars($singleCatObject->url ?? ''); ?>" alt="A cat">
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </section>
        </main>

        <footer>
            <nav class="pagination">
                <?php
                    $previousStep = max(0, $lessonActivePage - 1);
                    $nextStep = $lessonActivePage + 1;

                    if ($lessonActivePage > 0) {
                        echo "<a href='?page={$previousStep}'>&laquo; Previous</a>";
                    }
                    echo "<a href='?page={$nextStep}'>Next &raquo;</a>";
                ?>
            </nav>
        </footer>
    </body>
</html>