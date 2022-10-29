<?php
if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}

if (isset($this->data['form'][0])) {
    $valorForm = $this->data['form'][0];
}
?>

<h1>Editar Usuário</h1>

<?php

echo "<a href='" . URLADM . "list-users/index'>Listar</a><br>";
if (isset($valorForm['id'])) {
    echo "<a href='" . URLADM . "view-users/index/" . $valorForm['id'] . "'>Visualizar</a><br><br>";
}

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<span id="msg"></span>

<form method="POST" action="" id="form-edit-user">
    <?php
    $id = "";
    if (isset($valorForm['id'])) {
        $id = $valorForm['id'];
    }
    ?>
    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

    <?php
    $name = "";
    if (isset($valorForm['name'])) {
        $name = $valorForm['name'];
    }
    ?>
    <label>Nome:<span style="color: #f00;">*</span> </label>
    <input type="text" name="name" id="name" placeholder="Digite o nome completo" value="<?php echo $name; ?>" required><br><br>

    <?php
    $nickname = "";
    if (isset($valorForm['nickname'])) {
        $nickname = $valorForm['nickname'];
    }
    ?>
    <label>Apelido: </label>
    <input type="text" name="nickname" id="nickname" placeholder="Digite o apelido" value="<?php echo $nickname; ?>" ><br><br>

    <?php
    $email = "";
    if (isset($valorForm['email'])) {
        $email = $valorForm['email'];
    }
    ?>
    <label>E-mail:<span style="color: #f00;">*</span> </label>
    <input type="email" name="email" id="email" placeholder="Digite o seu melhor e-mail" value="<?php echo $email; ?>" required><br><br>

    <?php
    $user = "";
    if (isset($valorForm['user'])) {
        $user = $valorForm['user'];
    }
    ?>
    <label>Usuário:<span style="color: #f00;">*</span> </label>
    <input type="text" name="user" id="user" placeholder="Digite o usuário para acessar o administrativo" value="<?php echo $user; ?>" required><br><br>

    <span style="color: #f00;">* Campo Obrigatório</span><br><br>

    <button type="submit" name="SendEditUser" value="Salvar">Salvar</button>
</form>