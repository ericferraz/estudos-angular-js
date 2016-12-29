<!DOCTYPE html>
<html ng-app="listaTelefonica">
    <head>
        <meta charset="UTF-8">
        <title>Lista Telefônica</title>
        <link rel="stylesheet" type="text/css" href="../../bootstrap-3.3.7/css/bootstrap.css">
        <style>
            .jumbotron{
                text-align: center;
                margin-left: auto;
                margin-right: auto;
                margin-top: 20px;
            }
            .table{
                margin-top: 20px;
            }
        </style>

        <script src="../../js/angular-1.5.0/angular.js"></script>

        <script>
            angular.module('listaTelefonica', []);

            //scope faz a mediação entre view e controller
            angular.module('listaTelefonica').controller('listaTelefonicaController', function ($scope) {
                $scope.app = "Lista Telefônica";
                $scope.contatos = [
                    {nome: "Eric", telefone: "(14) 98872-3232"},
                    {nome: "Ana Maria", telefone: "(43) 88872-3202"},
                    {nome: "Daniele", telefone: "(14) 98982-7868"},
                    {nome: "Vania Soares", telefone: "(14) 8198-3242"}
                ];

                //cria uma função chamada adicionarContato visível para esse escopo
                $scope.adicionarContato = function (nome, telefone) {
                    //adiciona um novo objeto ao fim do array

                    //1- a forma ruim  de se fazer
                    // $scope.contatos.push({nome:$scope.nome,telefone:$scope.telefone});

                    //2- a forma rasuável  de se fazer
                    $scope.contatos.push({nome: nome, telefone: telefone});
                };
            });
        </script>
    </head>
    <body ng-controller="listaTelefonicaController">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>{{app}}</h4>
                </div>
            </div>

            <div class="panel-body">

                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nome:</label>
                        <div class="col-sm-6">
                            <input type="text" ng-model="nome" class="form-control">
                        </div>
                        {{nome}}
                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label">Telefone:</label>
                        <div class="col-sm-4">
                            <input type="text" ng-model="telefone" class="form-control">
                        </div>
                        {{telefone}}
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3 col-sm-offset-2">
                            <button ng-click="adicionarContato(nome,telefone)" type="button" title="Adicionar" class="btn btn-success btn-block">
                                <span class="glyphicon glyphicon-saved"></span>
                                Adicionar Contato
                            </button>
                        </div>
                    </div>
                </form>
                <hr/>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Telefone</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr ng-repeat="contato in contatos">
                            <td>{{contato.nome}}</td> 
                            <td>{{contato.telefone}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
