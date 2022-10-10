<?php

namespace Sts\Controllers;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Controller da página Home
 * //http://localhost/project-ondhas/app/sts/Controllers/SobreEmpresa.php
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class SobreEmpresa
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

	  $aboutCompany = new \Sts\Models\StsSobreEmpresa();
	  $this->data['about-company'] = $aboutCompany->index();

	  //var_dump($this->data['about-company']);
	  
	  $loadView= new \Core\ConfigView("sts/Views/sobreEmpresa/sobreEmpresa", $this->data);
	  $loadView->loadView();
  }
}
