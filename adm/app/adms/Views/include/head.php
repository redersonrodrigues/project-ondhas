<?php
// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo URLADM; ?>app/adms/assets/image/icon/favicon.ico">
        <!-- Incluir os icones do font-awesome da CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link rel="stylesheet" href="<?php echo URLADM; ?>app/adms/assets/css/custom_adms.css">
        <title>ONDHAS - Administrativo</title>
    </head>
    <body>