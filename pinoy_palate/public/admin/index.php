<?php

require_once('../../private/initialize.php');
require_login();

if (!isset($_SESSION['member_id']) || $_SESSION['user_level'] !== 'A') {
  redirect_to(url_for('/login.php'));
}

// Find all members
$members = Member::find_all();

$page_title = 'Admin Page';
include(SHARED_PATH . '/admin_header.php');

?>

<div id="content">
  <div class="members listing">
    <h1>Users</h1>

    <div class="actions">
      <a class="action" href="new.php">Add User</a>
    </div>

  	<table class="list">
      <tr>
        <th>ID</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Username</th>
        <th>User Level</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php foreach($members as $member) { ?>
        <tr>
          <td><?= h($member->id); ?></td>
          <td><?= h($member->first_name); ?></td>
          <td><?= h($member->last_name); ?></td>
          <td><?= h($member->email); ?></td>
          <td><?= h($member->username); ?></td>
          <td><?= h($member->user_level); ?></td>
          <td><a class="action" href="show.php?id=<?= h(u($member->id)); ?>">View</a></td>
          <td><a class="action" href="edit.php?id=<?= h(u($member->id)); ?>">Edit</a></td>
          <td><a class="action" href="delete.php?id=<?= h(u($member->id)); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
