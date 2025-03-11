<?php

require_once('../../private/initialize.php');
// Get requested ID
$id = $_GET['id'] ?? false;

if(!$id) {
  redirect_to('recipes/recipes.php');
}

// Find recipe using ID
$recipe = recipe::find_by_id($id);

$page_title = 'Detail: ' . $recipe->title;

if ($session->user_level === 'A') {
  $page_title = 'Admin recipe CRUD Area';
  include(SHARED_PATH . '/admin_header.php');
} elseif ($session->user_level === 'M') {
  $page_title = 'Members Area';
  include(SHARED_PATH . '/member_header.php');
} else {
  include(SHARED_PATH . '/public_header.php');
}

?>

<a class="back-link" href="<?= url_for('recipes/recipes.php'); ?>">&laquo; Back to List</a>

  <h1>Recipe: <?= h($recipe->title); ?></h1>

      <dl>
        <dt>Name</dt>
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
        <dt>Difficulty</dt>
        <dd><?= h($recipe->difficulty()); ?></dd>
      </dl>
      <dl>
        <dt>Instructions</dt>
        <dd><?= h($recipe->instructions); ?></dd>
      </dl>

<?php 

if ($session->user_level === 'A') {
  include(SHARED_PATH . '/admin_footer.php');
} elseif ($session->user_level === 'M') {
  include(SHARED_PATH . '/member_footer.php');
} else {
  include(SHARED_PATH . '/public_footer.php');
}

?>
