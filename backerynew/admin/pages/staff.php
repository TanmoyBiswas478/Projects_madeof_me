

<div style="padding-top: 20px;" ng-init="staffview()">
    <!-- <h2 class="text-center"><u>Staff Registration Section</u></h2> -->


    <div style="padding:30px !important;">
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <div class="mr-auto p-2">Staff Section</div>
                    <div class="p-2">
                    <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg" ng-click="roleview();outletview();"><i
                    class="fa-solid fa-plus"></i> Add Staff</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <table width="100%" class="table table-bordered" style="font-size: 11.5px!important;">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Phone No</th>
                    <th class="text-center">Staff Name</th>
                    <th class="text-center">Address</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">Job Location</th>
                    <th class="text-center">Qualification</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                <tr ng-repeat="x in staff_data">
                    <td class="text-center">{{$index+1}}</td>
                    <td class="text-center">{{x.phone}}</td>
                    <td class="text-center">{{x.sname | uppercase}}</td>
                    <td class="text-center" style="text-transform: capitalize;">{{x.address}}</td>
                    <td class="text-center" style="text-transform: capitalize;">{{x.gender}}</td>
                    <td class="text-center">{{x.email | lowercase}}</td>
                    <td class="text-center" style="text-transform: capitalize;">{{x.role}}</td>
                    <td class="text-center" style="text-transform: capitalize;">{{x.location}}</td>
                    <td class="text-center" style="text-transform: capitalize;">{{x.quali}}</td>
                    <td class="text-center">
                        <button class="btn-success" title="edit" data-toggle="modal"
                            data-target="#exampleModalCenter"><i class="fa-solid fa-pen-to-square" ng-click="staff_edit(x.id)"></i></button>
                        <button class="btn-danger" title="Delete" ng-click="staff_delete(x.id)"><i
                                class="fa-sharp fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
<!-- Client Model Section -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <h2 class="text-center"><u>Staff Entry Section</u></h2>
            <div class="container" style="padding-bottom: 20px !important;">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Phone No</label>
                            <input type="text" class="form-control" ng-model="phone" maxlength="10"oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" ng-blur="check()" required>
                        </div>
                        <span style="color:red">{{error}}</span>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Staff Name</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" style="text-transform: uppercase;" ng-model="sname">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Address</label>
                            <textarea class="form-control" style="text-transform: capitalize;" ng-model="address"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Gender</label>
                            <select class="form-control" id="formGroupExampleInput" style="text-transform: capitalize;" ng-model="gender">
                            <option>Select....</option>
                            <option>Male</option>
                            <option>Female</option>
                            </select>  
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Email</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" style="text-transform: lowercase;" ng-model="email">
                        </div>
                    </div>
                </div>

                
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Role</label>
                            <select class="custom-select" ng-model="role">
                                <option ng-repeat="x in role_data">
                                    {{x.role}}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Job Location</label>
                            <select class="custom-select" ng-model="location" style="text-transform: capitalize;">
                            <option ng-repeat="x in sdata">
                                    {{x.oname}}
                                </option>
                                </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Qualification</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" style="text-transform: capitalize;" ng-model="quali">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-success" id="myBtn" ng-click="staffentry()">Submit</button> &nbsp;
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button> &nbsp;
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Update model section -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Update Staff Section</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Phone No</label>
                            <input type="text" class="form-control" ng-model="phone" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" ng-blur="check()" required>
                            <input type="hidden" class="form-control" ng-model="idd" maxlength="10">
                        </div>
                        <span style="color:red">{{error}}</span>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Staff Name</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" style="text-transform: uppercase;" ng-model="sname">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Address</label>
                            <textarea class="form-control" style="text-transform: capitalize;" ng-model="address"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Gender</label>
                            <input type="text" list="gen" class="form-control" style="text-transform: capitalize;" ng-model="gender">
                            <datalist id="gen">
                              <option>Male</option>
                               <option>Female</option>
                           </datalist>  
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Email</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" style="text-transform: lowercase;" ng-model="email">
                        </div>
                    </div>
                </div>

                
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Role</label>
                            <input type="text" list="ro" class="custom-select" ng-model="role">
                             <datalist id="ro">
                                <option ng-repeat="x in role_data">
                                    {{x.role}}
                                </option>
                             </datalist>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Job Location</label>
                            <input type="text" list="jl" class="custom-select" ng-model="location" style="text-transform: capitalize;">
                            <datalist id="jl">
                            <option ng-repeat="x in sdata">
                                    {{x.oname}}
                                </option>
                            </datalist>
                        </div>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Qualification</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" style="text-transform: capitalize;" ng-model="quali">
                        </div>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
          <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button-->
          <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="staff_update()">Update</button>
        </div>
      </div>
    </div>
  </div>