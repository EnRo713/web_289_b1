<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($member)) {
  redirect_to('index.php');
}
?>

<dl>
  <dt>First name</dt>
  <dd><input type="text" name="member[first_name]" value="<?php echo h($member->first_name); ?>" /></dd>
</dl>

<dl>
  <dt>Last name</dt>
  <dd><input type="text" name="member[last_name]" value="<?php echo h($member->last_name); ?>" /></dd>
</dl>

<dl>
  <dt>Email</dt>
  <dd><input type="text" name="member[email]" value="<?php echo h($member->email); ?>" /></dd>
</dl>

<dl>
  <dt>Username</dt>
  <dd><input type="text" name="member[username]" value="<?php echo h($member->username); ?>" /></dd>
</dl>

<dl>
  <dt>User Level</dt>
  <dd>
    <select name="member[user_level]">
      <option value="M" <?php echo ($member->user_level == 'M') ? 'selected' : ''; ?>>Member</option>
      <option value="A" <?php echo ($member->user_level == 'A') ? 'selected' : ''; ?>>Admin</option>
    </select>
  </dd>
</dl>

<dl>
  <dt>Password</dt>
  <dd><input type="password" name="member[password]" value="" /></dd>
</dl>

<dl>
  <dt>Confirm Password</dt>
  <dd><input type="password" name="member[confirm_password]" value="" /></dd>
</dl>
