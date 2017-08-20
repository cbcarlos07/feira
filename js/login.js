/**
 * Created by carlos on 19/08/17.
 */

$(document).ready(function () {
   $('.progress').fadeOut();
});

$('.btn-login').on( 'click', function () {
   
    if( verificarCampos() ){

        var usuario = $('#usuario').val();
        var senha   = $('#pwd').val();
        var check = $('#lembrar');
        var lembrar = 'N';
        if( check.checked ){
            lembrar = 'S';
        }

        $.ajax({
            url  : 'function/usuario.php',
            type : 'post',
            dataType : 'json',
            beforeSend : carregando,
            data     : {
                acao  : 'L',
                login : usuario,
                senha : senha,
                lembrar : lembrar
            },
            success : function (data) {
                $('.progress').fadeOut();
                if( data.sucesso === 1 ){
                    sucesso(  );
                }else{
                    errosend();
                }

            }
        })

    }
    
} );


function verificarCampos() {
    var usuario = $('#usuario').val();
    var senha   = $('#pwd').val();

    if( ( usuario != "" ) && ( senha != "" ) ){
        corCampo( 'usuario', '' );
        corCampo( 'pwd', '' );
        return true;

    }
    else{

        if( usuario == "" ){
            corCampo( 'usuario', 'red' );
        }

        if( senha == "" ){
            corCampo( 'pwd', 'red' );
        }
        return false;

    }
}

function corCampo( id, cor ) {

    $('input[id="'+id+'"]').css( 'border-color', cor );

}


function carregando(){
    var mensagem = $('.mensagem');
    //alert('Carregando: '+mensagem);
    $('.progress').fadeIn();


}


function sucesso(){
    var mensagem = $('.mensagem');
    mensagem.empty().html('<p class="alert alert-success"><strong>OK.</strong> Estamos redirecionando </p>').fadeIn("fast");
    var url = 'index1.html';
    var form = $('<form action="' + url + '" method="post">' +

        '</form>');
    $('body').append(form);
    form.submit();
    //   location.href = "usuario?acao=S";

    //window.setTimeout()
    //delay(2000);
}

function errosend(){
    var mensagem = $('.mensagem');
    mensagem.empty().html('<p class="alert alert-danger"><strong>Opa!</strong> Por favor, verifique seu login e/ou sua senha</p>').fadeIn("fast");
}
