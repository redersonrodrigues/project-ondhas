<?php 
// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('R1A0M4A2R2')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
?>
<!-- incluir o JavaScript -->
<script src="<?php echo URL; ?>app/sts/assets/js/custom.js"></script>

</body>

</html>