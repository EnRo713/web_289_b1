<?php

require_once('../../private/initialize.php');
require_login();

if (!isset($_SESSION['member_id']) || $_SESSION['user_level'] !== 'A') {
  redirect_to(url_for('/login.php'));
}

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$id = $_GET['id'];
$member = Member::find_by_id($id);
if($member == false) {
  redirect_to(url_for('index.php'));
}

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['member'];
  $member->merge_attributes($args);
  $result = $member->save();

  if($result === true) {
    $session->message('The user was updated successfully.');
    redirect_to('show.php?id=' . $id);
  }
}

$page_title = 'Edit User';
include(SHARED_PATH . '/admin_header.php');

?>

<div id="content">

  <a class="back-link" href="index.php">&laquo; Back to List</a>

  <div class="member edit">
    <h1>Edit User</h1>

    <?php echo display_errors($member->errors); ?>

    <form action="edit.php?id=<?= h(u($id)); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Edit User" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
