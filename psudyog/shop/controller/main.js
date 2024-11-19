var app = angular.module("myApp", ["ngRoute", "ngCookies"]);
app.config(function ($routeProvider) {

    $routeProvider
        .when("/", {
            templateUrl: "pages/dashboard.php",
            controller: 'dashCtrl'
        })
        .when("/dash", {
            templateUrl: "pages/dashboard.php",
            controller: 'dashCtrl'
        })
        .when('/role', {
            templateUrl: 'pages/role.html',
            controller: 'dashCtrl'
        })

        .when('/stype', {
            templateUrl: 'pages/stype.html',
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

        .when('/sreq', {
            templateUrl: 'pages/service_request.html',
            controller: 'dashCtrl'
        })


        .when('/client', {
            templateUrl: 'pages/client.html',
            controller: 'dashCtrl'
        })

        .when('/works', {
            templateUrl: 'pages/works_entry.html',
            controller: 'dashCtrl'
        })


        .when('/vendor_pay', {
            templateUrl: 'pages/vendor_payment.html',
            controller: 'dashCtrl'
        })

        .when('/vendor_ledger', {
            templateUrl: 'pages/vendor_ledger.html',
            controller: 'dashCtrl'
        })

        .when('/client_wroks', {
            templateUrl: 'pages/count.html',
            controller: 'dashCtrl'
        })

        .when('/bill', {
            templateUrl: 'pages/bill.html',
            controller: 'dashCtrl'
        })

        .when('/asign', {
            templateUrl: 'pages/asign.html',
            controller: 'dashCtrl'
        })

        .when('/purchase', {
            templateUrl: 'pages/purchase.php',
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

        .when('/tc', {
            templateUrl: 'pages/Today_collection.html',
            controller: 'dashCtrl'
        })
        .when('/cp', {
            templateUrl: 'pages/cp.html',
            controller: 'dashCtrl'
        })
        .otherwise({
            template: "<h1>Error 404! Not Found </h1>"
        });
});

app.controller('dashCtrl', function ($scope, $http) {

    // **** Dash Section ****
    $scope.count_sec = function () {
        setInterval(function()
        { 
            $scope.count_sec1(); 
        }, 2000);
    }

    $scope.count_sec1 = function () {
        console.log("success");
        $http({
            url: "../assets2/api/count_sec.php",
            method: "GET"
        }).then(
            function (data) {
                console.log(data.data);
                $scope.pending=data.data[0];
                $scope.delivered=data.data[1];
                $scope.ptotal=data.data[2];
                $scope.stotal=data.data[3];
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    
    //Role Entry Section
    $scope.roleentry = function () {
        $http({
            url: "../assets2/api/role_section.php",
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
            url: "../assets2/api/role_section.php",
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
            url: "../assets2/api/role_section.php",
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
            url: "../assets2/api/role_section.php",
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
            url: "../assets2/api/role_section.php",
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

    //Service Type Entry Section
    $scope.typeentry = function () {
        $http({
            url: "../assets2/api/stype_section.php",
            method: "POST",
            data: {
                "stype": $scope.stype,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.stype = null;
                $scope.typeview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the role ****
    $scope.typeview = function () {
        $http({
            url: "../assets2/api/stype_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.type_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.type_edit = function (type) {
        $http({
            url: "../assets2/api/stype_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.stype = data.data[0]['stype'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Edit the role section **** 
    $scope.type_update = function (type) {
        $http({
            url: "../assets2/api/stype_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "stype": $scope.stype,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.typeview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any role ***
    $scope.type_delete = function (type) {
        $http({
            url: "../assets2/api/stype_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.typeview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    //Company Entry Section
    $scope.companyentry = function () {
        $http({
            url: "../assets2/api/company_section.php",
            method: "POST",
            data: {
                "company": $scope.company,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.role = null;
                $scope.companyview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the role ****
    $scope.companyview = function () {
        $http({
            url: "../assets2/api/company_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.company_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.company_edit = function (type) {
        $http({
            url: "../assets2/api/company_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.company = data.data[0]['company'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Edit the role section **** 
    $scope.company_update = function (type) {
        $http({
            url: "../assets2/api/company_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "company": $scope.company,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.companyview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any role ***
    $scope.company_delete = function (type) {
        $http({
            url: "../assets2/api/company_section.php",
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

    // **** Work order Curd operaton ****

    $scope.workentry = function () {
        $http({
            url: "../assets2/api/work_section.php",
            method: "POST",
            data: {
                "wno": $scope.wno,
                "wdate":$scope.wdate,
                "cname":$scope.cname,
                "ph":$scope.ph,
                "email":$scope.email,
                "state":$scope.state,
                "iname":$scope.iname,
                "iserial":$scope.iserial,
                "stype":$scope.stype,
                "caddress":$scope.caddress,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.wno=null;
                $scope.wdate=null;
                $scope.cname=null;
                $scope.ph=null;
                $scope.email=null;
                $scope.state=null;
                $scope.iname=null;
                $scope.iserial=null;
                $scope.stype=null;
                $scope.caddress=null;
                $scope.workview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the role ****
    $scope.workview = function () {
        $http({
            url: "../assets2/api/work_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.work_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.work_edit = function (type) {
        $http({
            url: "../assets2/api/work_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.wno=data.data[0]['wno'];
                $scope.wdate=data.data[0]['wdate'];
                $scope.cname=data.data[0]['cname'];
                $scope.ph=data.data['ph'];
                $scope.email=data.data[0]['email'];
                $scope.state=data.data[0]['state'];
                $scope.iname=data.data[0]['iname'];
                $scope.iserial=data.data[0]['iserial'];
                $scope.stype=data.data[0]['stype'];
                $scope.caddress=data.data[0]['address'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Edit the role section **** 
    $scope.work_update = function (type) {
        $http({
            url: "../assets2/api/role_section.php",
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
    $scope.work_delete = function (type) {
        $http({
            url: "../assets2/api/role_section.php",
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
            url: "../assets2/api/outlet_section.php",
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
            url: "../assets2/api/outlet_section.php",
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
            url: "../assets2/api/outlet_section.php",
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
            url: "../assets2/api/outlet_section.php",
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
            url: "../assets2/api/outlet_section.php",
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
            url: "../assets2/api/employee_section.php",
            method: "POST",
            data: {
                "phone": $scope.phone,
                "stname": $scope.sname,
                "address": $scope.address,
                "gender": $scope.gender,
                "email": $scope.email,
                "role": $scope.role,
                "location": $scope.location,
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
            url: "../assets2/api/employee_section.php",
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
            url: "../assets2/api/employee_section.php",
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
            url: "../assets2/api/employee_section.php",
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
            url: "../assets2/api/employee_section.php",
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

    // *** Vendore entry section *** 
    $scope.state_search = function () {

        $http({
            url: "../assets2/api/vendor_section.php",
            method: "POST",
            data: {
                "gstno": $scope.gstno,
                "op": "select_state"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.state = data.data[0]['State'];
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.vendore_entry = function () {
        $http({
            url: "../assets2/api/vendor_section.php",
            method: "POST",
            data: {
                "vname": $scope.vname,
                "address": $scope.address,
                "gstno": $scope.gstno,
                "panno": $scope.panno,
                "phone": $scope.phone,
                "state": $scope.state,
                "nod": $scope.nod,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.vname = null;
                $scope.address = null;
                $scope.gstno = null;
                $scope.panno = null;
                $scope.phone = null;
                $scope.state = null;
                $scope.nod = null;
                $scope.vendorview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.vendorview = function () {
        $http({
            url: "../assets2/api/vendor_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.vdata = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.vendor_edit = function (type) {
        $http({
            url: "../assets2/api/vendor_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.vname = data.data[0]['vname'];
                $scope.address = data.data[0]['address'];
                $scope.gstno = data.data[0]['gstno'];
                $scope.panno = data.data[0]['panno'];
                $scope.phone = data.data[0]['phone'];
                $scope.state = data.data[0]['state'];
                $scope.nod = data.data[0]['nod'];
                $scope.idd = type;

            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // *** Edit the outlet section **** 
    $scope.vendor_update = function (type) {
        $http({
            url: "../assets2/api/vendor_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "vname": $scope.vname,
                "address": $scope.address,
                "gstno": $scope.gstno,
                "panno": $scope.panno,
                "phone": $scope.phone,
                "state": $scope.state,
                "nod": $scope.nod,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.vendorview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any outlet ***
    $scope.vendor_delete = function (type) {
        $http({
            url: "../assets2/api/vendor_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.vendorview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // *** Client Section ***

    $scope.state_search = function () {

        $http({
            url: "../assets2/api/client_section.php",
            method: "POST",
            data: {
                "gstno": $scope.gstno,
                "op": "select_state"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.state = data.data[0]['State'];
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.client_entry = function () {
        $http({
            url: "../assets2/api/client_section.php",
            method: "POST",
            data: {
                "cname": $scope.cname,
                "address": $scope.address,
                "gstno": $scope.gstno,
                "panno": $scope.panno,
                "phone": $scope.phone,
                "state": $scope.state,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.vname = null;
                $scope.address = null;
                $scope.gstno = null;
                $scope.panno = null;
                $scope.phone = null;
                $scope.state = null;
                $scope.clientview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.clientview = function () {
        $http({
            url: "../assets2/api/client_section.php",
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
    $scope.client_edit = function (type) {
        
        $http({
            url: "../assets2/api/client_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.vname = data.data[0]['cname'];
                $scope.address = data.data[0]['address'];
                $scope.gstno = data.data[0]['gstno'];
                $scope.panno = data.data[0]['panno'];
                $scope.phone = data.data[0]['phone'];
                $scope.state = data.data[0]['state'];
                $scope.idd = type;

            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // *** Edit the outlet section **** 
    $scope.client_update = function (type) {
        $http({
            url: "../assets2/api/client_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "cname": $scope.cname,
                "address": $scope.address,
                "gstno": $scope.gstno,
                "panno": $scope.panno,
                "phone": $scope.phone,
                "state": $scope.state,
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

    // **** Delete any outlet ***
    $scope.client_delete = function (type) {
        $http({
            url: "../assets2/api/client_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.clientview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Item entry section ***

    $scope.itementry = function () {
        $http({
            url: "../assets2/api/item_section.php",
            method: "POST",
            data: {
                "iname": $scope.iname,
                "hsn": $scope.hsn,
                "qty": $scope.qty,
                "unit": $scope.unit,
                "price": $scope.price,
                "gst": $scope.gst,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.iname = null;
                $scope.price = null;
                $scope.gst = null;
                $scope.itemview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the role ****
    $scope.itemview = function () {
        $http({
            url: "../assets2/api/item_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.item_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    
    // *** Purchase section entry *** 
     
    $scope.openModal = function() {
        $('#myModal').modal('show');
        //$scope.companyview();
        document.getElementById("myBtn").disabled = true;
    };


    // pan no function 
    $scope.pan_data = function () {
        let str = $scope.gstno;
        let middleChars = str.substring(2, 12);
        $scope.panno = middleChars;
        $scope.state_search();
    }

    $scope.gstsec = function () {
        $scope.gstcalc1();
        var state = $scope.state;
        if (state === 'Tripura') {
            var x = $scope.gstper;
            var y = $scope.gstamt;
            var x1 = parseFloat(x) / 2;
            var y1 = parseFloat(y) / 2;
            y1 = parseFloat(y1.toFixed(2));
            $scope.cgst = x1;
            $scope.cgstp = y1;
            $scope.sgst = x1;
            $scope.sgstp = y1;
            $scope.igst = 0;
            $scope.igstp = 0;
        }
        else {
            $scope.cgst = 0;
            $scope.cgstp = 0;
            $scope.sgst = 0;
            $scope.sgstp = 0;
            $scope.igst = $scope.gstper;
            $scope.igstp = $scope.gstamt;
        }
        document.getElementById("myBtn").disabled = false;
    }

    $scope.batch_sec = function () {
        var x = $scope.bno;
        if (parseInt(x) < 0) {
            $scope.bno = Math.random();
        }
    }

    $scope.gstcalc1 = function () {
        var x = $scope.tax;
        var y = $scope.gstper;
        var y1 = (parseFloat(x) * parseFloat(y)) / 100;
        y1 = parseFloat(y1.toFixed(2));
        var z = parseInt(x) + parseInt(y1);
        $scope.gstamt = y1;
        $scope.total = z;
    }

    $scope.ratecalc = function () {
        var x = $scope.qty1;
        var y = $scope.rate;
        var z = parseFloat(x) * parseFloat(y);
        $scope.tax=z.toFixed(2);
    }

    $scope.ven_data = function () { 
        $http({
            url: "../assets2/api/vendor_section.php",
            method: "POST",
            data: {
                "vname": $scope.vname,
                "op": "select_vendor"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.address = data.data[0]['address'];
                $scope.gstno = data.data[0]['gstno'];
                $scope.panno = data.data[0]['panno'];
                $scope.phone = data.data[0]['phone'];
                $scope.email = 'NA';
                $scope.state = data.data[0]['state'];
                $scope.openModal();
                
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.pro_data = function () { 
        $http({
            url: "../assets2/api/product_section.php",
            method: "POST",
            data: {
                "category": $scope.category,
                "op": "select_condition"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.prdata = data.data; 
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.unitview = function () { 
      var x=$scope.unit;
      
      if(x==='Case'){
        $scope.unit1="PC";
        document.getElementById("nop").readOnly = false;
        
      }
      else if(x=='Dojon'){
       $scope.nop="12";
       document.getElementById("nop").readOnly = true;
       $scope.unit1="PC";
      }
      else{
        $scope.nop="1";
        document.getElementById("nop").readOnly = true;
        $scope.unit1=$scope.unit;
      }
        
    }

    $scope.totalpc = function () { 
        var x=$scope.qty1;
        var y=$scope.fqty;
        var z=$scope.nop;
        var qty=parseInt(x)*parseInt(z);
        var z1=$scope.unitt;
        if(z1==='Case'){
            var fqty=parseInt(y)*parseInt(z);
            qty=parseInt(qty)+parseInt(fqty);
        }
        else if(z1=='Dojon'){
            var fqty=12*parseInt(y);
            qty=parseInt(qty)+parseInt(fqty);
        }
        else{
            var fqty=1*parseInt(y);
            qty=parseInt(qty)+parseInt(fqty); 
        }
        $scope.qty=qty;
      }

      $scope.prate=function(){
        var x=$scope.rate;
        var y=$scope.nop;
        var z=parseFloat(x)/parseFloat(y);
        $scope.rate1=z.toFixed(2);
        x=$scope.srate;
        y=$scope.nop;
        z=parseFloat(x)/parseFloat(y);
        $scope.rate2=z.toFixed(2);
        $scope.ratecalc();
      }


    $scope.purchase_entry = function () {
        $http({
            url: "../assets2/api/purchase_section.php",
            method: "POST",
            data: {
                "pinv": $scope.pinv,
                "invdate": $scope.invdate,
                "vendore": $scope.vname,
                "gstno": $scope.gstno,
                "state": $scope.state,
                "category": $scope.category,
                "product": $scope.product,
                "hsn": $scope.hsn,
                "qty": $scope.qty1,
                "unit": $scope.unit,
                "unit1": $scope.unit1,
                "fqty":$scope.fqty,
                "unit2":$scope.unitt,
                "bno": $scope.bno,
                "expdate": $scope.expdate,
                "rack":$scope.rack,
                "disc":$scope.disc,
                "rate": $scope.rate,
                "srate":$scope.srate,
                "tax": $scope.tax,
                "gstper": $scope.gstper,
                "cgst": $scope.cgst,
                "cgstp": $scope.cgstp,
                "sgst": $scope.sgst,
                "sgstp": $scope.sgstp,
                "igst": $scope.igst,
                "igstp": $scope.igstp,
                "gstamt": $scope.gstamt,
                "total": $scope.total,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.pdata = data.data;
                $scope.gtotal_sec();
                $scope.category = null;
                $scope.product = null;
                $scope.hsn = null;
                $scope.qty = null;
                $scope.unit = null;
                $scope.bno = null;
                $scope.expdate = null;
                $scope.srate=null;
                $scope.rate1=null;
                $scope.rate2=null;
                $scope.rate = null;
                $scope.nop=null;
                $scope.fqty=null;
                $scope.unitt=null;
                $scope.unit1=null;
                $scope.tax = null;
                $scope.gstper = null;
                $scope.cgst = null;
                $scope.cgstp = null;
                $scope.sgst = null;
                $scope.sgstp = null;
                $scope.igst = null;
                $scope.igstp = null;
                $scope.gstamt = null;
                $scope.total = null;
                document.getElementById("myBtn").disabled = true;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.gtotal_sec = function () {
        $http({
            url: "../assets2/api/purchase_section.php",
            method: "POST",
            data: {
                "pinv": $scope.pinv,
                "state": $scope.state,
                "vendore": $scope.vname,
                "gstno": $scope.gstno,
                "op": "gtotal"
            }
        }).then(
            function (data) {
                console.log(data.data);
                //alert(data.data);
                $scope.tax1 = data.data[0]['tax'];
                $scope.gstamt1 = data.data[0]['gstamt'];
                $scope.total1 = data.data[0]['total'];
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.add_new = function () {
        $scope.pinv = null;
        $scope.invdate = null;
        $scope.vname = null;
        $scope.gstno = null;
        $scope.state = null;
        $scope.address = null;
        $scope.phone = null;
        $scope.gstno = null;
        $scope.panno = null;
        $scope.email = null;
        $scope.pdata = null;
        $scope.tax1 = null;
        $scope.gstamt1 = null;
        $scope.total1 = null;
    }

   

    // *** Stock Section ***
    $scope.stockview = function () {
        $http({
            url: "../assets2/api/stock_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.stock_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.delete_stock = function () {
        $http({
            url: "../assets2/api/stock_section.php",
            method: "POST",
            data: {
                "id": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.stockview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.stock_calc = function () {
        console.log($scope.pname);
        $http({
            url: "../assets2/api/stock_calc.php",
            method: "POST",
            data: {
                "product": $scope.pname,
                "qty": $scope.qty,
                "unit": $scope.unit
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.cost = data.data[0];
                $scope.total = data.data[1];
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.stockexp = function () {
        $http({
            url: "../assets2/api/stock_section.php",
            method: "POST",
            data: {
                "op": "select_condition"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.stock_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // *** Reuistion Section *** 
    $scope.req_view = function () {
        $http({
            url: "../assets2/api/req_view.php",
            method: "GET"
        }).then(
            function (data) {
                console.log(data.data);
                $scope.req_data = data.data;
                $scope.var = true;
                $scope.var1 = false;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.req_item = function (type) {
        $http({
            url: "../assets2/api/req_section.php",
            method: "POST",
            data: {
                "reqno": type,
                "op": "select_condition"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.req_data = data.data;
                $scope.var1 = true;
                $scope.var = false;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }


    $scope.req_accept = function (type, type1, type2) {
        let sqty = prompt("Please enter No of Qty Send", type2);
        $http({
            url: "../assets2/api/req_section.php",
            method: "POST",
            data: {
                "reqno": type,
                "item": type1,
                "sqty": sqty,
                "status": "Send to Outlet",
                "op": "update"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.req_data = data.data;
                $scope.var1 = true;
                $scope.var = false;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.req_cancel = function (type, type1, type2) {
        let cancel = prompt("Cancel Remarks");
        $http({
            url: "../assets2/api/req_section.php",
            method: "POST",
            data: {
                "reqno": type,
                "item": type1,
                "cancel": cancel,
                "status": "Send to Outlet",
                "op": "update"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.req_data = data.data;
                $scope.var1 = true;
                $scope.var = false;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    // Purchae report section 
    $scope.pruchase_report = function () {
        $http({
            url: "../assets2/api/report_section.php",
            method: "POST",
            data: {
                "pinv": "1",
                "op": "purchase_view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.pdata = data.data;
                $scope.pruchase_total();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.pruchase_total = function () {
        $http({
            url: "../assets2/api/report_section.php",
            method: "POST",
            data: {
                "pinv": "1",
                "op": "purchase_total"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.gtax = data.data[0]['gtax'];
                $scope.gcgst = data.data[0]['gcgsta'];
                $scope.gsgst = data.data[0]['gsgsta'];
                $scope.gigst = data.data[0]['gigsta'];
                $scope.gtotal = data.data[0]['gtotal'];
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.p_view = function (type) {
        console.log(type);
        $http({
            url: "../assets2/api/report_section.php",
            method: "POST",
            data: {
                "pinv": type,
                "op": "purchase_details"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.pvdata = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    // **** Vendore payment section *****
    $scope.venpayentry = function () {
        $http({
            url: "../assets2/api/vendore_payment.php",
            method: "POST",
            data: {
                "vname": $scope.vname,
                "gstno": $scope.gstno,
                "debit": $scope.debit,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.vname = null;
                $scope.gstno = null;
                $scope.debit = null;
                $scope.venpayview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the role ****
    $scope.venpayview = function () {
        $http({
            url: "../assets2/api/vendore_payment.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.pay_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.venpay_edit = function (type) {
        $http({
            url: "../assets2/api/vendore_payment.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.vname = data.data[0]['vname'];
                $scope.gstno = data.data[0]['gstno'];
                $scope.debit = data.data[0]['debit'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Edit the role section **** 
    $scope.venpay_update = function (type) {
        $http({
            url: "../assets2/api/vendore_payment.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "vname": $scope.vname,
                "gstno": $scope.gstno,
                "debit": $scope.debit,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.vname = null;
                $scope.gstno = null;
                $scope.debit = null;
                $scope.venpayview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any role ***
    $scope.venpay_delete = function (type) {
        $http({
            url: "../assets2/api/vendore_payment.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.venpayview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.ven_data1 = function () {
        $http({
            url: "../assets2/api/vendor_section.php",
            method: "POST",
            data: {
                "vname": $scope.vname,
                "op": "select_vendor"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.gstno = data.data[0]['gstno'];
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.venpay_ledger = function () {
        $http({
            url: "../assets2/api/vendore_payment.php",
            method: "POST",
            data: {
                "op": "ledger"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.pay_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Sales report section ****
    $scope.salesrep = function () {
        $http({
            url: "../assets2/api/salesrep.php",
            method: "GET"
        }).then(
            function (data) {
                console.log(data.data);
                $scope.srdata = data.data;
                $scope.view1=true;
                $scope.view2=false;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.salesrep1 = function (type) {
        $http({
            url: "../assets2/api/salesrep1.php",
            method: "POST",
            data:{
                "name":type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.srdata1 = data.data;
                $scope.view2=true;
                $scope.view1=false;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // *** Sales Section ***
    $scope.order_no = function () {
        $http({
            url: "../assets2/api/invoauto.php",
            method: "GET",
        }).then(
            function (data) {
                console.log(data.data);
                $scope.invno = data.data[0];
                $scope.clientview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.staffsearch = function () {
        console.log($scope.cname);
        $http({
            url: "../assets2/api/employee_section.php",
            method: "POST",
            data: {
                "stname":$scope.ae,
                "op": "select_staff"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.sph=data.data[0]['phone'];
                $scope.semail=data.data[0]['email'];
                $scope.openModal();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.openModal = function () {
        $('#myModal').modal('show');
        $scope.itemview();
    };

    $scope.itemview = function () {
        $http({
            url: "../assets2/api/item_section.php",
            method: "GET"
        }).then(
            function (data) {
                console.log(data.data);
                $scope.item_data = data.data;

            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.itemsearch = function () {
        $http({
            url: "../assets2/api/item_search.php",
            method: "POST",
            data: {
                "product": $scope.product
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.hsn = data.data[0]['hsn'];
                $scope.bno = data.data[0]['bno'];
                $scope.expdate = data.data[0]['expdate'];
                $scope.gstper = data.data[0]['gst'];
                $scope.rate2 = data.data[0]['srate'];
                $scope.nop = data.data[0]['nop'];
                $scope.category = data.data[0]['category'];
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.unitview1 = function () {
        var x = $scope.unit;
        var y = $scope.nop;
        var z = $scope.rate2;
        if (x === 'Case' || x === 'Dojon') {
            var z1 = parseFloat(y) * parseFloat(z);
            $scope.srate = z1.toFixed();
        }
        else {
            $scope.srate = parseInt(z);
        }
        $scope.gstcalc();
    }

    $scope.gstcalc = function () {
        var gst = $scope.gstper;
        var state=$scope.state;
        var x = parseInt($scope.qty);
        var y = parseFloat($scope.srate);
        var z = x * y;
        $scope.tax = z.toFixed(2);
        var gstamt = (parseFloat(z) * parseFloat(gst)) / 100;
        $scope.gstamt = gstamt.toFixed(2);
        var total = gstamt + z;
        $scope.total=total.toFixed();
        if(state=='Tripura'){
          $scope.cgst=parseFloat(gst)/2;
          $scope.sgst=parseFloat(gst)/2;
          $scope.cgstp=parseFloat($scope.gstamt)/2;
          $scope.sgstp=parseFloat($scope.gstamt)/2;  
        }
        else{
            $scope.igst=gst;
            $scope.igstp=$scope.gstamt;
        }
    }

    $scope.salesview = function () {
        $http({
            url: "../assets2/api/sales_section.php",
            method: "POST",
            data: {
                "sinv": $scope.invno,
                "ph":$scope.ph,
                "gstno":$scope.gstno,
                "state":$scope.state,
                "op": "item_view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.sadata = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.sales_total = function () {
        $http({
            url: "../assets2/api/sales_total.php",
            method: "POST",
            data: {
                "sinv": $scope.invno,
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.gtax = data.data[0];
                $scope.tgstamt = data.data[1];
                $scope.gtotal = data.data[2];
                $scope.total1=data.data[2];
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.pen=function(){
        var x=$scope.rcv;
        var y=$scope.total1;
        $scope.pending=parseInt(x)-parseInt(y);
    }


    $scope.salesentry = function () {
        $http({
            url: "../assets2/api/sales_section.php",
            method: "POST",
            data: {
                "sinv": $scope.invno,
                "invdate": new Date(),
                "name": $scope.cname,
                "ph":$scope.ph,
                "gstno":$scope.gstno,
                "state":$scope.state,
                "category":$scope.category,
                "product":$scope.product,
                "hsn":$scope.hsn,
                "qty":$scope.qty,
                "unit":$scope.unit,
                "rate":$scope.srate,
                "bno":$scope.bno,
                "expdate":$scope.expdate,
                "tax": $scope.tax,
                "gstper": $scope.gstper,
                "cgst":$scope.cgst,
                "cgstp":$scope.cgstp,
                "sgst":$scope.sgst,
                "sgstp":$scope.sgstp,
                "igst":$scope.igst,
                "igstp":$scope.igstp,
                "gstamt": $scope.gstamt,
                "total": $scope.total,
                "op": "insert"
            }
        }).then(
            function (data) {
                alert(data.data);
                console.log(data.data);
                $scope.product=null;
                $scope.hsn=null;
                $scope.qty=null;
                $scope.unit=null;
                $scope.srate=null;
                $scope.rate2=null;
                $scope.nop=null;
                $scope.bno=null;
                $scope.expdate=null;
                $scope.tax=null;
                $scope.gst=null;
                $scope.cgst=null;
                $scope.cgstp=null;
                $scope.sgst=null;
                $scope.sgstp=null;
                $scope.igst=null;
                $scope.igstp=null;
                $scope.gstamt=null;
                $scope.total=null;
                $scope.salesview();
                $scope.sales_total();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.sales_submit = function () {
        console.log($scope.sinv);
        $http({
            url: "../assets2/api/sales_submit1.php",
            method: "POST",
            data: {
                "inv": $scope.invno,
                "pay": $scope.tmode,
                "type": "Bill",
                "gtotal":$scope.total1
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.sdata=null;
                $scope.invdate=null;
                $scope.ph=null;
                $scope.name=null;
                $scope.total1=null;
                $scope.rcv=null;
                $scope.total1=null;
                $scope.tmode=null;
                $scope.wph=null;
                $scope.tax1 = null;
                $scope.gstamt1 = null;
                $scope.total1 = null;
                window.location = 'print.php?invno=' + $scope.sinv;
                $scope.invno_no();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    // *** Todays collection Section ***
    $scope.today_collection=function(){
        $http({
            url: "../assets2/api/todays_sales.php",
            method: "GET"
        }).then(
            function (data) {
                console.log(data.data);
                $scope.billdata=data.data;
                $scope.gtoday_collection();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.gtoday_collection=function(){
        $http({
            url: "../assets2/api/todays_sales1.php",
            method: "GET"
        }).then(
            function (data) {
                console.log(data.data);
                $scope.gtotal=data.data[0];
                $scope.gcash=data.data[1];
                $scope.gcard=data.data[2];
                $scope.gupi=data.data[3];
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }





});
