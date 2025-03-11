<!doctype html>

<html lang="en">
  <head>
    <title>WNC Recipes <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6LeGgBYpAAAAAAbaliB8aYuIk-NUS7m7ihmgTzen" async defer></script>
  </head>

  <body>

    <header>
      <h1>
        <a href="<?= url_for('../public/index.php'); ?>">WNC Recipes</a> Admin Area
      </h1>
    </header>

    <navigation>
      <ul>
        <?php if($session->is_logged_in()) { ?>
        <li>User: <?= $session->username; ?></li>
        <ul>
          <li><a href="<?= url_for('admin/index.php'); ?>">Users</a></li>
          <li><a href="<?= url_for('recipes/recipes.php'); ?>">Recipes</a></li>
        </ul>
        <li><a href="<?= url_for('/logout.php'); ?>">Logout</a></li>
        <?php } ?>
      </ul>
    </navigation>

<?= display_session_message(); ?>
