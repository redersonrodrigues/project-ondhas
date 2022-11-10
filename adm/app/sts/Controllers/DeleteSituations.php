<?php

namespace App\sts\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller apagar situação
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class DeleteSituations
{

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;
    
    /**
     * Método apagar situação
     * Se existir o ID na URL instancia a MODELS para excluir o registro no banco de dados
     * Senao criar a mensagem de erro
     * Redireciona para a pagina listar situação
     *
     * @param integer|string|null|null $id
     * @return void
     */
    public function index(int|string|null $id = null): void
    {

        if (!empty($id)) {
            $this->id = (int) $id;
            $deleteSituations = new \App\sts\Models\StsDeleteSituations();
            $deleteSituations->deleteSituations($this->id);            
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Necessário selecionar uma situação!</p>";
        }

        $urlRedirect = URLADM . "list-situations/index";
        header("Location: $urlRedirect");

    }
}
