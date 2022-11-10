<?php

namespace App\sts\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller apagar sobre empresa
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class DeleteAboutsComp
{

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;
    
    /**
     * Método apagar sobre empresa
     * Se existir o ID na URL instancia a MODELS para excluir o registro no banco de dados
     * Senao criar a mensagem de erro
     * Redireciona para a pagina listar sobre empresa
     *
     * @param integer|string|null|null $id
     * @return void
     */
    public function index(int|string|null $id = null): void
    {

        if (!empty($id)) {
            $this->id = (int) $id;
            $deleteAboutsComp = new \App\sts\Models\StsDeleteAboutsComp();
            $deleteAboutsComp->deleteAboutsComp($this->id);            
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Necessário selecionar sobre empresa!</p>";
        }

        $urlRedirect = URLADM . "list-abouts-comp/index";
        header("Location: $urlRedirect");

    }
}
