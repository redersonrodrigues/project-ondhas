<?php

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
?>

<script src="<?php echo URLADM; ?>app/adms/assets/js/custom_login.js"></script>
</body>

</html>