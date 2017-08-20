<!DOCTYPE html>
<html>
<?php include "include/head.php"?>

<body>
<?php include "include/barra_superior.php" ?>


<?php include "include/menu_bar.php" ?>

<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Usu&aacute;rios / Cadastrar Usu&aacute;rios</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header col-lg-9">Cadastrar Usu&aacute;rio</h1>

        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="form-group col-lg-10">
                        <label for="nome">Nome</label>
                        <input id="nome" class="form-control" />
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="login">Login</label>
                        <input id="login" class="form-control" />
                    </div>
                    <div class="row"></div>
                    <div class="form-group col-lg-5">
                        <label for="senha">Digite a senha</label>
                        <input type="password" id="senha" class="form-control" />
                        <span class="aviso-senha" style="color: red"></span>
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="repetir">Repita a Senha</label>
                        <input type="password" id="repetir" class="form-control" />
                        <span class="aviso-repetir-senha" style="color: red"></span>
                    </div>
                    <div class="row"></div>
                    <div class="col-lg-3">
                        <button class="btn btn-success btn-salvar">Salvar</button>
                        <!--<button class="btn btn-warning btn-limpar">Limpar</button>-->

                        <button class="btn btn-default btn-cancelar">Voltar</button>
                    </div>

                </div>
            </div>
        </div>
    </div><!--/.row-->



</div><!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/chart.min.js"></script>
<script src="js/chart-data.js"></script>
<script src="js/easypiechart.js"></script>
<script src="js/easypiechart-data.js"></script>

<script src="js/selecao.js"></script>
<script src="js/usuario.js"></script>
</body>

</html>
