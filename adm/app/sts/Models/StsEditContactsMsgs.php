<?php

namespace App\sts\Models;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Editar mensagem de contato no banco de dados
 *
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class StsEditContactsMsgs
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /** @var array|null $data Recebe as informacoes do formulario */
    private array|null $data;

    /** @return bool Retorna true quando executar o processo com sucesso e false quando houver erro */
    function getResult(): bool
    {
        return $this->result;
    }

    /** @return bool Retorna os detalhes do registro */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    /**
     * Metodo recebe como parametro o ID que sera usado para verificar se tem o registro cadastrado no banco de dados
     * @param integer $id
     * @return void
     */
    public function viewContactsMsgs(int $id): void
    {
        $this->id = $id;

        $viewContactsMsgs = new \App\adms\Models\helper\AdmsRead();
        $viewContactsMsgs->fullRead("SELECT id, name, email, subject, content
                            FROM sts_contacts_msgs
                            WHERE id=:id
                            LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewContactsMsgs->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Mensagem de contato não encontrada!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo recebe as informacoes da mensagem de contato que serao validadas
     * Instancia o helper AdmsValEmptyField para validar os campos do formulario    
     * Chama o metodo valInput para validar os campos especificos do formulario
     * @param array|null $data
     * @return void
     */
    public function update(array $data = null): void
    {
        $this->data = $data;

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if ($valEmptyField->getResult()) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }

    /**
     * Metodo envia as informacoes editadas para o banco de dados
     * @return void
     */
    private function edit(): void
    {
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upContactsMsgs = new \App\adms\Models\helper\AdmsUpdate();
        $upContactsMsgs->exeUpdate("sts_contacts_msgs", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if ($upContactsMsgs->getResult()) {
            $_SESSION['msg'] = "<p class='alert-success'>Mensagem de contato editada com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Mensagem de contato não editada com sucesso!</p>";
            $this->result = false;
        }
    }

}
