<?php
function registrar_cpt_cards() {
  register_post_type('cards', array(
    'label' => 'Cards',
    'description' => 'Cards',
    'public' => true,
    'show_ui' => true,
    'capability_type' => 'post',
    'rewrite' => array('slug' => 'cards', 'with_front' => true),
    'query_var' => true,
    'supports' => array('custom-fields', 'author', 'title'),
    'publicly_queryable' => true
  ));
}
add_action('init', 'registrar_cpt_cards');

?>