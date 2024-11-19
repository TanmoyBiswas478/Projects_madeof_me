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
        .when('/assign', {
            templateUrl: "pages/upload_assignment.html",
            controller: 'dashCtrl'
        })
        
        .when('/question', {
            templateUrl: "pages/upload_question.html",
            controller: 'dashCtrl'
        })
         
        .when('/materials', {
            templateUrl: 'pages/upload_materials.html',  
            controller: 'dashCtrl'
        })
        .when('/link', {
            templateUrl: 'pages/online_link.html',  
            controller: 'dashCtrl'
        })
        .when('/assingment_marks', {
            templateUrl: 'pages/assingment_marks.html',  
            controller: 'dashCtrl'
        })

        .when('/marks_statement', {
            templateUrl: 'pages/marks_statement.html',  
            controller: 'dashCtrl'
        })
        
        .when('/batch_details', {
            templateUrl: 'pages/bathc_details.html',  
            controller: 'dashCtrl'
        })

        .when('/class', {
            templateUrl: 'pages/class_schedule.php',  
            controller: 'dashCtrl'
        })

        .when('/change_pass', {
            templateUrl: 'pages/change password.html',  
            controller: 'dashCtrl'
        })

        .when('/materials', {
            templateUrl: 'pages/upload_materials.html',  
            controller: 'dashCtrl'
        })

       
        .otherwise({
            template: "<h1>Error 404! Not Found </h1>"
        });
});

app.controller('dashCtrl', function ($scope, $http) {

// *** Assignment upload section **** 
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
// *** Materials Sections ****
$scope.batch_section = function () {
    $http({
        url: "../assets/api/material_section.php",
        method: "POST",
        data: {
            "tname": $scope.tname,
            "bno": $scope.bno,
            "op": "view1"
        }
    }).then(
        function (data) {
            console.log(data.data);
            $scope.batch_data = data.data;
            $scope.teacher = data.data[0]['trname'];
        },
        function () {
            alert("Error! Fetching Problem in sendData()");
        });
};


// *** Class Routine Section ****
    $scope.sloat_view = function () {
        $http({
            url: "../assets/api/class_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.sloat_data = data.data;
                $scope.days_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.days_view = function () {
        $http({
            url: "../assets/api/class_section.php",
            method: "POST",
            data: {
                "op": "dview"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.days_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.view_routine = function (type,type1) {
        $http({
            url: "../assets/api/class_section.php",
            method: "POST",
            data: {
                "days":type,
                "sloat":type1,
                "op": "cview"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.sloat1=data.data;
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
    // view teacher allotnment questions
    $scope.teacher_training_allot = function () {
        $http({
            url: "../assets/api/teacher_training_allot.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.training_allot_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.assignment_mark_entry = function () {
        $http({
            url: "../assets/api/assignment_mark.php",
            method: "POST",
            data: {
                "cname": $scope.cname,
                "tname": $scope.tname,
                "regno": $scope.regno,
                "bno": $scope.bno,
                "mark": $scope.mark,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.cname = null;
                $scope.tname = null;
                $scope.regno = null;
                $scope.bno = null;
                $scope.mark = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
        };

    $scope.batchview = function () {
        $http({
            url: "../assets/api/assignment_mark.php",
            method: "POST",
            data: {
                "op": "view",
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.batch_data = data.data;
                $scope.var=true;
                $scope.var1=false;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    
    $scope.student_view = function (type,type1) {
        // console.log(type);
        // console.log(type1);
        $http({
            url: "../assets/api/assignment_mark.php",
            method: "POST",
            data: {
                "tname":type,
                "bno":type1,
                "op": "sview"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.student_data = data.data;
                $scope.var1=true;
                $scope.var=false;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    

    

});