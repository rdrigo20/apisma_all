<?php


function api_usuario_post($request) {
    $email = sanitize_email($request['email']);
    $senha = $request['senha'];
    $nome = sanitize_text_field($request['nome']);
    $rua = sanitize_text_field($request['rua']);
    $cep = sanitize_text_field($request['cep']);
    $numero = sanitize_text_field($request['numero']);
    $bairro = sanitize_text_field($request['bairro']);
    $cidade = sanitize_text_field($request['cidade']);
    $estado = sanitize_text_field($request['estado']);

    // Verificação se o email e a senha foram fornecidos
    if (!$email || !$senha) {
        return new WP_Error('missing_fields', 'Email e senha são obrigatórios.', array('status' => 400));
    }

    $user_exists = username_exists($email);
    $email_exists = email_exists($email);

    if (!$user_exists && !$email_exists) {
        // Criar usuário
        $user_id = wp_create_user($email, $senha, $email);

        if (is_wp_error($user_id)) {
            return $user_id;
        }

        // Atualizar dados do usuário
        $response = array(
            'ID' => $user_id,
            'display_name' => $nome,
            'first_name' => $nome,
            'role' => 'subscriber',
        );
        wp_update_user($response);

        // Atualizar metadados do usuário
        update_user_meta($user_id, 'cep', $cep);
        update_user_meta($user_id, 'rua', $rua);
        update_user_meta($user_id, 'numero', $numero);
        update_user_meta($user_id, 'bairro', $bairro);
        update_user_meta($user_id, 'cidade', $cidade);
        update_user_meta($user_id, 'estado', $estado);

        return rest_ensure_response($response);
    } else {
        return new WP_Error('email_exists', 'Email já cadastrado.', array('status' => 403));
    }
}

function registrar_api_usuario_post() {
    register_rest_route('api', '/usuario', array(
        array(
            'methods' => WP_REST_Server::CREATABLE,
            'callback' => 'api_usuario_post',
        ),
    ));
}

add_action('rest_api_init', 'registrar_api_usuario_post');


//function antiga do usuario_post
/* 
function api_usuario_post($request) {
  $email = sanitize_email($request['email']);
  $senha = $request['senha'];
  $nome = sanitize_text_field($request['nome']);
  $rua = sanitize_text_field($request['rua']);
  $cep = sanitize_text_field($request['cep']);
  $numero = sanitize_text_field($request['numero']);
  $bairro = sanitize_text_field($request['bairro']);
  $cidade = sanitize_text_field($request['cidade']);
  $estado = sanitize_text_field($request['estado']);
  $user_exists = username_exists($email);
  $email_exists = email_exists($email);
  if(!$user_exists && !$email_exists && $email && $senha) {
    $user_id = wp_create_user($email, $senha, $email);
    $response = array(
      'ID' => $user_id,
      'display_name' => $nome,
      'first_name' => $nome,
      'role' => 'subscriber',
    );
    wp_update_user($response);
    update_user_meta($user_id, 'cep', $cep);
    update_user_meta($user_id, 'rua', $rua);
    update_user_meta($user_id, 'numero', $numero);
    update_user_meta($user_id, 'bairro', $bairro);
    update_user_meta($user_id, 'cidade', $cidade);
    update_user_meta($user_id, 'estado', $estado);
  } else {
    $response = new WP_Error('email', 'Email já cadastrado.', array('status' => 403));
  }
  return rest_ensure_response($response);
}
function registrar_api_usuario_post() {
  register_rest_route('api', '/usuario', array(
    array(
      'methods' => WP_REST_Server::CREATABLE,
      'callback' => 'api_usuario_post',
    ),
  ));
}
add_action('rest_api_init', 'registrar_api_usuario_post');
*/
?>