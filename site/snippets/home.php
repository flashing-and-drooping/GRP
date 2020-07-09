<?php if ($image = $page->cover()->toFile()) : ?>
<figure class="w-full h-fill mb-3">
  <img
    class="w-full h-full object-cover"
    src="<?= $image->resize(700, 700, 90)->url() ?>"
    srcset="<?= $image->resize(700, 700, 90)->url() ?> 1x, <?= $image->resize(1400, 1400, 90)->url() ?> 2x"
    alt="">
</figure>
<?php endif ?>