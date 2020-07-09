<!doctype html>
<html lang="<?= site()->language() ? site()->language()->code() : 'en' ?>">
<head>
<?php snippet('authors') ?>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title><?= $site->title()->html() ?></title>
  <meta name="description" content="<?= $site->description()->html() ?>">

  <style><?= F::read('assets/css/site.css') ?></style>
</head>

<body
  class="
    page-<?= $page->intendedTemplate() ?>
    <?= r(in_array($page->intendedTemplate(), ['interiors', 'interior']), 'dark') ?>
    font-sans text-color uppercase bg-background
    transition-colors duration-500 ease
  ">

  <div id="nanobar" data-persist></div>

  <header class="fixed top-0 bottom-0 z-10 flex flex-col w-full pointer-events-none">

    <div class="w-full bg-background border-b border-gray-light transition-colors duration-500 ease pointer-events-auto">

      <div class="flex">
        <?= snippet('menu-button') ?>
        
        <a
          href="/"
          class="logo flex flex-grow items-center justify-center sm:w-full p-3 pl-0 sm:p-5 focus:outline-none"
          aria-label="<?= $site->title()->html() ?>">
          <span style="width: 260px;">
            <?= F::read('assets/images/logo.svg') ?>
          </span>
        </a>
      </div>
    
      <div class="info flex flex-col sm:flex-row break-words" data-display="flex"> 
        <div class="w-full sm:w-1/4 md:w-1/2 p-2 pb-3 sm:pr-5px pt-0">
          <?= page('home')->address()->kt()->upper() ?>
        </div>

        <div class="w-full sm:w-3/4 md:w-1/2 p-2 pb-3 sm:pl-3px pt-0">
          <?= page('home')->description()->kt()->upper() ?>
        </div>
      </div>

    </div>

    <?php snippet('menu') ?>

  </header>