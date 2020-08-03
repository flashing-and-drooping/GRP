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

    <div
  id="menu"
  class="
    <?= r('interiors' === $page->intendedTemplate(), 'flex', 'hidden') ?>
    menu sm:flex flex-col sm:flex-grow w-full sm:w-1/4
    bg-background sm:bg-transparent border-b sm:border-0 border-gray-light
    transition-colors duration-500 ease-in-out pointer-events-auto
  "
  aria-hidden="<?= r('interiors' === $page->intendedTemplate(), 'false', 'true') ?>"
  data-display="flex">

  <nav class="w-full p-2">
	  <ul>
		  <?php foreach ($page->files() as $file) : ?>
		  
		  	<a href="<?= $file->url() ?>">
		  		<li><?= $file->filename() ?></li>
		  	</a>
		  	
		  <?php endforeach ?>
	  </ul>
  </nav>
 
 
  <?= snippet('private') ?>
</div>

  </header>

<div class="sm:flex sm:justify-end pt-offset">

  <main class="w-full sm:w-3/4">
      
<?php if ($image = page('home')->cover()->toFile()) : ?>
<figure class="w-full h-fill mb-3">
  <img
    class="w-full h-full object-cover"
    src="<?= $image->resize(700, 700, 90)->url() ?>"
    srcset="<?= $image->resize(700, 700, 90)->url() ?> 1x, <?= $image->resize(1400, 1400, 90)->url() ?> 2x"
    alt="">
</figure>
<?php endif ?>
  </main>

</div>

<?php snippet('footer') ?>