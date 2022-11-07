<?php
 namespace App\adms\Controllers;
 // Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Controller da página erro
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class Erro
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     * Instanciar a classe responsável em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index():void
    {

        $this->data = "<p style='color: #f00;'>Página não encontrada!</p>";

        $loadView = new \Core\ConfigView("adms/Views/erro/erro", $this->data);
        $loadView->loadViewLogin();
    }
}