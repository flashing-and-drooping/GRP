<button
  type="button"
  class="sm:hidden p-2 focus:outline-none"
  aria-controls="menu"
  aria-expanded="<?= r('interiors' === $page->intendedTemplate(), 'true', 'false') ?>"
  aria-label="Toggle menu">
  <div class="relative" style="height: 10px; width: 35px;">
    <span class="absolute top-0 block w-full h-px transform origin-center transition duration-150 bg-gray-light"></span>
    <span class="absolute bottom-0 block w-full h-px transform origin-center transition duration-150 bg-gray-light"></span>
  </div>
</button>