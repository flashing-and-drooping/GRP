<?php snippet('header') ?>

  <main class="grid full">

    <div class="grid half"></div>

    <div class="grid right three-fourths gallery">
      

<?php

require_once './Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? snippet('showcase-mobile') : snippet('showcase-mobile') ) : snippet('showcase') );

?>


      

    </div>


  </main>
  


 

<?php snippet('footer') ?>