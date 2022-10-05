<?php

namespace Sts\Controllers;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Controller da página Home
 * 
 * @author Réderson <rederson@ramartecnologia.com.br>
 */
class Contato
{

    /** @var array|string|null $dados Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /** @var array|null $dataForm Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $dataForm;


    /**
     * Instanciar a classe responsável em carregar a View
     * //http://localhost/project-ondhas/app/sts/Controllers/Contato.php
     * @return void
     */
    public function index(): void
    {
		/** transforma os dados recebidos do formulário em array */
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dataForm['AddContMsg'])) {
            var_dump($this->dataForm);
			// Instancia um objeto para cadastro no banco de dados da Models
            $createContactMsg = new \Sts\Models\StsContato();
			/** metodo para testar se conseguiu cadastrar corretamente */
            if ($createContactMsg->create($this->dataForm)) {
                echo "Cadastrado!<br>";
                echo $_SESSION['msg'];
            } else {
                echo "Não cadastrado!<br>";
                echo $_SESSION['msg'];
            }
        }

        $this->data = "Mensagem enviada com sucesso!<br>";
        $loadView = new \Core\ConfigView("sts/Views/contato/contato", $this->data);
        $loadView->loadView();
    }
}
