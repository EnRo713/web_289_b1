<?php

require_once('../private/initialize.php');
include(SHARED_PATH . '/public_header.php');
$page_title = 'Sign Up';

if(is_post_request()) {

  // Create record using post parameters
  $args = $_POST['member'];
  $member = new Member($args);
  $result = $member->save();

  if($result === true) {
    $new_id = $member->id;
    $session->message('Thank you for signing up!');
    redirect_to(url_for('/recipes/recipes.php'));
  } else {
    // show errors
  }

} else {
  // display the form
  $member = new Member;
}


?>

<div id="content">

  <a class="back-link" href="<?= url_for('index.php'); ?>">&laquo; Back to Home</a>

  <div class="member new">
    <h1>Sign Up</h1>

    <?= display_errors($member->errors); ?>

    <form action="<?= url_for('signup.php'); ?>" method="post" id="demo-form">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Sign Up" />

      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
