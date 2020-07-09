<?php snippet('header') ?>

<div class="sm:flex sm:justify-end pt-offset">

  <main class="w-full sm:w-3/4 pb-3">

    <h1 class="sr-only"><?= $page->title()->html() ?></h1>
      
    <?php snippet('collections') ?>

  </main>

</div>

<?php snippet('footer') ?>