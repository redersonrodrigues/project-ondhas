<?php

namespace App\adms\Controllers;
/**

 * Controller da página users

 * @author Réderson <rederson@ramartecnologia.com.br>

 */
class Users
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    public function index()
    {
        $this->data = [];

        $loadView = new \Core\ConfigView("adms/Views/users/users", $this->data);
        $loadView->loadView();
    }
}
