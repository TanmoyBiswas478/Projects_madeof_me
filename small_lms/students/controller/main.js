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
        .when('/addcname', {
            templateUrl: "pages/addc_name.html",
            controller: 'dashCtrl'
        })
        
        .when('/materials', {
            templateUrl: "pages/view_materials.php",
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

    $scope.material_view1 = function () {
        console.log("tname being sent:", $scope.tname); // Check the selected tname
    
        $http({
            method: 'POST',
            url: '../assets/api/material.php',
            data: {
                op: 'view2',
                tname: $scope.tname,
            }
        }).then(function (response) {
            console.log("Filtered materials:", response.data); // Verify the response
            $scope.material_data = response.data;
        }, function (error) {
            console.error("Error fetching materials:", error);
        });
    };
});