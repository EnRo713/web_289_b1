<?php
require_once('../../private/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to(url_for('/login.php'));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipe = new Recipe($_POST);
    if ($recipe->save()) {
        redirect_to(url_for('/recipes/recipes.php'));
    } else {
        $errors = $recipe->errors;
    }
}

$page_title = 'Add Recipe';
include(SHARED_PATH . '/member_header.php');
?>

<h2>Add a New Recipe</h2>

<?php if (!empty($errors)) { echo display_errors($errors); } ?>

<form action="<?= url_for('/recipes/new.php'); ?>" method="post">
    <label for="name">Recipe Name:</label>
    <input type="text" name="name" required>

    <label for="type">Type:</label>
    <input type="text" name="type">

    <label for="diet">Diet:</label>
    <input type="text" name="diet">

    <label for="prep_time">Prep Time (minutes):</label>
    <input type="number" name="prep_time">

    <label for="cook_time">Cook Time (minutes):</label>
    <input type="number" name="cook_time">

    <input type="submit" value="Add Recipe">
</form>

<?php include(SHARED_PATH . '/member_footer.php'); ?>
