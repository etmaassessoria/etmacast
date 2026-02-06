<?php
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data
    $name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';

    // Validar campos do formulário
    if (empty($name)) {
        $errors[] = 'Nome está vazio';
    }

    if (empty($email)) {
        $errors[] = 'Email está vazio';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email é inválido';
    }

    if (empty($message)) {
        $errors[] = 'Mensagem está vazia';
    }

    // Se não houver erros, enviar email
    if (empty($errors)) {
        // Endereço de email do destinatário (substitua pelo seu próprio)
        $recipient = "etmacast@etma.com.br";

        // Cabeçalhos adicionais
        $headers = "From: $name <$email>";

        // Enviar email
        if (mail($recipient, $message, $headers)) {
            echo "Email enviado com sucesso!";
        } else {
            echo "Envio de email falhou. Por favor tente novamente mais tarde.";
        }
    } else {
        // Exibir erros
        echo "O formulário possui os seguintes erros:<br>";
        foreach ($errors as $error) {
            echo "- $error<br>";
        }
    }
} else {
    // Solicitação não é POST, exibir erro 403 proibido
    header("HTTP/1.1 403 Forbidden");
    echo "Não tem permissões para aceder a esta página.";
}
?>