var app = angular.module('myApp', ['ngRoute']);
app.factory("services", ['$http', function($http) {
  var serviceBase = '../../model/administracion/personas.php/'
    var obj = {};
    obj.getPersonas = function(){
        return $http.get(serviceBase + 'listaPersonas');
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
    obj.updateCustomer = function (animal) {
      console.log(animal);
      return $http.post(serviceBase + 'editAnimales', animal).then(function (status) {
        return status.data;
      });
    };
    return obj;   
}]);

app.controller('listCtrl', function ($scope,services) {
    services.getPersonas().then(function(data){
        $scope.personas = data.data;
        $scope.currentPage = 1; //current page
        $scope.entryLimit = 5; //max no of items to display in a page
        $scope.filteredItems = $scope.personas.length; //Initially for no filter
        $scope.totalItems = $scope.personas.length;
    });
    $scope.razas = ['Chapi','Akita','Chihuahua','Pastor Aleman','Labrador Retriever'];

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

    $scope.GuardarAnimal = function(animal){
      services.insertCustomer(animal);
    }
    $scope.obtAnimal = function(idAn){
      /*services.getCustomer(idAn).then(function(animal){
        $scope.animal = animal.data;
      });*/
      alert(idAn);  
    }
    $scope.modificarAnimal = function(animal){
      services.updateCustomer(animal);
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