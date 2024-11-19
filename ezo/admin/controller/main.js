// Define the AngularJS application module
angular.module('myApp', ['ngRoute'])

// Configure the routing
.config(function($routeProvider) {
    $routeProvider
    .when('/', {
        templateUrl: 'pages/index.html',           // Home page content
        controller: 'HomeController'
    })
    .when('/index', {
        templateUrl: 'pages/index.html',           // Home page content
        controller: 'HomeController'
    })
    .when('/role', {
        templateUrl: 'pages/role.html',           // Role Section content
        controller: 'RoleController'
    })
    .when('/location', {
        templateUrl: 'pages/location.html',       // Location Section content
        controller: 'LocationController'
    })
    .when('/item', {
        templateUrl: 'pages/item.html',           // Item Section content
        controller: 'ItemController'
    })
    .when('/staff', {
        templateUrl: 'pages/staff.html',          // Staff Section content
        controller: 'StaffController'
    })
    .when('/collection', {
        templateUrl: 'pages/collection.php',          // Staff Section content
        controller: 'CollectionController'
    })
    .when('/bill', {
        templateUrl: 'pages/bill.html',          // Staff Section content
        controller: 'bill'
    })
    .when('/bill1', {
        templateUrl: 'pages/bill.html',          // Staff Section content
        controller: 'bill1'
    })
    .when('/change_pass', {
        templateUrl: 'change_pass.html',    // Change Password content
        controller: 'ChangePassController'
    })
    .otherwise({
        template: "<h1>Error 404! Not Found </h1>"
    });
})

// Define controllers for each route
.controller('HomeController', function($scope , $http) {
    // Logic for the Home page
    $scope.message = "Welcome to the Home Page!";
})

.controller('RoleController', function($scope , $http) {
    // Logic for the Role Section
    $scope.message = "Manage roles here.";
    // Example data or logic for roles could go here
})

.controller('LocationController', function($scope , $http) {
    // Logic for the Location Section
    $scope.message = "Manage locations here.";
    // Example data or logic for locations could go here
})

.controller('ItemController', function($scope , $http) {
    // Logic for the Item Section
    $scope.message = "Manage items here.";
    // Example data or logic for items could go here
})

.controller('StaffController', function($scope , $http) {
    // Logic for the Staff Section
    $scope.message = "Manage staff here.";
    // Example data or logic for staff could go here
})
.controller('CollectionController', function($scope , $http) {
    // Logic for the Staff Section
    $scope.message = "Manage collection here.";
    // Example data or logic for staff could go here
})

.controller('ChangePassController', function($scope , $http) {
    // Logic for Change Password
    $scope.message = "Change your password here.";
    // Example logic for handling password change could go here
})
.controller('bill', function($scope , $http) {
    // Logic for Change Password
    $scope.message = "Change your password here.";
    // Example logic for handling password change could go here
})
.controller('bill1', function($scope , $http) {
    // Logic for Change Password
    $scope.message = "Change your password here.";
    // Example logic for handling password change could go here
});
