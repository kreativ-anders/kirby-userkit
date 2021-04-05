<div>
  <p><?= isset($error) ? $page->alert()->html() : '' ?></p>
  <p><?= isset($alert['error']) ? html($alert['error']) : '' ?></p>
</div>
