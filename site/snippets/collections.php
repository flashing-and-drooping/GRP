<?php foreach ($page->grandChildren()->visible() as $collection) : ?>

<div id="<?= $collection->slug() ?>" class="grid sm:grid-cols-2 md:grid-cols-3 gap-5px">

  <?php foreach ($collection->images()->sortBy('sort', 'asc') as $image) : ?>

  <figure class="w-full mb-3">
    <span class="frame" style="--w:<?= $image->width() ?>;--h:<?= $image->height() ?>">
      <img
        class="lozad w-full"
        data-src="<?= $image->resize(700, 700, 90)->url() ?>"
        data-srcset="<?= $image->resize(700, 700, 90)->url() ?> 1x, <?= $image->resize(1400, 1400, 90)->url() ?> 2x"
        alt="">
    </span>

    <figcaption class="mt-3px px-1 sm:px-0 uppercase">
      <?php if ($image->title()->isNotEmpty()) : ?>
        <?= $image->title()->kt() ?>
      <?php endif ?>
      <?php if ($image->description()->isNotEmpty()) : ?>
        <?= $image->description()->kt() ?>
      <?php endif ?>
      <?php if (! isMobile() && $tearsheet = $image->tearsheet()->toFile()) : ?>
        <a href="<?= $tearsheet->url() ?>" download>
          DOWNLOAD TEARSHEET
        </a>
      <?php endif ?>
      <?php if ($image->inquire()->isTrue()) : ?>
        <a href="mailto:info@greenriverprojectllc.com?subject=<?= $image->title() ?>">
          INQUIRE
        </a>
      <?php endif ?>
    </figcaption>
  </figure>

  <?php endforeach ?>

</div>
    
<?php endforeach ?>