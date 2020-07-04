<?php

$seasons = page('seasons')->children()->visible();

/*

The $limit parameter can be passed to this snippet to
display only a specified amount of seasons:

```
<?php snippet('showcase', ['limit' => 3]) ?>
```

Learn more about snippets and parameters at:
https://getkirby.com/docs/templates/snippets

*/

if (isset($limit)) {
  $seasons = $seasons->limit($limit);
}

?>

<ul class="showcase grid gutter-1">

  <?php foreach ($seasons->children()->visible() as $collection) : ?>
  
  <?php if (! isMobile()) : ?>
  <div class="season">
  <?php endif ?>

    <?php foreach ($collection->images()->sortBy('sort', 'asc') as $image) : ?>

    <figure data-i="<?= $collection->slug() ?>" class="grid">
      <?php if (isMobile()) : ?>
      <img class="a" src="<?= url('assets/images/load.jpg') ?>" data-src data-src-mobile="<?= $image->resize(1000, 1000, 85)->url() ?>" alt="">
      <?php else : ?>
      <img class="a" src="<?= url('assets/images/load.jpg') ?>" data-src="<?= $image->resize(2000, 2000, 90)->url() ?>" alt="">
      <?php endif ?>

      <figcaption>
        <?php if ($image->title()->isNotEmpty()) : ?>
          <?= $image->title()->kt() ?>
        <?php endif ?>
        <?php if ($image->description()->isNotEmpty()) : ?>
          <?= $image->description()->kt() ?>
        <?php endif ?>
        <?php if (! isMobile() && $tearsheet = $image->tearsheet()->toFile()) : ?>
          <a target="_blank" href="<?= $tearsheet->url() ?>">
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
    
  <?php if (! isMobile()) : ?>
  </div>
  <?php endif ?>
      
  <?php endforeach ?>

</ul>