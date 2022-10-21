<?php
//require './core/Config.php';

namespace Core;



class ConfigController extends Config

{



    private string $url;

    private array $urlArray;

    private string $urlController;

    private string $urlMetodo;

    private string $urlParameter;

    private string $classLoad;





    public function __construct()

    {

        $this->configAdm();

        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {

            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);

            var_dump($this->url);

            $this->urlArray = explode("/", $this->url);

            var_dump($this->urlArray);



            if (isset($this->urlArray[0])) {

                $this->urlController = $this->urlArray[0];

            } else {

                $this->urlController = CONTROLLER;

            }



            if (isset($this->urlArray[1])) {

                $this->urlMetodo = $this->urlArray[1];

            } else {

                $this->urlMetodo = METODO;

            }



            if (isset($this->urlArray[2])) {

                $this->urlParameter = $this->urlArray[2];

            } else {

                $this->urlParameter = "";

            }

        } else {

            $this->urlController = CONTROLLERERRO;

            $this->urlMetodo = METODO;

            $this->urlParameter = "";

        }

        echo "Controller: {$this->urlController} <br>";

        echo "Metodo: {$this->urlMetodo} <br>";

        echo "Paramentro: {$this->urlParameter} <br>";

    }



    public function loadPage()

    {

        echo "Carregar Pagina: {$this->urlController}<br>";



        $this->urlController = ucwords($this->urlController);

        echo "Carregar Pagina corrigida: {$this->urlController}<br>";



        $this->classLoad = "\\App\\adms\\Controllers\\" . $this->urlController;

        $classePage = new $this->classLoad();

        $classePage->{$this->urlMetodo}();





        /*$login = new \App\adms\Controllers\Login();

        $login->index();



        $users = new \App\adms\Controllers\Users();

        $users->index();*/

    }

}