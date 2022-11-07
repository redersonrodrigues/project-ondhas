<?php

namespace App\adms\Controllers;
// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Controller apagar situação usuário
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class DeleteSitsUsers
{

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;
    
    /**
     * Método apagar situação usuário
     * Se existir o ID na URL instancia a MODELS para excluir o registro no banco de dados
     * Senão criar a mensagem de erro
     * Redireciona para a página listar situação usuários
     *
     * @param integer|string|null|null $id Receber o id do registro que deve ser excluido
     * @return void
     */
    public function index(int|string|null $id = null): void
    {

        if (!empty($id)) {
            $this->id = (int) $id;
            $deleteSitUser = new \App\adms\Models\AdmsDeleteSitsUsers();
            $deleteSitUser->deleteSitUser($this->id);            
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Necessário selecionar uma situação!</p>";
        }

        $urlRedirect = URLADM . "list-sits-users/index";
        header("Location: $urlRedirect");

    }
}
