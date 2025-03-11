<?php

require_once('../private/initialize.php');
include(SHARED_PATH . '/public_header.php');

?>

  <ul>
    <li><a href="<?php echo url_for('signup.php'); ?>">Sign Up</a></li>
    <li><a href="<?php echo url_for('login.php'); ?>">Login</a></li>
    <?php if ($session->is_logged_in()) : ?>
      <li><a href="<?php echo url_for('logout.php'); ?>">Logout</a></li>
    <?php endif; ?>
    <li><a href="<?php echo url_for('recipes/recipes.php'); ?>">View Recipes</a></li>
    <li><a href="<?php echo url_for('/about.php'); ?>">About Us</a></li>
  </ul>
    

<?php include(SHARED_PATH . '/public_footer.php'); ?>
