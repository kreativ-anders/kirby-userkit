<?php
/*
  Templates render the content of your pages.

  They contain the markup together with some control structures
  like loops or if-statements. The `$page` variable always
  refers to the currently active page.

  To fetch the content from each field we call the field name as a
  method on the `$page` object, e.g. `$page->title()`.

  This default template must not be removed. It is used whenever Kirby
  cannot find a template with the name of the content file.

  Snippets like the header and footer contain markup used in
  multiple templates. They also help to keep templates clean.

  More about templates: https://getkirby.com/docs/guide/templates/basics
*/
?>
<?php snippet('header') ?>

<h1><?= $page->title()->html() ?></h1>

<?php if($error): ?>
<div class="alert"><?= $page->alert()->html() ?></div>
<?php endif ?>

<form method="post" action="<?= $page->url() ?>">
  <div>
    <label for="email"><?= $page->username()->html() ?></label>
    <input type="email" id="email" name="email" value="<?= esc(get('email')) ?>" required>
  </div>
  <div>
    <label for="password"><?= $page->password()->html() ?></label>
    <input type="password" id="password" name="password" value="<?= esc(get('password')) ?>" required>
  </div>
  <div>
    <input type="submit" name="login" value="<?= $page->button()->html() ?>">
  </div>
</form>

<?php snippet('footer') ?>