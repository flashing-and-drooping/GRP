<div id="menu" class="
    menu hidden sm:flex flex-col sm:flex-grow w-full sm:w-1/3
    uppercase bg-background sm:bg-transparent border-b sm:border-0 border-gray-light
    transition-colors duration-500 ease-in-out pointer-events-auto
  "
  aria-hidden="true"
  data-display="flex">

  <nav class="w-full p-2">
    <?php foreach ($site->children()->visible() as $section) : ?>

    <h2 class="mb-1">
      <a
        href="<?= $section->url() ?>"
        aria-controls="list-<?= $section->uid() ?>"
        aria-expanded="<?= r($section->isOpen(), 'true', 'false') ?>"
        data-ignore="<?= r($section->isOpen(), 'true', 'false') ?>"
      >
        <?= $section->title() ?>
      </a>
    </h2>

    <ul
      id="list-<?= $section->uid() ?>"
      class="<?= r(!$section->isOpen(), 'hidden') ?> mb-1 ml-1"
      aria-hidden="<?= r($section->isOpen(), 'false', 'true') ?>"
    >
      <?php foreach ($section->children()->visible() as $item) : ?>
      <li class="mb-1">
        <?php if ('year' === $item->intendedTemplate()) : ?>
        <?= $item->title()->html() ?>
        <?php else : ?>
        <a href="#<?= $item->slug() ?>" class="inline-block">
          <?= $item->title()->html() ?>
        </a>
        <?php endif ?>

        <?php if ($item->children()->visible()->count()) : ?>
        <ul class="ml-1">
          <?php foreach ($item->children()->visible() as $subitem) : ?>
          <li class="mt-1">
            <a href="#<?= $subitem->slug() ?>"><?= $subitem->title()->html() ?></a>
          </li>
          <?php endforeach ?>
        </ul>
        <?php endif ?>
      </li>
      <?php endforeach ?>
    </ul>

    <?php endforeach ?>
  </nav>

  <div class="w-full mt-auto p-2">
    <button class="uppercase focus:outline-none" aria-controls="login" aria-expanded="false">Private</button>

    <form id="login" class="hidden w-1/2" aria-hidden="true">
      <label class="block w-full mt-2 mb-1 uppercase">
        Username <input type="text" name="username">
      </label>
      <label class="block w-full mb-1 uppercase">
        Password <input type="password" name="password">
      </label>
    </form>
  </div>
</div>