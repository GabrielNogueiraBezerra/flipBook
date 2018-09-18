$(document).ready(function () {
    //Cadastro usuario
    $("#dados-localizacao").hide();
    $("#dados-conta").hide();



    $("#dados-usuario .form-control").on("keydown", function () {
        if ($("[name='nome']").val() != '' && $("[name='sobrenome']").val() != '' && $("[name='data']").val() != '' && $("[name='telefone']").val() != '') {
            $("[data-actives='dados-localizacao']").attr("disabled", false);
        } else {
            $("[data-actives='dados-localizacao']").attr("disabled", true);
        }

    });

    $("#dados-localizacao .form-control").on("keydown", function () {
        if ($("[name='endereco']").val() != '' && $("[name='numero']").val() != '' && $("[name='cep']").val() != '' && $("[name='estado']").val() != '' && $("[name='cidade']").val() != '') {
            $("[data-actives='dados-conta']").attr("disabled", false);
        } else {
            $("[data-actives='dados-conta']").attr("disabled", true);
        }

    });

    $("[data-actives='dados-localizacao']").click(function () {
        $("#dados-usuario").hide();
        $("#dados-conta").hide();
        $("#dados-localizacao").show();
    });

    $("[data-actives='dados-conta']").click(function () {
        $("#dados-usuario").hide();
        $("#dados-localizacao").hide();
        $("#dados-conta").show();
    });

    $("[data-actives='dados-usuario']").click(function () {
        $("#dados-localizacao").hide();
        $("#dados-conta").hide();
        $("#dados-usuario").show();
    });

    //livros
    $(".list-group a").click(function () {
        var livro = $(this);
        if (!livro.hasClass('bg-warning text-light')) {
            $(".list-group a").removeClass("bg-warning text-light");
            livro.addClass("bg-warning text-light");
            $("#lista-opcoes a ").removeClass("disabled");
            $("#lista-opcoes a[name='ver-livro']").attr("href", "livro/" + livro.attr("id-livro"));
            $("#lista-opcoes a[name='alterar-livro']").attr("href", "livros/" + livro.attr("id-livro"));
            $("#lista-opcoes a[name='excluir-livro']").attr("href", "excluir/" + livro.attr("id-livro"));
        } else {
            livro.removeClass("bg-warning text-light");
            $("#lista-opcoes a ").addClass("disabled");

        }
    });


});