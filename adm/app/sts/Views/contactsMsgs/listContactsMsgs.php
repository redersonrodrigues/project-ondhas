<?php

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}
?>

<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Listar Mensagens de Contato</span>
            <div class="top-list-right">
                <?php
                echo "<a href='" . URLADM . "add-contacts-msgs/index' class='btn-success'>Cadastrar</a>";
                ?>
            </div>
        </div>

        <div class="top-list">
            <form method="POST" action="">
                <div class="row-input-search">
                    <?php
                    $search_msg = "";
                    if (isset($valorForm['search_msg'])) {
                        $search_msg = $valorForm['search_msg'];
                    }
                    ?>
                    <div class="column">
                        <label class="title-input-search">Pesquisar: </label>
                        <input type="text" name="search_msg" id="search_title" class="input-search" placeholder="Pesquisar no e-mail ou assunto" value="<?php echo $search_msg; ?>">
                    </div>

                    <div class="column margin-top-search-one">
                        <button type="submit" name="SendSearchContactsMsgs" class="btn-info" value="Pesquisar">Pesquisar</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="content-adm-alert">
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
        </div>
        <table class="table-list">
            <thead class="list-head">
                <tr>
                    <th class="list-head-content">ID</th>
                    <th class="list-head-content">Nome</th>
                    <th class="list-head-content table-sm-none">E-mail</th>
                    <th class="list-head-content table-sm-none">Assunto</th>
                    <th class="list-head-content">Ações</th>
                </tr>
            </thead>
            <tbody class="list-body">
                <?php
                foreach ($this->data['listContactsMsgs'] as $contactsMsgs) {
                    extract($contactsMsgs);
                ?>
                    <tr>
                        <td class="list-body-content"><?php echo $id; ?></td>
                        <td class="list-body-content"><?php echo $name; ?></td>
                        <td class="list-body-content table-sm-none"><?php echo $email; ?></td>
                        <td class="list-body-content table-sm-none"><?php echo $subject; ?></td>
                        <td class="list-body-content">
                            <div class="dropdown-action">
                                <button onclick="actionDropdown(<?php echo $id; ?>)" class="dropdown-btn-action">Ações</button>
                                <div id="actionDropdown<?php echo $id; ?>" class="dropdown-action-item">
                                    <?php
                                    echo "<a href='" . URLADM . "view-contacts-msgs/index/$id'>Visualizar</a>";
                                    echo "<a href='" . URLADM . "edit-contacts-msgs/index/$id'>Editar</a>";
                                    echo "<a href='" . URLADM . "delete-contacts-msgs/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir este registro?\")'>Apagar</a>";
                                    ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <?php echo $this->data['pagination']; ?>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->