/**
 * Comment
 */
function selectRow(row) {
    $('.input-selecionado')
        .find('input:hidden').val(row.idpessoa).trigger('blur')
        .end()
        .find('input:text').val(row.nompessoa).trigger('blur');
}

$(function () {
    //$("ul").find('li').removeClass('disabled').addClass('enabled');
    $('ul').find('a').unbind('click');

    $('ul').find('a').on("click", function (e) {
        e.preventDefault();
    });

    $.pnotify.defaults.history = false;

    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        language: 'pt-BR'
    });

    $("#resetbutton").click(function () {
        //$('.container-importar').slideToggle();
        $("#importar").select2('data', null);
    });

    var
        $form = $("form#form-gerencia"),
        url_cadastrar = base_url + "/projeto/tap/add/format/json";

    $form.validate({
        errorClass: 'error',
        validClass: 'success',
        submitHandler: function (form) {
            enviar_ajax("/projeto/tap/add/format/json", "form#form-gerencia", function (data) {
                if (data.success) {
                    window.location.href = base_url + "/projeto/tap/informacoesiniciais/idprojeto/" + data.dados.idprojeto;
                }
            });
        }
    });

    $(".pessoa-button").on('click', function (event) {
        event.preventDefault();
        $(this).closest('.container-pessoa').find('.control-group').removeClass('input-selecionado');
        $(this).closest('.control-group').addClass('input-selecionado');
        if ($("table#list-grid-pessoa").length <= 0) {
            $.ajax({
                url: base_url + "/cadastro/pessoa/grid",
                type: "GET",
                dataType: "html",
                success: function (html) {
                    $(".grid-append").append(html).slideDown('fast');
                }
            });
            $('.pessoa-button')
                .off('click')
                .on('click', function () {
                    var $this = $(this);
                    $(".grid-append").slideDown('fast', function () {
                        $this.closest('.container-pessoa').find('.control-group').removeClass('input-selecionado');
                        $this.closest('.control-group').addClass('input-selecionado');
                    });
                });
        }
    });
});


