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
                    "iname":$scope.iname,
                    "type":$scope.type,
                    "price":$scope.price,
                    "op": "insert"
                }
            }).then(
                function (data) {
                    console.log(data.data);
                    alert(data.data);
                    $scope.cname = null;
                    $scope.iname=null;
                    $scope.type=null;
                    $scope.price=null;
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

    //Company Section
    $scope.companyentry = function () {
        $http({
            url: "../assets/api/company_section.php",
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
            url: "../assets/api/company_section.php",
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
            url: "../assets/api/company_section.php",
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
            url: "../assets/api/company_section.php",
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
            url: "../assets/api/company_section.php",
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

    // *** Purchase Section *** 
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
                    $scope.openModal();
                    
                },
                function () {
                    alert("Error! Fetching Problem in sendData()");
                });
        }
    
        $scope.pro_data = function () { 
            $http({
                url: "../assets/api/product_section.php",
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
                url: "../assets/api/purchase_section.php",
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
                    "nop":$scope.nop,
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
        url: "../assets/api/stock_section.php",
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
        url: "../assets/api/stock_section.php",
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

   
});
