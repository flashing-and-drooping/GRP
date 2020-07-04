<div class="grid half padding nav"><div>

  <?php foreach (page('seasons')->children()->visible() as $season) : ?>
  <ul>
 
    <li><?= $season->title() ?></li>

    <?php foreach ($season->children()->visible() as $collection) : ?>
		<li data-i="<?= $collection->slug() ?>"><?= $collection->title()->html() ?></li>
    <?php endforeach ?>
  </ul>
  <?php endforeach ?>

  <ul>
    <li class="private">PRIVATE RESIDENCES</li>

    <form id="login" action="">
      <label>USERNAME &ensp;<input type="text"></label>
      <br><label>PASSWORD &ensp;<input type="password"></label>
    </form>
  </ul>
</div>