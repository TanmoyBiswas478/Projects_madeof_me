<?php
$con = mysqli_connect("localhost", "root", "", "lms") or die(mysqli_error($con));
$sql = "SELECT *FROM materials";
$result = $con->query($sql);

?>
<br>
<div class="container-fluid" style="background: #fff;border: 2px solid #EAEAEC;" ng-init="material_view1();">
    <div class="row">
        <div class="col-md-12"
            style="background:blueviolet; height: 60px; color: #fff !important; display: flex; align-items: center;">
            <div class="mr-auto p-3"><i class="fa-solid fa-bars"></i> View Uploaded Materials
            </div>
        </div>
    </div>
    <div class="row" style="padding-top: 10px !important;">
    </div>
    <div class="row" style="padding-top: 10px !important;">
        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleInputEmail1">Training Name</label>
                <select class="form-control" ng-model="tname" name="tname" ng-change="material_view1()">
                    <option></option>
                    <option ng-repeat="x in training_data">{{x.tname}}</option>
                    <?php
                    // $sql3="select id,tname from training";
                    // $result=mysqli_query($con,$sql3);
                    // $trainings = array();
                    // while($row1= mysqli_fetch_assoc($result)){
                    //     $training[]=$row1;
                    //     echo "<option>$row1[tname]</option>"; }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered text-center" ng-if="material_data.length">
                <thead class="table-info">
                    <tr>
                        <th>#</th>
                        <th>Topic Name</th>
                        <th>Materials</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="material in material_data">
                        <td>{{$index + 1}}</td>
                        <td>{{material.topic}}</td>
                        <td>{{material.file}}</td>
                        <td>
                            <a ng-href="../materials/{{material.file}}" target="_blank" class="btn btn-success"
                                title="View File">
                                <i class="fa-solid fa-eye"></i> View
                            </a>

                            <a href="" ng-click="material_edit(material.id)" class="btn btn-primary" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="" ng-click="material_delete(material.id)" class="btn btn-danger" title="Delete">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p ng-if="!material_data.length">No materials found for this training.</p>
        </div>

    </div>
</div>
<!-- Update Questions Section -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="container" style="background: #fff; height: 750px !important; border: 2px solid #EAEAEC;"
                ng-init="trainingview();">
                <div class="row">
                    <div class="col-md-12"
                        style="background:blueviolet; height: 60px; color: #fff !important; display: flex; align-items: center;">
                        <div class="mr-auto p-3"><i class="fa-solid fa-bars"></i> Update View Uploaded Materials
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 10px !important;">
                </div>
                <div class="row" style="padding-top: 10px !important;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Training Name</label>
                            <select class="form-control" ng-model="tname" name="tname" ng-change="material_view1()">
                                <option value="">Select Training</option>
                                <option ng-repeat="x in training_data" value="{{x.tname}}">{{x.tname}}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Teacher Name</label>
                            <textarea class="form-control" ng-model="question"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Materials</label>
                            <input type="text" class="form-control" ng-model="option1">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" ng-click="material_update()"><i
                                    class="fa-solid fa-floppy-disk"></i> Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$con->close();
?>