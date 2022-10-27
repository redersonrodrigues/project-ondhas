<?php
if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}
?>

<h1>Nova Senha</h1>

<?php
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<span id="msg"></span>

<form method="POST" action="" id="form-login">    

    <?php
    $password = "";
    if (isset($valorForm['password'])) {
        $password = $valorForm['password'];
    }
    ?>
    <label>Senha: </label>
    <input type="password" name="password" id="password" placeholder="Digite a nova senha" value="<?php echo $password; ?>"><br><br>

    <button type="submit" name="SendUpPass" value="Salvar">Salvar</button>
</form>
<p><a href="<?php echo URLADM; ?>">Clique aqui</a> para acessar</p>
