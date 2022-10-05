<?php

session_start(); // iniciar a sessão
ob_start(); // Buffer de saída (limpar) - caso de redirecionamento

//Constante que define que o usuário está acessando páginas internas através da página "index.php".
define('R1A0M4A2R2', true);

	/** Carregar o composer */
    require './vendor/autoload.php';
	/** Instanciar a classe ConfigController, responsável em tratar a URL */
    $url = new Core\ConfigController();
	/** Instanciar o método para carregar a página/controller */
    $url->loadPage();

