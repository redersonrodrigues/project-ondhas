<?php
session_start();
ob_start();

define('R1A0M4A2R2', true);

//Carregar o Composer
require './vendor/autoload.php';

//Instanciar a classe ConfigController, responsável em tratar a URL
$home = new Core\ConfigController();

//Instanciar o método para carregar a página/controller
$home->loadPage();
