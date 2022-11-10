<?php

namespace App\sts\Models;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Editar a imagem do serviço premium da pagina home
 *
 * @author Celke
 */
class StsEditHomePremImg
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

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
     * @return bool Retorna os detalhes do registro
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    /**
     * Metodo para pesquisar a imagem do serviço premium da pagina home que sera editada
     * @return boolean
     */
    public function viewHomePremImg(): bool
    {

        $viewHomePremImg = new \App\adms\Models\helper\AdmsRead();
        $viewHomePremImg->fullRead(
            "SELECT id, prem_image 
                            FROM sts_homes_premiums
                            LIMIT :limit",
            "limit=1"
        );

        $this->resultBd = $viewHomePremImg->getResult();
        if ($this->resultBd) {
            $this->result = true;
            return true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Imagem do serviço premium da página home não encontrado!</p>";
            $this->result = false;
            return false;
        }
    }

    /**
     * Metodo recebe a informacao da imagem que sera editada
     * Instancia o helper AdmsValEmptyField para validar os campos do formulario
     * Retira o campo "new_image" da validacao
     * Chama o metodo valInput para validar a extensao da imagem     
     * @param array|null $data
     * @return void
     */
    public function update(array $data = null): void
    {
        $this->data = $data;

        $this->dataImagem = $this->data['new_image'];
        unset($this->data['new_image']);

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if ($valEmptyField->getResult()) {
            if (!empty($this->dataImagem['name'])) {
                $this->valInput();
            } else {
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Necessário selecionar uma imagem!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }

    /** 
     * Valida a extensão da imagem com o helper AdmsValExtImg
     * Retorna FALSE quando houve algum erro
     * 
     * @return void
     */
    private function valInput(): void
    {
        $valExtImg = new \App\adms\Models\helper\AdmsValExtImg();
        $valExtImg->validateExtImg($this->dataImagem['type']);
        if (($this->viewHomePremImg()) and ($valExtImg->getResult())) {
            $this->upload();
        } else {
            $this->result = false;
        }
    }

    /**
     * Metodo gera o slug da imagem com o helper AdmsSlug
     * Faz o upload da imagem usando o helper AdmsUploadImgRes
     * Chama o metodo edit para atualizar as informacoes no banco de dados
     * @return void
     */
    private function upload(): void
    {
        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->nameImg = $slugImg->slug($this->dataImagem['name']);

        $this->directory = "app/sts/assets/image/home_prem/";

        $uploadImgRes = new \App\adms\Models\helper\AdmsUploadImgRes();
        $uploadImgRes->upload($this->dataImagem, $this->directory, $this->nameImg, 500, 500);

        if ($uploadImgRes->getResult()) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }

    /**
     * Metodo envia as informações editadas para o banco de dados
     * Chama o metodo deleteImage apagar a imagem antiga
     *
     * @return void
     */
    private function edit(): void
    {
        $this->data['prem_image'] = $this->nameImg;
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upHomePremImg = new \App\adms\Models\helper\AdmsUpdate();
        $upHomePremImg->exeUpdate("sts_homes_premiums", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if ($upHomePremImg->getResult()) {
            $this->deleteImage();
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Imagem não editada com sucesso!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo apaga a imagem antiga
     * @return void
     */
    private function deleteImage(): void
    {
        if (((!empty($this->resultBd[0]['prem_image'])) or ($this->resultBd[0]['prem_image'] != null)) and ($this->resultBd[0]['prem_image'] != $this->nameImg)) {
            $this->delImg = "app/sts/assets/image/home_prem/" . $this->resultBd[0]['prem_image'];
            if (file_exists($this->delImg)) {
                unlink($this->delImg);
            }
        }

        $_SESSION['msg'] = "<p class='alert-success'>Imagem editada com sucesso!</p>";
        $this->result = true;
    }
}
