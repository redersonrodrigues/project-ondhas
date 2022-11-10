<?php

namespace App\sts\Models;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Visualizar sobre empresa no banco de dados
 *
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class StsViewAboutsComp
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * @return bool Retorna os detalhes do registro
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    /**
     * Metodo para visualizar os detalhes sobre empresa
     * Recebe o ID do sobre empresa que sera usado como parametro na pesquisa
     * Retorna FALSE se houver algum erro
     * @param integer $id
     * @return void
     */
    public function viewAboutsComp(int $id): void
    {
        $this->id = $id;

        $viewAboutsComp = new \App\adms\Models\helper\AdmsRead();
        $viewAboutsComp->fullRead("SELECT comp.id, comp.title, comp.description, comp.image, comp.created, comp.modified,
                            sit.name AS name_sit
                            FROM sts_abouts_companies AS comp
                            INNER JOIN sts_situations AS sit ON sit.id=comp.sts_situation_id 
                            WHERE comp.id=:id
                            LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewAboutsComp->getResult();        
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Sobre empresa não encontrado!</p>";
            $this->result = false;
        }
    }
}
