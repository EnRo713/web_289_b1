<?php

if(!isset($recipe)) {
  redirect_to(url_for('members/members.php'));
}
?>

<dl>
  <dt>Title</dt>
  <dd><input type="text" name="recipe[title]" value="<?php echo h($recipe->title); ?>" /></dd>
</dl>

<dl>
  <dt>Category</dt>
  <dd><input type="text" name="recipe[category]" value="<?php echo h($recipe->category); ?>" /></dd>
</dl>

<dl>
  <dt>Ingredients</dt>
  <dd><input type="text" name="recipe[ingredients]" value="<?php echo h($recipe->ingredients); ?>" /></dd>
</dl>

<dl>
  <dt>Difficulty ID</dt>
  <dd>
    <select name="recipe[difficulty_id]">
      <option value=""></option>
      <?php foreach ($difficulty_options as $id => $name) { ?>
        <option value="<?php echo $id; ?>" <?php if ($recipe->difficulty_id == $id) { echo 'selected'; } ?>><?php echo $name; ?></option>
      <?php } ?>
    </select>
  </dd>
</dl>

<dl>
  <dt>Instructions</dt>
  <dd><textarea name="recipe[instructions]" rows="5" cols="50"><?php echo h($recipe->instructions); ?></textarea></dd>
</dl>
