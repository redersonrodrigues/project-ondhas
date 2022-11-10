<?php
if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}
?>
<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Detalhes Sobre Empresa</span>
            <div class="top-list-right">
                <?php
                echo "<a href='" . URLADM . "list-abouts-comp/index' class='btn-info'>Listar</a> ";
                if (!empty($this->data['viewAboutsComp'])) {
                    echo "<a href='" . URLADM . "edit-abouts-comp/index/" . $this->data['viewAboutsComp'][0]['id'] . "' class='btn-warning'>Editar</a> ";
                    echo "<a href='" . URLADM . "edit-abouts-comp-image/index/" . $this->data['viewAboutsComp'][0]['id'] . "' class='btn-warning'>Editar Imagem</a> ";
                    echo "<a href='" . URLADM . "delete-abouts-comp/index/" . $this->data['viewAboutsComp'][0]['id'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este registro?\")' class='btn-danger'>Apagar</a> ";
                }
                ?>
            </div>
        </div>

        <div class="content-adm-alert">
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
        </div>

        <div class="content-adm">
            <?php
            if (!empty($this->data['viewAboutsComp'])) {
                extract($this->data['viewAboutsComp'][0]);
            ?>
                <div class="view-det-adm">
                    <span class="view-adm-title">Foto: </span>
                    <span class="view-adm-info">
                        <?php
                        if ((!empty($image)) and (file_exists("app/sts/assets/image/about/$id/$image"))) {
                            echo "<img src='" . URLADM . "app/sts/assets/image/about/$id/$image' width='100' height='100'><br><br>";
                        } else {
                            echo "<img src='" . URLADM . "app/sts/assets/image/about/icon_about_comp.jpg' width='100' height='100'><br><br>";
                        }
                        ?>
                    </span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">ID: </span>
                    <span class="view-adm-info"><?php echo $id; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Título: </span>
                    <span class="view-adm-info"><?php echo $title; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Descrição: </span>
                    <span class="view-adm-info"><?php echo $description; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Situação: </span>
                    <span class="view-adm-info"><?php echo $name_sit; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Cadastrado: </span>
                    <span class="view-adm-info"><?php echo date('d/m/Y H:i:s', strtotime($created)); ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Editado: </span>
                    <span class="view-adm-info">
                        <?php
                        if (!empty($modified)) {
                            echo date('d/m/Y H:i:s', strtotime($modified));
                        } ?>
                    </span>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->