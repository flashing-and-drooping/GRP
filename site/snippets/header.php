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

  <?= css('assets/css/index.css') ?>

  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127006539-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-127006539-1');
</script>

</head>
<body>

  <header class="grid full">

    <div class="grid full header">
		
	<div class="menu-button">
	  <div class="icon">
      	<div class="line"></div>
		<div class="line"></div>
	  </div>
	</div>
	  	
      <div class="grid full logo">
        <img style="width:260px;" src="<?= url('assets/images/logo.svg') ?>" alt="" />
      </div>
  
      <div class="grid full info padding" >
  
        <div class="grid half ">
          <?= page('about')->address()->kt()->upper() ?>
        </div>

  
        <div class="grid half about" style="padding-left:5px">
          <?= page('about')->description()->kt()->upper() ?>
        </div>
  
      </div>

    </div>

    <?php snippet('menu') ?>
    
  </header>