<?php

function news_details_create($request) {

  $user = wp_get_current_user();
  $user_id = $user->ID;
  
  $data = sanitize_text_field($request['data']);
  $titulo = sanitize_text_field($request['titulo']);
  $subtitulo = sanitize_text_field($request['subtitulo']);
  $autor = sanitize_text_field($request['autor']);
  $texto = sanitize_text_field($request['texto']);
  $imagem = esc_url_raw($request['imagem']); // Novo campo para a imagem

  $response = array(
    'post_author' => $user_id,
    'post_type' => 'news_details',
    'post_title' => $titulo,
    'post_status' => 'publish',
    'meta_input' => array(
      'data' => $data,
      'subtitulo' => $subtitulo,
      'autor' => $autor,
      'texto' => $texto,
      'imagem' => $imagem,
    ),
  );

  $produto_id = wp_insert_post($response);
  $response['id'] = get_post_field('post_name', $produto_id);


  return rest_ensure_response($response);
}

function registrar_news_details_create() {
  register_rest_route('api', '/news_details', array(
    array(
      'methods' => WP_REST_Server::CREATABLE,
      'callback' => 'news_details_create',
    ),
  ));
}

add_action('rest_api_init', 'registrar_news_details_create');

?>