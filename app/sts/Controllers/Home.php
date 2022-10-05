<?php

namespace Sts\Controllers;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Controller da página Home
 * //http://localhost/project-ondhas/app/sts/Controllers/home.php
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class Home
{
 /** @var array|string|null $dados Recebe os dados que devem ser enviados para VIEW */
 
 private array|string|null $data;

 /**
  * Instanciar a classe responsável em carregar a View
  * 
  * @return void
  */
    public function index()
    {
		/** instanciando a model Home do site pelo método index. */
		$home = new \Sts\Models\StsHome();
		$this->data = $home->index();
	
        $loadView= new \Core\ConfigView("sts/Views/home/home", $this->data);
        $loadView->loadView();
    }
}