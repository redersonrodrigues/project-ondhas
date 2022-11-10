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
            <span class="title-content">Listar Sobre Empresa</span>
            <div class="top-list-right">
                <?php
                echo "<a href='" . URLADM . "add-abouts-comp/index' class='btn-success'>Cadastrar</a>";
                ?>
            </div>
        </div>

        <div class="top-list">
            <form method="POST" action="">
                <div class="row-input-search">
                    <?php
                    $search_title = "";
                    if (isset($valorForm['search_title'])) {
                        $search_title = $valorForm['search_title'];
                    }
                    ?>
                    <div class="column">
                        <label class="title-input-search">Pesquisar: </label>
                        <input type="text" name="search_title" id="search_title" class="input-search" placeholder="Pesquisar no título ou descrição" value="<?php echo $search_title; ?>">
                    </div>

                    <div class="column margin-top-search-one">
                        <button type="submit" name="SendSearchAboutsComp" class="btn-info" value="Pesquisar">Pesquisar</button>
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
                    <th class="list-head-content">Título</th>
                    <th class="list-head-content table-sm-none">Situação</th>
                    <th class="list-head-content">Ações</th>
                </tr>
            </thead>
            <tbody class="list-body">
                <?php
                foreach ($this->data['listAboutsComp'] as $aboutsComp) {
                    extract($aboutsComp);
                ?>
                    <tr>
                        <td class="list-body-content"><?php echo $id; ?></td>
                        <td class="list-body-content"><?php echo $title; ?></td>
                        <td class="list-body-content table-sm-none"><?php echo $name_sit; ?></td>
                        <td class="list-body-content">
                            <div class="dropdown-action">
                                <button onclick="actionDropdown(<?php echo $id; ?>)" class="dropdown-btn-action">Ações</button>
                                <div id="actionDropdown<?php echo $id; ?>" class="dropdown-action-item">
                                    <?php
                                    echo "<a href='" . URLADM . "view-abouts-comp/index/$id'>Visualizar</a>";
                                    echo "<a href='" . URLADM . "edit-abouts-comp/index/$id'>Editar</a>";
                                    echo "<a href='" . URLADM . "delete-abouts-comp/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir este registro?\")'>Apagar</a>";
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