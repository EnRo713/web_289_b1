<?php

require_once('../../private/initialize.php');
$page_title = 'Recipe List';

if ($session->user_level === 'A') {
    $page_title = 'Admin Recipe Management Area';
    include(SHARED_PATH . '/admin_header.php');
} elseif ($session->user_level === 'M') {
    $page_title = 'Members Area';
    include(SHARED_PATH . '/member_header.php');
} else {
    include(SHARED_PATH . '/public_header.php');
}

?>

<h2>Recipe Collection</h2>
<p>Browse and share your favorite recipes!</p>

<?php if ($session->is_logged_in()) : ?>
    <a href="<?= url_for('/recipes/new.php'); ?>">Add Recipe</a>
<?php endif; ?>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Diet</th>
        <th>Prep Time</th>
        <th>Cook Time</th>
        <th>&nbsp;</th>
        <?php if ($session->is_logged_in()) : ?>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        <?php endif; ?>
    </tr>

<?php
$recipes = Recipe::find_all();
foreach ($recipes as $recipe) { 
?>

    <tr>
        <td><?= h($recipe->name); ?></td>
        <td><?= h($recipe->type); ?></td>
        <td><?= h($recipe->diet); ?></td>
        <td><?= h($recipe->prep_time); ?> min</td>
        <td><?= h($recipe->cook_time); ?> min</td>
        <td><a href="detail.php?id=<?= $recipe->id; ?>">View</a></td>
        <?php if ($session->is_logged_in()) : ?>
            <td><a href="<?= url_for('recipes/edit.php?id=' . h(u($recipe->id))); ?>">Edit</a></td>
            <td><a href="<?= url_for('recipes/delete.php?id=' . h(u($recipe->id))); ?>">Delete</a></td>
        <?php endif; ?>
    </tr>

<?php } ?>

</table>

<?php 

if ($session->user_level === 'A') {
    include(SHARED_PATH . '/admin_footer.php');
} elseif ($session->user_level === 'M') {
    include(SHARED_PATH . '/member_footer.php');
} else {
    include(SHARED_PATH . '/public_footer.php');
}

?>
