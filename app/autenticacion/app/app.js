var app = angular.module('myApp', ['ngRoute', 'ngAnimate', 'toaster']);

app.controller("NavCtrl",function($scope,$http){
	var serviceBase = '../../model/proy2_grillas_restful/cliente.php/';
	$http.get(serviceBase + 'categories').then(function (results) {
        $scope.categories = results.data;
    });
});

app.config(['$routeProvider',
  function ($routeProvider) {
        $default = '../autenticacion/index.html';
        //$ruta = '../administracion/usuarios.html';        
        $routeProvider.
        when('/login', {
            title: 'Login',
            templateUrl: 'partials/login.html',
            controller: 'authCtrl'
        })
            .when('/logout', {
                title: 'Logout',
                templateUrl: 'partials/login.html',
                controller: 'logoutCtrl'
            })
            .when('/signup', {
                title: 'Signup',
                templateUrl: 'partials/signup.html',
                controller: 'authCtrl'
            })
            .when('/dashboard', {
                title: 'Dashboard',
                templateUrl: 'partials/dashboard.html',
                controller: 'authCtrl'
            })
            .when('/', {
                title: 'Login',
                templateUrl: 'partials/login.html',
                controller: 'authCtrl',
                role: '0'
            })
            .when('/menu', {
			     templateUrl: $default,
                controller: 'authCtrl'
		      })        
            .when('/13', {
			     templateUrl: "../administracion/usuarios.html",
                controller: 'authCtrl'
		      })
            .when('/14', {
			     templateUrl: "../administracion/usuarios.html",
                controller: 'authCtrl'
		      })
            .when('/15', {
			    templateUrl: "../administracion/usuarios.html",
                controller: 'authCtrl'
		      })
            .otherwise({                
                //redirectTo: '/login'
                templateUrl: $default
            });
  }])
    .run(function ($rootScope, $location, Data) {
        $rootScope.$on("$routeChangeStart", function (event, next, current) {
            $rootScope.authenticated = false;
            Data.get('session').then(function (results) {
                if (results.uid) {
                    $rootScope.authenticated = true;
                    $rootScope.uid = results.uid;
                    $rootScope.name = results.name;
                    $rootScope.email = results.email;
                } else {
                    var nextUrl = next.$$route.originalPath;
                    if (nextUrl == '/signup' || nextUrl == '/login') {

                    } else {
                        $location.path("/login");
                    }
                }
            });
        });
    });


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