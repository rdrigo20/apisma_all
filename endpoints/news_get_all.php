<?php
// Função de callback para recuperar os news
function get_all_news(WP_REST_Request $request) {
    $args = array(
        'post_type' => 'news_details', // Tipo de post ""
        'post_status' => 'publish',
        'numberposts' => -1, // Obter todos os posts
    );

    $posts = get_posts($args);

    if (empty($posts)) {
        return new WP_Error('no_posts', 'No news found', array('status' => 404));
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
                'data_news' => get_post_meta($post->ID, 'data_news', true),
                'autor' => get_post_meta($post->ID, 'autor', true),
                'titulo' => get_post_meta($post->ID, 'titulo', true),
                'link' => get_post_meta($post->ID, 'link', true),
                'link' => get_post_meta($post->ID, 'link', true),
                'link' => get_post_meta($post->ID, 'link', true),
            ),
        );
        $data[] = $post_data;
    }
    return new WP_REST_Response($data, 200);
}

// Função para registrar o endpoint
function registrar_get_all_news() {
    register_rest_route('api', '/news', array(
        'methods' => 'GET',
        'callback' => 'get_all_news',
    ));
}
add_action('rest_api_init', 'registrar_get_all_news');
?>
