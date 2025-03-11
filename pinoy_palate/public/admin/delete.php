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
  redirect_to('index.php');
}

if(is_post_request()) {

  // Delete member
  $result = $member->delete();
  $session->message('The user was deleted successfully.');
  redirect_to('index.php');

} else {
  // Display form
}

$page_title = 'Delete User';
include(SHARED_PATH . '/admin_header.php');

?>

<div id="content">

  <a class="back-link" href="index.php">&laquo; Back to List</a>

  <div class="member delete">
    <h1>Delete Member</h1>
    <p>Are you sure you want to delete this member?</p>
    <p class="item"><?= h($member->full_name()); ?></p>

    <form action="delete.php?id=<?= h(u($id)); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete User" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
