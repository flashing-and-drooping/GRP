<div
  id="menu"
  class="
    <?= r(in_array($page->intendedTemplate(), ['collections', 'interiors']), 'flex', 'hidden') ?>
    menu sm:flex flex-col sm:flex-grow w-full sm:w-1/4
    bg-background sm:bg-transparent border-b sm:border-0 border-gray-light
    pointer-events-auto
  "
  aria-hidden="<?= r('interiors' === $page->intendedTemplate(), 'false', 'true') ?>"
  data-display="flex">

  <nav class="w-full p-2">

    <?php foreach ($site->children()->visible() as $section) : ?>
    <h2 class="mb-1">
      <a
        href="<?= $section->url() ?>"
        aria-controls="list-<?= $section->uid() ?>"
        aria-expanded="<?= r($section->isOpen(), 'true', 'false') ?>"
        data-ignore="<?= r($section->isOpen(), 'true', 'false') ?>">
        <?= $section->title() ?>
      </a>
    </h2>

    <ul
      id="list-<?= $section->uid() ?>"
      class="<?= r(!$section->isOpen(), 'hidden') ?> mb-1 <?= r($section->title() !== 'Collections', 'ml-1') ?>"
      aria-hidden="<?= r($section->isOpen(), 'false', 'true') ?>">

      <?php foreach ($section->children()->visible() as $item) : ?>

      <li class="mb-1 ml-1">
        <?php if ('year' === $item->intendedTemplate()) : ?>
          
        <?= $item->title()->html() ?>

        <?php else : ?>

        <a href="#<?= $item->slug() ?>" class="inline-block">
          <?= $item->title()->html() ?>
        </a>
        
        <?php endif ?>

        <?php if ($item->children()->visible()->count()) : ?>
        <ul class="">

          <?php foreach ($item->children()->visible() as $subitem) : ?>
          <li class="">
            <a href="#<?= $subitem->slug() ?>">
              <?= $subitem->title()->html() ?>
            </a>
          </li>
          <?php endforeach ?>

        </ul>
        <?php endif ?>

      </li>
      <?php endforeach ?>

    </ul>
    <?php endforeach ?>

  </nav>

  <?php /* echo snippet('private') */ ?>
</div>