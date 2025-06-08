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
        .when('/role', {
            templateUrl: "pages/role.html",
            controller: 'dashCtrl'
        })
        .when('/category', {
            templateUrl: "pages/ccategory.html",
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
        .when('/cname', {
            templateUrl: "pages/c_name.html",
            controller: 'dashCtrl'
        })
        .when('/s_app', {
            templateUrl: "pages/student_approval.html",
            controller: 'dashCtrl'
        })
        .when('/f_col', {
            templateUrl: "pages/fees_collection.html",
            controller: 'dashCtrl'
        })
        .when('/f_pen', {
            templateUrl: "pages/Fees_pending.html",
            controller: 'dashCtrl'
        })
        .when('/today', {
            templateUrl: "pages/Today_collection.html",
            controller: 'dashCtrl'
        })
        .when('/routine', {
            templateUrl: "pages/routine.html",
            controller: 'dashCtrl'
        })

        .otherwise({
            template: "<h1>Error 404! Not Found </h1>"
        });
});

app.controller('dashCtrl', function ($scope, $http) {
    // *** Role Section ****
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

    // *** Location Section ****
    $scope.locationentry = function () {
        $http({
            url: "../assets/api/location_section.php",
            method: "POST",
            data: {
                "location": $scope.location,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.location = null;
                $scope.locationview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.locationview = function () {
        $http({
            url: "../assets/api/location_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.location_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.location_edit = function (type) {
        $http({
            url: "../assets/api/location_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.location = data.data[0]['location'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.location_update = function (type) {
        $http({
            url: "../assets/api/location_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "location": $scope.location,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.locationview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.location_delete = function (type) {
        $http({
            url: "../assets/api/location_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.locationview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    //*** Training category section  */
    $scope.categoryentry = function () {
        $http({
            url: "../assets/api/category_section.php",
            method: "POST",
            data: {
                "category": $scope.category,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.category = null;
                $scope.categoryview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

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
                $scope.category_data = data.data;
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
                $scope.category = data.data[0]['category'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.category_update = function (type) {
        $http({
            url: "../assets/api/category_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "category": $scope.category,
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

    //*** Course section  */
    $scope.courseentry = function () {
        $http({
            url: "../assets/api/course_section.php",
            method: "POST",
            data: {
                "course_name": $scope.course_name,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.course_name = null;
                $scope.courseview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.courseview = function () {
        $http({
            url: "../assets/api/course_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.course_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.course_edit = function (type) {
        $http({
            url: "../assets/api/course_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.course_name = data.data[0]['course_name'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.course_update = function (type) {
        $http({
            url: "../assets/api/course_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "course_name": $scope.course_name,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.courseview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.course_delete = function (type) {

        $http({
            url: "../assets/api/course_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.courseview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.approval = function (type) {
        $http({
            url: "../assets/api/approval.php",
            method: "POST",
            data: {
                "idd": type,
                "tname": type1
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.approval_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // Staff Entry Section
    $scope.staff_entry = function () {
        $http({
            url: "../assets/api/staff_section.php",
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
                $scope.staff_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.staff_view = function () {
        $http({
            url: "../assets/api/staff_section.php",
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
            url: "../assets/api/staff_section.php",
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
                $scope.role = data.data[0]['role'];
                $scope.location = data.data[0]['location'];
                $scope.quali = data.data[0]['quali'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.staff_update = function (type) {
        $http({
            url: "../assets/api/staff_section.php",
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
                $scope.staff_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.staff_delete = function (type) {

        $http({
            url: "../assets/api/staff_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.staff_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.student_entry = function () {
        var formData = new FormData();
        formData.append("course_name", $scope.course_name);
        formData.append("sname", $scope.sname);
        formData.append("fname", $scope.fname);
        formData.append("c_fees", $scope.c_fees);
        formData.append("regno", $scope.regno);
        formData.append("app_date", $scope.app_date);
        formData.append("dob", $scope.dob);
        formData.append("gender", $scope.gender);
        formData.append("s_ph", $scope.s_ph);
        formData.append("pay", $scope.pay);
        formData.append("img", document.querySelector('input[name="img"]').files[0]);
        formData.append("pay_ss", document.querySelector('input[name="pay_ss"]').files[0]);
        formData.append("op", "insert");

        $http({
            url: "../assets/api/student_registration.php",
            method: "POST",
            data: formData,
            headers: { "Content-Type": undefined }, // Needed for file upload
            transformRequest: angular.identity
        }).then(
            function (response) {
                console.log(response.data);
                alert(response.data);

                // Clear form fields after successful submission
                $scope.course_name = null;
                $scope.sname = null;
                $scope.fname = null;
                $scope.c_fees = null;
                $scope.regno = null;
                $scope.app_date = null;
                $scope.dob = null;
                $scope.gender = null;
                $scope.s_ph = null;
                $scope.pay = null;
                document.querySelector('input[name="img"]').value = "";
                document.querySelector('input[name="pay_ss"]').value = "";
            },
            function () {
                alert("Error! Problem in student_entry()");
            }
        );
    };


    $scope.days = function () {
        $http({
            url: "../assets/api/routine_section.php",
            method: "POST",
            data: {
                "op": "dview"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.day = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.sloatdata = function () {
        $http({
            url: "../assets/api/routine_section.php",
            method: "POST",
            data: {
                "op": "sview"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.slot_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.batch_datas = function () {
        $http({
            url: "../assets/api/routine_section.php",
            method: "POST",
            data: {
                "tname": $scope.tname,
                "op": "bview"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.b_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.dates_data = function () {
        $http({
            url: "../assets/api/routine_section.php",
            method: "POST",
            data: {
                "tname": $scope.tname,
                "bno": $scope.bno,
                "op": "d_view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.sdate = data.data[0]['sdate'];
                $scope.edate = data.data[0]['edate'];
                $scope.tdate = data.data[0]['tdate'];
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };



    $scope.routine_entry = function () {
        $http({
            url: "../assets/api/routine_section.php",
            method: "POST",
            data: {
                "days": $scope.days,
                "sloat": $scope.sloat,
                "tname": $scope.tname,
                "bno": $scope.bno,
                "sdate": $scope.sdate,
                "tdate": $scope.tdate,
                "teacher": $scope.teacher,
                "op": "insert"

                // Add additional data as needed
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.days = null;
                $scope.sloat = null;
                $scope.tname = null;
                $scope.bno = null;
                $scope.sdate = null;
                $scope.tdate = null;
                $scope.teacher = null;
                $scope.routine_view();
            },
            function () {
                alert("Error! Problem occurred while submitting data.");
            }
        );
    };

    $scope.routine_view = function () {
        $http({
            url: "../assets/api/routine_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.routine_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.routine_edit = function (type) {
        $http({
            url: "../assets/api/routine_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.days = data.data[0]['days'];
                $scope.sloat = data.data[0]['sloat'];
                $scope.tname = data.data[0]['tname'];
                $scope.bno = data.data[0]['bno'];
                $scope.sdate = data.data[0]['sdate'];
                $scope.tdate = data.data[0]['tdate'];
                $scope.teacher = data.data[0]['teacher'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    $scope.routine_update = function (type) {
        $http({
            url: "../assets/api/routine_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "days": $scope.days,
                "sloat": $scope.sloat,
                "tname": $scope.tname,
                "bno": $scope.bno,
                "sdate": $scope.sdate,
                "tdate": $scope.tdate,
                "teacher": $scope.teacher,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.routine_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.routine_delete = function (type) {
        $http({
            url: "../assets/api/routine_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.routine_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    $scope.approval = function (type) {
        $http({
            url: "../assets/api/approval.php",
            method: "POST",
            data: {
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

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

    // **** Training entry section ****
    $scope.trainingentry = function () {
        $http({
            url: "../assets/api/training_section.php",
            method: "POST",
            data: {
                "category": $scope.category,
                "tname": $scope.tname,
                "sform": $scope.sform,
                "duration": $scope.duration,
                "fees": $scope.fees,
                "unit": $scope.unit,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.catagory = null;
                $scope.tname = null;
                $scope.sform = null;
                $scope.duration = null;
                $scope.fees = null;
                $scope.unit = null;
                $scope.trainingview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.trainingview = function () {
        $http({
            url: "../assets/api/training_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.training_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    $scope.training_edit = function (type) {
        $http({
            url: "../assets/api/training_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.category = data.data[0]['category'];
                $scope.tname = data.data[0]['tname'];
                $scope.sform = data.data[0]['sform'];
                $scope.duration = data.data[0]['duration'];
                $scope.fees = data.data[0]['fees'];
                $scope.unit = data.data[0]['unit'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.training_update = function (type) {
        $http({
            url: "../assets/api/training_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "category": $scope.category,
                "tname": $scope.tname,
                "sform": $scope.sform,
                "duration": $scope.duration,
                "fees": $scope.fees,
                "unit": $scope.unit,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.trainingview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.training_delete = function (type) {

        $http({
            url: "../assets/api/training_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.trainingview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    
});





