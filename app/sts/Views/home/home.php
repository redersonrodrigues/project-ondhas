<?php

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

echo "View da página home do site<br>";

var_dump($this->data);

//Testar o acesso ao arquivo
//http://localhost/project-ondhas/app/sts/Views/home/home.php

//Testar o acesso ao arquivo
//http://localhost/project-ondhas/app/sts/