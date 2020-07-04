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
  
  <div class="season">

    <?php foreach($collection->images()->sortBy('sort', 'asc') as $image): ?>

      <figure data-i="<?= $collection->slug() ?>" class="grid">
        <img class="a" src="<?php echo url('assets/images/load.jpg') ?>" data-src="<?= $image->resize(2000,2000,90)->url()?>" alt="">
        <figcaption>
          
          <?php if ($image->title()->isNotEmpty()) :?>
            <?= $image->title()->kt() ?>
          <?php endif ?>
          <?php if ($image->description()->isNotEmpty()) :?>
            <?= $image->description()->kt() ?>
          <?php endif ?>
          <?php if ($tearsheet = $image->tearsheet()->toFile()) :?>
           
            <a target="_blank" href="<?= $tearsheet->url() ?>">
              DOWNLOAD TEARSHEET
            </a>

          <?php endif ?>
          <?php if ($image->inquire() == true) :?>
           
            <a href="mailto:info@greenriverprojectllc.com?subject=<?= $image->title() ?>">
              INQUIRE
            </a>

          <?php endif ?>
         
        </figcaption>
      </figure>

    <?php endforeach ?>
    
  </div>
    
<!--     <div style="position:relative;width:100%;clear:both;"></div> -->
      
  <?php endforeach ?>
 <?php endforeach ?>
</ul>