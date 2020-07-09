<?php snippet('header') ?>

<div class="sm:flex sm:justify-end">

  <main class="w-full sm:w-3/4">
      
    <header>

      <h1><?= $page->title()->html() ?></h1>
      <div><?= $page->intro()->kirbytext() ?></div>

    </header>
      
    <article><?= $page->text()->kirbytext() ?></article>

  </main>

</div>

<?php snippet('footer') ?>