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