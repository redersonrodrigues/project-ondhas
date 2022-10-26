<?php

namespace App\adms\Models;

/**
 * Validar os dados do login
 *
 * @author Réderson
 */
class AdmsLogin
{

    /** @var array|null $data Recebe as informações do formulário */
    private array|null $data;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

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
     * Recebe os valores do formulário.
     * Recupera as informações do usuário no banco de dados
     * Quando encontrar o usuário no banco de dados instanciar o método "valPassword" para validar a senha 
     * Retorna FALSE quando não encontrar usuário no banco de dados
     * 
     * @param array $data Recebe as informações do formulário
     * 
     * @return void
     */
    public function login(array $data = null): void
    {
        $this->data = $data; 

        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT id, name, nickname, email, password, image FROM adms_users WHERE user =:user OR email =:email LIMIT :limit", "user={$this->data['user']}&email={$this->data['user']}&limit=1");

        $this->resultBd = $viewUser->getResult();
        if($this->resultBd){
            $this->valPassword();
        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário ou a senha incorreta!</p>";
            $this->result = false;
        }
    }

    /** 
     * Compara a senha enviado pelo usuário com a senha que está salva no banco de dados
     * Retorna TRUE quando os dados estão corretos e salva as informações do usuário na sessão
     * Retorna FALSE quando a senha está incorreta
     * 
     * @return void
     */
    private function valPassword(): void
    {
        if(password_verify($this->data['password'], $this->resultBd[0]['password'])){
            $_SESSION['user_id'] = $this->resultBd[0]['id'];
            $_SESSION['user_name'] = $this->resultBd[0]['name'];
            $_SESSION['user_nickname'] = $this->resultBd[0]['nickname'];
            $_SESSION['user_email'] = $this->resultBd[0]['email'];
            $_SESSION['user_image'] = $this->resultBd[0]['image'];
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário ou a senha incorreta!</p>";
            $this->result = false;
        }
    }
}