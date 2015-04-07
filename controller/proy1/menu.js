app = angular.module('app', []);
app.controller("NavCtrl",function($scope,$http){
    var serviceBase = '../../model/proy2_grillas_restful/cliente.php/';
    $http.get(serviceBase + 'categories').then(function (results) {
        $scope.categories = results.data;
    });
});