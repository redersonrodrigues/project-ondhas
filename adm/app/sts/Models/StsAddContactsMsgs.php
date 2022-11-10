<?php

namespace App\sts\Models;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Cadastrar nova mensagem de contato no banco de dados
 *
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class StsAddContactsMsgs
{
    /** @var array|null $data Recebe as informacoes do formulario */
    private array|null $data;

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /** 
     * Recebe os valores do formulario.
     * Instancia o helper "AdmsValEmptyField" para verificar se todos os campos estao preenchidos 
     * Verifica se todos os campos estao preenchidos e instancia o método "valInput" para validar os dados dos campos
     * Retorna FALSE quando algum campo esta vazio
     * 
     * @param array $data Recebe as informações do formulario
     * 
     * @return void
     */
    public function create(array $data = null)
    {
        $this->data = $data;

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if ($valEmptyField->getResult()) {
            $this->add();
        } else {
            $this->result = false;
        }
    }

    /** 
     * Cadastrar mensagem de contato no banco de dados
     * Retorna TRUE quando cadastrar a mensagem de contato com sucesso
     * Retorna FALSE quando nao cadastrar a mensagem de contato
     * 
     * @return void
     */
    private function add(): void
    {
        $this->data['created'] = date("Y-m-d H:i:s");

        $createContactsMsgs = new \App\adms\Models\helper\AdmsCreate();
        $createContactsMsgs->exeCreate("sts_contacts_msgs", $this->data);

        if ($createContactsMsgs->getResult()) {
            $_SESSION['msg'] = "<p class='alert-success'>Mensagem de contato cadastrada com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Mensagem de contato não cadastrada com sucesso!</p>";
            $this->result = false;
        }
    }
}
