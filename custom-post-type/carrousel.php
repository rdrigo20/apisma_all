<?php
function registrar_cpt_carrousel() {
  register_post_type('carrousel', array(
    'label' => 'Carrousel',
    'description' => 'Carrousel',
    'public' => true,
    'show_ui' => true,
    'capability_type' => 'post',
    'rewrite' => array('slug' => 'carrousel', 'with_front' => true),
    'query_var' => true,
    'supports' => array('custom-fields', 'author', 'title'),
    'publicly_queryable' => true
  ));
}
add_action('init', 'registrar_cpt_carrousel');

?>