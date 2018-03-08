<?php
class tripal_phylotree_handler_filter_field_count extends views_handler_filter_numeric {
  function operators() {
    $operators = parent::operators();
    return $operators;
  }

  function option_definition() {
    $options = parent::option_definition();
    return $options;
  }

  // Helper function to return a sql expression
  // for counting words in a field.
  function field_count() {
    // Set the real field to the title of the node
    $this->real_field = 'title';

    $field = "$this->table_alias.$this->real_field";
    return "LENGTH($field)-LENGTH(REPLACE($field,' ',''))+1";
  }

  function query() {
    $this->ensure_my_table();
    $field = "$this->table_alias.$this->real_field";

    $info = $this->operators();
    if (!empty($info[$this->operator]['method'])) {
      $this->{$info[$this->operator]['method']}($field);
    }
  }

  // Override the op_between function
  // adding our field count function as parameter
  function op_between($field) {
    $field_count = $this->field_count();

    $min = $this->value['min'];
    $max = $this->value['max'];

    if ($this->operator == 'between') {
      $this->query->add_where_expression($this->options['group'], "$field_count BETWEEN $min AND $max");
    }
    else {
      $this->query->add_where_expression($this->options['group'], "($field_count <= $min) OR ($field_count >= $max)");
    }
  }

  // Override the op_simple function
  // adding our field count function as parameter
  function op_simple($field) {
    echo "njknjk"; exit;
    $field_count = $this->field_count();

    $value = $this->value['value'];
    $this->query->add_where_expression($this->options['group'], "$field_count $this->operator $value");
  }
}
