<?php snippet('header') ?>
<?php snippet('intro') ?>
<?php snippet('notification') ?>

<form method="post" action="<?= $page->url() ?>">
  <fieldset>
    <legend><?= $page->title()->html() ?></legend>

    <section>
      <label for="email"><?= $page->email()->html() ?></label>
      <input type="email" id="email" name="email" value="<?= $data['email'] ?? '' ?>" autocomplete="email" autofocus
        required>
      <?= isset($alert['email']) ? html($alert['email']) : '' ?>
    </section>

    <section>
      <label for="password"><?= $page->password()->html() ?></label>
      <input type="password" id="password" name="password" value="<?= $data['password'] ?? '' ?>" minlength="8"
        autocomplete="new-password" required>
      <?= isset($alert['password']) ? '<span class="alert error">' . html($alert['password']) . '</span>' : '' ?>
    </section>

    <section>
      <input type="submit" name="register" value="<?= $page->button()->html() ?>">
    </section>

  </fieldset>
</form>

<?php snippet('footer') ?>