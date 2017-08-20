/**
 * Created by carlos on 20/08/17.
 */


$(document).ready(function () {
    getUsuarios();
})

function getUsuarios() {
    $('.tbody').find( 'tr' ).remove();
    $.ajax({
        url  : 'function/usuario.php',
        type : 'post',
        dataType : 'json',
        data : {
            acao : 'U',
        },
        success: function (data) {

            $.each( data.usuarios, function (i, j) {
                var check = "";
                if( j.ativo == "S" ){
                    check = "<i class='fa fa-check'></i>"
                }
                $('.tbody').append(
                    "<tr>"+
                        "<td>"+ j.codigo +"</td>"+
                        "<td>"+ j.nome +"</td>"+
                        "<td>"+ j.login +"</td>"+
                        "<td>"+ check +"</td>"+
                        "<td>" +
                            "<a href='#editar' class='btn btn-warning btn-editar' title='Editar' data-id='"+ j.codigo +"'><i class='fa fa-pencil-square-o'></i> Editar </a> &nbsp;" +
                            "<a href='#excluir' class='btn btn-danger btn-excluir' title='Excluir' data-id='"+ j.codigo +"'><i class='fa fa-times'></i> Excluir</a>" +
                        "</td>"+
                    "</tr>"
                );
            } );

        }
    });

}

function validarcampos() {



}


function colorirCampo( id, cor ) {

    $('input[id="'+ id +'"]').css( "border-color", cor );

}