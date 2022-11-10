<?php

namespace App\sts\Models;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Apagar a mensagem de contato no banco de dados
 *
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class StsDeleteContactsMsgs
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * Metodo recebe como parametro o ID que sera usado para excluir o registro da tabela sts_contacts_msgs
     * Chama a função viewContactsMsgs para verificar se a mensagem esta cadastrada no sistema
     * @param integer $id
     * @return void
     */
    public function deleteContactsMsgs(int $id): void
    {
        $this->id = (int) $id;

        if($this->viewContactsMsgs()){
            $deleteContactsMsgs = new \App\adms\Models\helper\AdmsDelete();
            $deleteContactsMsgs->exeDelete("sts_contacts_msgs", "WHERE id =:id", "id={$this->id}");
    
            if ($deleteContactsMsgs->getResult()) {
                $_SESSION['msg'] = "<p class='alert-success'>Mensagem de contato apagada com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Mensagem de contato não apagada com sucesso!</p>";
                $this->result = false;
            }
        }else{
            $this->result = false;
        }
        
    }

    /**
     * Metodo faz a pesquisa para verificar se a mensagem de contato esta cadastrada no sistema, o resultado he enviado para a funcao deleteContactsMsgs
     *
     * @return boolean
     */
    private function viewContactsMsgs(): bool
    {

        $viewContactsMsgs = new \App\adms\Models\helper\AdmsRead();
        $viewContactsMsgs->fullRead("SELECT id FROM sts_contacts_msgs                           
                            WHERE id=:id
                            LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewContactsMsgs->getResult();
        if ($this->resultBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Mensagem de contato não encontrada!</p>";
            return false;
        }
    }
}
