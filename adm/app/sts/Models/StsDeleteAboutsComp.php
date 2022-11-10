<?php

namespace App\sts\Models;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Apagar o sobre empresa no banco de dados
 *
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class StsDeleteAboutsComp
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var string $delDirectory Recebe o endereço para apagar o diretorio */
    private string $delDirectory;

    /** @var string $delImg Recebe o endereço para apagar a imagem */
    private string $delImg;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * Metodo recebe como parametro o ID que sera usado para excluir o registro da tabela sts_abouts_companies
     * Chama a função viewAboutsComp para verificar se sobre esta cadastrado no sistema e na sequencia chama a funcao deleteImg para apagar a imagem do usuario
     * @param integer $id
     * @return void
     */
    public function deleteAboutsComp(int $id): void
    {
        $this->id = (int) $id;

        if($this->viewAboutsComp()){
            $deleteAboutsComp = new \App\adms\Models\helper\AdmsDelete();
            $deleteAboutsComp->exeDelete("sts_abouts_companies", "WHERE id =:id", "id={$this->id}");
    
            if ($deleteAboutsComp->getResult()) {
                $this->deleteImg();
                $_SESSION['msg'] = "<p class='alert-success'>Sobre empresa apagado com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Sobre empresa não apagado com sucesso!</p>";
                $this->result = false;
            }
        }else{
            $this->result = false;
        }
        
    }

    /**
     * Metodo faz a pesquisa para verificar se sobre empresa esta cadastrado no sistema, o resultado he enviado para a funcao deleteUser
     *
     * @return boolean
     */
    private function viewAboutsComp(): bool
    {

        $viewAboutsComp = new \App\adms\Models\helper\AdmsRead();
        $viewAboutsComp->fullRead(
            "SELECT id, image
                            FROM sts_abouts_companies                           
                            WHERE id=:id
                            LIMIT :limit",
            "id={$this->id}&limit=1"
        );

        $this->resultBd = $viewAboutsComp->getResult();
        if ($this->resultBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Sobre empresa não encontrado!</p>";
            return false;
        }
    }

    /**
     * Metodo usado para apagar a imagem e o diretorio sobre empresa no servidor
     *
     * @return void
     */
    private function deleteImg(): void
    {
        if((!empty($this->resultBd[0]['image'])) or ($this->resultBd[0]['image'] != null)){
            $this->delDirectory = "app/sts/assets/image/about/" . $this->resultBd[0]['id'];
            $this->delImg = $this->delDirectory . "/" . $this->resultBd[0]['image'];

            if(file_exists($this->delImg)){
                unlink($this->delImg);
            }

            if(file_exists($this->delDirectory)){
                rmdir($this->delDirectory);
            }
        }
    }
}
