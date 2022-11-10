<?php

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}

if (isset($this->data['form'][0])) {
    $valorForm = $this->data['form'][0];
}
?>
<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Editar Imagem do Serviço Premium</span>
            <div class="top-list-right">
                <?php
                echo "<a href='" . URLADM . "view-page-home/index' class='btn-primary'>Visualizar</a> ";
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
            <span id="msg"></span>
        </div>

        <div class="content-adm">
            <form method="POST" action="" id="form-edit-home-prem-img" class="form-adm" enctype="multipart/form-data">

                <?php
                $id = "";
                if (isset($valorForm['id'])) {
                    $id = $valorForm['id'];
                }
                ?>
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

                <div class="row-input">
                    <div class="column">
                        <?php
                        $prem_image = "";
                        if (isset($valorForm['prem_image'])) {
                            $prem_image = $valorForm['prem_image'];
                        }
                        ?>
                        <label class="title-input">Imagem:<span class="text-danger">*</span> 500x500</label>
                        <input type="file" name="new_image" id="new_image" class="input-adm" onchange="inputFileValImgSts()">
                    </div>
                    <div class="column">
                        <?php
                        if ((!empty($valorForm['prem_image'])) and (file_exists("app/sts/assets/image/home_prem/" . $valorForm['prem_image']))) {
                            $old_image = URLADM . "app/sts/assets/image/home_prem/" . $valorForm['prem_image'];
                        } else {
                            $old_image = URLADM . "app/sts/assets/image/home_prem/icon_premium_serv.jpg";
                        }
                        ?>
                        <span id="preview-img">
                            <img src="<?php echo $old_image; ?>" alt="Imagem" style="width: 250px;">
                        </span>
                    </div>
                </div>

                <p class="text-danger mb-5 fs-4">* Campo Obrigatório</p>

                <button type="submit" name="SendEditHomePremImg" class="btn-warning" value="Salvar">Salvar</button>

            </form>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->