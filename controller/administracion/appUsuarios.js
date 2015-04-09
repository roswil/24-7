var app = angular.module('myApp', ['ngRoute']);
app.factory("services", ['$http', function($http) {
  var serviceBase = '../../model/administracion/usuarios.php/'
    var obj = {};
    obj.getUsuarios = function(){
        return $http.get(serviceBase + 'listaUsuarios');
    };
    return obj;   
}]);

app.controller('listCtrl', function ($scope,services) {
    services.getUsuarios().then(function(data){
        $scope.usuarios = data.data;
        $scope.currentPage = 1; //current page
        $scope.entryLimit = 5; //max no of items to display in a page
        $scope.filteredItems = $scope.usuarios.length; //Initially for no filter
        $scope.totalItems = $scope.usuarios.length;
    });
    
    $scope.setPage = function(pageNo) {
      $scope.currentPage = pageNo;
    };
    $scope.filter = function() {
      $timeout(function() {
        $scope.filteredItems = $scope.filtered.length;
      }, 10);
    };
    $scope.sort_by = function(predicate) {
      $scope.predicate = predicate;
      $scope.reverse = $scope.reverse;
    };
});

app.run(['$location', '$rootScope', function($location, $rootScope) {
    $rootScope.$on('$routeChangeSuccess', function (event, current, previous) {
        $rootScope.title = current.$$route.title;
    });
}]);