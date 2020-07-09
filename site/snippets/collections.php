<?php foreach ($page->grandChildren()->visible() as $collection) : ?>

<div id="<?= $collection->slug() ?>" class="grid sm:grid-cols-2 md:grid-cols-3 gap-5px">

  <?php foreach ($collection->images()->sortBy('sort', 'asc') as $image) : ?>
  <figure class="w-full mb-3">
    <span class="frame" style="--w:<?= $image->width() ?>;--h:<?= $image->height() ?>">
      <img
        class="lozad w-full"
        data-src="<?= $image->resize(700, 700, 90)->url() ?>"
        data-srcset="<?= $image->resize(700, 700, 90)->url() ?> 1x, <?= $image->resize(1400, 1400, 90)->url() ?> 2x"
        alt="<?= $image->title()->html() ?>">
    </span>

    <?php snippet('collection-caption', ['image' => $image]) ?>
    
  </figure>
  <?php endforeach ?>

</div>
    
<?php endforeach ?>