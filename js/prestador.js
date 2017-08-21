/**
 * Created by carlos on 20/08/17.
 */

$(document).ready(function () {
    getListObj();
    comboBoxEspecialidade( 0 );
    $('.progress').fadeOut();
    $('.mensagem').fadeOut();
    $('.msgAvisoModal').fadeOut();
    getObj( $('#id').val() );
   // comboBoxConselho( 0 );

});

function comboBoxConselho( id ) {
    $('#conselho').find('option').remove();
    $("#conselho").append($("<option />").val(0).text("Selecione"));
    $.ajax({
        url   : 'function/tipo_conselho.php',
        type  : 'post',
        dataType : 'json',
        data : {
            acao : 'L'
        },
        success : function (data) {

            $.each( data.objetos, function (i, j) {
                $("#conselho").append($("<option />").val(j.id).text(j.name));
            } );
            if( id > 0 )
              $("#conselho").val( id );

        }
    });
}


function comboBoxEspecialidade( id ) {
    $('#especialidade').find('option').remove();
    $.ajax({
        url   : 'function/especialidade.php',
        type  : 'post',
        dataType : 'json',
        data : {
            acao : 'L'
        },
        success : function (data) {

            $.each( data.objetos, function (i, j) {
                $("#especialidade").append($("<option />").val(j.id).text(j.name));
            } );
            if( id > 0 )
                $("#especialidade").val( id );

        }
    });
}

function getObj( id ) {
    if( id > 0 ){

        $.ajax({
            url  : 'function/prestador.php',
            type : 'post',
            dataType : 'json',
            data : {
                acao : 'G',
                id   : id
            },
            success : function (data) {
                $('#nome').val( data.nome );
                $('#especialidade').val( data.especialidade );

            }
        })

    }
}




$('.btn-salvar').on('click',function () {
    if( validarcampos() ){
        var acao  = $('#acao').val();
        var id    = $('#id').val();
        var nome  = $('#nome').val();
        var especialidade  = $('#especialidade').val();

        $.ajax({
            url   : 'function/prestador.php',
            type  : 'post',
            dataType : 'json',
            beforeSend : aguardando,
            data : {

                acao  : acao,
                id    : id,
                nome  : nome,
                especialidade : especialidade
            },
            success : function (data) {
                $('.progress').fadeOut();
                if( data.sucesso === 1){
                    msgSucesso();
                }else{
                    erroSend();
                }
            }
        });

    }
    return false;
})






function getListObj() {
    $('.tbody').find( 'tr' ).remove();
    $.ajax({
        url  : 'function/prestador.php',
        type : 'post',
        dataType : 'json',
        data : {
            acao : 'L'
        },
        success: function (data) {

            $.each( data.objetos, function (i, j) {


                $('.tbody').append(
                    "<tr>"+
                        "<td>"+ j.id +"</td>"+
                        "<td>"+ j.name +"</td>"+
                        "<td>"+ j.especialidade +"</td>"+
                        "<td>" +
                            "<a href='#editar' class='btn btn-warning btn-editar' title='Editar' data-id='"+ j.id +"'><i class='fa fa-pencil-square-o'></i> Editar </a> &nbsp;" +
                            "<a href='#excluir' class='btn btn-danger btn-excluir' title='Excluir' data-id='"+ j.id +"' data-nome='"+ j.name +"'><i class='fa fa-times'></i> Excluir</a>" +
                        "</td>"+
                    "</tr>"


                );
            } );

            $('.btn-editar').on('click', function () {
              //  console.log("Editar");
                var id = $(this).data('id');
                var form = $('<form method="post" action="prestadoralt.php">'+
                    '<input type="hidden" name="id" value="'+ id +'" />'+
                    '</form>');
                $('body').append(form);
                form.submit();
            });

            $('.btn-excluir').on('click', function () {
             //   console.log("Editar");
                var id = $(this).data('id');
                var nome = $(this).data('nome');
                $('span.user-nome').text(nome);
                $('.modal-question').modal('show');
                $('.btn-sim').on('click', function () {
                    $.ajax({
                        url  : 'function/prestador.php',
                        type : 'post',
                        dataType: 'json',
                        befereSend : aguardandoModal,
                        data : {
                            acao : 'E',
                            id   : id
                        },
                        success : function (data) {

                            $('.progress').fadeOut();
                            if( data.success === 1 ){
                                msgSucessoModal();
                            }else{
                                erroSendModal();
                            }
                        }
                    });
                });


            });

        }
    });

}

function validarcampos() {

    var descricao = $('#descricao').val();

    if( descricao != "" ){
        colorirCampo( "descricao", "" );
        return true;
    }else{
        if( descricao == "" ){
            colorirCampo( "descricao", "red" );
        }

        return false;
    }



}


function colorirCampo( id, cor ) {

    $('input[id="'+ id +'"]').css( "border-color", cor );

}





function aguardando() {
    $('.progress').fadeIn();
}

function erroSend() {
    var mensagem = $('.mensagem');
    mensagem.empty().html("<p class='alert alert-danger'><strong>Ops</strong> Ocorreu um erro ao processar sua requisi&ccedil;&atilde;o </p>").fadeIn();
    setTimeout(function () {
        mensagem.fadeOut('slow');
    }, 3000)

}

function aguardandoModal() {
    var mensagem = $('.mensagem');
    mensagem.empty().html("<p class='alert alert-danger'><strong>Ops</strong> Ocorreu um erro ao processar sua requisi&ccedil;&atilde;o </p>").fadeIn();
    setTimeout(function () {
        mensagem.fadeOut('slow');
    }, 3000)

}

function erroSendModal() {
    var mensagem = $('.msgAvisoModal');
    mensagem.empty().html("<p class='alert alert-danger'><strong>Ops</strong> Ocorreu um erro ao processar sua requisi&ccedil;&atilde;o </p>").fadeIn();
    setTimeout(function () {
        mensagem.fadeOut('slow');
    }, 3000)

}

function msgSucesso() {
    var mensagem = $('.mensagem');
    mensagem.empty().html("<p class='alert alert-success'><strong>Parab&eacute;ns</strong> Opera&ccedil;&atilde;o realizada com sucesso! </p>").fadeIn();
    setTimeout(function () {
        location.href = "prestador.php";
    },3000);
}


function msgSucessoModal() {
    var mensagem = $('.msgAvisoModal');
    mensagem.empty().html("<p class='alert alert-success'><strong>Parab&eacute;ns</strong> Opera&ccedil;&atilde;o realizada com sucesso! </p>").fadeIn();
    setTimeout(function () {
        location.href = "prestador.php";
    },3000);
}