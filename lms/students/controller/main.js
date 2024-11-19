var app = angular.module("myApp", ["ngRoute", "ngCookies"]);
app.config(function ($routeProvider) {

    $routeProvider
        .when("/", {
            templateUrl: "pages/dash.php",
            controller: 'dashCtrl'
        })
        .when("/dash", {
            templateUrl: "pages/dash.php",
            controller: 'dashCtrl'
        })
        .when('/assignment', {
            templateUrl: "pages/assignment.html",
            controller: 'dashCtrl'
        })
        
        .when('/materials', {
            templateUrl: "pages/materials.html",
            controller: 'dashCtrl'
        })
        
        .when('/topics', {
            templateUrl: "pages/topics.html",
            controller: 'dashCtrl'
        })

        .when('/upload', {
            templateUrl: "pages/upload_assignment.html",
            controller: 'dashCtrl'
        })

        .when('/exam', {
            templateUrl: "pages/examination.html",
            controller: 'dashCtrl'
        })
        
        .otherwise({
            template: "<h1>Error 404! Not Found </h1>"
        });
});

app.controller('dashCtrl', function ($scope, $http) {
});