<?php snippet('header') ?>
<?php snippet('intro') ?>
<?php snippet('notification') ?>

<form method="post" action="<?= $page->url() ?>">
  <fieldset>
    <legend><?= $page->title()->html() ?></legend>

    <section>
      <label for="email"><?= $page->email()->html() ?></label>
      <input type="email" id="email" name="email" value="<?= esc(get('email')) ?>" autocomplete="email" autofocus
        required>
    </section>

    <section>
      <label for="password"><?= $page->password()->html() ?></label>
      <input type="password" id="password" name="password" value="<?= esc(get('password')) ?>"
        autocomplete="new-password" required>
    </section>

    <section>
      <input type="submit" name="register" value="<?= $page->button()->html() ?>">
    </section>

  </fieldset>
</form>

<?php snippet('footer') ?>