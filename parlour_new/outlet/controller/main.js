var app = angular.module("myApp", ["ngRoute", "ngCookies"]);

app.config(function($routeProvider) {
    $routeProvider
    .when("/", {
        templateUrl: "pages/dash.html",
    })
    .when("/dash", {
        templateUrl: "pages/dash.html",
    })
    .when('/appoinment', {
        templateUrl: 'pages/appoinment.html',
        controller: 'dashCtrl'
    })
    .when('/company', {
        templateUrl: 'pages/company.html',
        controller: 'dashCtrl'
    })
    .when('/shop', {
        templateUrl: 'pages/shop.html',
        controller: 'dashCtrl'
    })
    .when('/staff', {
        templateUrl: 'pages/staff.php',
        controller: 'dashCtrl'
    })
    .when('/vendor', {
        templateUrl: 'pages/vendore.html',
        controller: 'dashCtrl'
    })
    .when('/category', {
        templateUrl: 'pages/category.html',
        controller: 'dashCtrl'
    })
    .when('/service', {
        templateUrl: 'pages/service.html',
        controller: 'dashCtrl'
    })
    .when('/receipe', {
        templateUrl: 'pages/receipe.html',
        controller: 'dashCtrl'
    })
    .when('/purchase', {
        templateUrl: 'pages/purchase.php',
        controller: 'dashCtrl'
    })
    .when('/req', {
        templateUrl: 'pages/requsition.php',
        controller: 'dashCtrl'
    })
    .when('/stockexp', {
        templateUrl: 'pages/stockexp.html',
        controller: 'dashCtrl'
    })
    .when('/stocko', {
        templateUrl: 'pages/stockoutlet.html',
        controller: 'dashCtrl'
    })
    .when('/stock', {
        templateUrl: 'pages/stock.html',
        controller: 'dashCtrl'
    })
    .when('/purchaserep', {
        templateUrl: 'pages/purchaserep.html',
        controller: 'dashCtrl'
    })
    .when('/salesrep', {
        templateUrl: 'pages/salesrep.html',
        controller: 'dashCtrl'
    })
    .when('/requsitionrep', {
        templateUrl: 'pages/requsitionrep.php',
        controller: 'dashCtrl'
    })
    .when('/cp', {
        templateUrl: 'pages/change_password.html',
        controller: 'dashCtrl'
    })
    .otherwise({
        template: "<h1>Error 404! Not Found </h1>"
    });
});

app.controller("DashController", function($scope) {
    $scope.message = "Welcome to the dashboard!";
});

app.controller("AppointmentController", function($scope, $http, $cookies) {
    $scope.var = true;
    $scope.var1 = false;
    $scope.var3 = false;
    $scope.cart = [];

    $scope.loading = function() {
        // Initialize variables, load data, etc.
        $scope.showProducts = true;
        $http.get("path-to-api/items.php").then(function(response) {
            $scope.idata = response.data;
        });
    };

    $scope.next = function() {
        $scope.var = false;
        $scope.var1 = true;
    };

    $scope.addToCart = function(item) {
        let existingItem = $scope.cart.find(i => i.id === item.id);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            $scope.cart.push({ ...item, quantity: 1 });
        }
    };

    $scope.increaseQuantity = function(item) {
        item.quantity++;
    };

    $scope.decreaseQuantity = function(item) {
        if (item.quantity > 1) {
            item.quantity--;
        } else {
            $scope.cart = $scope.cart.filter(i => i.id !== item.id);
        }
    };

    $scope.calculateTotal = function() {
        return $scope.cart.reduce((total, item) => total + item.price * item.quantity, 0);
    };

    $scope.goToBilling = function() {
        $scope.var1 = false;
        $scope.var3 = true;
    };

    $scope.addAppointment = function() {
        let appointmentData = {
            op: 'insert',
            appointment_no: $scope.apno,
            appointment_date: $scope.apdate,
            phone_no: $scope.phoneNo,
            customer_name: $scope.custName,
            customer_type: $scope.custType,
            service_man: $scope.serviceMan
        };

        $http.post("../assets/api/appointment.php", appointmentData)
        .then(function(response) {
            if (response.data.status === "success") {
                alert("Appointment added successfully!");
            } else {
                alert(response.data.message);
            }
        }, function() {
            alert("Error adding appointment!");
        });
    };
});
