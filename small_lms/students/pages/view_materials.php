<?php
// Establish database connection
$con = mysqli_connect("localhost", "root", "", "lms") or die(mysqli_error($con));

// Fetch materials
$sql = "SELECT * FROM materials";
$result = $con->query($sql);
?>
<br>
<div class="container-fluid" style="background:rgb(82, 70, 159) !important; color: aliceblue !important; " ng-init="material_view1();trainingview();">
    <!-- Header Section -->
    <div class="row">
        <div class="col-md-12"
        style="background:rgb(82, 70, 159) !important; color: aliceblue !important;">
            <div class="mr-auto p-3"><i class="fa-solid fa-bars"></i> View Uploaded Materials</div>
        </div>
    </div>

    <!-- Dropdown Section -->
    <div class="row" style="padding-top: 10px;">
        <div class="col-md-12">
            <div class="form-group">
                <label for="trainingSelect">Course Name</label>
                <select class="form-control" id="trainingSelect" ng-model="tname" name="tname" ng-change="material_view1()">
                    <option value="">Select Course</option>
                    <option ng-repeat="x in training_data" value="{{x.tname}}">{{x.tname}}</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Materials Table -->
    <div class="row" style="padding-top: 10px;">
        <div class="col-md-12">
            <table class="table table-bordered text-center" ng-if="material_data.length">
                <thead class="table-info">
                    <tr>
                        <th>#</th>
                        <th>Course Name</th>
                        <th>Materials</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="material in material_data">
                        <td>{{$index + 1}}</td>
                        <td>{{material.topic}}</td>
                        <td>
                            <a ng-href="../materials/{{material.file}}" target="_blank">{{material.file}}</a>
                        </td>
                        <td>
                            <a ng-href="../materials/{{material.file}}" target="_blank" class="btn btn-success" title="View File">
                                <i class="fa-solid fa-eye"></i> View
                            </a>
                            <button class="btn btn-primary" title="Edit" data-toggle="modal" data-target="#updateMaterialModal"
                                ng-click="material_edit(material.id)">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button class="btn btn-danger" title="Delete" ng-click="material_delete(material.id)">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p ng-if="!material_data.length">No Materials Found For This Course.</p>
        </div>
    </div>
</div>

<!-- Update Material Modal -->
<div class="modal fade" id="updateMaterialModal" tabindex="-1" role="dialog" aria-labelledby="updateMaterialLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateMaterialLabel">Update Uploaded Materials</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="editTrainingName">Course Name</label>
                        <select class="form-control" id="editTrainingName" ng-model="tname">
                            <option value="">Select Course</option>
                            <option ng-repeat="x in training_data" value="{{x.tname}}">{{x.tname}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editTopicName">Course Name</label>
                        <textarea class="form-control" id="editTopicName" ng-model="topic"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editMaterialFile">Material File</label>
                        <input type="text" class="form-control" id="editMaterialFile" ng-model="file">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" ng-click="material_update()">
                    <i class="fa-solid fa-floppy-disk"></i> Update
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php
// Close database connection
$con->close();
?>
