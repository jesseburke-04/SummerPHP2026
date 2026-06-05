<main>
  <section>
    <h2>Popular Movies Week Five Lesson</h2>
  </section>
  <section>
    <?php 
      foreach($lessonMovieRecords as $singleMovieObject){
        // securely handle text data with htmlspecialchars() to avoid XSS (Cross-Site Scripting)
        $validatedTitle = htmlspecialchars($singleMovieObject->title ?? "Unknown Title");
        $validatedRelease = htmlspecialchars($singleMovieObject->release_date ?? "N/A");
        $validatedDescription =  htmlspecialchars($singleMovieObject->description ?? "No Description");
        $validatedActors = htmlspecialchars($singleMovieObject->main_actors ?? "N/A");
        $validatedGenre = htmlspecialchars($singleMovieObject->genre ?? "Uncategorized");
    ?>
    <div>
      <div>
        <span><?php echo $validatedGenre; ?></span>
        <h3><?php echo $validatedTitle; ?></h3>
        <p><?php echo $validatedRelease; ?></p>
        <p><?php echo $validatedDescription; ?></p>
        <p><?php echo $validatedActors; ?></p>
      </div>
    </div>
    <?php } ?>
  </section>
  <section>
    <div>
      <?php 
        $previousStep = max(1, $lessonActivePage - 1);
        $nextStep = $lessonActivePage + 1;
        if($lessonActivePage > 1){
          echo "<a href='?page={$previousStep}'>Previous Page</a>";
        }
        echo "<a href='?page={$nextStep}'>Next Page</a>";
      ?>
    </div>
  </section>
</main>