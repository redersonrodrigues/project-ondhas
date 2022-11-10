<?php

namespace App\sts\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller apagar mensagem de contato
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class DeleteContactsMsgs
{

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;
    
    /**
     * Método apagar mensagem de contato
     * Se existir o ID na URL instancia a MODELS para excluir o registro no banco de dados
     * Senao criar a mensagem de erro
     * Redireciona para a pagina listar mensagem de contato
     *
     * @param integer|string|null|null $id
     * @return void
     */
    public function index(int|string|null $id = null): void
    {

        if (!empty($id)) {
            $this->id = (int) $id;
            $deleteContactsMsgs = new \App\sts\Models\StsDeleteContactsMsgs();
            $deleteContactsMsgs->deleteContactsMsgs($this->id);            
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Necessário selecionar uma mensagem de contato!</p>";
        }

        $urlRedirect = URLADM . "list-contacts-msgs/index";
        header("Location: $urlRedirect");

    }
}
