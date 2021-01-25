<?php
/**
 * Templates render the content of your pages. 
 * They contain the markup together with some control structures like loops or if-statements.
 * The `$page` variable always refers to the currently active page. 
 * To fetch the content from each field we call the field name as a method on the `$page` object, e.g. `$page->title()`. * 
 * This default template must not be removed. It is used whenever Kirby cannot find a template with the name of the content file.
 * Snippets like the header, footer and intro contain markup used in multiple templates. They also help to keep templates clean.
 * More about templates: https://getkirby.com/docs/guide/templates/basics
 */
?>
<?php snippet('header') ?>


<header>
  <p><i><?= $page->title()->html() ?></i></p>
</header>

<?php if($error): ?>
<div class="alert"><?= $page->alert()->html() ?></div>
<?php endif ?>

<section>
  <form action="" method="POST">
    <fieldset>
      <legend><?= $page->user()->email(); ?></legend>
      <label for="email"><?= $page->email()->html() ?></label>
      <input class="input" name="email" type="email" placeholder="<?= (get('email'))? get('email') : $kirby->user()->email() ?>">
      <br>
      <label for="password"><?= $page->password()->html() ?></label>
      <input class="input" type="password" name="password" pattern=".{8,}" placeholder="<?= $page->password()->html() ?>">
      <br>
      <input type="submit" name="update" value="<?= $page->button()->html() ?>">
    </fieldset>
  </form>


</section>
<hr>
<footer>
  <ul>
    <li><a href="user.json" target="_blank">meine Daten als JSON anfordern</a></li>
    <li><a href="user.csv" class="button" target="_blank">meine Daten als CSV anfordern</a></li>
  </ul>
  <form action="user" method="POST" onsubmit="return confirm('<?= $page->delete_warning()->html(); ?>');">
    <div class="buttons">
      <input type="submit" name="delete" value="<?= $page->delete_button()->email(); ?>" />
    </div>
  </form>
</footer>

<?php snippet('footer') ?>