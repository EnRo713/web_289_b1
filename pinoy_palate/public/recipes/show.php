<?php

require_once('../../private/initialize.php');
require_login();

$id = $_GET['id'] ?? '1'; // PHP > 7.0
$recipe = recipe::find_by_id($id);

$page_title = 'Show recipe: ' . h($recipe->title);

if ($session->user_level === 'A') {
  include(SHARED_PATH . '/admin_header.php');
} elseif ($session->user_level === 'M') {
  include(SHARED_PATH . '/member_header.php');
}

?>

  <a class="back-link" href="<?= url_for('recipes/recipes.php'); ?>">&laquo; Back to List</a>

  <h2>Recipe: <?= h($recipe->title); ?></h2>

  <div class="attributes">
    <dl>
      <dt>Title</dt>
      <dd><?= h($recipe->title); ?></dd>
    </dl>
    <dl>
      <dt>Category</dt>
      <dd><?= h($recipe->category); ?></dd>
    </dl>
    <dl>
      <dt>Ingredients</dt>
      <dd><?= h($recipe->ingredients); ?></dd>
    </dl>
    <dl>
      <dt>Difficulty ID</dt>
      <dd><?= h($recipe->difficulty()); ?></dd>
    </dl>
    <dl>
      <dt>Instructions</dt>
      <dd><?= h($recipe->instructions); ?></dd>
    </dl>
  </div>
