<?php

namespace App\sts\Models\helper;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Classe genérica para upload
 *
 * @author Celke
 */
class StsUploadImg
{
    /** @var string $directory Recebe o caminho do direitorio*/
    private string $directory;
    /** @var string $tmpName Recebe o nome temporario*/
    private string $tmpName;
    /** @var array $imageData Recebe a informação da imagem*/
    private array $imageData;
    /** @var string $name Recebe o nome da imagem*/
    private string $name;


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
     * Metodo recebe o caminho do diretorio, o nome temporario e o nome da imagem que será salvo
     * Chama o metodo valDirectory para validar o caminho do diretorio e na sequencia chama o metodo uploadFile para fazer o upload
     * Retorna FALSE caso tenha algum erro
     * @param string $directory
     * @param string $tmpName
     * @param string $name
     * @return void
     */
    public function upload(string $directory, array $imageData, string $name): void
    {
        $this->directory = $directory;
        $this->tmpName = $imageData['tmp_name'];
        $this->imageData = $imageData;
        $this->name = $name;

        $this->valFile();
    }

    /**
     * Metodo verifica o tipo da imagem JPEG ou PNG
     * Chama o metodo valDirectory 
     * Retorna FALSE se houver algum erro
     * @return void
     */
    private function valFile(): void
    {
        switch ($this->imageData['type']) {
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->valDirectory();
                break;
            case 'image/png':
            case 'image/x-png':
                $this->valDirectory();
                break;
            default:
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Necessário selecionar imagem JPEG ou PNG!</p>";
                $this->result = false;
        }
    }

    /**
     * Metodo verifica se o diretorio é valido e se ele existe, se não existir, o diretorio é criado
     * 
     * @return boolean
     */
    private function valDirectory():void
    {
        if ((!file_exists($this->directory)) and (!is_dir($this->directory))) {
            mkdir($this->directory, 0755);
            if ((!file_exists($this->directory)) and (!is_dir($this->directory))) {
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Upload não realizado com sucesso. Tente novamente!</p>";
                $this->result = false;
            }else{
                $this->uploadFile();
            }
        }else{
            $this->uploadFile();
        }
    }

    /**
     * Metodo faz o upload do arquivo no servidor
     * Retorna FALSE se houver algum erro
     * @return void
     */
    private function uploadFile(){
        if (move_uploaded_file($this->tmpName, $this->directory . $this->name)) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Upload não realizado com sucesso. Tente novamente!</p>";
            $this->result = false;
        }
    }

}
