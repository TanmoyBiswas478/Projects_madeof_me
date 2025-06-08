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

        .when('/vendor', {
            templateUrl: 'pages/vendore.html',
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

        .when('/item', {
            templateUrl: 'pages/item.html',
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

        .when('/tc', {
            templateUrl: 'pages/Today_collection.html',
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

    // *** Vendore entry section *** 
    $scope.state_search = function () {

        $http({
            url: "../assets/api/vendor_section.php",
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
            url: "../assets/api/vendor_section.php",
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
            url: "../assets/api/vendor_section.php",
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
            url: "../assets/api/vendor_section.php",
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
            url: "../assets/api/vendor_section.php",
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
            url: "../assets/api/vendor_section.php",
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

    // *** Item entry section ***

    $scope.itementry = function () {
        $http({
            url: "../assets/api/item_section.php",
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
            url: "../assets/api/item_section.php",
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

    // **** Delete any item ***
    $scope.item_delete = function (type) {
        $http({
            url: "../assets/api/item_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.itemview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // *** Receipe Entry section ***

    $scope.receipeentry = function () {
        $http({
            url: "../assets/api/receipe_section.php",
            method: "POST",
            data: {
                "iname": $scope.iname,
                "pname": $scope.pname,
                "qty": $scope.qty,
                "unit": $scope.unit,
                "cost": $scope.cost,
                "total": $scope.total,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.pname = null;
                $scope.qty = null;
                $scope.unit = null;
                $scope.receipeview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.receipeview = function () {
        $http({
            url: "../assets/api/receipe_section.php",
            method: "POST",
            data: {
                "iname": $scope.iname,
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.receipe_data = data.data;
                $scope.receipetotal();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.receipe_delete = function (type) {
        $http({
            url: "../assets/api/receipe_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.receipeview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.receipetotal = function () {
        $http({
            url: "../assets/api/receipe_section.php",
            method: "POST",
            data: {
                "iname": $scope.iname,
                "op": "gtotal"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.gtotal = data.data[0]['total'];
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Purchase section entry *** 
    
    $scope.product_data = function () {
        $http({
            url: "../assets/api/product.php",
            method: "GET"
        }).then(
            function (data) {
                console.log(data.data);
                $scope.prodata = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.hsn_data = function (type) {
        console.log($scope.product);
        $http({
            url: "../assets/api/hsn.php",
            method: "POST",
            data:{
                "pname":$scope.product
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.hsn = data.data[0]['hsn'];
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }


    // pan no function 
    $scope.pan_data = function () {
        let str = $scope.gstno;
        let middleChars = str.substring(2, 12);
        $scope.panno = middleChars;
        $scope.state_search();
    }

    $scope.gstsec = function () {
        $scope.gstcalc();
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
    }

    $scope.batch_sec = function () {
        var x = $scope.bno;
        if (parseInt(x) < 0) {
            $scope.bno = Math.random();
        }
    }

    $scope.gstcalc = function () {
        var x = $scope.tax;
        var y = $scope.gstper;
        var y1 = (parseFloat(x) * parseFloat(y)) / 100;
        y1 = parseFloat(y1.toFixed(2));
        var z = parseFloat(x) + parseFloat(y1);
        $scope.gstamt = y1;
        $scope.total = z.toFixed(2);
    }

    $scope.ratecalc = function () {
        var x = $scope.qty;
        var y = $scope.rate;
        var tax = parseFloat(x) * parseFloat(y);
        $scope.tax=tax.toFixed(2);
    }
    
    $scope.ven_data = function () {
        $http({
            url: "../assets/api/vendor_section.php",
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
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.purchase_entry = function () {
        let x = Math.floor((Math.random() * 10000000) + 1);
        $http({
            url: "../assets/api/purchase_section.php",
            method: "POST",
            data: {
                "pinv": $scope.pinv,
                "invdate": $scope.invdate,
                "vendore": $scope.vname,
                "gstno": $scope.gstno,
                "state": $scope.state,
                "category": 'Sales',
                "product": $scope.product,
                "hsn": $scope.hsn,
                "qty": $scope.qty,
                "unit": $scope.unit,
                "bno": x,
                "expdate": $scope.expdate,
                "rate": $scope.rate,
                "srate": $scope.srate,
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
                $scope.rate = null;
                $scope.srate = null;
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
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.gtotal_sec = function () {
        $http({
            url: "../assets/api/purchase_section.php",
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
                alert(data.data);
                $scope.tax1 = data.data[0]['tax'];
                $scope.gstamt1 = data.data[0]['gstamt'];
                $scope.total1 = data.data[0]['total'];
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    
    $scope.bill_delete = function (type) {
            $http({
                url: "../assets/api/purchase_section.php",
                method: "POST",
                data: {
                    "idd": type,
                    "inv":$scope.pinv,
                    "pinv": $scope.pinv,
                    "state": $scope.state,
                    "vendore": $scope.vname,
                    "gstno": $scope.gstno,
                    "op": "delete"
                }
            }).then(
                function (data) {
                    console.log(data.data);
                    $scope.pdata = data.data;
                    $scope.gtotal_sec();
                    //alert(data.data);
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

    $scope.viewrequ = function () {
        $scope.var = true;
        $scope.var1 = false;
    }

    $scope.viewprod = function () {
        $scope.var1 = true;
        $scope.var = false;
    }

    // *** Stock Section ***
    $scope.stockview = function () {
        $http({
            url: "../assets/api/stock_section.php",
            method: "POST",
            data: {
                "op": "view_stock"
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
    
    $scope.stock_view = function () {
        $http({
            url: "../assets/api/stock_section.php",
            method: "POST",
            data: {
                "op": "ostock_view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.stock_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.stock_calc = function () {
        console.log($scope.pname);
        $http({
            url: "../assets/api/stock_calc.php",
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
            url: "../assets/api/stock_section.php",
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
            url: "../assets/api/req_view.php",
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
            url: "../assets/api/req_section.php",
            method: "POST",
            data: {
                "reqno": type,
                "op": "select_condition2"
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
            url: "../assets/api/req_section.php",
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
            url: "../assets/api/req_section.php",
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
            url: "../assets/api/report_section.php",
            method: "POST",
            data: {
                "op": "purchase_vendor"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.prdata = data.data;
                $scope.part1=true;
                $scope.part2=false;
                $scope.pruchase_total();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.pruchase_total = function () {
        $http({
            url: "../assets/api/report_section.php",
            method: "POST",
            data: {
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

    $scope.pruchase_total1 = function (type) {
        $http({
            url: "../assets/api/report_section.php",
            method: "POST",
            data: {
                "pinv": "1",
                "vendor": type,
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
        $http({
            url: "../assets/api/report_section.php",
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

    $scope.pr_view = function (type) {
        $http({
            url: "../assets/api/report_section.php",
            method: "POST",
            data: {
                "pinv": "1",
                "vendor": type,
                "op": "purchase_details1"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.pvdata1 = data.data;
                $scope.pruchase_total1(type);
                $scope.part1=false;
                $scope.part2=true;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    // **** Sales Report Section ****

    $scope.sales_report = function () {
        $http({
            url: "../assets/api/sreport_section.php",
            method: "POST",
            data: {
                "op": "sales_vendor"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.prdata = data.data;
                $scope.part1=true;
                $scope.part2=false;
                $scope.sales_total();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.sales_total = function () {
        $http({
            url: "../assets/api/sreport_section.php",
            method: "POST",
            data: {
                "op": "sales_total"
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

    $scope.sales_total1 = function (type) {
        $http({
            url: "../assets/api/sreport_section.php",
            method: "POST",
            data: {
                "pinv": "1",
                "ph": type,
                "op": "sales_total"
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

    $scope.s_view = function (type) {
        $http({
            url: "../assets/api/sreport_section.php",
            method: "POST",
            data: {
                "sinv": type,
                "op": "sales_details"
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

    $scope.sr_view = function (type) {
        $http({
            url: "../assets/api/sreport_section.php",
            method: "POST",
            data: {
                "pinv": "1",
                "ph": type,
                "op": "sales_details1"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.pvdata1 = data.data;
                $scope.sales_total1(type);
                $scope.part1=false;
                $scope.part2=true;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }



    // **** Vendore payment section *****
    $scope.venpayentry = function () {
        $http({
            url: "../assets/api/vendore_payment.php",
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
            url: "../assets/api/vendore_payment.php",
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
            url: "../assets/api/vendore_payment.php",
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
            url: "../assets/api/vendore_payment.php",
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
            url: "../assets/api/vendore_payment.php",
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
            url: "../assets/api/vendor_section.php",
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
            url: "../assets/api/vendore_payment.php",
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

    // *** Todays collection Section ***
    $scope.today_collection=function(){
        $http({
            url: "../assets/api/todays_sales.php",
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
            url: "../assets/api/todays_sales1.php",
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
