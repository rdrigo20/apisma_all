<?php

// Função de callback para obter um card por slug
function get_carrousel_by_slug(WP_REST_Request $request) {
    $slug = $request['slug']; // Obter o slug da requisição

    // Argumentos para buscar o card por slug
    $args = array(
        'name' => $slug,
        'post_type' => 'carrousel',
        'post_status' => 'publish',
        'numberposts' => 1, // Obter apenas um post
    );

    $posts = get_posts($args);

    if (empty($posts)) {
        return new WP_Error('no_post', 'carrousel not found', array('status' => 404));
    }

    $post = $posts[0]; // Obter o primeiro (e único) post encontrado

    // Preparar os dados para a resposta
    $post_data = array(
        'id' => $post->ID,
        'title' => $post->post_title,
        'content' => $post->post_content,
        'author' => get_the_author_meta('display_name', $post->post_author),
        'date' => $post->post_date,
        'slug' => $post->post_name,
        'meta' => array(
            'descricao' => get_post_meta($post->ID, 'descricao', true),
            'link' => get_post_meta($post->ID, 'link', true),
        ),
    );

    return new WP_REST_Response($post_data, 200);
}

// Função para registrar o endpoint
function registrar_get_carrousel_by_slug() {
    register_rest_route('api', '/carrousel/(?P<slug>[a-zA-Z0-9-]+)', array(
        'methods' => 'GET',
        'callback' => 'get_carrousel_by_slug',
    ));
}
add_action('rest_api_init', 'registrar_get_carrousel_by_slug');

?>