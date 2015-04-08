var app = angular.module('myApp2', ['ngRoute']);
app.factory("services", ['$http', function($http) {
  var serviceBase = '../../model/proy4/grupos.php/'
    var obj = {};
    obj.getCustomers = function(){
        return $http.get(serviceBase + 'loadGrupos');       
    };
    
   obj.getCustomer = function(grupoID){
   //console.log(customerID);
        return $http.get(serviceBase + 'loadEditGrupos/' + grupoID);
   }

   obj.getGrupoEdit = function(grupoID){
   //console.log(customerID);
        return $http.get(serviceBase + 'editGrupos/' + grupoID);
   }
    /*obj.getGrupoEdit = function(id,customer){
   console.log(id,customer);
     return $http.post(serviceBase + 'editGrupos/'+ id, customer).then(function (status) {
     return status.data;
     });
   }*/
   return obj; 
}]);



app.controller('listCtrl', function ($scope, services) {
    services.getCustomers().then(function(data){
        $scope.customers = data.data;
    });
    $scope.loadGrupos = function(idGrupo){
      //console.log(idGrupo);
      services.getCustomer(idGrupo).then(function(data){
          $scope.customer = data.data;
      });
    }

    $scope.editGrupos = function(idGrupo){
      //console.log(idGrupo);
      services.getGrupoEdit(idGrupo).then(function(data){
          $scope.editGrupos = data.data;
      });
    }

});

 
app.controller('editCtrl', function ($scope, services) {

});



app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/', {
        title: 'GRUPOS',
        templateUrl: 'grupos.html',
        controller: 'listCtrl'
      })
      /******* EDIT *******/
       .when('/edit-customer/:customerID', {
         title: 'Edit Grupos',
         templateUrl: 'grupos.html',
         controller: 'editCtrl',
         resolve: {
         customer: function(services, $route){
         var customerID = $route.current.params.customerID;
         return services.getCustomer(customerID);
         }
         }
         })
       /**********************/
      .otherwise({
        redirectTo: '/'
      });
}]);



app.run(['$location', '$rootScope', function($location, $rootScope) {
    $rootScope.$on('$routeChangeSuccess', function (event, current, previous) {
        $rootScope.title = current.$$route.title;
    });
}]);