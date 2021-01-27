<?php snippet('header') ?>
<?php snippet('intro') ?>
<?php snippet('notification') ?>

<form method="post" action="<?= $page->url() ?>">
  <fieldset>
    <legend><?= $kirby->user()->email() ?></legend>

    <section>
      <label for="email"><?= $page->email()->html() ?></label>
      <input type="email" id="email" name="email" value="<?= esc(get('email')) ?>"
        placeholder="<?= (get('email'))? get('email') : $kirby->user()->email() ?>" autocomplete="email">
    </section>

    <section>
      <label for="password"><?= $page->password()->html() ?></label>
      <input type="password" id="password" name="password" value="<?= esc(get('password')) ?>"
        placeholder="<?= $page->password()->html() ?>" autocomplete="new-password">
    </section>

    <section>
      <input type="submit" name="update" value="<?= $page->button()->html() ?>">
    </section>

  </fieldset>
</form>

<p>
  <?= $page->export()->html() ?> ( <a href="user.json" target="_blank"><abbr
      title="JavaScript Object Notation">JSON</abbr></a> | <a href="user.csv" target="_blank"><abbr
      title="Comma-Separated Values">CSV</abbr></a> )
</p>

<form method="post" action="<?= $page->url() ?>" onsubmit="return confirm('<?= $page->delete_warning()->html() ?>');">
  <fieldset>
    <legend><?=$page->danger()->html() ?></legend>

    <section>
      <input type="submit" name="delete" value="<?= $page->delete_button()->email() ?>">
    </section>

  </fieldset>
</form>

<?php snippet('footer') ?>