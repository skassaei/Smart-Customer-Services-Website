<html>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>

<body ng-app="myApp">

  <div ng-view></div>
  <script>
    var app = angular.module("myApp", ["ngRoute"]);
app.config(function($routeProvider) {
    $routeProvider
    .when("/", {
        templateUrl : "home.php"
    })
    .when("/aboutus", {
        templateUrl : "aboutus.php"
    })
	
	.when("/contactus", {
        templateUrl : "contactus.php"
    })
    .otherwise({redirectTo: '/'});
});
    </script>
  </body>