<?php

namespace App\sts\Models;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Visualizar mensagem de contato do banco de dados
 *
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class StsViewContactsMsgs
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
     * Metodo para visualizar os detalhes da mensagem do contato
     * Recebe o ID da mensagem de contato que sera usado como parametro na pesquisa
     * Retorna FALSE se houver algum erro
     * @param integer $id
     * @return void
     */
    public function viewContactsMsgs(int $id): void
    {
        $this->id = $id;

        $viewContactsMsgs = new \App\adms\Models\helper\AdmsRead();
        $viewContactsMsgs->fullRead("SELECT id, name, email, subject, content, created, modified
                            FROM sts_contacts_msgs
                            WHERE id=:id
                            LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewContactsMsgs->getResult();        
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Mensagem não encontrada!</p>";
            $this->result = false;
        }
    }
}
