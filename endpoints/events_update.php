<?php
// Função de callback para atualizar um card por slug events
function update_events_by_slug(WP_REST_Request $request) {
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
        return new WP_Error('no_post', 'event not found', array('status' => 404));
    }

    $post = $posts[0]; // Obter o primeiro (e único) post encontrado

    // Verificar permissões
    /*if (!current_user_can('edit_post', $post->ID)) {
        return new WP_Error('rest_forbidden', esc_html__('You cannot edit this post.'), array('status' => rest_authorization_required_code()));
    }*/

    // Atualizar o post
    $updated_post = array(
        'ID' => $post->ID,
        'post_title' => sanitize_text_field($request['titulo']),
        'meta_input' => array(
            'descricao' => sanitize_text_field($request['descricao']),
            'link' => esc_url_raw($request['link']),
            'data' => sanitize_text_field($request['data']),
        ),
    );

    $post_id = wp_update_post($updated_post);

    if (is_wp_error($post_id)) {
        return new WP_Error('post_update_failed', 'Failed to update post', array('status' => 500));
    }

    return new WP_REST_Response(array('message' => 'event updated'), 200);
}

// Função para registrar o endpoint
function registrar_update_events_by_slug() {
    register_rest_route('api', '/events/(?P<slug>[a-zA-Z0-9-]+)', array(
        'methods' => 'PUT',
        'callback' => 'update_events_by_slug',
    ));
}
add_action('rest_api_init', 'registrar_update_events_by_slug');
?>
