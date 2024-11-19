var app = angular.module("myApp", ["ngRoute", "ngCookies"]);
app.config(function ($routeProvider) {

    $routeProvider
        .when("/", {
            templateUrl: "pages/dashboard.php",
        })
        .when("/dash", {
            templateUrl: "pages/dashboard.php",
        })
        .when("/vendor", {
            templateUrl: "pages/vendore.html",
            controller: 'dashCtrl'
        })
        .when('/appoinment', {
            templateUrl: 'pages/appoinment.html',
            controller: 'dashCtrl'
        })
        .when('/apdetails', {
            templateUrl: 'pages/appoinment_details.html',
            controller: 'dashCtrl'
        })
        .when('/aview', {
            templateUrl: 'pages/appoinment_view.html',
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
        .when('/misc', {
            templateUrl: 'pages/micilinous.html',
            controller: 'dashCtrl'
        })

        .when('/stockexp', {
            templateUrl: 'pages/stockexp.html',
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

        .when('/bill', {
            templateUrl: 'pages/bill.html',
            controller: 'dashCtrl'
        })

        .when('/today', {
            templateUrl: 'pages/Today_collection.html',
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
    // *** Auto Generate invoice section
    $scope.invauto = function (type) {
        $http({
            url: "../assets/api/invauto.php",
            method: "GET"
        }).then(
            function (data) {
                console.log(data.data);
                $scope.invno = data.data[0];
                $scope.invdate = data.data[1];
                $scope.fy = data.data[2];
                $scope.services();
                $scope.staff_data();

            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // *** Searching the client data **** 
    $scope.search1 = function () {
        $http({
            url: "../assets/api/sales_section.php",
            method: "POST",
            data: {
                "ph": $scope.ph,
                "op": "search"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.name = data.data[0]['name'];
                $scope.ccode = data.data[0]['cid'];
                $scope.gender = data.data[0]['gender'];
                $scope.address = data.data[0]['address'];

            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // *** Fetch the service data **** 
    $scope.services = function () {
        $http({
            url: "../assets/api/service_section.php",
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

    // *** Fetch the Staff data **** 
    $scope.staff_data = function () {
        $http({
            url: "../assets/api/staff_data.php",
            method: "GET"
        }).then(
            function (data) {
                console.log(data.data);
                $scope.stdata = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Fetch the service data **** 
    $scope.service_data = function (type) {
        var valudata = type.split("-");
        $http({
            url: "../assets/api/sales_section.php",
            method: "POST",
            data: {
                "service": valudata[0].trim(),
                "type": valudata[1].trim(),
                "op": "service_search"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.rate = data.data[0]['price'];
                $scope.gst = data.data[0]['gst'];
                $scope.tax=data.data[0]['price'];
                $scope.hsn = "NA";
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    //    *** GST Calculation section 
    $scope.gstcalc1 = function () {
        var y = parseInt($scope.gst);
        var z = (parseInt(y) * parseInt($scope.tax)) / 100;
        $scope.gstamt = z;
        var cgst = parseFloat(y) / 2;
        $scope.cgst = cgst.toFixed(2);
        $scope.sgst = cgst.toFixed(2);
        $scope.igst = 0;
        var cgstp = parseInt(z) / 2;
        $scope.cgstp = cgstp;
        $scope.sgstp = cgstp;
        $scope.igstp = 0;
        $scope.total = parseInt(z) + parseInt($scope.tax);
        $scope.check_sloat();
    };

    //    Sales entry section 
    $scope.sales_entry = function () {
        $http({
            url: "../assets/api/sales_section.php",
            method: "POST",
            data: {
                "invno": $scope.invno,
                "invdate": $scope.invdate,
                "ph": $scope.ph,
                "cid": $scope.ccode,
                "name": $scope.name,
                "gender": $scope.gender,
                "address": $scope.address,
                "gstno": "NA",
                "state": "West Bengal",
                "product": $scope.product,
                "hsn": $scope.hsn,
                "sname": $scope.sname,
                "asloat": $scope.atime,
                "qty": "1",
                "unit": "NA",
                "bno": "NA",
                "rate": $scope.rate,
                "tax": $scope.tax,
                "gstper": $scope.gst,
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
                $scope.adata = data.data;
                $scope.gtotal_sec();
                $scope.category = null;
                $scope.product = null;
                $scope.hsn = null;
                $scope.qty = null;
                $scope.unit = null;
                $scope.atime = null;
                $scope.bno = null;
                $scope.expdate = null;
                $scope.rate = null;
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
        console.log($scope.invno);
        $http({
            url: "../assets/api/sales_section.php",
            method: "POST",
            data: {
                "invno": $scope.invno,
                "state":"West Bengal",
                "ph":$scope.ph,
                "gstno":"NA",
                "pay": $scope.pay,
                "type": "Appoinmnet",
                "op": "gtotal"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.tax1 = data.data[0]['tax'];
                $scope.gstamt1 = data.data[0]['gstamt'];
                $scope.total1 = data.data[0]['total'];
                $scope.gtotal = data.data[0]['total'];
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.book_appoinment = function () {
        console.log($scope.invno);
        $http({
            url: "../assets/api/sales_submit.php",
            method: "POST",
            data: {
                "invno": $scope.invno,
                "pay": $scope.tmode,
                "type": "Appointment",
                "gtotal": $scope.gtotal,
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.invno = null;
                $scope.invdate = null;
                $scope.ph = null;
                $scope.ccode = null;
                $scope.name = null;
                $scope.gender = null;
                $scope.address = null;
                $scope.sname = null;
                $scope.gtotal = null;
                location.reload();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    

    $scope.check_sloat = function () {
        console.log("true");
        $http({
            url: "../assets/api/sales_section.php",
            method: "POST",
            data: {
                "as": $scope.atime,
                "sname": $scope.sname,
                "op":"sloat",
            }
        }).then(
            function (data) {
                console.log(data.data);
                var x=data.data[0]['c'];
                if (+x > 0) {
                    alert("This sloat is booked please select another sloat....");
                    document.getElementById("myBtn").disabled = true;
                    document.getElementById("myBtn1").disabled = true;
                }
                else {
                    document.getElementById("myBtn").disabled = false;
                    document.getElementById("myBtn1").disabled = false;
                }
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.pen = function () {
        var x = $scope.rcv;
        var y = $scope.total1;
        $scope.pending = parseInt(x) - parseInt(y);
    }

    $scope.appoinment_details = function () {
        $http({
            url: "../assets/api/ap_details.php",
            method: "GET"
        }).then(
            function (data) {
                console.log(data.data);
                $scope.apdata = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.today_collection = function () {
        $http({
            url: "../assets/api/todays_sales.php",
            method: "GET"
        }).then(
            function (data) {
                console.log(data.data);
                $scope.billdata = data.data;
                $scope.gtoday_collection();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.gtoday_collection = function () {
        $http({
            url: "../assets/api/todays_sales1.php",
            method: "GET"
        }).then(
            function (data) {
                console.log(data.data);
                $scope.gtotal = data.data[0];
                $scope.gcash = data.data[1];
                $scope.gcard = data.data[2];
                $scope.gupi = data.data[3];
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    //  *** Vendore section *** 
    $scope.pan_data = function () {
        let str = $scope.gstno;
        let middleChars = str.substring(2, 12);
        $scope.panno = middleChars;
        $scope.state_search();
    }

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

    // **** Purchase Section **** 
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
            data: {
                "pname": $scope.product
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
        $scope.tax = tax.toFixed(2);
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

    

    $scope.bill_delete = function (type) {
        $http({
            url: "../assets/api/purchase_section.php",
            method: "POST",
            data: {
                "idd": type,
                "inv": $scope.pinv,
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
    // *** Stock Section **** 
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
                "op": "stock_exp"
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

    // *** Purchase report section **** 
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

//   *** Apoinment Section ***

});
