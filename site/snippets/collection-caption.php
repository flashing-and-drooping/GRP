<figcaption class="mt-5px px-1 sm:px-0">

  <?php if ($image->title()->isNotEmpty()) : ?>
    <?= $image->title()->kt() ?>
  <?php endif ?>

  <?php if ($image->description()->isNotEmpty()) : ?>
    <?= $image->description()->kt() ?>
  <?php endif ?>

  <?php if ($tearsheet = $image->tearsheet()->toFile()) : ?>
    <a href="<?= $tearsheet->url() ?>" class="hidden sm:inline-block" download>
      Download Tearsheet
    </a>
  <?php endif ?>

  <?php if ($image->inquire()->isTrue()) : ?>
    <a href="mailto:info@greenriverprojectllc.com?subject=<?= $image->title() ?>">
      Inquire
    </a>
  <?php endif ?>

</figcaption>