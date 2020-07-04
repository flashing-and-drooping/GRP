<?php snippet('header') ?>

  <main class="grid full">

    <div class="grid half"></div>

    <div class="grid right three-fourths gallery">
      
      <?php isMobile() ? snippet('showcase-mobile') : snippet('showcase') ?>

    </div>

  </main>

<?php snippet('footer') ?>