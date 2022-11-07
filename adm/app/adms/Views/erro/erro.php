<?php

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

echo "VIEW - Página erro!<br>";
var_dump($this->data);
echo $this->data;