var app = angular.module("myApp", ["ngRoute", "ngCookies"]);
app.config(function ($routeProvider) {

    $routeProvider
        .when("/", {
            templateUrl: "pages/dash.html",
            controller: 'dashCtrl'
        })
        .when("/dash", {
            templateUrl: "pages/dash.html",
            controller: 'dashCtrl'
        })
        .when('/role', {
            templateUrl: "pages/role.html",
            controller: 'dashCtrl'
        })
        .when('/location', {
            templateUrl: "pages/location.html",
            controller: 'dashCtrl'
        })
        .when('/staff', {
            templateUrl: "pages/staff.html",
            controller: 'dashCtrl'
        })
        .when('/company', {
            templateUrl: "pages/company.html",
            controller: 'dashCtrl'
        })
        .when('/unit', {
            templateUrl: "pages/unit.html",
            controller: 'dashCtrl'
        })
        .when('/category', {
            templateUrl: "pages/category.html",
            controller: 'dashCtrl'
        })
        .when('/client_entry', {
            templateUrl: "pages/client_entry.html",
            controller: 'dashCtrl'
        })
        .when('/vendor', {
            templateUrl: "pages/vendor.html",
            controller: 'dashCtrl'
        })
        .when('/purchase_entry', {
            templateUrl: "pages/purchase_entry.html",
            controller: 'dashCtrl'
        })
        .when('/bill_entry', {
            templateUrl: "pages/bill_entry.html",
            controller: 'dashCtrl'
        })
        .when('/unit', {
            templateUrl: "pages/unit.html",
            controller: 'dashCtrl'
        })
        .when('/vendore', {
            templateUrl: "pages/vendore.html",
            controller: 'dashCtrl'
        })
        .when('/company', {
            templateUrl: "pages/company.html",
            controller: 'dashCtrl'
        })
        .when('/stock', {
            templateUrl: "pages/stock.html",
            controller: 'dashCtrl'
        })
        .otherwise({
            template: "<h1>Error 404! Not Found </h1>"
         });
});

app.controller('dashCtrl', function ($scope, $http) {

    


});
