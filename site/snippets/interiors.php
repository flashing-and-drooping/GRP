<?php foreach ($page->children()->visible() as $interior) : ?>

<div id="<?= $interior->slug() ?>" class="grid">

  <?php foreach ($interior->images()->sortBy('sort', 'asc') as $image) : ?>
  <figure class="<?= r($image->half()->isTrue(), 'figure-half') ?> flex justify-center w-full mb-3">
    <span class="frame" style="--w:<?= $image->width() ?>;--h:<?= $image->height() ?>;">
      <img
        class="lozad"
        data-src="<?= $image->resize(900, 900, 90)->url() ?>"
        data-srcset="<?= $image->resize(900, 900, 90)->url() ?> 1x, <?= $image->resize(1800, 1800, 90)->url() ?> 2x"
        alt="<?= $image->title()->html() ?>">
    </span>
  </figure>
  <?php endforeach ?>

</div>

<?php endforeach ?>