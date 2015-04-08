(function(){
	"use strict";
	angular.module('funcionApp',[])
	.controller('MainController',function($scope){
		$scope.name='Mercedes'
		$scope.categories = ['HTML5','JavaScript','CSS','Games'];
		$scope.bookmarks = [
            {id:1,name:'Quizzpot.com',url:'word.docx',category:'JavaScript'},
            {id:2,name:'Html5 Game Devs',url:'SAC.jpg',category:'Games'},
            {id:3,name:'CSS Tricks',url:'urbanizacion.pdf',category:'CSS'},
            {id:4,name:'Bootstrap',url:'musica.wma',category:'CSS'},
            {id:5,name:'Card',url:'http://jessepollak.github.io/card/',category:'JavaScript'}
        ];

        $scope.currentCategory = null
        $scope.setCurrentCategory = function(category){ 
            $scope.currentCategory = category;          
        }
        $scope.isCurrentCategory = function(category){ 
            return $scope.currentCategory = category;          
        }
	});
	//console.log('creando modulos');
})();