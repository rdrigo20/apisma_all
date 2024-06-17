<?php
// Função de callback para deletar um card por slug events
function delete_events_by_slug(WP_REST_Request $request) {
    $slug = $request['slug']; // Obter o slug da requisição

    // Argumentos para buscar o card por slug
    $args = array(
        'name' => $slug,
        'post_type' => 'events',
        'post_status' => 'publish',
        'numberposts' => 1, // Obter apenas um post
    );

    $posts = get_posts($args);

    if (empty($posts)) {
        return new WP_Error('no_post', 'events not found', array('status' => 404));
    }

    $post = $posts[0]; // Obter o primeiro (e único) post encontrado

    // Verificar permissões
    /*if (!current_user_can('delete_post', $post->ID)) {
        return new WP_Error('rest_forbidden', esc_html__('You cannot delete this post.'), array('status' => rest_authorization_required_code()));
    }*/

    // Deletar o post
    wp_delete_post($post->ID, true);

    return new WP_REST_Response(array('message' => 'events deletado'), 200);
}

// Função para registrar o endpoint
function registrar_delete_events_by_slug() {
    register_rest_route('api', '/events/(?P<slug>[a-zA-Z0-9-]+)', array(
        'methods' => 'DELETE',
        'callback' => 'delete_events_by_slug',
    ));
}
add_action('rest_api_init', 'registrar_delete_events_by_slug');
?>
