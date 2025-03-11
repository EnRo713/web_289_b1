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
    $recipe->merge_attributes($_POST);
    if ($recipe->save()) {
        redirect_to(url_for('/recipes/recipes.php'));
    } else {
        $errors = $recipe->errors;
    }
}

$page_title = 'Edit Recipe';
include(SHARED_PATH . '/member_header.php');
?>

<h2>Edit Recipe</h2>

<?php if (!empty($errors)) { echo display_errors($errors); } ?>

<form action="<?= url_for('/recipes/edit.php?id=' . h(u($id))); ?>" method="post">
    <label for="name">Recipe Name:</label>
    <input type="text" name="name" value="<?= h($recipe->name); ?>" required>

    <label for="type">Type:</label>
    <input type="text" name="type" value="<?= h($recipe->type); ?>">

    <label for="diet">Diet:</label>
    <input type="text" name="diet" value="<?= h($recipe->diet); ?>">

    <label for="prep_time">Prep Time (minutes):</label>
    <input type="number" name="prep_time" value="<?= h($recipe->prep_time); ?>">

    <label for="cook_time">Cook Time (minutes):</label>
    <input type="number" name="cook_time" value="<?= h($recipe->cook_time); ?>">

    <input type="submit" value="Save Changes">
</form>

<?php include(SHARED_PATH . '/member_footer.php'); ?>
