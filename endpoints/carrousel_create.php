<?php

function carrousel_create($request) {

  $user = wp_get_current_user();
  $user_id = $user->ID;
  
    $endereco = sanitize_text_field($request['endereco']);
    $texto = sanitize_text_field($request['texto']);
    $nome = sanitize_text_field($request['nome']);
    //$link = $request['link'];
    //$descricao = sanitize_text_field($request['descricao']);


  $response = array(
    'post_author' => $user_id,
    'post_type' => 'carrousel',
    'post_title' => $nome,
    'post_status' => 'publish',
    'meta_input' => array(
      'texto' => $texto,
      'endereco' => $endereco,
      'nome' => $nome,
    ),
  );

  $produto_id = wp_insert_post($response);
  $response['id'] = get_post_field('post_name', $produto_id);


  return rest_ensure_response($response);
}

function registrar_carrousel_create() {
  register_rest_route('api', '/carrousel', array(
    array(
      'methods' => WP_REST_Server::CREATABLE,
      'callback' => 'carrousel_create',
    ),
  ));
}

add_action('rest_api_init', 'registrar_carrousel_create');

?>