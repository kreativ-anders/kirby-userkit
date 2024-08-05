<?php snippet('header') ?>
<?php snippet('intro') ?>
<?php snippet('notification') ?>

<form method="post" action="<?= $page->url() ?>">

  <input type="hidden" name="csrf" value="<?= csrf() ?>">

  <fieldset>
    <legend><?= $page->title()->html() ?></legend>

    <?php // HONEYPOT ?>
    <section style="position: absolute; left: -9999px; z-index: -1">
      <label for="username" aria-hidden="true"><?= $page->honeypot()->html() ?></label>
      <input type="text" id="username" name="username" value="" tabindex="-1">
    </section>

    <section>
      <label for="email"><?= $page->email()->html() ?></label>
      <input type="email" id="email" name="email" value="<?= $data['email'] ?? '' ?>" autocomplete="email" autofocus required>
      <?= isset($alert['email']) ? html($alert['email']) : '' ?>
    </section>

    <section>
      <label for="password"><?= $page->password()->html() ?></label>
      <input type="password" id="password" name="password" value="<?= $data['password'] ?? '' ?>" minlength="8" autocomplete="new-password" required>
      <?= isset($alert['password']) ? html($alert['password']) : '' ?>
    </section>

    <section>
      <input type="submit" name="register" value="<?= $page->button()->html() ?>">
    </section>

  </fieldset>
</form>

<?php snippet('footer') ?>