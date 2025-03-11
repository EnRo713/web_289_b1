<?php
require_once('../../private/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to(url_for('/login.php'));
}

$id = $_GET['id'] ?? false;
if (!$id) {
    redirect_to(url_for('/recipes/recipes.php'));
}

$recipe = Recipe::find_by_id($id);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($recipe->delete()) {
        redirect_to(url_for('/recipes/recipes.php'));
    } else {
        $errors = $recipe->errors;
    }
}

$page_title = 'Delete Recipe';
include(SHARED_PATH . '/member_header.php');
?>

<h2>Delete Recipe</h2>
<p>Are you sure you want to delete the recipe "<?= h($recipe->name); ?>"?</p>

<form action="<?= url_for('/recipes/delete.php?id=' . h(u($id))); ?>" method="post">
    <input type="submit" value="Delete Recipe">
</form>

<a href="<?= url_for('/recipes/recipes.php'); ?>">Cancel</a>

<?php include(SHARED_PATH . '/member_footer.php'); ?>
