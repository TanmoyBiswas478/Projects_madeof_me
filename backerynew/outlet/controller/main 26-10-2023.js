var app = angular.module("myApp", ["ngRoute", "ngCookies"]);
app.config(function ($routeProvider) {

    $routeProvider
        .when("/", {
            templateUrl: "pages/dashboard.php",
        })
        .when("/dash", {
            templateUrl: "pages/dashboard.php",
        })
        .when('/order', {
            templateUrl: 'pages/order.html',
            controller: 'dashCtrl'
        })
        .when('/bill', {
            templateUrl: 'pages/bill.html',
            controller: 'dashCtrl'
        })
        .when('/oview', {
            templateUrl: 'pages/order_view.html',
            controller: 'dashCtrl'
        })

        .when('/rs', {
            templateUrl: 'pages/rs.html',
            controller: 'dashCtrl'
        })

        .when('/rr', {
            templateUrl: 'pages/rr.html',
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

        .when('/stock', {
            templateUrl: 'pages/stock.html',
            controller: 'dashCtrl'
        })

        .when('/tc', {
            templateUrl: 'pages/Today_collection.html',
            controller: 'dashCtrl'
        })

        .when('/salesrep', {
            templateUrl: 'pages/salesrep.html',
            controller: 'dashCtrl'
        })
        .when('/rreport', {
            templateUrl: 'pages/rreport.html',
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

    $scope.viewrequ = function () {
        $scope.var = true;
        $scope.var1 = false;
    }

    $scope.viewprod = function () {
        $scope.var1 = true;
        $scope.var = false;
    }

    // **** Requistion Section *** 
    $scope.autoreq = function () {
        $http({
            url: "../assets/api/reqauto.php",
            method: "GET",
        }).then(
            function (data) {
                console.log(data.data);
                $scope.reqno = data.data[0];
                $scope.reqdate = data.data[1];
                $scope.stockview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

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



    $scope.inserreq = function () {
        $http({
            url: "../assets/api/req_section.php",
            method: "POST",
            data: {
                "reqno": $scope.reqno,
                "reqdate": $scope.reqdate,
                "item": $scope.product,
                "qty": $scope.qty,
                "unit": $scope.unit,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.inserreq_view();
                $scope.product = null;
                $scope.qty = null;
                $scope.unit = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.inserreq_view = function () {
        $http({
            url: "../assets/api/req_section.php",
            method: "POST",
            data: {
                "reqno": $scope.reqno,
                "op": "select_condition1"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.req_data = data.data;

            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.send_req = function () {
        $http({
            url: "../assets/api/req_section.php",
            method: "POST",
            data: {
                "reqno": $scope.reqno,
                "status": "Send Request",
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert("Request Send Successfully...");
                $scope.autoreq();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.rcv_req = function () {
        $http({
            url: "../assets/api/req_recev.php",
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
    }

    $scope.req_item = function (type) {
        $http({
            url: "../assets/api/req_section.php",
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

    $scope.req_accept = function (type,type1,type2) {
        $http({
            url: "../assets/api/req_accept.php",
            method: "POST",
            data: {
                "reqno": type,
                "item":type1,
                "qty":type2
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.req_item(type);
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    // *** Sales Section ***
    $scope.invno_no = function () {
        $http({
            url: "../assets/api/invoauto.php",
            method: "GET",
        }).then(
            function (data) {
                console.log(data.data);
                $scope.sinv = data.data[0];
                $scope.invdate = data.data[1];
                $scope.invdate = data.data[1];
                $scope.stock_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.stock_view=function(){
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

    $scope.stockexp = function () {
        $http({
            url: "../assets/api/stock_section.php",
            method: "POST",
            data: {
                "op": "select_condition_outlet"
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

    $scope.view_product=function(){
        $http({
            url: "../assets/api/stock_section.php",
            method: "POST",
            data: {
                "product":$scope.product,
                "op": "select_product"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.hsn=data.data[0]['hsn'];
                $scope.qty=1;
                $scope.unit=data.data[0]['unit'];
                $scope.rate=data.data[0]['srate'];
                $scope.gstper=data.data[0]['gst'];
                $scope.expdate=data.data[0]['expdate'];
                $scope.gst_calc();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.gst_calc=function(){
        var x=$scope.qty;
        var y=$scope.rate;
        var z=parseInt(x)*parseInt(y);
        $scope.tax=z.toFixed(2);
        var gst=$scope.gstper;
        $scope.gstamt=(parseInt(z)*parseInt(gst))/100;
        $scope.total=parseInt($scope.gstamt)+parseInt($scope.tax);
    }
   
    $scope.sales_entry = function () {
        $http({
            url: "../assets/api/sales_section.php",
            method: "POST",
            data: {
                "sinv": $scope.sinv,
                "invdate": $scope.invdate,
                "name": $scope.name,
                "ph": $scope.ph,
                "gstno":"NA",
                "wph":$scope.wph,
                "state": 'Tripura',
                "product": $scope.product,
                "hsn": $scope.hsn,
                "qty": $scope.qty,
                "unit": $scope.unit,
                "rate": $scope.rate,
                "expdate": $scope.expdate,
                "tax": $scope.tax,
                "gstper": $scope.gstper,
                "gstamt": $scope.gstamt,
                "total": $scope.total,
                "tmode":$scope.tmode,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.sdata = data.data;
                $scope.gtotal_sec();
                $scope.category = null;
                $scope.product = null;
                $scope.hsn = null;
                $scope.qty = null;
                $scope.unit = null;
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
        $http({
            url: "../assets/api/sales_section.php",
            method: "POST",
            data: {
                "sinv": $scope.sinv,
                "state": 'Tripura',
                "ph": $scope.ph,
                "gstno": 'NA',
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

    $scope.sales_submit = function () {
        console.log($scope.sinv);
        $http({
            url: "../assets/api/sales_submit.php",
            method: "POST",
            data: {
                "inv": $scope.sinv,
                "pay": $scope.tmode,
                "type": "Bill",
                "gtotal":$scope.total1
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.sinv=null;
                $scope.invdate=null;
                $scope.ph=null;
                $scope.name=null;
                $scope.total1=null;
                $scope.rcv=null;
                $scope.total1=null;
                $scope.tmode=null;
                $scope.wph=null;
                $scope.invno_no();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.pen=function(){
        var x=$scope.rcv;
        var y=$scope.total1;
        $scope.pending=parseInt(x)-parseInt(y);
    }


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

//    ***** Requistion Section ****




});
