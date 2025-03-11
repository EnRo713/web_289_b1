<?php

require_once('../../private/initialize.php');
require_login();

if (!isset($_SESSION['member_id']) || $_SESSION['user_level'] !== 'A') {
  redirect_to(url_for('/login.php'));
}

if(is_post_request()) {

  // Create record using post parameters
  $args = $_POST['member'];
  $member = new Member($args);
  $result = $member->save();

  if($result === true) {
    $new_id = $member->id;
    $session->message('The member was created successfully.');
    redirect_to('show.php?id=' . $new_id);
  } else {
    // show errors
  }

} else {
  // display the form
  $member = new Member;
}

?>

<?php $page_title = 'Create User'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="index.php">&laquo; Back to List</a>

  <div class="member new">
    <h1>Create User</h1>

    <?php echo display_errors($member->errors); ?>

    <form action="new.php" method="post" id="demo-form">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Create User" />

      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
