<?php
// Função de callback para recuperar os events
function get_all_events(WP_REST_Request $request) {
    $args = array(
        'post_type' => 'events', // Tipo de post "cards"
        'post_status' => 'publish',
        'numberposts' => -1, // Obter todos os posts
    );

    $posts = get_posts($args);

    if (empty($posts)) {
        return new WP_Error('no_posts', 'No events found', array('status' => 404));
    }

    // Preparar os dados para a resposta
    $data = array();
    foreach ($posts as $post) {
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
        $data[] = $post_data;
    }
    return new WP_REST_Response($data, 200);
}

// Função para registrar o endpoint
function registrar_get_all_events() {
    register_rest_route('api', '/events', array(
        'methods' => 'GET',
        'callback' => 'get_all_events',
    ));
}
add_action('rest_api_init', 'registrar_get_all_events');
?>
