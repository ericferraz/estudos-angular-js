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
            .selecionado{
                background-color: yellow;
            }
            .negrito{
                font-weight: bold;
            }
        </style>

        <script src="../../js/angular-1.5.0/angular.js"></script>
        <script src="../../js/angular-1.5.0/angular-messages.js"></script>

        <script>
            angular.module("listaTelefonica", ["ngMessages"]);
            //scope faz a mediação entre view e controller
            angular.module('listaTelefonica').controller('listaTelefonicaController', function ($scope) {
                $scope.app = "Lista Telefônica";
                $scope.contatos = [
                    {nome: "Eric", telefone: "(14) 98872-3232", cor: 'red'},
                    {nome: "Ana Maria", telefone: "(43) 88872-3202", cor: 'yellow'},
                    {nome: "Daniele", telefone: "(14) 98982-7868", cor: 'blue'},
                    {nome: "Vania Soares", telefone: "(14) 8198-3242", cor: 'purple'}
                ];
                $scope.operadoras = [
                    {nome: "OI", categoria: "CEL"},
                    {nome: "TIM", categoria: "CEL"},
                    {nome: "CLARO", categoria: "CEL"},
                    {nome: "VIVO", categoria: "CEL,FIXO"}
                ];
                //cria uma função chamada adicionarContato visível para esse escopo
                $scope.adicionarContato = function (contato) {
                    //adiciona um novo objeto ao fim do array

                    //1- a forma ruim  de se fazer
                    // $scope.contatos.push({nome:$scope.nome,telefone:$scope.telefone});

                    //2- a forma rasuável  de se fazer
                    //$scope.contatos.push({nome: nome, telefone: telefone});

                    //3- a melhor formar
                    $scope.contatos.push(angular.copy(contato));

                    //seta o forma para a propriedade original, como se nunca tivesse sido selecionado
                    $scope.contatoForm.$setPristine();
                };
                $scope.apagarContato = function (contatos) {

                    $scope.contatos = contatos.filter(function (contato) {
                        if (!contato.selecionado) {
                            return contato;
                        }
                    });
                };
                $scope.isContatosSelecionados = function (contatos) {
                    return contatos.some(function (contato) {
                        return contato.selecionado;
                    });
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

                <form name="contatoForm" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nome:</label>
                        <div class="col-sm-6">
                            <input type="text" name="nome" ng-model="contato.nome" ng-required="true" ng-minlength="3" class="form-control">
                        </div>
                        {{contato.nome}}
                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label">Telefone:</label>
                        <div class="col-sm-4">
                            <input type="text" name="telefone" 
                                   ng-model="contato.telefone"  
                                   ng-required="true" 
                                   ng-pattern="/^\d{4,5}-\d{4}$/"
                                   class="form-control">
                        </div>
                        {{contato.telefone}}
                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Operadora:</label>
                        <div class="col-sm-4">
                            <select name="operadora" class="form-control" ng-model="contato.operadora"  ng-required="true" ng-options="operadora.nome for operadora in operadoras">
                                <option value="">Selecione uma operadora</option>
                            </select>
                        </div>
                        {{contato.telefone}}
                    </div>

                    <div ng-messages="contatoForm.nome.$error">
                        <div class="alert alert-danger col-sm-5 col-sm-offset-2" ng-message="required">
                            Por favor, preencha o nome.
                        </div>

                        <div class="alert alert-danger col-sm-5 col-sm-offset-2" ng-message="minlength">
                            O campo nome deve ter no mínimo 3 caracteres.
                        </div>
                    </div>


                    <div class="alert alert-danger col-sm-5 col-sm-offset-2" ng-show="contatoForm.telefone.$error.required && contatoForm.telefone.$dirty">
                        Por favor, preencha o telefone.
                    </div>

                    <div class="alert alert-danger col-sm-5 col-sm-offset-2" ng-show="contatoForm.telefone.$error.pattern && contatoForm.telefone.$dirty">
                        Telefone inválido.
                    </div>


                    <div class="alert alert-danger col-sm-5 col-sm-offset-2" ng-show="contatoForm.operadora.$invalid && contatoForm.operadora.$dirty">
                        Por favor, informe a operadora.
                    </div>


                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="btn-group">

                                <button style="margin-right: 5px;" ng-disabled="contatoForm.$invalid" ng-click="adicionarContato(contato)" type="button" title="Adicionar contato" class="btn btn-success">
                                    <span class="glyphicon glyphicon-saved"></span>
                                    Adicionar contato
                                </button>

                                <!--
                                <button  ng-click="apagarContato(contatos)" ng-disabled="!isContatosSelecionados(contatos)" type="button" title="Apagar contato" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span>
                                    Apagar contato
                                </button>
                                -->

                                <!--
                                <button  ng-click="apagarContato(contatos)" ng-show="isContatosSelecionados(contatos)" type="button" title="Apagar contato" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span>
                                    Apagar contato
                                </button>
                                -->

                                <!--
                                ng-if interage diretamente com o dom, adicionando
                                o elemento se a condição for true
                                -->
                                <button  ng-click="apagarContato(contatos)" ng-if="isContatosSelecionados(contatos)" type="button" title="Apagar contato" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span>
                                    Apagar contato
                                </button>

                            </div>
                        </div>
                    </div>
                </form>
                <hr/>

                <table class="table table-bordered" ng-show="contatos.length > 0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Operadora</th>
                            <th style="width: 50px;"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr ng-class="{
                            'selecionado negrito'
                                    : contato.selecionado}" ng-repeat="contato in contatos">
                            <td>
                                <input type="checkbox"
                                       ng-model="contato.selecionado">
                            </td>
                            <td>{{contato.nome}}</td> 
                            <td>{{contato.telefone}}</td>
                            <td>{{contato.operadora.nome}}</td>
                            <td>
                                <div style="width: 50px;height: 50px;border-radius: 50%;" ng-style="{
                                    'background-color'
                                            : contato.cor}">

                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div ng-include="'footer.html'"></div>
    </body>
</html>
