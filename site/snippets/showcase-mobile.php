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

if(isset($limit)) $seasons = $seasons->limit($limit);

?>

<ul class="showcase grid gutter-1">

  <?php foreach($seasons as $season): ?>
  
  <?php foreach($season->children()->visible() as $collection): ?>

    <?php foreach($collection->images()->sortBy('sort', 'asc') as $image): ?>

      <figure data-i="<?= $collection->slug() ?>" class="grid full">
        <img class="a" src="<?php echo url('assets/images/load.jpg') ?>??" data-src="" data-src-mobile="<?= $image->resize(1000,1000,85)->url()?>" alt="">
        <figcaption>
          
          <?php if ($image->title()->isNotEmpty()) :?>
            <?= $image->title()->kt() ?>
          <?php endif ?>
          <?php if ($image->description()->isNotEmpty()) :?>
            <?= $image->description()->kt() ?>
          <?php endif ?>
          <?php if ($image->inquire() == true) :?>
           
            <a href="mailto:info@greenriverprojectllc.com?subject=<?= $image->title() ?>">
              INQUIRE
            </a>

          <?php endif ?>
         
        </figcaption>
      </figure>

    <?php endforeach ?>
      
  <?php endforeach ?>
  
 <?php endforeach ?>

</ul>