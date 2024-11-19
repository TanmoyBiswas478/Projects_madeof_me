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
        .when('/location', {
            templateUrl: "pages/branch.html",
            controller: 'dashCtrl'
        })
        .when('/staff', {
            templateUrl: 'pages/staff.php',
            controller: 'dashCtrl'
        })
        .when('/ttype', {
            templateUrl: 'pages/training_type.html',
            controller: 'dashCtrl'
        })
        .when('/training', {
            templateUrl: 'pages/training.html',
            controller: 'dashCtrl'
        })
        .when('/batch', {
            templateUrl: 'pages/batch_creating.html',
            controller: 'dashCtrl'
        })
        .when('/rountine', {
            templateUrl: 'pages/routine.html',
            controller: 'dashCtrl'
        })
        .when('/approval', {
            templateUrl: 'pages/student_approval.html',
            controller: 'dashCtrl'
        })
        .when('/question', {
            templateUrl: 'pages/upload_question.html',
            controller: 'dashCtrl'
        })
        .when('/view_question', {
            templateUrl: 'pages/view_upload_questions.html',
            controller: 'dashCtrl'
        })
        .when('/materials', {
            templateUrl: 'pages/upload_materials.html',
            controller: 'dashCtrl'
        })
        .when('/view_materials', {
            templateUrl: 'pages/view_materials.php',
            controller: 'dashCtrl'
        })
        .when('/fees', {
            templateUrl: 'pages/fees_details.html',
            controller: 'dashCtrl'
        })
        .when('/pending', {
            templateUrl: 'pages/fees_pending.html',
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

    // *** Branch Section ****

    $scope.branchentry = function () {
        $http({
            url: "../assets/api/branch_section.php",
            method: "POST",
            data: {
                "bname": $scope.bname,
                "location": $scope.location,
                "ph": $scope.ph,
                "email": $scope.email,
                "cordinator": $scope.cordinator,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.role = null;
                $scope.branchview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.branchview = function () {
        $http({
            url: "../assets/api/branch_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.branch_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.branch_edit = function (type) {
        $http({
            url: "../assets/api/branch_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.bname = data.data[0]['bname'];
                $scope.location = data.data[0]['location'];
                $scope.ph = data.data[0]['ph'];
                $scope.email = data.data[0]['email'];
                $scope.cordinator = data.data[0]['cordinator'];

                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.branch_update = function (type) {
        $http({
            url: "../assets/api/branch_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "bname": $scope.bname,
                "location": $scope.location,
                "ph": $scope.ph,
                "email": $scope.email,
                "cordinator": $scope.cordinator,

                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.branchview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.branch_delete = function (type) {
        $http({
            url: "../assets/api/branch_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.branchview();
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


    //*** Training category section  */
    $scope.categoryentry = function () {
        $http({
            url: "../assets/api/category_section.php",
            method: "POST",
            data: {
                "catagory": $scope.catagory,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.catagory = null;
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

    $scope.catagory_edit = function (type) {
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
                $scope.catagory = data.data[0]['catagory'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.catagory_update = function (type) {
        $http({
            url: "../assets/api/category_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "catagory": $scope.catagory,
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

    $scope.catagory_delete = function (type) {

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

    // *** Batch Creating Section *** 
    $scope.trainingview1 = function () {
        $http({
            url: "../assets/api/batch_section.php",
            method: "POST",
            data: {
                "category": $scope.category,
                "op": "training_view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.training_data1 = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.gen_batch = function () {
        $http({
            url: "../assets/api/batch_section.php",
            method: "POST",
            data: {
                "tname": $scope.tname,
                "op": "batch_no"
            }
        }).then(
            function (data) {
                console.log(data.data);
                var x = data.data[0]['bno'];
                if (parseInt(x) > 0) {
                    $scope.bno = parseInt(x) + 1;
                }
                else {
                    $scope.bno = 1;
                }
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.batchentry = function () {
        $http({
            url: "../assets/api/batch_section.php",
            method: "POST",
            data: {
                "category": $scope.category,
                "tname": $scope.tname,
                "bno": $scope.bno,
                "trname": $scope.trname,
                "sdate": $scope.sdate,
                "edate": $scope.edate,
                "venue": $scope.venue,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.catagory = null;
                $scope.tname = null;
                $scope.bno = null;
                $scope.trname = null;
                $scope.sdate = null;
                $scope.edate = null;
                $scope.venue = null;
                $scope.batchview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.batchview = function () {
        $http({
            url: "../assets/api/batch_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.batch_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.batch_edit = function (type) {
        $http({
            url: "../assets/api/batch_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.catagory = data.data[0]['catagory'];
                $scope.tname = data.data[0]['tname'];
                $scope.bno = data.data[0]['bno'];
                $scope.trname = data.data[0]['trname'];
                $scope.sdate = data.data[0]['sdate'];
                $scope.edate = data.data[0]['edate'];
                $scope.venue = data.data[0]['venue'];
                $scope.idd = type;
                // $('#exampleModalCenter').modal('show');
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.batch_update = function (type) {
        $http({
            url: "../assets/api/batch_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "category": $scope.catagory,
                "tname": $scope.tname,
                "bno": $scope.bno,
                "trname": $scope.trname,
                "sdate": $scope.sdate,
                "edate": $scope.edate,
                "venue": $scope.venue,

                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.batchview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.batch_delete = function (type) {
        $http({
            url: "../assets/api/batch_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.batchview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // *** Student approval Section ****

    $scope.student_view = function () {
        $http({
            url: "../assets/api/approval_section.php",
            method: "POST",
            data: {
                "op": "view"
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

    // *** Materials Sections ****
    $scope.batch_section = function () {
        $http({
            url: "../assets/api/material_section.php",
            method: "POST",
            data: {
                "tname": $scope.tname,
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.batch_data = data.data;
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

    $scope.material_entry = function () {
        $http({
            url: "../assets/api/material.php",
            method: "POST",
            data: {
                "tname": $scope.tname,
                "bno": $scope.bno,
                "topic": $scope.topic,
                "file": $scope.file,
                "op": "insert"

                // Add additional data as needed
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.tname = null;
                $scope.bno = null;
                $scope.topic = null;
                $scope.file = null;
                $scope.material_view1();
            },
            function () {
                alert("Error! Problem occurred while submitting data.");
            }
        );
    };

    $scope.material_view1 = function () {
        console.log("tname being sent:", $scope.tname); // Check the selected tname
    
        $http({
            method: 'POST',
            url: '../assets/api/material.php',
            data: {
                op: 'view',
                tname: $scope.tname
            }
        }).then(function (response) {
            console.log("Filtered materials:", response.data); // Verify the response
            $scope.material_data = response.data;
        }, function (error) {
            console.error("Error fetching materials:", error);
        });
    };
    
    
    


    $scope.material_edit = function (type) {
        $http({
            url: "../assets/api/material.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.tname = data.data[0]['tname'];
                $scope.bno = data.data[0]['bno'];
                $scope.topic = data.data[0]['topic'];
                $scope.file = data.data[0]['file'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.material_update = function (type) {
        $http({
            url: "../assets/api/material.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "tname": $scope.tname,
                "bno": $scope.bno,
                "topic": $scope.topic,
                "file": $scope.file,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.material_view1();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.material_delete = function (type) {

        $http({
            url: "../assets/api/material.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.material_view1();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };



    $scope.question_entry = function () {
        $http({
            url: "../assets/api/upload_question.php",
            method: "POST",
            data: {
                "tname": $scope.tname,
                "question": $scope.question,
                "option1": $scope.option1,
                "option2": $scope.option2,
                "option3": $scope.option3,
                "option4": $scope.option4,
                "answer": $scope.answer,
                "op": "insert"

                // Add additional data as needed
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.tname = null;
                $scope.question = null;
                $scope.option1 = null;
                $scope.option2 = null;
                $scope.option3 = null;
                $scope.option4 = null;
                $scope.answer = null;
                $scope.question_view();
            },
            function () {
                alert("Error! Problem occurred while submitting data.");
            }
        );
    };

    $scope.question_view = function () {
        $http({
            url: "../assets/api/upload_question.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.question_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    $scope.question_edit = function (type) {
        $http({
            url: "../assets/api/upload_question.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.tname = data.data[0]['tname'];
                $scope.question = data.data[0]['question'];
                $scope.option1 = data.data[0]['option1'];
                $scope.option2 = data.data[0]['option2'];
                $scope.option3 = data.data[0]['option3'];
                $scope.option4 = data.data[0]['option4'];
                $scope.answer = data.data[0]['answer'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.question_update = function (type) {
        $http({
            url: "../assets/api/upload_question.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "tname": $scope.tname,
                "question": $scope.question,
                "option1": $scope.option1,
                "option2": $scope.option2,
                "option3": $scope.option3,
                "option4": $scope.option4,
                "answer": $scope.answer,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.question_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.question_delete = function (type) {

        $http({
            url: "../assets/api/upload_question.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.question_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    $scope.setFile = function (element) {
        $scope.file = element.files[0];
    };

    $scope.uploadFile = function () {
        var formData = new FormData();
        formData.append('file', $scope.file);

        $http.post('upload.php', formData, {
            transformRequest: angular.identity,
            headers: { 'Content-Type': undefined }
        }).then(function (response) {
            console.log(response.data);
        }, function (error) {
            console.log(error);
        });
    };

    // *** Routine Section ***
    $scope.trainingview2 = function () {
        $http({
            url: "../assets/api/routine_section.php",
            method: "POST",
            data: {
                "op": "tview"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.training_data = data.data;
                $scope.days();
                $scope.sloatdata()
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
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

    $scope.routine_edit = function (id) {
        // Clear existing data to prevent old data from appearing
        $scope.days = null;
        $scope.sloat = null;
        $scope.tname = null;
        $scope.bno = null;
        $scope.sdate = null;
        $scope.tdate = null;
        $scope.teacher = null;
    
        $http({
            url: "../assets/api/routine_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": id
            }
        }).then(
            function (response) {
                const data = response.data;
                if (data && data.length > 0) {
                    // Populate scope variables only if data is successfully loaded
                    $scope.days = data[0].days;
                    $scope.sloat = data[0].sloat;
                    $scope.tname = data[0].tname;
                    $scope.bno = data[0].bno;
                    $scope.sdate = data[0].sdate;
                    $scope.tdate = data[0].tdate;
                    $scope.teacher = data[0].teacher;
                    $scope.idd = id;
    
                    // Open the modal after the data is fully loaded
                    $('#exampleModalCenter').modal('show');
                } else {
                    alert("No data found for the selected entry.");
                }
            },
            function () {
                alert("Error fetching data.");
            }
        );
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
    // View Quetion Bank Training wise
    $scope.question_view = function () {
        $http({
            url: "../assets/api/view_question_section.php",
            method: "POST",
            data: {
                "tname": $scope.tname,
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.quetions_bank = data.data;

            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    // questions Edit
    $scope.question_edit = function (type) {
        $http({
            url: "../assets/api/view_question_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.question = data.data[0]['question'];
                $scope.option1 = data.data[0]['option1'];
                $scope.option2 = data.data[0]['option2'];
                $scope.option3 = data.data[0]['option3'];
                $scope.option4 = data.data[0]['option4'];
                $scope.answer = data.data[0]['answer'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** update the questions section **** 
    $scope.question_update = function (type) {
        $http({
            url: "../assets/api/view_question_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "question": $scope.question,
                "option1": $scope.option1,
                "option2": $scope.option2,
                "option3": $scope.option3,
                "option4": $scope.option4,
                "answer": $scope.answer,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.question_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete questions ***
    $scope.question_delete = function (type) {
        $http({
            url: "../assets/api/view_question_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.question_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

});

