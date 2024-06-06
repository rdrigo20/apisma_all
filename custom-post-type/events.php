<?php
function registrar_cpt_events() {
  register_post_type('events', array(
    'label' => 'Events',
    'description' => 'Events',
    'public' => true,
    'show_ui' => true,
    'capability_type' => 'post',
    'rewrite' => array('slug' => 'events', 'with_front' => true),
    'query_var' => true,
    'supports' => array('custom-fields', 'author', 'title'),
    'publicly_queryable' => true
  ));
}
add_action('init', 'registrar_cpt_events');

?>