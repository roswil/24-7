var app = angular.module('myAppCan', ['ngRoute','ui.bootstrap', 'ngAnimate']);

app.factory("services", ['$http', function($http) {
  var serviceBase = '../../model/crudCanes/crudCanes.php/'
    var obj = {};
    obj.getLstCanCustomers = function(){
        return $http.get(serviceBase + 'loadCan');
    };	
	//********obteniendo departamentos	
	obj.getCustomersDepartamentos = function(){
        return $http.get(serviceBase + 'listdepartamentos');
    }; 
	//********obteniendo Porvincias	
	obj.getCustomersProvincias = function(idDep){
        return $http.get(serviceBase + 'listdeprovincias/' + idDep);
    };
    return obj; 	
}]);

app.controller('listaCtrlCanes', function ($scope, services) {
    //******lista de canes******
    services.getLstCanCustomers().then(function(data){
        $scope.customersCan = data.data;
    });
	//**************combo de departamentos
	services.getCustomersDepartamentos().then(function(data){
        $scope.ComboCustomersDep = data.data;
    });
	//***************obtniendo departamentos
	$scope.getProvincias = function (id) {
            console.log('Ingresando provincia'+id);
	   services.getCustomersProvincias(id).then(function(data){
        $scope.ComboCustomersProv = data.data;
    });
	 };
	
	 
      	
    
	
	
});


app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/', {
        title: 'Canes',
        templateUrl: 'canes.html',
        controller: 'listaCtrlCanes'
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