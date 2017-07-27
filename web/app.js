var app = angular.module("myApp", ["ngRoute","ngStorage"]);

app.config(['$routeProvider', function($routeProvider) {
  $routeProvider
    .when("/login", {
      templateUrl: Routing.generate('login',
        {template:"default/login.html.twig"}),
        controller: 'loginctrl',
    })
    .when("/register", {
      templateUrl: Routing.generate('register',
        {template:"default/registere.html.twig"}),
      controller: 'httpgetctrl',  
    });
}]);

    app.controller("httpgetctrl", function ($scope, $http) {

        $scope.SendData = function () {
           // use $.param jQuery function to serialize data from JSON 
            var data = $.param({
                username: $scope.username,
                email: $scope.email,
                pass: $scope.password,
                confir: $scope.confirmationpass
            });
        
            var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }

            $http.post("{{path('register')}}", data, config)
            .then(function (response) {
                console.log("success");
            })
            .catch(function() {
                console.log("error");
  })
        };

    });

    app.controller("loginctrl", function ($scope, $http,$localStorage) {

        $scope.login = function () {
           // use $.param jQuery function to serialize data from JSON 
            var data = $.param({
                username: $scope.user,
                password: $scope.pass
            });
        
            var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            }

            $http.post("{{path('login')}}", data, config)
            .then(function (response) {
                console.log("success");
                //$localStorage.LocalMessag = x ;
                //console.log($localStorage.LocalMessag);
            })
            .catch(function() {
                console.log("error");
  })
        };

    });