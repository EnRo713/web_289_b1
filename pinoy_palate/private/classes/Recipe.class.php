<?php

class Recipe extends DatabaseObject {

  static protected $table_name = 'recipe';
  static protected $db_columns = ['recipe_id', 'name', 'description', 'user_id'];

  public $recipe_id;
  public $name;
  public $description;
  public $user_id;

  public function __construct($args=[]) {
    $this->name = $args['name'] ?? '';
    $this->description = $args['description'] ?? '';
    $this->user_id = $args['user_id'] ?? null;
  }

  public function validate() {
    $this->errors = [];

    if(is_blank($this->name)) {
      $this->errors[] = "Recipe name cannot be blank.";
    } elseif (!has_length($this->name, ['max' => 100])) {
      $this->errors[] = "Recipe name must be less than 100 characters.";
    }

    if(is_blank($this->description)) {
      $this->errors[] = "Description cannot be blank.";
    }

    return $this->errors;
  }
}

?>
