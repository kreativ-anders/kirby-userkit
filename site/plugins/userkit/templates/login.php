<?php snippet('header') ?>
<?php snippet('intro') ?>
<?php snippet('userkit/notification') ?>

<form method="post" action="<?= $page->url() ?>">

  <input type="hidden" name="csrf" value="<?= csrf() ?>">

  <fieldset>
    <legend><?= $page->title()->html() ?></legend>

    <section>
      <label for="email"><?= $page->email()->html() ?></label>
      <input type="email" id="email" name="email" value="<?= $data['email'] ?? '' ?>" autocomplete="email" autofocus required>
      <?= isset($alert['email']) ? html($alert['email']) : '' ?>
    </section>

    <section>
      <label for="password"><?= $page->password()->html() ?></label>
      <input type="password" id="password" name="password" value="<?= $data['password'] ?? '' ?>" autocomplete="current-password" required>
      <?= isset($alert['password']) ? html($alert['password']) : '' ?>
    </section>

    <section>
      <input type="submit" name="login" value="<?= $page->button()->html() ?>">
    </section>

  </fieldset>
</form>

<?php snippet('footer') ?>