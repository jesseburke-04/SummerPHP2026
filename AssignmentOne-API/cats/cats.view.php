<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Browse popular and random cats using The Cat API">
        <meta name="author" content="Your Name Here">
        <title>Cat Browser</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <h1>Random Cats — Page <?php echo $lessonActivePage; ?></h1>
        </header>

        <main>
            <section class="cat-grid">
                <?php foreach ($lessonCatRecords as $singleCatObject): ?>
                    <article class="cat-card">
                        <figure>
                            <img
                                src="<?php echo htmlspecialchars($singleCatObject->url ?? ''); ?>"
                                alt="A cat"
                            >
                            <?php
                                $breedName = $singleCatObject->breeds[0]->name ?? null;
                                if ($breedName):
                            ?>
                                <figcaption><?php echo htmlspecialchars($breedName); ?></figcaption>
                            <?php endif; ?>
                        </figure>
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