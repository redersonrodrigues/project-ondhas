<?php

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


if (isset($this->data['form'])) {
    $valueForm = $this->data['form'];
    extract($valueForm);
}

echo "<h1>Entre em Contato</h1>";

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

//var_dump($this->data);
?>

<form method="POST" action="">
    <?php 
    $value_name = "";
    if (isset($name)) {
        $value_name = $name;
    } 
    ?>
    <label>Nome: </label>
    <input name="name" type="text" id="name" placeholder="Nome completo" value="<?php echo $value_name; ?>"><br><br>

    <?php 
    $value_email = "";
    if (isset($email)) {
        $value_email = $email;
    } 
    ?>
    <label>E-mail: </label>
    <input name="email" type="email" id="email" placeholder="Seu melhor e-mail" value="<?php echo $value_email; ?>"><br><br>

    <?php 
    $value_subject = "";
    if (isset($subject)) {
        $value_subject = $subject;
    } 
    ?>
    <label>Assunto: </label>
    <input name="subject" type="text" id="subject" placeholder="Assunto da mensagem" value="<?php echo $value_subject; ?>"><br><br>

    <?php 
    $value_content = "";
    if (isset($content)) {
        $value_content = $content;
    } 
    ?>
    <label>Mensagem: </label>
    <textarea name="content" rows="6" cols="50" placeholder="Conteúdo da mensagem"><?php echo $value_content; ?></textarea><br><br>

    <input name="AddContMsg" type="submit" value="Enviar">

</form>