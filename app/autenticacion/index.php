<!DOCTYPE html>
<html lang="en" ng-app="myApp">

  <head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible"></meta>
    <meta content="width=device-width, initial-scale=1" name="viewport"></meta>
    
     <title> Online Shopping Mega Menu using AngularJS, PHP, MySQL </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/megamenu.css" rel="stylesheet">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>AngularJS Authentication App</title>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet"/>
        <link href="css/custom.css" rel="stylesheet"/>
        <link href="css/toaster.css" rel="stylesheet"/>
        <style>
          a {
          color: orange;
          }
        </style>
    
  </head>

  <body ng-cloak="">
    <div class="navbar navbar-inverse navbar-fixed-top navbar-default megamenu" role="navigation">
      <div class="container" ng-controller="NavCtrl">
        <div class="col-sm-12">
          <div class="navbar-header">
            <button type="button" data-toggle="collapse" data-target="#navbar-collapse-grid" class="navbar-toggle">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>  
          </div>
          <div id="navbar-collapse-grid" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            <li ng-repeat ="p in categories" class="dropdown megamenu-fw"><a href="#" data-toggle="dropdown" class="dropdown-toggle">{{p.grupo}}<b class="caret"></b></a>
              <ul class="dropdown-menu">
              <li class="grid-demo">
                <div class="row">
                <div class="col-sm-3" ng-repeat="c in p.sub_categories">
                  <a href="#/category/{{c.id_grupo}}/{{c.description}}">{{c.opcion}}
                </a></div>
                </div>
              </li>
              </ul>
            </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
    <footer class="footer">
      <div >
        <div class="container" style="margin-top:20px;">
          <div data-ng-view="" id="ng-view" class="slide-animation"></div>
        </div>
      </div>
    </foter>
    </body>
  <!-- Libs -->
  <script src="js/angular.min.js"></script>
  <script src="js/angular-route.min.js"></script>
  <script src="js/angular-animate.min.js" ></script>
  <script src="js/toaster.js"></script>
  
  
  
  <script src="app/app.js"></script>
  <script src="app/data.js"></script>
  <script src="app/directives.js"></script>
  <script src="app/authCtrl.js"></script>
</html>

