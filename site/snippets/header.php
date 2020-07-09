<!doctype html>
<html lang="<?= site()->language() ? site()->language()->code() : 'en' ?>">
<head>
<!-- 







                        ERIC WRENN OFFICE, INC.
                        ERICWRENNOFFICE.COM

                        JON LUCAS
                        JON-L.COM






-->

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title><?= $site->title()->html() ?></title>
  <meta name="description" content="<?= $site->description()->html() ?>">

  <style><?= F::read('assets/css/site.css') ?></style>
</head>
<body
  class="
    page-<?= $page->intendedTemplate() ?>
    <?= r('interiors' === $page->intendedTemplate(), 'dark-theme') ?>
    font-sans text-color bg-background transition-colors duration-500 ease
  ">
  <div id="nanobar" data-persist></div>
  <header class="fixed top-0 bottom-0 z-10 flex flex-col w-full pointer-events-none">
    <div class="w-full bg-background border-b border-gray-light transition-colors duration-500 ease pointer-events-auto">
      <div class="flex">
        <button class="sm:hidden p-2 focus:outline-none" type="button" aria-label="Toggle menu" aria-controls="menu" aria-expanded="false">
          <div class="relative" style="height: 10px; width: 35px;">
            <span class="absolute top-0 block w-full h-px transform origin-center transition duration-150 bg-gray-light"></span>
            <span class="absolute bottom-0 block w-full h-px transform origin-center transition duration-150 bg-gray-light"></span>
          </div>
        </button>
        
        <a href="/" class="logo flex items-center justify-center flex-grow sm:w-full pr-2 sm:p-5 focus:outline-none">
          <span style="width: 260px;">
            <?= F::read('assets/images/logo.svg') ?>
          </span>
        </a>
      </div>
    
      <div class="info flex flex-col sm:flex-row-reverse" data-display="flex">
        <div class="w-full sm:w-1/2 p-2 pt-0">
          <?= page('home')->description()->kt()->upper() ?>
        </div>
  
        <div class="w-full  sm:w-1/2 p-2 pt-0">
          <?= page('home')->address()->kt()->upper() ?>
        </div>
      </div>
    </div>

    <?php snippet('menu') ?>
  </header>

  <div class="sm:flex sm:justify-end">