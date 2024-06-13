<?php

function cards_create($request) {

  $user = wp_get_current_user();
  $user_id = $user->ID;
  

  $descricao = sanitize_text_field($request['descricao']);
  $titulo = sanitize_text_field($request['titulo']);
  $link = $request['link'];
  $imagem = esc_url_raw($request['imagem']); // Novo campo para a imagem
  //$descricao = sanitize_text_field($request['descricao']);


  $response = array(
    'post_author' => $user_id,
    'post_type' => 'cards',
    'post_title' => $titulo,
    'post_status' => 'publish',
    'meta_input' => array(
      'descricao' => $descricao,
      'link' => $link,
      'imagem' => $imagem,
    ),
  );

  $produto_id = wp_insert_post($response);
  $response['id'] = get_post_field('post_name', $produto_id);


  return rest_ensure_response($response);
}

function registrar_cards_create() {
  register_rest_route('api', '/cards', array(
    array(
      'methods' => WP_REST_Server::CREATABLE,
      'callback' => 'cards_create',
    ),
  ));
}

add_action('rest_api_init', 'registrar_cards_create');

?>