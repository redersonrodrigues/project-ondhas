<?php

namespace App\adms\Controllers;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Controller apagar configuração de email
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class DeleteConfEmails
{

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;
    
    /**
     * Método apagar configuração de email
     * Se existir o ID na URL instancia a MODELS para excluir o registro no banco de dados
     * Senão criar a mensagem de erro
     * Redireciona para a página listar configuração de email
     *
     * @param integer|string|null|null $id
     * @return void
     */
    public function index(int|string|null $id = null): void
    {

        if (!empty($id)) {
            $this->id = (int) $id;
            $deleteConfEmails = new \App\adms\Models\AdmsDeleteConfEmails();
            $deleteConfEmails->deleteConfEmails($this->id);            
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Necessário selecionar uma configuração de email!</p>";
        }

        $urlRedirect = URLADM . "list-conf-emails/index";
        header("Location: $urlRedirect");

    }
}
