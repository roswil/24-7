var app = angular.module('myApp', ['ngRoute']);
app.factory("services", ['$http', function($http) {
  var serviceBase = '../../model/proy2_grillas_restful/cliente.php/'
    var obj = {};
    obj.getCustomers = function(){
        return $http.get(serviceBase + 'loadUsers');
    };
    return obj;   
}]);

app.controller('listCtrl', function ($scope, services) {
    services.getCustomers().then(function(data){
        $scope.customers = data.data;
    });
});


app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/', {
        title: 'Clientes',
        templateUrl: 'clientes.html',
        controller: 'listCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
}]);

app.run(['$location', '$rootScope', function($location, $rootScope) {
    $rootScope.$on('$routeChangeSuccess', function (event, current, previous) {
        $rootScope.title = current.$$route.title;
    });
}]);