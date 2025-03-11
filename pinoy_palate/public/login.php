<?php
require_once('../private/initialize.php');

$errors = [];
$username = '';
$password = '';

if(is_post_request()) {

  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Validations
  if(is_blank($username)) {
    $errors[] = "Username cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  // if there were no errors, try to login
  if(empty($errors)) {
    $member = Member::find_by_username($username, $session->id ?? null);
    // test if member found and password is correct
    if ($member != false && $member->verify_password($password)) {
      // Mark member as logged in
      $session->login($member);

      // Check user level and redirect accordingly
      if (isset($member->user_level)) {
          if ($member->user_level === 'M') {
              // Redirect for members
              redirect_to(url_for('/recipes/recipes.php'));
          } elseif ($member->user_level === 'A') {
              // Redirect for admins
              redirect_to(url_for('/admin/index.php'));
          } else {
              // Handle other user levels or show an error
              $errors[] = "Invalid user level";
          }
      } else {
          // Handle the case where user level is not set
          $errors[] = "User level not set";
      }
    } else {
        $errors[] = "Log in was unsuccessful.";
    }
  }

}

?>

<?php $page_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="content">
  <h1>Log in</h1>

  <?php echo display_errors($errors); ?>

  <form action="login.php" method="post">
    Username:<br />
    <input type="text" name="username" value="<?php echo h($username); ?>" /><br />
    Password:<br />
    <input type="password" name="password" value="" /><br />
    <input type="submit" name="submit" value="Submit"  />
  </form>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
