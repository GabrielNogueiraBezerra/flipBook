$(document).ready(function () {
    $("#estado").change(function () {
        var URLLocal = 'http://localhost:8000/buscarCidadesPerfil/' + this.value;
        var select = document.getElementById("cidade");
        $("#cidade").empty();

        $.ajax({

            type: 'GET',

            url: URLLocal,

            dataType: 'json',

            data: {'value': $(this).val()},

            success: function (result) {
                for (var i = 0; i < result.length; i++) {
                    var option = new Option(result[i].descricao, result[i].id);
                    select.add(option);
                }

            }
        });
    });
});