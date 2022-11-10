const formEditHomeTopImg = document.getElementById("form-edit-home-top-img");
if (formEditHomeTopImg) {
    formEditHomeTopImg.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var new_image = document.querySelector("#new_image").value;
        // Verificar se o campo esta vazio
        if (new_image === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário selecionar uma imagem!</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}

const formEditHomePremImg = document.getElementById("form-edit-home-prem-img");
if (formEditHomePremImg) {
    formEditHomePremImg.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var new_image = document.querySelector("#new_image").value;
        // Verificar se o campo esta vazio
        if (new_image === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário selecionar uma imagem!</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}

function inputFileValImgSts() {
    //Receber o valor do campo
    var new_image = document.querySelector("#new_image");

    var filePath = new_image.value;

    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

    if (!allowedExtensions.exec(filePath)) {
        new_image.value = '';
        document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário selecionar uma imagem JPG ou PNG!</p>";
        return;
    } else {
        previewImageHomeTop(new_image);
        document.getElementById("msg").innerHTML = "<p></p>";
        return;
    }
}

function previewImageHomeTop(new_image) {
    if ((new_image.files) && (new_image.files[0])) {
        // FileReader() - ler o conteúdo dos arquivos
        var reader = new FileReader();
        // onload - disparar um evento quando qualquer elemento tenha sido carregado
        reader.onload = function(e) {
            document.getElementById('preview-img').innerHTML = "<img src='" + e.target.result + "' alt='Imagem' style='width: 250px;'>";
        }
    }

    // readAsDataURL - Retorna os dados do formato blob como uma URL de dados - Blob representa um arquivo
    reader.readAsDataURL(new_image.files[0]);
}

const formEditHomeTop = document.getElementById("form-edit-home-top");
if (formEditHomeTop) {
    formEditHomeTop.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var title_one_top = document.querySelector("#title_one_top").value;
        // Verificar se o campo esta vazio
        if (title_one_top === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo título um!</p>";
            return;
        }

        //Receber o valor do campo
        var title_two_top = document.querySelector("#title_two_top").value;
        // Verificar se o campo esta vazio
        if (title_two_top === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo título dois!</p>";
            return;
        }

        //Receber o valor do campo
        var title_three_top = document.querySelector("#title_three_top").value;
        // Verificar se o campo esta vazio
        if (title_three_top === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo título três!</p>";
            return;
        }
        
        //Receber o valor do campo
        var link_btn_top = document.querySelector("#link_btn_top").value;
        // Verificar se o campo esta vazio
        if (link_btn_top === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo link do botão!</p>";
            return;
        }
        
        //Receber o valor do campo
        var txt_btn_top = document.querySelector("#txt_btn_top").value;
        // Verificar se o campo esta vazio
        if (txt_btn_top === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo texto do botão!</p>";
            return;
        }
    });
}

const formEditHomeServ = document.getElementById("form-edit-home-serv");
if (formEditHomeServ) {
    formEditHomeServ.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var serv_title = document.querySelector("#serv_title").value;
        // Verificar se o campo esta vazio
        if (serv_title === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo título!</p>";
            return;
        }

        //Receber o valor do campo
        var serv_title_one = document.querySelector("#serv_title_one").value;
        // Verificar se o campo esta vazio
        if (serv_title_one === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo título do serviço um!</p>";
            return;
        }

        //Receber o valor do campo
        var serv_icon_one = document.querySelector("#serv_icon_one").value;
        // Verificar se o campo esta vazio
        if (serv_icon_one === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo ícone do serviço um!</p>";
            return;
        }
        
        //Receber o valor do campo
        var serv_desc_one = document.querySelector("#serv_desc_one").value;
        // Verificar se o campo esta vazio
        if (serv_desc_one === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo descrição do serviço um!</p>";
            return;
        }

        //Receber o valor do campo
        var serv_title_two = document.querySelector("#serv_title_two").value;
        // Verificar se o campo esta vazio
        if (serv_title_two === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo título do serviço dois!</p>";
            return;
        }

        //Receber o valor do campo
        var serv_icon_two = document.querySelector("#serv_icon_two").value;
        // Verificar se o campo esta vazio
        if (serv_icon_two === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo ícone do serviço dois!</p>";
            return;
        }
        
        //Receber o valor do campo
        var serv_desc_two = document.querySelector("#serv_desc_two").value;
        // Verificar se o campo esta vazio
        if (serv_desc_two === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo descrição do serviço dois!</p>";
            return;
        }

        //Receber o valor do campo
        var serv_title_three = document.querySelector("#serv_title_three").value;
        // Verificar se o campo esta vazio
        if (serv_title_three === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo título do serviço três!</p>";
            return;
        }

        //Receber o valor do campo
        var serv_icon_three = document.querySelector("#serv_icon_three").value;
        // Verificar se o campo esta vazio
        if (serv_icon_three === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo ícone do serviço três!</p>";
            return;
        }
        
        //Receber o valor do campo
        var serv_desc_three = document.querySelector("#serv_desc_three").value;
        // Verificar se o campo esta vazio
        if (serv_desc_three === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo descrição do serviço três!</p>";
            return;
        }
    });
}

const formEditHomePrev = document.getElementById("form-edit-home-prem");
if (formEditHomePrev) {
    formEditHomePrev.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var prem_title = document.querySelector("#prem_title").value;
        // Verificar se o campo esta vazio
        if (prem_title === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo título!</p>";
            return;
        }

        //Receber o valor do campo
        var prem_subtitle = document.querySelector("#prem_subtitle").value;
        // Verificar se o campo esta vazio
        if (prem_subtitle === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo subtítulo!</p>";
            return;
        }

        //Receber o valor do campo
        var prem_desc = document.querySelector("#prem_desc").value;
        // Verificar se o campo esta vazio
        if (prem_desc === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo descrição!</p>";
            return;
        }
        
        //Receber o valor do campo
        var prem_btn_link = document.querySelector("#prem_btn_link").value;
        // Verificar se o campo esta vazio
        if (prem_btn_link === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo link do botão!</p>";
            return;
        }

        //Receber o valor do campo
        var prem_btn_text = document.querySelector("#prem_btn_text").value;
        // Verificar se o campo esta vazio
        if (prem_btn_text === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo texto do botão!</p>";
            return;
        }
    });
}

const formEditAboutCompTop = document.getElementById("form-add-abouts-comp");
if (formEditAboutCompTop) {
    formEditAboutCompTop.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var title = document.querySelector("#title").value;
        // Verificar se o campo esta vazio
        if (title === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo título!</p>";
            return;
        }

        //Receber o valor do campo
        var description = document.querySelector("#description").value;
        // Verificar se o campo esta vazio
        if (description === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo descrição!</p>";
            return;
        }

        //Receber o valor do campo
        var sts_situation_id = document.querySelector("#sts_situation_id").value;
        // Verificar se o campo esta vazio
        if (sts_situation_id === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo situação!</p>";
            return;
        }
    });
}