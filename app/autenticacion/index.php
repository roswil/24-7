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
        <!--<style>
          a {
          color: orange;
          }
        </style>-->
    
  </head>

  <body ng-cloak="">
    <div ng-if='uid && name'>        
      <div class="navbar navbar-fixed-top navbar-default megamenu" >
      <nav class="navbar navbar-default">
      <div class="container-fluid" >
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Ini</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">*</a>
          </div>
          <div class="navbar-collapse collapse"  id="bs-example-navbar-collapse-1"ng-controller="NavCtrl">
            <ul class="nav navbar-nav">
              <li class="active">
                <a href="#">INICIO <span class="sr-only">(current)</span></a>
              </li>
            <li ng-repeat ="p in categories" class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">{{p.grupo}}
            <span class="caret"></span></a>
              <ul class="dropdown-menu"  role="menu">
              <li ng-repeat="c in p.sub_categories">
                  <a href="#{{c.id_opcion}}" id="{{c.contenido}}">{{c.opcion}}</a>
              </li>
              </ul>
            </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#">USUARIO: {{name}}</a></li>
              <li><a href="#administracion|usuarios">opcion ejemplo</a></li>
              <li><a href="#">SALIR</a></li>
              <li><a ng-click="logout();" >SALIR</a></li>
            </ul>
          </div>
        </div>
        </nav>
      </div>
    </div>
   <foter class="footer">
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
  <script src="js/jquery-1.11.2.min.js"></script>
 <!--  nuevas librearias adicionales-->

<link rel="stylesheet" href="../../libs/components/bootstrap/dist/css/bootstrap.min.css" />
    <!-- endbower -->
    <!-- build:css(.tmp) styles/main.css -->
    <link rel="stylesheet" href="../../libs/styles/main.css">
    <link rel="stylesheet" href="../../libs/styles/sb-admin-2.css">
    <link rel="stylesheet" href="../../libs/styles/timeline.css">
    <link rel="stylesheet" href="../../libs/components/metisMenu/dist/metisMenu.min.css">
    <link rel="stylesheet" href="../../libs/components/angular-loading-bar/build/loading-bar.min.css">
    <link rel="stylesheet" href="../../libs/components/font-awesome/css/font-awesome.min.css" type="text/css">
    <!-- endbuild -->
    
    <!-- build:js(.) scripts/vendor.js -->
    <!-- bower:js -->
    <script src="../../libs/components/jquery/dist/jquery.min.js"></script>
    <script src="../../libs/components/angular/angular.min.js"></script>
    <script src="../../libs/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../libs/components/angular-ui-router/release/angular-ui-router.min.js"></script>
    <script src="../../libs/components/json3/lib/json3.min.js"></script>
    <script src="../../libs/components/oclazyload/dist/ocLazyLoad.min.js"></script>
    <script src="../../libs/components/angular-loading-bar/build/loading-bar.min.js"></script>
    <script src="../../libs/components/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>
    <script src="../../libs/components/metisMenu/dist/metisMenu.min.js"></script>
    <!-- endbower -->
  <!-- app -->
  <script src="app/app.js"></script>
  <script src="app/data.js"></script>
  <script src="app/directives.js"></script>
  <script src="app/authCtrl.js"></script>
</html>

