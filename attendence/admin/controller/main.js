var app = angular.module("myApp", ["ngRoute", "ngCookies"]);
app.config(function ($routeProvider) {

    $routeProvider
        .when("/", {
            templateUrl: "pages/dashboard.php",
        })
        .when("/dash", {
            templateUrl: "pages/dashboard.php",
        })
        .when('/role', {
            templateUrl: 'pages/role.html',
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

        .when('/client', {
            templateUrl: 'pages/client.html',
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

        .when('/attendance', {
            templateUrl: 'pages/attendence_view.html',
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

app.controller('dashCtrl', function ($scope, $http) {

    //Role Entry Section
    $scope.roleentry = function () {
        $http({
            url: "../assets/api/role_section.php",
            method: "POST",
            data: {
                "role": $scope.role,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.role = null;
                $scope.roleview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the role ****
    $scope.roleview = function () {
        $http({
            url: "../assets/api/role_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.role_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.role_edit = function (type) {
        $http({
            url: "../assets/api/role_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.role = data.data[0]['role'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Edit the role section **** 
    $scope.role_update = function (type) {
        $http({
            url: "../assets/api/role_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "role": $scope.role,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.roleview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any role ***
    $scope.role_delete = function (type) {
        $http({
            url: "../assets/api/role_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.roleview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // *** Outlet section CURD Operation **** 

    //Outlet Entry Section
    $scope.outletentry = function () {
        $http({
            url: "../assets/api/outlet_section.php",
            method: "POST",
            data: {
                "oname": $scope.sname,
                "address": $scope.address,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.shop = null;
                $scope.address = null;
                $scope.outletview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the outlet ****
    $scope.outletview = function () {
        $http({
            url: "../assets/api/outlet_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.sdata = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.outlet_edit = function (type) {
        $http({
            url: "../assets/api/outlet_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.sname = data.data[0]['oname'];
                $scope.address = data.data[0]['address'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Edit the outlet section **** 
    $scope.outlet_update = function (type) {
        $http({
            url: "../assets/api/outlet_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "oname": $scope.sname,
                "address": $scope.address,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.outletview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any outlet ***
    $scope.outlet_delete = function (type) {
        $http({
            url: "../assets/api/outlet_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.outletview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Staff section ***

    //staff Entry Section
    $scope.staffentry = function () {
        $http({
            url: "../assets/api/employee_section.php",
            method: "POST",
            data: {
                "phone": $scope.phone,
                "sname": $scope.sname,
                "address": $scope.address,
                "gender": $scope.gender,
                "email": $scope.email,
                "role": $scope.role.trim(),
                "location": $scope.location.trim(),
                "quali": $scope.quali,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.phone = null;
                $scope.sname = null;
                $scope.address = null;
                $scope.gender = null;
                $scope.email = null;
                $scope.role = null;
                $scope.location = null;
                $scope.quali = null;
                $scope.staffview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the outlet ****
    $scope.staffview = function () {
        $http({
            url: "../assets/api/employee_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.staff_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.staff_edit = function (type) {
        $http({
            url: "../assets/api/employee_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.phone = data.data[0]['phone'];
                $scope.sname = data.data[0]['sname'];
                $scope.address = data.data[0]['address'];
                $scope.gender = data.data[0]['gender'];
                $scope.email = data.data[0]['email'];
                $scope.role = data.data[0]['role'].trim();
                $scope.location = data.data[0]['location'].trim();
                $scope.quali = data.data[0]['quali'];
                $scope.idd = type;

            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Edit the outlet section **** 
    $scope.staff_update = function (type) {
        $http({
            url: "../assets/api/employee_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "phone": $scope.phone,
                "sname": $scope.sname,
                "address": $scope.address,
                "gender": $scope.gender,
                "email": $scope.email,
                "role": $scope.role,
                "location": $scope.location,
                "quali": $scope.quali,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.staffview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any outlet ***
    $scope.staff_delete = function (type) {
        $http({
            url: "../assets/api/employee_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.staffview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    //Outlet Entry Section
    $scope.categoryentry = function () {
        $http({
            url: "../assets/api/category_section.php",
            method: "POST",
            data: {
                "cname": $scope.cname,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.cname = null;
                $scope.categoryview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the outlet ****
    $scope.categoryview = function () {
        $http({
            url: "../assets/api/category_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.cdata = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.category_edit = function (type) {
        $http({
            url: "../assets/api/category_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.sname = data.data[0]['oname'];
                $scope.address = data.data[0]['address'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Edit the outlet section **** 
    $scope.category_update = function (type) {
        $http({
            url: "../assets/api/category_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "cname": $scope.sname,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.categoryview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any outlet ***
    $scope.category_delete = function (type) {
        $http({
            url: "../assets/api/category_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.categoryview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Service Section ***
    $scope.serviceentry = function () {
        $http({
            url: "../assets/api/service_section.php",
            method: "POST",
            data: {
                "cname": $scope.cname,
                "iname": $scope.iname,
                "type": $scope.type,
                "price": $scope.price,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.cname = null;
                $scope.iname = null;
                $scope.type = null;
                $scope.price = null;
                $scope.serviceview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the outlet ****
    $scope.serviceview = function () {
        $http({
            url: "../assets/api/service_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.idata = data.data;
                $scope.categoryview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.service_edit = function (type) {
        $http({
            url: "../assets/api/service_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.sname = data.data[0]['oname'];
                $scope.address = data.data[0]['address'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Edit the outlet section **** 
    $scope.service_update = function (type) {
        $http({
            url: "../assets/api/service_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "cname": $scope.sname,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.serviceview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any outlet ***
    $scope.service_delete = function (type) {
        $http({
            url: "../assets/api/service_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.serviceview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // *** Client Section ***

    $scope.clientsave = function () {
        $http({
            url: "../assets/api/client_section.php",
            method: "POST",
            data: {
                "name": $scope.name,
                "ctype": $scope.ctype,
                "dob": $scope.dob,
                "ph": $scope.ph,
                "email": $scope.email,
                "pan": $scope.pan,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.name = null;
                $scope.ctype = null;
                $scope.dob = null;
                $scope.ph = null;
                $scope.email = null;
                $scope.pan = null;
                $scope.clientview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.clientview = function () {
        $http({
            url: "../assets/api/client_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.client_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.client_edit = function (type) {
        $http({
            url: "../assets/api/client_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.email = data.data[0]['email'];
                $scope.name = data.data[0]['name'];
                $scope.ctype = data.data[0]['ctype'];
                $scope.dob = data.data[0]['dob'];
                $scope.ph = data.data[0]['ph'];
                $scope.pan = data.data[0]['pan'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.client_update = function (type) {
        $http({
            url: "../assets/api/client_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "name": $scope.name,
                "ctype": $scope.ctype,
                "dob": $scope.dob,
                "ph": $scope.ph,
                "email": $scope.email,
                "pan": $scope.pan,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.clientview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.client_delete = function (type) {
        $http({
            url: "../assets/api/client_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.clientview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.emaild = function (type) {
        $scope.to = type;
    }

    $scope.email_send = function () {
        $http({
            url: "../assets/api/email_client.php",
            method: "POST",
            data: {
                "to": $scope.to,
                "subject": $scope.subject,
                "txt": $scope.txt
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.to = null;
                $scope.subject = null;
                $scope.txt = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }


    // *** Attendence Section *** 
    $scope.attendence_view1 = function (type) {
        $http({
            url: "../assets/api/attendence_view.php",
            method: "GET"
        }).then(
            function (data) {
                console.log(data.data);
                $scope.adata = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.attendence_view = function () {
        setInterval(function () {
            $scope.attendence_view1();
        }, 2000);
    };




});
