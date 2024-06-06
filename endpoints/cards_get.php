<?php
// n funciona e deixei pra dps

function cards_get($request) {

    $response = $request ["slug"];

    return rest_ensure_response($response);
}

function registrar_cards_get() {
  register_rest_route('api', '/cards(?P<slug>[-\w]+)', array(
    array(
      'methods' => WP_REST_Server::READABLE,
      'callback' => 'cards_get',
    ),
  ));
}

add_action('rest_api_init', 'registrar_cards_get');

?>