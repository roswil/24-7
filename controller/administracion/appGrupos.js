var app = angular.module('myApp', ['ngRoute']);
app.factory("services", ['$http', function($http) {
  var serviceBase = '../../model/administracion/grupos.php/'
    var obj = {};
    obj.getCustomers = function(){
        return $http.get(serviceBase + 'listaGrupos');
    };
    obj.getCustomer = function(idAn){
      console.log(idAn);
        return $http.get(serviceBase + 'CargarAnimal/' + idAn);
    }
    obj.insertCustomer = function (animal) {
      return $http.post(serviceBase + 'nuevoAnimal', animal).then(function (results) {
        return results;
      });
    };
    obj.updateCustomer = function (id,customer) {
      console.log(id);
      console.log(customer);
      return $http.post(serviceBase + 'editAnimales', {id:id, customer:customer}).then(function (status) {
        return status.data;
      });
    };
    return obj;   
}]);

app.controller('listCtrl', function ($scope,services) {
    services.getCustomers().then(function(data){
        $scope.customers = data.data;
    });
    $scope.razas = ['Chapi','Akita','Chihuahua','Pastor Aleman','Labrador Retriever'];
    $scope.GuardarAnimal = function(animal){
      services.insertCustomer(animal);
    }
    $scope.obtAnimal = function(idAn){
      services.getCustomer(idAn).then(function(animal){
        $scope.animal = animal.data;
      });  
    }
    $scope.modificarAnimal = function(idAn, animal){
      services.updateCustomer(animal,idAn);
    }
});

app.controller('controles',function ($scope, services){
  $scope.razas = ['Chapi','Akita','Chihuahua','Pastor Aleman','Labrador Retriever'];
  $scope.GuardarAnimal = function(animal){
    console.log(animal);
    //$location.path('/nuevoAnimal');
      services.insertCustomer(animal);
      console.log(animal);
  }
});

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/', {
        title: 'Animales',
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