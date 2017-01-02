<!DOCTYPE html>
<html ng-app="helloWorld">
    <head>
        <meta charset="UTF-8">
        <title>Hello World</title>
        <script src="../../js/angular-1.5.0/angular.js"></script>

        <script>
            angular.module('helloWorld',[]);
            angular.module('helloWorld').controller('helloWorldController',function ($scope){
                $scope.message = 'Hello World!';
                $scope.name = 'Éric';
            });
        </script>
    </head>
    <body>
        <div ng-controller="helloWorldController">
            {{message}}
            <br/>
             <input ng-model="name" type="text">
             <h1>You entered: {{name}}</h1>
             <br/>
             <input value="{{name}}" type="text">
        </div>
        
       
    </body>
</html>
