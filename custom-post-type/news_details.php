<?php
function registrar_cpt_news_details() {
  register_post_type('news_details', array(
    'label' => 'News_details',
    'description' => 'News_details',
    'public' => true,
    'show_ui' => true,
    'capability_type' => 'post',
    'rewrite' => array('slug' => 'news_details', 'with_front' => true),
    'query_var' => true,
    'supports' => array('custom-fields', 'author', 'title'),
    'publicly_queryable' => true
  ));
}
add_action('init', 'registrar_cpt_news_details');

?>