<?php
// Função de callback para atualizar um card por slug
function update_card_by_slug(WP_REST_Request $request) {
    $slug = $request['slug']; // Obter o slug da requisição

    // Argumentos para buscar o card por slug
    $args = array(
        'name' => $slug,
        'post_type' => 'cards',
        'post_status' => 'publish',
        'numberposts' => 1, // Obter apenas um post
    );

    $posts = get_posts($args);

    if (empty($posts)) {
        return new WP_Error('no_post', 'Card not found', array('status' => 404));
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
            'imagem' => esc_url_raw($request['imagem']), // Novo campo para a imagem
        ),
    );

    $post_id = wp_update_post($updated_post);

    if (is_wp_error($post_id)) {
        return new WP_Error('post_update_failed', 'Failed to update post', array('status' => 500));
    }

    return new WP_REST_Response(array('message' => 'Card updated'), 200);
}

// Função para registrar o endpoint
function registrar_update_card_by_slug() {
    register_rest_route('api', '/cards/(?P<slug>[a-zA-Z0-9-]+)', array(
        'methods' => 'PUT',
        'callback' => 'update_card_by_slug',
    ));
}
add_action('rest_api_init', 'registrar_update_card_by_slug');
?>
