<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Browser</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <section>
            <h1>Random Cats — Page <?php echo $lessonActivePage; ?></h1>
        </section>
        <section>
            <?php foreach ($lessonCatRecords as $singleCatObject): ?>
            <div>
                <img
                    src="<?php echo htmlspecialchars($singleCatObject->url ?? ''); ?>"
                    alt="A cat"
                    width="300"
                >
                <?php
                    $breedName = $singleCatObject->breeds[0]->name ?? null;
                    if ($breedName):
                ?>
                    <h3><?php echo htmlspecialchars($breedName); ?></h3>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </section>
        <section>
            <?php
                $previousStep = max(0, $lessonActivePage - 1);
                $nextStep = $lessonActivePage + 1;

                if ($lessonActivePage > 0) {
                    echo "<a href='?page={$previousStep}'>&laquo; Previous</a> &nbsp;";
                }
                echo "<a href='?page={$nextStep}'>Next &raquo;</a>";
            ?>
        </section>
    </main>
</body>
</html>