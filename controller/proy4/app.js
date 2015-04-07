var app = angular.module('myApp', ['ngRoute']);
app.factory("services", ['$http', function($http) {
  var serviceBase = '../../model/proy4/grupos.php/'
    var obj = {};
    obj.getCustomers = function(){
        return $http.get(serviceBase + 'loadGrupos');
       
    };
    return obj; 

     obj.getGrupos = function(){
        return $http.get(serviceBase + 'loadEditGrupos');
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
        title: 'GRUPOS',
        templateUrl: 'grupos.html',
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