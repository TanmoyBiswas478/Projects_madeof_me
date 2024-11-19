var app = angular.module('myApp', []);
app.controller('personCtrl', function ($scope, $http) {

    //*** Menus section */
    //menue Entry Section
    $scope.menueentry = function () {
        $http({
            url: "../../assets/api/menue_section.php",
            method: "POST",
            data: {
                "menue": $scope.menue,
                "submenu": $scope.submenu,
                "url": $scope.url,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.submenu = null;
                $scope.url = null;
                $scope.menueview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the menue ****
    $scope.menueview = function () {
        $http({
            url: "../../assets/api/menue_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.menue_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.menue_edit = function (type) {
        $http({
            url: "../../assets/api/menue_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.menue = data.data[0]['menue'];
                $scope.submenu = data.data[0]['submenu'];
                $scope.url = data.data[0]['url'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Edit the menue section **** 
    $scope.menue_update = function (type) {
        $http({
            url: "../../assets/api/menue_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "menue": $scope.menue,
                "submenu": $scope.submenu,
                "url": $scope.url,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.menueview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any menue ***
    $scope.menue_delete = function (type) {
        $http({
            url: "../../assets/api/menue_section.php",
            method: "POST",
            data: {
                "id": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.menueview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // *** Permission Section *** 

    $scope.userview = function () {
        $http({
            url: "../../assets/api/permission_section.php",
            method: "POST",
            data: {
                "op": "uview"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.ldata = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.find_user = function () {
        console.log($scope.ph);
        $http({
            url: "../../assets/api/permission_section.php",
            method: "POST",
            data: {
                "ph": $scope.ph,
                "op": "user_view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.sname = data.data[0]['name'];
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.old_patient_view = function () {
        console.log($scope.patient_id);
        $http({
            url: "../../assets/api/old_patient_view.php",
            method: "POST",
            data: {
                "patient_id": $scope.patient_id,
                "op": "select_condition"

            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.patient_id = data.data[0]['patient_id'];
                $scope.mobile = data.data[0]['mobile'];
                $scope.referral_doctor = data.data[0]['referral_doctor'];
                $scope.patient_name = data.data[0]['patient_name'];
                $scope.father_name = data.data[0]['father_name'];
                $scope.address = data.data[0]['address'];
                $scope.state = data.data[0]['state'];
                $scope.city = data.data[0]['city'];
                $scope.pin = data.data[0]['pin'];
                $scope.gender = data.data[0]['gender'];
                $scope.age = data.data[0]['age'];
                $scope.blood_group = data.data[0]['blood_group'];
                $scope.email = data.data[0]['email'];
                $scope.whatsapp = data.data[0]['whatsapp'];
                $scope.marital = data.data[0]['marital'];
                $scope.n_id_type = data.data[0]['n_id_type'];
                $scope.nid = data.data[0]['nid'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.menueview1 = function () {
        $http({
            url: "../../assets/api/permission_section.php",
            method: "POST",
            data: {
                "op": "mview"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.menue_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.sub_menue = function () {
        $http({
            url: "../../assets/api/permission_section.php",
            method: "POST",
            data: {
                "menue": $scope.menue,
                "op": "sview"
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

    $scope.get_menue = function () {
        $http({
            url: "../../assets/api/permission_section.php",
            method: "POST",
            data: {
                "menue": $scope.menue,
                "submenue": $scope.submenue,
                "op": "urlview"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.url = data.data[0]['url'];
                $scope.id = data.data[0]['id'];
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.permission_entry = function () {
        $http({
            url: "../../assets/api/permission_section.php",
            method: "POST",
            data: {
                "ph": $scope.ph,
                "sname": $scope.sname,
                "menue": $scope.menue,
                "submenue": $scope.submenue,
                "url": $scope.url,
                "id": $scope.id,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.permission_view();
                $scope.submenu = null;
                $scope.url = null;
                $scope.ph = null;
                $scope.sname = null;
                $scope.menue = null;
                $scope.submenue = null;
                $scope.url = null;
                $scope.id = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.permission_view = function () {
        $http({
            url: "../../assets/api/permission_section.php",
            method: "POST",
            data: {
                "ph": $scope.ph,
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.permission_data = data.data;

            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    // **** Staff Entry section *** 
    $scope.staffentry = function () {
        $http({
            url: "../../assets/api/staff_section.php",
            method: "POST",
            data: {
                "name": $scope.name,
                "ph": $scope.ph,
                "address": $scope.address,
                "gender": $scope.gender,
                "email": $scope.email,
                "location": 'NA',
                "role": 'NA',
                "quali": $scope.qualification,
                "pass": $scope.pass,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.name = null;
                $scope.ph = null;
                $scope.address = null;
                $scope.gender = null;
                $scope.email = null;
                $scope.pass = null;
                $scope.qualification = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the menue ****
    $scope.staffview = function () {
        $http({
            url: "../../assets/api/staff_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.staff_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.staff_edit = function (type) {
        console.log(type);
        $http({
            url: "../../assets/api/staff_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.name = data.data[0]['name'];
                $scope.ph = data.data[0]['ph'];
                $scope.address = data.data[0]['address'];
                $scope.gender = data.data[0]['gender'];
                $scope.email = data.data[0]['email'];
                $scope.qualification = data.data[0]['quali'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Edit the menue section **** 
    $scope.staff_update = function (type) {
        $http({
            url: "../../assets/api/staff_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "name": $scope.name,
                "ph": $scope.ph,
                "gender": $scope.gender,
                "email": $scope.email,
                "quali": $scope.qualification,
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

    // **** Delete any menue ***
    $scope.staff_delete = function (type) {
        $http({
            url: "../../assets/api/staff_section.php",
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

    $scope.generatePass = function () {
        let pass = '';
        let str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' +
            'abcdefghijklmnopqrstuvwxyz0123456789@#$';
        for (let i = 1; i <= 8; i++) {
            let char = Math.floor(Math.random()
                * str.length + 1);
            pass += str.charAt(char)
        }
        $scope.pass = pass;
    }

    // *** User permission deactive section ****
    $scope.astaffview = function () {
        $http({
            url: "../../assets/api/staff_section.php",
            method: "POST",
            data: {
                "op": "aview"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.user_active_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.deactive = function (type) {
        $http({
            url: "../../assets/api/staff_section.php",
            method: "POST",
            data: {
                "op": "deactive",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.astaffview();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Symptom Entry section *** 
    $scope.symptom_entry = function () {
        $http({
            url: "../../assets/api/symtom_section.php",
            method: "POST",
            data: {
                "symptoms_type": $scope.symptoms_type,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.symptom_view();
                $scope.symptoms_type = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the menue ****
    $scope.symptom_view = function () {
        $http({
            url: "../../assets/api/symtom_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.symptom_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    $scope.symptom_edit = function (type) {
        $http({
            url: "../../assets/api/symtom_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.symptoms_type = data.data[0]['symptoms_type'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Edit the menue section **** 
    $scope.symptom_update = function (type) {
        $http({
            url: "../../assets/api/symtom_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "symptoms_type": $scope.symptoms_type,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.symptom_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any menue ***
    $scope.symptom_delete = function (type) {
        $http({
            url: "../../assets/api/symtom_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.symptom_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    // **** Symptom Entry section *** 
    $scope.symptom_head_entry = function () {
        $http({
            url: "../../assets/api/symtom_section.php",
            method: "POST",
            data: {
                "symptoms_head": $scope.symptoms_head,
                "symptoms_type": $scope.symptoms_type,
                "symptoms_description": $scope.symptoms_description,
                "op": "insert1"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.symptom_head_view();
                $scope.symptoms_head = null;
                $scope.symptoms_type = null;
                $scope.symptoms_description = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the menue ****
    $scope.symptom_head_view = function () {
        $http({
            url: "../../assets/api/symtom_section.php",
            method: "POST",
            data: {
                "op": "view1"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.symptom_head_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    $scope.symptom_head_edit = function (type) {
        $http({
            url: "../../assets/api/symtom_section.php",
            method: "POST",
            data: {
                "op": "select_condition1",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.symptoms_head = data.data[0]['symptoms_head'];
                $scope.symptoms_type = data.data[0]['symptoms_type'];
                $scope.symptoms_description = data.data[0]['symptoms_description'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Edit the menue section **** 
    $scope.symptom_head_update = function (type) {
        $http({
            url: "../../assets/api/symtom_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "symptoms_head": $scope.symptoms_head,
                "symptoms_type": $scope.symptoms_type,
                "symptoms_description": $scope.symptoms_description,
                "op": "edit1"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.symptom_head_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any menue ***
    $scope.symptom_head_delete = function (type) {
        $http({
            url: "../../assets/api/symtom_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete1"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.symptom_head_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Role Entry section *** 
    $scope.role_entry = function () {
        $http({
            // url: "../../assets/api/staff_section.php",
            url: "../../assets/api/role_section.php",
            method: "POST",
            data: {
                "rolename": $scope.rolename,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.role_view();
                $scope.rolename = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the Role ****
    $scope.role_view = function () {
        $http({
            url: "../../assets/api/role_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.role_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // Role Edit
    $scope.role_edit = function (type) {
        $http({
            url: "../../assets/api/role_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.rolename = data.data[0]['rolename'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** update the Role section **** 
    $scope.role_update = function (type) {
        $http({
            url: "../../assets/api/role_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "rolename": $scope.rolename,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.role_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete Role ***
    $scope.role_delete = function (type) {
        $http({
            url: "../../assets/api/role_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.role_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    // **** dept Entry section *** 
    $scope.dept_entry = function () {
        $http({
            // url: "../../assets/api/staff_section.php",
            url: "../../assets/api/dept_section.php",
            method: "POST",
            data: {
                "dept_id": $scope.dept_id,
                "dept_name": $scope.dept_name,
                "dept_head": $scope.dept_head,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.dept_view();
                $scope.dept_id = null;
                $scope.dept_name = null;
                $scope.dept_head = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the Role ****
    $scope.dept_view = function () {
        $http({
            url: "../../assets/api/dept_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.dept_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // Role Edit
    $scope.dept_edit = function (type) {
        $http({
            url: "../../assets/api/dept_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.dept_id = data.data[0]['dept_id'];
                $scope.dept_name = data.data[0]['dept_name'];
                $scope.dept_head = data.data[0]['dept_head'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** updatethe Role section **** 
    $scope.dept_update = function (type) {
        $http({
            url: "../../assets/api/dept_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "dept_id": $scope.dept_id,
                "dept_name": $scope.dept_name,
                "dept_head": $scope.dept_head,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.dept_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete Role ***
    $scope.dept_delete = function (type) {
        $http({
            url: "../../assets/api/dept_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.dept_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Doctor Entry section *** 
    $scope.doctor_entry = function () {
        $http({
            // url: "../../assets/api/staff_section.php",
            url: "../../assets/api/doctor_section.php",
            method: "POST",
            data: {
                "regis_no": $scope.regis_no,
                "name": $scope.name,
                "doctoraddress": $scope.doctoraddress,
                "mobile": $scope.mobile,
                "email": $scope.email,
                "specialization": $scope.specialization,
                "qulification": $scope.qulification,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.doctor_view();
                $scope.regis_no = null;
                $scope.name = null;
                $scope.doctoraddress = null;
                $scope.mobile = null;
                $scope.email = null;
                $scope.specialization = null;
                $scope.qulification = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the Role ****
    $scope.doctor_view = function () {
        $http({
            url: "../../assets/api/doctor_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.doctor_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // Role Edit
    $scope.doctor_edit = function (type) {
        $http({
            url: "../../assets/api/doctor_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.regis_no = data.data[0]['regis_no'];
                $scope.name = data.data[0]['name'];
                $scope.doctoraddress = data.data[0]['doctoraddress'];
                $scope.mobile = data.data[0]['mobile'];
                $scope.email = data.data[0]['email'];
                $scope.specialization = data.data[0]['specialization'];
                $scope.qulification = data.data[0]['qulification'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** updatethe Role section **** 
    $scope.doctor_update = function (type) {
        $http({
            url: "../../assets/api/doctor_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "regis_no": $scope.regis_no,
                "name": $scope.name,
                "doctoraddress": $scope.doctoraddress,
                "mobile": $scope.mobile,
                "email": $scope.email,
                "specialization": $scope.specialization,
                "qulification": $scope.qulification,

                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.doctor_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete Role ***
    $scope.doctor_delete = function (type) {
        $http({
            url: "../../assets/api/doctor_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.doctor_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.bed_type_entry = function () {
        $http({
            // url: "../../assets/api/staff_section.php",
            url: "../../assets/api/bed_type_section.php",
            method: "POST",
            data: {
                "bed_type": $scope.bed_type,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.bed_type_view();
                $scope.bed_type = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the menue ****
    $scope.bed_type_view = function () {
        $http({
            url: "../../assets/api/bed_type_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.bed_type_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    $scope.bed_type_edit = function (type) {
        $http({
            url: "../../assets/api/bed_type_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.bed_type = data.data[0]['bed_type'];
                $scope.price = data.data[0]['price'];
                $scope.bed_dsc = data.data[0]['bed_dsc'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Edit the menue section **** 
    $scope.bed_type_update = function (type) {
        $http({
            url: "../../assets/api/bed_type_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "bed_type": $scope.bed_type,
                "price": $scope.price,
                "bed_dsc": $scope.bed_dsc,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.bed_type_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any menue ***
    $scope.bed_type_delete = function (type) {
        $http({
            url: "../../assets/api/bed_type_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.bed_type_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // **** Bed group Entry section *** 
    $scope.bed_g_entry = function () {
        $http({
            // url: "../../assets/api/staff_section.php",
            url: "../../assets/api/bed_group_section.php",
            method: "POST",
            data: {
                "group_name": $scope.group_name,
                "floor": $scope.floor,
                "descs": $scope.descs,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.bed_g_view();
                $scope.group_name = null;
                $scope.floor = null;
                $scope.descs = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the menue ****
    $scope.bed_g_view = function () {
        $http({
            url: "../../assets/api/bed_group_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.bed_g_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    $scope.bed_g_edit = function (type) {
        $http({
            url: "../../assets/api/bed_group_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.group_name = data.data[0]['group_name'];
                $scope.floor = data.data[0]['floor'];
                $scope.descs = data.data[0]['descs'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Edit the menue section **** 
    $scope.bed_g_update = function (type) {
        $http({
            url: "../../assets/api/bed_group_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "group_name": $scope.group_name,
                "floor": $scope.floor,
                "descs": $scope.descs,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.bed_g_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any menue ***
    $scope.bed_g_delete = function (type) {
        $http({
            url: "../../assets/api/bed_group_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.bed_g_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.wardno_search = function () {
        $http({
            url: "../../assets/api/bed_entry_section.php",
            method: "POST",
            data: {
                "w_no": $scope.w_no,
                "op": "select_query2"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.wnodata = data.data;

            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    // **** Bed Entry section *** 
    $scope.bed_entry = function () {
        $http({
            // url: "../../assets/api/staff_section.php",
            url: "../../assets/api/bed_entry_section.php",
            method: "POST",
            data: {
                "bed_no": $scope.bed_no,
                "bed_type": $scope.bed_type,
                "w_no": $scope.w_no,
                "w_section": $scope.w_section,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.bed_view();
                $scope.bed_no = null;
                $scope.bed_type = null;
                $scope.w_no = null;
                $scope.w_section = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the menue ****
    $scope.bed_view = function () {
        $http({
            url: "../../assets/api/bed_entry_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.bed_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    $scope.bed_edit = function (type) {
        $http({
            url: "../../assets/api/bed_entry_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.bed_no = data.data[0]['bed_no'];
                $scope.bed_type = data.data[0]['bed_type'];
                $scope.w_no = data.data[0]['w_no'];
                $scope.w_section = data.data[0]['w_section'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Edit the menue section **** 
    $scope.bed_update = function (type) {
        $http({
            url: "../../assets/api/bed_entry_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "bed_no": $scope.bed_no,
                "bed_type": $scope.bed_type,
                "w_no": $scope.w_no,
                "w_section": $scope.w_section,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.bed_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any menue ***
    $scope.bed_delete = function (type) {
        $http({
            url: "../../assets/api/bed_entry_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.bed_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    // **** TPA Entry section *** 
    $scope.tpa_entry = function () {
        $http({
            url: "../../assets/api/tpa_entry.php",
            method: "POST",
            data: {
                "name": $scope.name,
                "code": $scope.code,
                "phone": $scope.phone,
                "address": $scope.address,
                "contact_prsn_nme": $scope.contact_prsn_nme,
                "contact_prsn_ph": $scope.contact_prsn_ph,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.tpa_view();
                $scope.name = null;
                $scope.code = null;
                $scope.phone = null;
                $scope.address = null;
                $scope.contact_prsn_nme = null;
                $scope.contact_prsn_ph = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the TPA ****
    $scope.tpa_view = function () {
        $http({
            url: "../../assets/api/tpa_entry.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.tpa_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    //        *** TPA Edit Section ***
    $scope.tpa_edit = function (type) {
        $http({
            url: "../../assets/api/tpa_entry.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.name = data.data[0]['name'];
                $scope.code = data.data[0]['code'];
                $scope.phone = data.data[0]['phone'];
                $scope.address = data.data[0]['address'];
                $scope.contact_prsn_nme = data.data[0]['contact_prsn_nme'];
                $scope.contact_prsn_ph = data.data[0]['contact_prsn_ph'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Update the TPA section **** 
    $scope.tpa_update = function (type) {
        $http({
            url: "../../assets/api/tpa_entry.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "name": $scope.name,
                "code": $scope.code,
                "phone": $scope.phone,
                "address": $scope.address,
                "contact_prsn_nme": $scope.contact_prsn_nme,
                "contact_prsn_ph": $scope.contact_prsn_ph,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.tpa_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any TPA ***
    $scope.tpa_delete = function (type) {
        $http({
            url: "../../assets/api/tpa_entry.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.tpa_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** ward Entry section *** 
    $scope.ward_entry = function () {
        $http({
            // url: "../../assets/api/staff_section.php",
            url: "../../assets/api/ward_section.php",
            method: "POST",
            data: {
                "dept_id": $scope.dept_id,
                "w_floor": $scope.w_floor,
                "w_no": $scope.w_no,
                "w_section": $scope.w_section,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.ward_view();
                $scope.dept_id = null;
                $scope.w_floor = null;
                $scope.w_no = null;
                $scope.w_section = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the ward ****
    $scope.ward_view = function () {
        $http({
            url: "../../assets/api/ward_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.ward_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    //         ***  Edit ward Section ***
    $scope.ward_edit = function (type) {
        $http({
            url: "../../assets/api/ward_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.dept_id = data.data[0]['dept_id'];
                $scope.w_floor = data.data[0]['w_floor'];
                $scope.w_no = data.data[0]['w_no'];
                $scope.w_section = data.data[0]['w_section'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Update the ward section **** 
    $scope.ward_update = function (type) {
        $http({
            url: "../../assets/api/ward_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "dept_id": $scope.dept_id,
                "w_floor": $scope.w_floor,
                "w_no": $scope.w_no,
                "w_section": $scope.w_section,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.ward_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any ward ***
    $scope.ward_delete = function (type) {
        $http({
            url: "../../assets/api/ward_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.ward_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    // **** Floor Entry section *** 
    $scope.floor_entry = function () {
        $http({

            url: "../../assets/api/floor_section.php",
            method: "POST",
            data: {
                "name": $scope.name,
                "description": $scope.description,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.floor_view();
                $scope.name = null;
                $scope.description = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the Floor ****
    $scope.floor_view = function () {
        $http({
            url: "../../assets/api/floor_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.floor_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    //         ***  Edit Floor Section ***
    $scope.floor_edit = function (type) {
        $http({
            url: "../../assets/api/floor_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.name = data.data[0]['name'];
                $scope.description = data.data[0]['description'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Update the Floor section **** 
    $scope.floor_update = function (type) {
        $http({
            url: "../../assets/api/floor_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "name": $scope.name,
                "description": $scope.description,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.floor_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any Floor ***
    $scope.floor_delete = function (type) {
        $http({
            url: "../../assets/api/floor_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.floor_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.nurse_view_admit = function () {
        $http({
            url: "../../assets/api/admited_patient_view.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.nurse_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    // Patient Section
    //    *** View the Appointment  ****
    $scope.app_view = function () {
        $http({
            url: "../../assets/api/general_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.app_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.nurse_patient_view = function () {
        $http({
            url: "../../assets/api/ipd_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.nurse_patient_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.patient_id_view = function () {
        $http({
            url: "../../assets/api/patient_id_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.patient_id_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.app_admit_view = function () {
        $http({
            url: "../../assets/api/appointment_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.app_admit_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.old_patient_view = function (type) {
        $http({
            url: "../../assets/api/old_patient_view.php",
            method: "POST",
            data: {
                "patient_id": $scope.patient_id,
                "op": "view1"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.location = data.data[0]['location'];
                $scope.patient_id = data.data[0]['patient_id'];
                $scope.mobile = data.data[0]['mobile'];
                $scope.referral_doctor = data.data[0]['referral_doctor'];
                $scope.patient_name = data.data[0]['patient_name'];
                $scope.father_name = data.data[0]['father_name'];
                $scope.address = data.data[0]['address'];
                $scope.state = data.data[0]['state'];
                $scope.city = data.data[0]['city'];
                $scope.pin = data.data[0]['pin'];
                $scope.gender = data.data[0]['gender'];
                $scope.age = data.data[0]['age'];
                $scope.blood_group = data.data[0]['blood_group'];
                $scope.email = data.data[0]['email'];
                $scope.whatsapp = data.data[0]['whatsapp'];
                $scope.marital = data.data[0]['marital'];
                $scope.n_id_type = data.data[0]['n_id_type'];
                $scope.nid = data.data[0]['nid'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.ipd_search = function (type) {
        $http({
            url: "../../assets/api/opd_section.php",
            method: "POST",
            data: {
                "patient_id": $scope.patient_id,
                "op": "view1"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.location = data.data[0]['location'];
                $scope.patient_id = data.data[0]['patient_id'];
                $scope.mobile = data.data[0]['mobile'];
                $scope.referral_doctor = data.data[0]['referral_doctor'];
                $scope.patient_name = data.data[0]['patient_name'];
                $scope.father_name = data.data[0]['father_name'];
                $scope.address = data.data[0]['address'];
                $scope.state = data.data[0]['state'];
                $scope.city = data.data[0]['city'];
                $scope.pin = data.data[0]['pin'];
                $scope.gender = data.data[0]['gender'];
                $scope.age = data.data[0]['age'];
                $scope.blood_group = data.data[0]['blood_group'];
                $scope.email = data.data[0]['email'];
                $scope.whatsapp = data.data[0]['whatsapp'];
                $scope.marital = data.data[0]['marital'];
                $scope.n_id_type = data.data[0]['n_id_type'];
                $scope.nid = data.data[0]['nid'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.old_number_search = function (type) {
        $http({
            url: "../../assets/api/old_patient_view.php",
            method: "POST",
            data: {
                "mobile": $scope.mobile,
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.location = data.data[0]['location'];
                $scope.patient_id = data.data[0]['patient_id'];
                $scope.mobile = data.data[0]['mobile'];
                $scope.referral_doctor = data.data[0]['referral_doctor'];
                $scope.patient_name = data.data[0]['patient_name'];
                $scope.father_name = data.data[0]['father_name'];
                $scope.address = data.data[0]['address'];
                $scope.state = data.data[0]['state'];
                $scope.city = data.data[0]['city'];
                $scope.pin = data.data[0]['pin'];
                $scope.gender = data.data[0]['gender'];
                $scope.age = data.data[0]['age'];
                $scope.blood_group = data.data[0]['blood_group'];
                $scope.email = data.data[0]['email'];
                $scope.whatsapp = data.data[0]['whatsapp'];
                $scope.marital = data.data[0]['marital'];
                $scope.n_id_type = data.data[0]['n_id_type'];
                $scope.nid = data.data[0]['nid'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.general_view = function (type) {
        $http({
            url: "../../assets/api/general_view.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.location = data.data[0]['location'];
                $scope.patient_id = data.data[0]['patient_id'];
                $scope.mobile = data.data[0]['mobile'];
                $scope.regis_type = data.data[0]['regis_type'];
                $scope.patient_name = data.data[0]['patient_name'];
                $scope.father_name = data.data[0]['father_name'];
                $scope.address = data.data[0]['address'];
                $scope.state = data.data[0]['state'];
                $scope.city = data.data[0]['city'];
                $scope.pin = data.data[0]['pin'];
                $scope.gender = data.data[0]['gender'];
                $scope.age = data.data[0]['age'];
                $scope.blood_group = data.data[0]['blood_group'];
                $scope.email = data.data[0]['email'];
                $scope.whatsapp = data.data[0]['whatsapp'];
                $scope.marital = data.data[0]['marital'];
                $scope.n_id_type = data.data[0]['n_id_type'];
                $scope.nid = data.data[0]['nid'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.general_edit = function (type) {
        $http({
            url: "../../assets/api/general_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.location = data.data[0]['location'];
                $scope.patient_id = data.data[0]['patient_id'];
                $scope.mobile = data.data[0]['mobile'];
                $scope.patient_name = data.data[0]['patient_name'];
                $scope.father_name = data.data[0]['father_name'];
                $scope.address = data.data[0]['address'];
                $scope.state = data.data[0]['state'];
                $scope.city = data.data[0]['city'];
                $scope.pin = data.data[0]['pin'];
                $scope.gender = data.data[0]['gender'];
                $scope.age = data.data[0]['age'];
                $scope.blood_group = data.data[0]['blood_group'];
                $scope.email = data.data[0]['email'];
                $scope.whatsapp = data.data[0]['whatsapp'];
                $scope.marital = data.data[0]['marital'];
                $scope.n_id_type = data.data[0]['n_id_type'];
                $scope.nid = data.data[0]['nid'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.general_update = function (type) {
        $http({
            url: "../../assets/api/general_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "location": $scope.location,
                "patient_id": $scope.patient_id,
                "mobile": $scope.mobile,
                "referral_doctor": $scope.referral_doctor,
                "patient_name": $scope.patient_name,
                "father_name": $scope.father_name,
                "address": $scope.address,
                "state": $scope.state,
                "city": $scope.city,
                "pin": $scope.pin,
                "gender": $scope.gender,
                "age": $scope.age,
                "blood_group": $scope.blood_group,
                "email": $scope.email,
                "whatsapp": $scope.whatsapp,
                "marital": $scope.marital,
                "n_id_type": $scope.n_id_type,
                "nid": $scope.nid,
                "op": "edit"
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


    $scope.nurse_view = function (type) {
        $http({
            url: "../../assets/api/ipd_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.patient_id = data.data[0]['patient_id'];
                $scope.patient_name = data.data[0]['patient_name'];
                $scope.gurdian_name = data.data[0]['gurdian_name'];
                $scope.age = data.data[0]['age'];
                $scope.mobile = data.data[0]['mobile'];
                $scope.referral_doctor = data.data[0]['referral_doctor'];
                $scope.consult_doctor = data.data[0]['consult_doctor'];
                $scope.gender = data.data[0]['gender'];
                $scope.department = data.data[0]['department'];
                $scope.department_ward = data.data[0]['department_ward'];
                $scope.bed_type = data.data[0]['bed_type'];
                $scope.bed_no = data.data[0]['bed_no'];
                $scope.symptoms_type = data.data[0]['symptoms_type'];
                $scope.symptoms_title = data.data[0]['symptoms_title'];
                $scope.symptoms_desc = data.data[0]['symptoms_desc'];
                $scope.description = data.data[0]['description'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Update the Floor section **** 
    $scope.floor_update = function (type) {
        $http({
            url: "../../assets/api/floor_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "name": $scope.name,
                "description": $scope.description,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.floor_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.ward_search = function () {
        $http({
            url: "../../assets/api/ward_section.php",
            method: "POST",
            data: {
                "dept": $scope.department,
                "op": "select_query"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.wdata = data.data;

            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.bed_type_search = function () {
        $http({
            url: "../../assets/api/bed_entry_section.php",
            method: "POST",
            data: {
                "dept_ward": $scope.department_ward,
                "op": "select_query"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.btdata = data.data;

            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.bed_no_search = function () {
        $http({
            url: "../../assets/api/bed_entry_section.php",
            method: "POST",
            data: {
                "bed_type": $scope.bed_type,
                "op": "select_query12"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.bed_no_data = data.data;

            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.symptoms_type_search = function () {
        $http({
            url: "../../assets/api/symtom_section.php",
            method: "POST",
            data: {
                "symptoms_type": $scope.symptoms_type,
                "op": "select_query"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.symptoms_title = data.data[0]['symptoms_head'];
                $scope.symptoms_desc = data.data[0]['symptoms_description'];

            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    // **** payment Entry section *** 
    $scope.payment_entry = function () {
        $http({
            url: "../../assets/api/payment_mode_section.php",
            method: "POST",
            data: {
                "payment_name": $scope.payment_name,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.payment_view();
                $scope.payment_name = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the payment ****
    $scope.payment_view = function () {
        $http({
            url: "../../assets/api/payment_mode_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.payment_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // payment Edit
    $scope.payment_edit = function (type) {
        $http({
            url: "../../assets/api/payment_mode_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.payment_name = data.data[0]['payment_name'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** update the payment section **** 
    $scope.payment_update = function (type) {
        $http({
            url: "../../assets/api/payment_mode_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "payment_name": $scope.payment_name,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.payment_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete payment ***
    $scope.payment_delete = function (type) {
        $http({
            url: "../../assets/api/payment_mode_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.payment_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // **** location Entry section *** 
    $scope.location_entry = function () {
        $http({
            url: "../../assets/api/location.php",
            method: "POST",
            data: {
                "location_name": $scope.location_name,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.location_view();
                $scope.location_name = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the location ****
    $scope.location_view = function () {
        $http({
            url: "../../assets/api/location.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.location_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // location Edit
    $scope.location_edit = function (type) {
        $http({
            url: "../../assets/api/location.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.location_name = data.data[0]['location_name'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** update the location section **** 
    $scope.location_update = function (type) {
        $http({
            url: "../../assets/api/location.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "location_name": $scope.location_name,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.location_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete location ***
    $scope.location_delete = function (type) {
        $http({
            url: "../../assets/api/location.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.location_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // **** National ID Entry section *** 
    $scope.n_id_type_entry = function () {
        $http({
            url: "../../assets/api/nation_id_section.php",
            method: "POST",
            data: {
                "n_id_type": $scope.n_id_type,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.nation_view();
                $scope.n_id_type = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the National ID ****
    $scope.nation_view = function () {
        $http({
            url: "../../assets/api/nation_id_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.nation_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // National Id Edit
    $scope.n_id_type_edit = function (type) {
        $http({
            url: "../../assets/api/nation_id_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.n_id_type = data.data[0]['n_id_type'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** update the National ID section **** 
    $scope.n_id_type_update = function (type) {
        $http({
            url: "../../assets/api/nation_id_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "n_id_type": $scope.n_id_type,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.nation_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete payment ***
    $scope.n_id_type_delete = function (type) {
        $http({
            url: "../../assets/api/nation_id_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.nation_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    //    *** View the National ID ****
    $scope.referral_doctor_view = function () {
        $http({
            url: "../../assets/api/referral_doctor.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.ref_doctor_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // *** Tanmoy ***//
    // *** Medical Charges Entry Section *** //
    $scope.medical_charges_entry = function () {
        $http({
            url: "../../assets/api/medical_service_section.php",
            method: "POST",
            data: {
                "m_type": $scope.m_type,
                "charge": $scope.charge,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.medical_charges_view();
                $scope.m_type = null;
                $scope.charge = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the Medical Charges ****
    $scope.medical_charges_view = function () {
        $http({
            url: "../../assets/api/medical_service_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.medical_charges_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // *** Edit the Medical Charges section *** //
    $scope.medical_charges_edit = function (type) {
        $http({
            url: "../../assets/api/medical_service_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.m_type = data.data[0]['m_type'];
                $scope.charge = data.data[0]['charge'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Update the Medical Charges section **** 
    $scope.medical_charges_update = function (type) {
        $http({
            url: "../../assets/api/medical_service_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "m_type": $scope.m_type,
                "charge": $scope.charge,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.medical_charges_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any Medical Charges ***
    $scope.medical_charges_delete = function (type) {
        $http({
            url: "../../assets/api/medical_service_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.medical_charges_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    // **** Surgical Charges *** 
    $scope.surgical_charges_entry = function () {
        $http({
            url: "../../assets/api/surgical_section.php",
            method: "POST",
            data: {
                "surgical_service": $scope.surgical_service,
                "charge": $scope.charge,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.surgical_charges_view();
                $scope.surgical_service = null;
                $scope.charge = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the Surgical Charges ****
    $scope.surgical_charges_view = function () {
        $http({
            url: "../../assets/api/surgical_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.surgical_charges_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // *** Edit the Surgical Charges section *** //
    $scope.surgical_charges_edit = function (type) {
        $http({
            url: "../../assets/api/surgical_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.surgical_service = data.data[0]['surgical_service'];
                $scope.charge = data.data[0]['charge'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Update the Surgical Charges section **** 
    $scope.surgical_charges_update = function (type) {
        $http({
            url: "../../assets/api/surgical_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "surgical_service": $scope.surgical_service,
                "charge": $scope.charge,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.surgical_charges_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any Surgical Charges ***
    $scope.surgical_charges_delete = function (type) {
        $http({
            url: "../../assets/api/surgical_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.surgical_charges_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    // *** Therapy Charges Entry Section *** //
    $scope.therapy_charges_entry = function () {
        $http({
            url: "../../assets/api/therapy_section.php",
            method: "POST",
            data: {
                "therapies_type": $scope.therapies_type,
                "charge": $scope.charge,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.therapy_charges_view();
                $scope.therapies_type = null;
                $scope.charge = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the Surgical Charges ****
    $scope.therapy_charges_view = function () {
        $http({
            url: "../../assets/api/therapy_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.therapy_charges_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // *** Edit the Surgical Charges section *** //
    $scope.therapy_charges_edit = function (type) {
        $http({
            url: "../../assets/api/therapy_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.therapies_type = data.data[0]['therapies_type'];
                $scope.charge = data.data[0]['charge'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Update the Surgical Charges section **** 
    $scope.therapy_charges_update = function (type) {
        $http({
            url: "../../assets/api/therapy_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "therapies_type": $scope.therapies_type,
                "charge": $scope.charge,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.therapy_charges_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any Surgical Charges ***
    $scope.therapy_charges_delete = function (type) {
        $http({
            url: "../../assets/api/therapy_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.therapy_charges_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** designation Charges Entry Section *** //
    $scope.designation_entry = function () {
        $http({
            url: "../../assets/api/designation_section.php",
            method: "POST",
            data: {
                "designation": $scope.designation,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.designation_view();
                $scope.designation = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the designation ****
    $scope.designation_view = function () {
        $http({
            url: "../../assets/api/designation_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.designation_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // *** Edit the Surgical Charges section *** //
    $scope.designation_edit = function (type) {
        $http({
            url: "../../assets/api/designation_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.designation = data.data[0]['designation'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Update the designation section **** 
    $scope.designation_update = function (type) {
        $http({
            url: "../../assets/api/designation_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "designation": $scope.designation,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.designation_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any Surgical Charges ***
    $scope.designation_delete = function (type) {
        $http({
            url: "../../assets/api/designation_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.designation_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    // **** Role Entry section *** 
    $scope.specialist_entry = function () {
        $http({
            // url: "../../assets/api/staff_section.php",
            url: "../../assets/api/specialist_section.php",
            method: "POST",
            data: {
                "specialist": $scope.specialist,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.specialist_view();
                $scope.specialist = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the Role ****
    $scope.specialist_view = function () {
        $http({
            url: "../../assets/api/specialist_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.specialist_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // Role Edit
    $scope.specialist_edit = function (type) {
        $http({
            url: "../../assets/api/specialist_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.specialist = data.data[0]['specialist'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** update the Role section **** 
    $scope.specialist_update = function (type) {
        $http({
            url: "../../assets/api/specialist_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "specialist": $scope.specialist,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.specialist_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete Role ***
    $scope.specialist_delete = function (type) {
        $http({
            url: "../../assets/api/specialist_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.specialist_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    //    *** View the Role ****
    $scope.staff_view = function () {
        $http({
            url: "../../assets/api/staff_section.php",
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
    $scope.birth_view = function () {
        $http({
            url: "../../assets/api/birth_and_deatth_section.php",
            method: "POST",
            data: {
                "op": "view1"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.birth_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.death_view = function () {
        $http({
            url: "../../assets/api/birth_and_deatth_section.php",
            method: "POST",
            data: {
                "op": "view2"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.death_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.unit_entry = function () {
        $http({
            url: "../../assets/api/unit_section.php",
            method: "POST",
            data: {
                "unit_name": $scope.unit_name,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.unit_view();
                $scope.unit_name = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.unit_view = function () {
        $http({
            url: "../../assets/api/unit_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.unit_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // Role Edit
    $scope.unit_edit = function (type) {
        $http({
            url: "../../assets/api/unit_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.unit_name = data.data[0]['unit_name'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** update the Role section **** 
    $scope.unit_update = function (type) {
        $http({
            url: "../../assets/api/unit_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "unit_name": $scope.unit_name,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.unit_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete Role ***
    $scope.unit_delete = function (type) {
        $http({
            url: "../../assets/api/unit_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.unit_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.percent_entry = function () {
        $http({
            url: "../../assets/api/percent_section.php",
            method: "POST",
            data: {
                "name": $scope.name,
                "percent": $scope.percent,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.percent_view();
                $scope.name = null;
                $scope.percent = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.percent_view = function () {
        $http({
            url: "../../assets/api/percent_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.percent_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // Role Edit
    $scope.percent_edit = function (type) {
        $http({
            url: "../../assets/api/percent_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.name = data.data[0]['name'];
                $scope.percent = data.data[0]['percent'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** update the Role section **** 
    $scope.percent_update = function (type) {
        $http({
            url: "../../assets/api/percent_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "name": $scope.name,
                "percent": $scope.percent,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.percent_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete Role ***
    $scope.percent_delete = function (type) {
        $http({
            url: "../../assets/api/percent_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.percent_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.charge_type_entry = function () {
        $http({
            url: "../../assets/api/charge_type_section.php",
            method: "POST",
            data: {
                "charge_type": $scope.charge_type,
                "appoinment": $scope.appoinment,
                "opd": $scope.opd,
                "ipd": $scope.ipd,
                "pathology": $scope.pathology,
                "radiology": $scope.radiology,
                "blood_bank": $scope.blood_bank,
                "ambulance": $scope.ambulance,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.charge_type_view();
                $scope.charge_type = null;
                $scope.appoinment = null;
                $scope.opd = null;
                $scope.ipd = null;
                $scope.pathology = null;
                $scope.radiology = null;
                $scope.blood_bank = null;
                $scope.ambulance = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.charge_type_view = function () {
        $http({
            url: "../../assets/api/charge_type_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.charge_type_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // Role Edit
    $scope.charge_type_edit = function (type) {
        $http({
            url: "../../assets/api/charge_type_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.charge_type = data.data[0]['charge_type'];
                $scope.appoinment = data.data[0]['appoinment'];
                $scope.opd = data.data[0]['opd'];
                $scope.ipd = data.data[0]['ipd'];
                $scope.pathology = data.data[0]['pathology'];
                $scope.radiology = data.data[0]['radiology'];
                $scope.blood_bank = data.data[0]['blood_bank'];
                $scope.ambulance = data.data[0]['ambulance'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** update the Role section **** 
    $scope.charge_type_update = function (type) {
        $http({
            url: "../../assets/api/charge_type_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "charge_type": $scope.charge_type,
                "appoinment": $scope.appoinment,
                "opd": $scope.opd,
                "ipd": $scope.ipd,
                "pathology": $scope.pathology,
                "radiology": $scope.radiology,
                "blood_bank": $scope.blood_bank,
                "ambulance": $scope.ambulance,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.charge_type_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete Role ***
    $scope.charge_type_delete = function (type) {
        $http({
            url: "../../assets/api/charge_type_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.charge_type_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.charge_cat_entry = function () {
        $http({
            url: "../../assets/api/charge_cat_section.php",
            method: "POST",
            data: {
                "charge_type": $scope.charge_type,
                "name": $scope.name,
                "descp": $scope.descp,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.charge_cat_view();
                $scope.charge_type = null;
                $scope.name = null;
                $scope.descp = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.charge_cat_view = function () {
        $http({
            url: "../../assets/api/charge_cat_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.charge_cat_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // Role Edit
    $scope.charge_cat_edit = function (type) {
        $http({
            url: "../../assets/api/charge_cat_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.charge_type = data.data[0]['charge_type'];
                $scope.name = data.data[0]['name'];
                $scope.descp = data.data[0]['descp'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** update the Role section **** 
    $scope.charge_cat_update = function (type) {
        $http({
            url: "../../assets/api/charge_cat_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "charge_type": $scope.charge_type,
                "name": $scope.name,
                "descp": $scope.descp,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.charge_cat_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete Role ***
    $scope.charge_cat_delete = function (type) {
        $http({
            url: "../../assets/api/charge_cat_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.charge_cat_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.charge_cat_view1 = function () {
        $http({
            url: "../../assets/api/charge_cat_section.php",
            method: "POST",
            data: {
                "op": "view1"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.charge_cat_data1 = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    // 
    $scope.searchtype = function () {
        $http({
            url: "../../assets/api/charge_cat_section.php",
            method: "POST",
            data: {
                "charge_type": $scope.charge_type,
                "op": "select_query2"
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
    $scope.tex = function () {
        console.log($scope.ph);
        $http({
            url: "../../assets/api/charge_cat_section.php",
            method: "POST",
            data: {
                "tax": $scope.tax,
                "op": "percent"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.tax_per = data.data[0]['percent'];
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.charge_entry = function () {
        $http({
            url: "../../assets/api/charge_section.php",
            method: "POST",
            data: {
                "charge_type": $scope.charge_type,
                "name_cat": $scope.name_cat,
                "unit": $scope.unit,
                "name": $scope.name,
                "tax": $scope.tax,
                "tax_per": $scope.tax_per,
                "standard_charge": $scope.standard_charge,
                "descp": $scope.descp,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.charge_view();
                $scope.charge_type = null;
                $scope.name_cat = null;
                $scope.unit = null;
                $scope.name = null;
                $scope.tax = null;
                $scope.tax_per = null;
                $scope.standard_charge = null;
                $scope.descp = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.charge_view = function () {
        $http({
            url: "../../assets/api/charge_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.charge_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // Role Edit
    $scope.charge_edit = function (type) {
        $http({
            url: "../../assets/api/charge_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.charge_type = data.data[0]['charge_type'];
                $scope.name_cat = data.data[0]['name_cat'];
                $scope.unit = data.data[0]['unit'];
                $scope.name = data.data[0]['name'];
                $scope.tax = data.data[0]['tax'];
                $scope.tax_per = data.data[0]['tax_per'];
                $scope.standard_charge = data.data[0]['standard_charge'];
                $scope.descp = data.data[0]['descp'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** update the Role section **** 
    $scope.charge_update = function (type) {
        $http({
            url: "../../assets/api/charge_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "charge_type": $scope.charge_type,
                "name_cat": $scope.name_cat,
                "unit": $scope.unit,
                "name": $scope.name,
                "tax": $scope.tax,
                "tax_per": $scope.tax_per,
                "standard_charge": $scope.standard_charge,
                "descp": $scope.descp,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.charge_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete Role ***
    $scope.charge_delete = function (type) {
        $http({
            url: "../../assets/api/charge_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.charge_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    // **** OT Entry section *** 
    $scope.ot_name_entry = function () {
        $http({
            url: "../../assets/api/operations_section.php",
            method: "POST",
            data: {
                "ot_name": $scope.ot_name,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.ot_category_view();
                $scope.ot_name = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the Role ****
    $scope.ot_category_view = function () {
        $http({
            url: "../../assets/api/operations_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.ot_cat_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // Role Edit
    $scope.ot_cat_edit = function (type) {
        $http({
            url: "../../assets/api/operations_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.ot_name = data.data[0]['ot_name'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** update the Role section **** 
    $scope.ot_cat_update = function (type) {
        $http({
            url: "../../assets/api/operations_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "ot_name": $scope.ot_name,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.ot_category_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete Role ***
    $scope.ot_cat_delete = function (type) {
        $http({
            url: "../../assets/api/operations_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.ot_category_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.ot_head_entry = function () {
        $http({
            url: "../../assets/api/operations_section.php",
            method: "POST",
            data: {
                "ot_head": $scope.ot_head,
                "ot_name": $scope.ot_name,
                "op": "insert1"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.ot_head_view();
                $scope.ot_head = null;
                $scope.ot_name = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the Role ****
    $scope.ot_head_view = function () {
        $http({
            url: "../../assets/api/operations_section.php",
            method: "POST",
            data: {
                "op": "view1"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.ot_head_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // Role Edit
    $scope.ot_head_edit = function (type) {
        $http({
            url: "../../assets/api/operations_section.php",
            method: "POST",
            data: {
                "op": "select_condition1",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.ot_head = data.data[0]['ot_head'];
                $scope.ot_name = data.data[0]['ot_name'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** update the Role section **** 
    $scope.ot_head_update = function (type) {
        $http({
            url: "../../assets/api/operations_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "ot_head": $scope.ot_head,
                "ot_name": $scope.ot_name,
                "op": "edit1"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.ot_head_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete Role ***
    $scope.ot_head_delete = function (type) {
        $http({
            url: "../../assets/api/operations_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete1"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.ot_head_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    // **** Qualification Entry section *** 
    $scope.qualification_entry = function () {
        $http({
            url: "../../assets/api/qualification_section.php",
            method: "POST",
            data: {
                "qulif": $scope.qulif,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.qualification_view();
                $scope.qulif = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the Qualification ****
    $scope.qualification_view = function () {
        $http({
            url: "../../assets/api/qualification_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.qualification_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // Qualification Edit
    $scope.qualification_edit = function (type) {
        $http({
            url: "../../assets/api/qualification_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.qulif = data.data[0]['qulif'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** update the Qualification section **** 
    $scope.qualification_update = function (type) {
        $http({
            url: "../../assets/api/qualification_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "qulif": $scope.qulif,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.qualification_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete Qualification ***
    $scope.qualification_delete = function (type) {
        $http({
            url: "../../assets/api/qualification_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.qualification_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    //Product Type Entry Section
    $scope.p_type_entry = function () {
        $http({
            url: "../../assets/api/blood_donor.php",
            method: "POST",
            data: {
                "product_type": $scope.product_type,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.product_type = null;
                $scope.p_type_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the Product type ****
    $scope.p_type_view = function () {
        $http({
            url: "../../assets/api/blood_donor.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.p_type_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    //    *** Edit the Product type ****
    $scope.p_type_edit = function (type) {
        $http({
            url: "../../assets/api/blood_donor.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.product_type = data.data[0]['product_type'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Update the product section **** 
    $scope.p_type_update = function (type) {
        $http({
            url: "../../assets/api/blood_donor.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "product_type": $scope.product_type,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.p_type_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any product type ***
    $scope.p_type_delete = function (type) {
        $http({
            url: "../../assets/api/blood_donor.php",
            method: "POST",
            data: {
                "id": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.p_type_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    //Product details Entry Section
    $scope.product_entry = function () {
        $http({
            url: "../../assets/api/blood_donor.php",
            method: "POST",
            data: {
                "product_type": $scope.product_type,
                "product_name": $scope.product_name,
                "op": "insert2"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.product_type = null;
                $scope.product_name = null;
                $scope.product_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the Product details ****
    $scope.product_view = function () {
        $http({
            url: "../../assets/api/blood_donor.php",
            method: "POST",
            data: {
                "op": "view2"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.product_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    //    *** Edit the Product details ****
    $scope.product_edit = function (type) {
        $http({
            url: "../../assets/api/blood_donor.php",
            method: "POST",
            data: {
                "op": "select_condition2",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.product_type = data.data[0]['product_type'];
                $scope.product_name = data.data[0]['product_name'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Update the product details section **** 
    $scope.product_update = function (type) {
        $http({
            url: "../../assets/api/blood_donor.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "product_type": $scope.product_type,
                "product_name": $scope.product_name,
                "op": "edit2"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.product_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any product details ***
    $scope.product_delete = function (type) {
        $http({
            url: "../../assets/api/blood_donor.php",
            method: "POST",
            data: {
                "id": type,
                "op": "delete2"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.product_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    //Blood donor Entry Section
    $scope.donor_entry = function () {
        $http({
            url: "../../assets/api/blood_donor.php",
            method: "POST",
            data: {
                "donor_name": $scope.donor_name,
                "b_gr": $scope.b_gr,
                "dob": $scope.dob,
                "gender": $scope.gender,
                "ph": $scope.ph,
                "g_name": $scope.g_name,
                "address": $scope.address,
                "report": $scope.report,
                "op": "insert3"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.donor_name = null;
                $scope.b_gr = null;
                $scope.dob = null;
                $scope.gender = null;
                $scope.ph = null;
                $scope.g_name = null;
                $scope.address = null;
                $scope.report = null;
                $scope.donor_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the Blood donor details ****
    $scope.donor_view = function () {
        $http({
            url: "../../assets/api/blood_donor.php",
            method: "POST",
            data: {
                "op": "view3"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.donor_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    //    *** Edit the Blood donor details ****
    $scope.donor_edit = function (type) {
        $http({
            url: "../../assets/api/blood_donor.php",
            method: "POST",
            data: {
                "op": "select_condition3",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.donor_name = data.data[0]['donor_name'];
                $scope.b_gr = data.data[0]['b_gr'];
                $scope.dob = data.data[0]['dob'];
                $scope.gender = data.data[0]['gender'];
                $scope.ph = data.data[0]['ph'];
                $scope.g_name = data.data[0]['g_name'];
                $scope.address = data.data[0]['address'];
                $scope.report = data.data[0]['report'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** Update the Blood donor details section **** 
    $scope.donor_update = function (type) {
        $http({
            url: "../../assets/api/blood_donor.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "donor_name": $scope.donor_name,
                "b_gr": $scope.b_gr,
                "dob": $scope.dob,
                "gender": $scope.gender,
                "ph": $scope.ph,
                "g_name": $scope.g_name,
                "address": $scope.address,
                "report": $scope.report,
                "op": "edit3"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.donor_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete any Blood donor details ***
    $scope.donor_delete = function (type) {
        $http({
            url: "../../assets/api/blood_donor.php",
            method: "POST",
            data: {
                "id": type,
                "op": "delete3"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.donor_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    // Function to add a referral person
    $scope.ref_person_entry = function () {
        $http({
            url: "../../assets/api/ref_person.php",
            method: "POST",
            data: {
                ref_name: $scope.ref_name,
                ref_ph: $scope.ref_ph,
                con_person_name: $scope.con_person_name,
                con_person_ph: $scope.con_person_ph,
                category: $scope.category,
                com: $scope.com,
                address: $scope.address,
                opd: $scope.opd,
                ipd: $scope.ipd,
                pharmacy: $scope.pharmacy,
                pathology: $scope.pathology,
                radiology: $scope.radiology,
                blood_bank: $scope.blood_bank,
                ambulance: $scope.ambulance,
                op: "insert"
            },
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.ref_person_view();
            },
            function () {
                alert("Error! Problem in sendData()");
            }
        );
    };

    // Function to retrieve all referral persons
    $scope.ref_person_view = function () {
        $http({
            url: "../../assets/api/ref_person.php",
            method: "POST",
            data: {
                op: "view"
            },
        }).then(
            function (data) {
                console.log(data.data);
                $scope.ref_person_view_data = data.data;
            },
            function () {
                alert("Error! Problem in sendData()");
            }
        );
    };

    // Function to retrieve and populate form for editing referral person
    $scope.ref_person_edit = function (type) {
        $http({
            url: "../../assets/api/patient_admit_section.php",
            method: "POST",
            data: {
                op: "edit",
                idd: type
            },
        }).then(
            function (data) {
                console.log(data.data);
                var data = data.data;
                $scope.ref_name = data.ref_name;
                $scope.ref_ph = data.ref_ph;
                $scope.con_person_name = data.con_person_name;
                $scope.con_person_ph = data.con_person_ph;
                $scope.category = data.category;
                $scope.com = data.com;
                $scope.address = data.address;
                $scope.opd = data.opd;
                $scope.ipd = data.ipd;
                $scope.pharmacy = data.pharmacy;
                $scope.pathology = data.pathology;
                $scope.radiology = data.radiology;
                $scope.blood_bank = data.blood_bank;
                $scope.ambulance = data.ambulance;
                $scope.idd = type;
            },
            function () {
                alert("Error! Problem in sendData()");
            }
        );
    };

    // Function to update a referral person
    $scope.ref_person_update = function (type) {
        $http({
            url: "../../assets/api/ref_person.php",
            method: "POST",
            data: {
                op: "edit",
                id: $scope.idd,
                ref_name: $scope.ref_name,
                ref_ph: $scope.ref_ph,
                con_person_name: $scope.con_person_name,
                con_person_ph: $scope.con_person_ph,
                category: $scope.category,
                com: $scope.com,
                address: $scope.address,
                opd: $scope.opd,
                ipd: $scope.ipd,
                pharmacy: $scope.pharmacy,
                pathology: $scope.pathology,
                radiology: $scope.radiology,
                blood_bank: $scope.blood_bank,
                ambulance: $scope.ambulance,
            },
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.ref_person_view();
            },
            function () {
                alert("Error! Problem in sendData()");
            }
        );
    };

    // Function to delete a referral person
    $scope.ref_person_delete = function (type) {
        $http({
            url: "../../assets/api/ref_person.php",
            method: "POST",
            data: {
                op: "delete",
                id: type
            },
        }).then(
            function (data) {
                console.log(data.data);
                $scope.ref_person_view();
            },
            function () {
                alert("Error! Problem in sendData()");
            }
        );
    };
    $scope.ipd_regis = function () {
        $http({
            url: "../../assets/api/ipd_section.php",
            method: "POST",
            data: {
                "patient_id": $scope.patient_id,
                "mobile": $scope.mobile,
                "referral_doctor": $scope.referral_doctor,
                "patient_name": $scope.patient_name,
                "father_name": $scope.father_name,
                "age": $scope.age,
                "gender": $scope.gender,
                "blood_group": $scope.blood_group,
                "address": $scope.address,
                "city": $scope.city,
                "state": $scope.state,
                "pin": $scope.pin,
                "email": $scope.email,
                "whatsapp": $scope.whatsapp,
                "n_id_type": $scope.n_id_type,
                "nid": $scope.nid,
                "marital": $scope.marital,
                "gurdian_name": $scope.gurdian_name,
                "relationship": $scope.relationship,
                "gurdian_address": $scope.gurdian_address,
                "gar_mobile": $scope.gar_mobile,
                "department": $scope.department,
                "department_ward": $scope.department_ward,
                "bed_type": $scope.bed_type,
                "bed_no": $scope.bed_no,
                "pay_mode": $scope.pay_mode,
                "pay_pack": $scope.pay_pack,
                "adv_pay": $scope.adv_pay,
                "due": $scope.due,
                "consult_doctor": $scope.consult_doctor,
                "regis_type": "IPD",
                "description": $scope.description,
                "symptoms_type": $scope.symptoms_type,
                "symptoms_title": $scope.symptoms_title,
                "symptoms_desc": $scope.symptoms_desc,
                "patient_status": "patient_regis",
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                
                $scope.patient_id = null;
                $scope.mobile = null;
                $scope.referral_doctor = null;
                $scope.patient_name = null;
                $scope.father_name = null;
                $scope.age = null;
                $scope.gender = null;
                $scope.blood_group = null;
                $scope.address = null;
                $scope.city = null;
                $scope.state = null;
                $scope.pin = null;
                $scope.email = null;
                $scope.whatsapp = null;
                $scope.n_id_type = null;
                $scope.nid = null;
                $scope.marital = null;
                $scope.gurdian_name = null;
                $scope.relationship = null;
                $scope.gurdian_address = null;
                $scope.gar_mobile = null;
                $scope.department = null;
                $scope.department_ward = null;
                $scope.bed_type = null;
                $scope.bed_no = null;
                $scope.pay_mode = null;
                $scope.pay_pack = null;
                $scope.adv_pay = null;
                $scope.due = null;
                $scope.consult_doctor = null;
                $scope.regis_type = null;
                $scope.description = null;
                $scope.symptoms_type = null;
                $scope.symptoms_title = null;
                $scope.symptoms_desc = null;
                $scope.patient_status = null;
                $scope.ipd_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.ipd_view = function () {
        $http({
            url: "../../assets/api/ipd_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.ipd_view_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    //opd registration
    $scope.opd_reg = function () {
        $http({
            url: "../../assets/api/opd_section.php",
            method: "POST",
            data: {
                "patient_id": $scope.patient_id,
                "regis_type": $scope.regis_type,
                "referral_doctor": $scope.referral_doctor,
                "con_doctor": $scope.con_doctor,
                "patient_name": $scope.patient_name,
                "father_name": $scope.father_name,
                "mobile": $scope.mobile,
                "gender": $scope.gender,
                "age": $scope.age,
                "blood_group": $scope.blood_group,
                "address": $scope.address,
                "city": $scope.city,
                "state": $scope.state,
                "pin": $scope.pin,
                "pay_mode": $scope.pay_mode,
                "pay_pack": $scope.pay_pack,
                "adv_pay": $scope.adv_pay,
                "due": $scope.due,
                "description": $scope.description,
                // Add other fields similarly
                "op": "insert",
                "patient_admit": $scope.patient_admit
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                // Reset all scope variables to null after successful submission
                $scope.patient_id = null;
                $scope.regis_type = null;
                $scope.referral_doctor = null;
                $scope.con_doctor = null;
                $scope.patient_name = null;
                $scope.father_name = null;
                $scope.mobile = null;
                $scope.gender = null;
                $scope.age = null;
                $scope.blood_group = null;
                $scope.address = null;
                $scope.city = null;
                $scope.state = null;
                $scope.pin = null;
                $scope.pay_mode = null;
                $scope.pay_pack = null;
                $scope.adv_pay = null;
                $scope.due = null;
                $scope.description = null;
                // Reset other fields similarly
                $scope.opd_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.opd_view = function () {
        $http({
            url: "../../assets/api/opd_section.php",
            method: "POST",
            data: {
                op: "view"
            },
        }).then(
            function (data) {
                console.log(data.data);
                $scope.opd_view_data = data.data;
            },
            function () {
                alert("Error! Problem in sendData()");
            }
        );
    };
    

    // Function to add a referral person
    $scope.ref_person_entry = function () {
        $http({
            url: "../../assets/api/ref_person.php",
            method: "POST",
            data: {
                id: $scope.id,
                ref_name: $scope.ref_name,
                ref_ph: $scope.ref_ph,
                con_person_name: $scope.con_person_name,
                con_person_ph: $scope.con_person_ph,
                category: $scope.category,
                com: $scope.com,
                address: $scope.address,
                opd: $scope.opd,
                ipd: $scope.ipd,
                pharmacy: $scope.pharmacy,
                pathology: $scope.pathology,
                radiology: $scope.radiology,
                blood_bank: $scope.blood_bank,
                ambulance: $scope.ambulance,
                op: "insert"
            },
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.ref_person_view();
                $scope.id = null;
                $scope.ref_name = null;
                $scope.ref_ph = null;
                $scope.con_person_name = null;
                $scope.con_person_ph = null;
                $scope.category = null;
                $scope.com = null;
                $scope.address = null;
                $scope.opd = null;
                $scope.ipd = null;
                $scope.pharmacy = null;
                $scope.pathology = null;
                $scope.radiology = null;
                $scope.blood_bank = null;
                $scope.ambulance = null;
            },
            function () {
                alert("Error! Problem in sendData()");
            }
        );
    };

    // Function to retrieve all referral persons
    $scope.ref_person_view = function () {
        $http({
            url: "../../assets/api/ref_person.php",
            method: "POST",
            data: {
                op: "view"
            },
        }).then(
            function (data) {
                console.log(data.data);
                $scope.ref_person_view_data = data.data;
            },
            function () {
                alert("Error! Problem in sendData()");
            }
        );
    };

    // Function to retrieve and populate form for editing referral person
    $scope.ref_person_edit = function (type) {
        $http({
            url: "../../assets/api/ref_person.php",
            method: "POST",
            data: {
                op: "select_condition",
                idd: type
            },
        }).then(
            function (data) {
                console.log(data.data);
                $scope.ref_name = data.data[0]["ref_name"];
                $scope.ref_ph = data.data[0]["ref_ph"];
                $scope.con_person_name = data.data[0]["con_person_name"];
                $scope.con_person_ph = data.data[0]["con_person_ph"];
                $scope.category = data.data[0]["category"];
                $scope.com = data.data[0]["com"];
                $scope.address = data.data[0]["address"];
                $scope.opd = data.data[0]["opd"];
                $scope.ipd = data.data[0]["ipd"];
                $scope.pharmacy = data.data[0]["pharmacy"];
                $scope.pathology = data.data[0]["pathology"];
                $scope.radiology = data.data[0]["radiology"];
                $scope.blood_bank = data.data[0]["blood_bank"];
                $scope.ambulance = data.data[0]["ambulance"];
                $scope.idd = type;
            },
            function () {
                alert("Error! Problem in sendData()");
            }
        );
    };

    // Function to update a referral person
    $scope.ref_person_update = function (type) {
        $http({
            url: "../../assets/api/ref_person.php",
            method: "POST",
            data: {
                op: "edit",
                id: $scope.idd,
                ref_name: $scope.ref_name,
                ref_ph: $scope.ref_ph,
                con_person_name: $scope.con_person_name,
                con_person_ph: $scope.con_person_ph,
                category: $scope.category,
                com: $scope.com,
                address: $scope.address,
                opd: $scope.opd,
                ipd: $scope.ipd,
                pharmacy: $scope.pharmacy,
                pathology: $scope.pathology,
                radiology: $scope.radiology,
                blood_bank: $scope.blood_bank,
                ambulance: $scope.ambulance,
            },
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.ref_person_view();
            },
            function () {
                alert("Error! Problem in sendData()");
            }
        );
    };
    $scope.general_regis = function () {
        $http({
            // url: "../../assets/api/staff_section.php",
            url: "../../assets/api/general_section.php",
            method: "POST",
            data: {
                "location": $scope.location,
                "mobile": $scope.mobile,
                "patient_id": $scope.patient_id,
                "patient_name": $scope.patient_name,
                "father_name": $scope.father_name,
                "address": $scope.address,
                "state": $scope.state,
                "city": $scope.city,
                "pin": $scope.pin,
                "gender": $scope.gender,
                "age": $scope.age,
                "blood_group": $scope.blood_group,
                "email": $scope.email,
                "whatsapp": $scope.whatsapp,
                "marital": $scope.marital,
                "n_id_type": $scope.n_id_type,
                "nid": $scope.nid,
                "regis_type": $scope.regis_type,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.general_view();
                $scope.location = null;
                $scope.mobile = null;
                $scope.patient_id = null;
                $scope.patient_name = null;
                $scope.father_name = null;
                $scope.address = null;
                $scope.state = null;
                $scope.city = null;
                $scope.pin = null;
                $scope.gender = null;
                $scope.age = null;
                $scope.blood_group = null;
                $scope.email = null;
                $scope.whatsapp = null;
                $scope.marital = null;
                $scope.n_id_type = null;
                $scope.nid = null;
                $scope.regis_type = null;

            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    $scope.lab_dept_entry = function () {
        $http({
            // url: "../../assets/api/staff_section.php",
            url: "../../assets/api/lab_dept_section.php",
            method: "POST",
            data: {
                "lab_dept": $scope.lab_dept,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.lab_dept_view();
                $scope.lab_dept = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the Role ****
    $scope.lab_dept_view = function () {
        $http({
            url: "../../assets/api/lab_dept_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.lab_dept_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // Role Edit
    $scope.lab_dept_edit = function (type) {
        $http({
            url: "../../assets/api/lab_dept_section.php",
            method: "POST",
            data: {
                "op": "select_condition",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.lab_dept = data.data[0]['lab_dept'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** update the Role section **** 
    $scope.lab_dept_update = function (type) {
        $http({
            url: "../../assets/api/lab_dept_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "lab_dept": $scope.lab_dept,
                "op": "edit"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.lab_dept_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete Role ***
    $scope.lab_dept_delete = function (type) {
        $http({
            url: "../../assets/api/lab_dept_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.lab_dept_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.lab_test_entry = function () {
        $http({
            // url: "../../assets/api/staff_section.php",
            url: "../../assets/api/lab_dept_section.php",
            method: "POST",
            data: {
                "lab_dept": $scope.lab_dept,
                "test": $scope.test,
                "op": "insert1"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.lab_test_view();
                $scope.lab_dept = null;
                $scope.test = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the Role ****
    $scope.lab_test_view = function () {
        $http({
            url: "../../assets/api/lab_dept_section.php",
            method: "POST",
            data: {
                "op": "view1"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.lab_test_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // Role Edit
    $scope.lab_test_edit = function (type) {
        $http({
            url: "../../assets/api/lab_dept_section.php",
            method: "POST",
            data: {
                "op": "select_condition1",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.lab_dept = data.data[0]['lab_dept'];
                $scope.test = data.data[0]['test'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** update the Role section **** 
    $scope.lab_test_update = function (type) {
        $http({
            url: "../../assets/api/lab_dept_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "lab_dept": $scope.lab_dept,
                "test": $scope.test,
                "op": "edit1"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.lab_test_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete Role ***
    $scope.lab_test_delete = function (type) {
        $http({
            url: "../../assets/api/lab_dept_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete1"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.lab_test_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    $scope.lab_charge_entry = function () {
        $http({
            // url: "../../assets/api/staff_section.php",
            url: "../../assets/api/lab_dept_section.php",
            method: "POST",
            data: {
                "lab_dept": $scope.lab_dept,
                "test": $scope.test,
                "test_charge": $scope.test_charge,
                "op": "insert2"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.lab_charge_view();
                $scope.lab_dept = null;
                $scope.test = null;
                $scope.test_charge = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    //    *** View the Role ****
    $scope.lab_charge_view = function () {
        $http({
            url: "../../assets/api/lab_dept_section.php",
            method: "POST",
            data: {
                "op": "view2"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.lab_charge_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // Role Edit
    $scope.lab_charge_edit = function (type) {
        $http({
            url: "../../assets/api/lab_dept_section.php",
            method: "POST",
            data: {
                "op": "select_condition2",
                "idd": type
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.lab_dept = data.data[0]['lab_dept'];
                $scope.test = data.data[0]['test'];
                $scope.test_charge = data.data[0]['test_charge'];
                $scope.idd = type;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };


    // *** update the Role section **** 
    $scope.lab_charge_update = function (type) {
        $http({
            url: "../../assets/api/lab_dept_section.php",
            method: "POST",
            data: {
                "id": $scope.idd,
                "lab_dept": $scope.lab_dept,
                "test": $scope.test,
                "test_charge": $scope.test_charge,
                "op": "edit2"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.lab_charge_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };

    // **** Delete Role ***
    $scope.lab_charge_delete = function (type) {
        $http({
            url: "../../assets/api/lab_dept_section.php",
            method: "POST",
            data: {
                "idd": type,
                "op": "delete2"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.lab_charge_view();
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.lab_dept_search = function () {
        $http({
            url: "../../assets/api/lab_dept_section.php",
            method: "POST",
            data: {
                "lab_dept": $scope.lab_dept,
                "op": "select_query3"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.tests_data = data.data;

            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.test_search = function () {
        $http({
            url: "../../assets/api/lab_dept_section.php",
            method: "POST",
            data: {
                "test": $scope.test,
                "op": "select_query4"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.test_charge = data.data[0]['test_charge'];
                calculateTotalAmount();

            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    };
    $scope.timeline_entry = function () {
        $http({
            url: "../../assets/api/timeline_section.php",
            method: "POST",
            data: {
                "title": $scope.title,
                "file": $scope.file,
                "descc": $scope.descc,
                "op": "insert"
            }
        }).then(
            function (data) {
                console.log(data.data);
                alert(data.data);
                $scope.timeline_view();
                $scope.title = null;
                $scope.file = null;
                $scope.descc = null;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }

    $scope.timeline_view = function () {
        $http({
            url: "../../assets/api/timeline_section.php",
            method: "POST",
            data: {
                "op": "view"
            }
        }).then(
            function (data) {
                console.log(data.data);
                $scope.timeline_data = data.data;
            },
            function () {
                alert("Error! Fetching Problem in sendData()");
            });
    }
    $scope.calculateTotal = function () {
        var quantity = parseInt($scope.quantity) || 1; // Default to 1 if quantity is not provided or not a number
        var discountAmount = parseFloat($scope.discount) || 0; // Default to 0 if discount is not provided or not a number
        var totalAmount = $scope.test_charge * quantity - discountAmount;
        $scope.totalAmount = totalAmount < 0 ? 0 : totalAmount; // Ensure totalAmount is not negative
        $scope.grandTotal = $scope.totalAmount;
    };
    
    // Watch for changes in discount or quantity
    $scope.$watchGroup(['discount', 'quantity'], function (newValues, oldValues) {
        if (newValues !== oldValues) {
            $scope.calculateTotal();
        }
    });
    // Patient Section
    $scope.patient_view = function () {
        $scope.var = true;
        $scope.var1 = false;
    };

    $scope.patient_entry = function () {
        $scope.var = false;
        $scope.var1 = true;
    };

    $scope.opd_reg_entry = function () {
        $scope.var = false;
        $scope.var1 = true;
    };

    $scope.staff_view = function () {
        $scope.var = true;
        $scope.var1 = false;
    };

    $scope.staff_entry = function () {
        $scope.var = false;
        $scope.var1 = true;
    };

});