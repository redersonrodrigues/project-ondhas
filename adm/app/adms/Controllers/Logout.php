<?php

namespace App\adms\Controllers;
// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Controller da página sair
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class Logout
{

    /**
     * Método sair do administrativo.
     * Destruir as sessões do usuário logado
     * 
     * @return void
     */
    public function index(): void
    {
        unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_nickname'], $_SESSION['user_email'], $_SESSION['user_image']);
        $_SESSION['msg'] = "<p class='alert-success'>Logout realizado com sucesso!</p>";
        $urlRedirect = URLADM . "login/index";
        header("Location: $urlRedirect");
    }
}
