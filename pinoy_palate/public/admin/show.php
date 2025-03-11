<?php

require_once('../../private/initialize.php');
require_login();

if (!isset($_SESSION['member_id']) || $_SESSION['user_level'] !== 'A') {
  redirect_to(url_for('/login.php'));
}

$id = $_GET['id'] ?? '2'; // PHP > 7.0

$member = Member::find_by_id($id);

$page_title = 'Show Member: ' . h($member->full_name());
include(SHARED_PATH . '/admin_header.php');

?>

<div id="content">

  <a class="back-link" href="index.php">&laquo; Back to List</a>

  <div class="member show">

    <h1>User: <?php echo h($member->full_name()); ?></h1>

    <div class="attributes">
      <dl>
        <dt>First name</dt>
        <dd><?php echo h($member->first_name); ?></dd>
      </dl>
      <dl>
        <dt>Last name</dt>
        <dd><?php echo h($member->last_name); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($member->email); ?></dd>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($member->username); ?></dd>
      </dl>
      <dl>
        <dt>User Level</dt>
        <dd><?php echo h($member->user_level); ?></dd>
      </dl>
    </div>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
