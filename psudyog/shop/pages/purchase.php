<div style="padding:20px;" ng-init="vendorview();companyview();">

    <!-- Card cod is here  -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <div class="mr-auto p-2">Purchase Section</div>
                <div class="p-2">
                    <button class="btn btn-success" ng-click="add_new()">
                        <i class="fas fa-plus"></i>
                        Add New
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Invoice No</label>
                        <input type="text" class="form-control" ng-model="pinv">

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Invoice Date</label>
                        <input type="date" class="form-control" ng-model="invdate" ng-model-options="{timezone: 'utc'}">

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Vendore Name</label>
                        <select class="form-control" ng-model="vname" ng-blur="ven_data()">
                            <option></option>
                            <option ng-repeat="x in vdata">{{x.vname}}</option>
                        </select>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <input type="text" class="form-control" ng-model="address" readonly>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone No</label>
                        <input type="text" class="form-control" ng-model="phone" readonly>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">GSTIN No</label>
                        <input type="text" class="form-control" ng-model="gstno" readonly>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pan No</label>
                        <input type="text" class="form-control" ng-model="panno" readonly>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">email</label>
                        <input type="text" class="form-control" ng-model="email" readonly>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">State</label>
                        <input type="text" class="form-control" ng-model="state" readonly>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">


                        <table class="table table-bordered" style="font-size: 11.5px;">
                            <!--table class="table table-bordered table-responsive" style="font-size:11.5px; width:200% !importnat;"-->
                            <thead>
                                <tr>
                                    <th class="text-center" width="2%">Sl</th>
                                    <th class="text-center" width="10%">Company Name</th>
                                    <th class="text-center" width="20%">Description of Goods</th>
                                    <th class="text-center">HSN No</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Unit</th>
                                    <th class="text-center">Free Qty</th>
                                    <th class="text-center">Unit</th>
                                    <th class="text-center">Rack No</th>
                                    <th class="text-center">Rate</th>
                                    <th class="text-center">Sales Rate</th>
                                    <th class="text-center">Taxable Values</th>
                                    <th class="text-center">GST%</th>
                                    <th class="text-center">GST Amt</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>


                                <tr ng-repeat="x in pdata">
                                    <td class="text-center" height="50">{{$index+1}}</td>
                                    <td>{{x.category}}</td>
                                    <td>{{x.product}}</td>
                                    <td>{{x.hsn}}</td>
                                    <td>{{x.qty}}</td>
                                    <td>{{x.unit}}</td>
                                    <td>{{x.fqty}}</td>
                                    <td>{{x.unit2}}</td>
                                    <td>{{x.rack}}</td>
                                    <td>{{x.rate}}</td>
                                    <td>{{x.srate}}</td>
                                    <td>{{x.tax}}</td>
                                    <td>{{x.gstper}}%</td>
                                    <td>{{x.gstamt}}</td>
                                    <td>{{x.total}}</td>
                                    <td>
                                        <button class="btn-danger" title="Delete">
                                            <i class="fas fa-trash-alt"></i></button>
                                    </td>

                                </tr>

                                <tr>
                                    <td colspan="11" class="text-right"><b>Grand Total:</b></td>

                                    <td class="text-center">&#8377;{{tax1}}</td>
                                    <td></td>
                                    <td class="text-center">&#8377;{{gstamt1}}</td>
                                    <td class="text-center">&#8377;{{total1}}</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Card Section -->

            <div class="card">
                <div class="card-header">
                    Purhase Item Section
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Company Name</label>
                                <select ng-model="category" class="form-control" ng-blur="pro_data()">
                                    <option ng-repeat="x in company_data">{{x.company | uppercase}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description of Goods</label>
                                <input type="text" list="po" ng-model="product" class="form-control" onkeypress="return addresskey(event)">
                                <datalist id="po">
                                    <option ng-repeat="x in prdata">{{x.product | uppercase}}</option>
                                </datalist>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">HSN No</label>
                                <input type="text" ng-model="hsn" class='form-control' maxlength="8" onkeypress="return isNumber(event)">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Batch No</label>
                                <input type="text" ng-model="bno" class='form-control' onkeypress="return isNumber(event)">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Exp Date</label>
                                <input type="date" ng-model="expdate" class='form-control'>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Qty</label>

                                <div class="input-group">
                                    <input type="text" ng-model="qty1" class='form-control' onkeypress="return isNumber(event)">
                                    <select class="form-control" ng-model="unit">
                                        <option>PC</option>
                                        <option>Nos</option>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Free qty</label>
                                <div class="input-group">
                                    <input type="text" ng-model="fqty" class='form-control' onkeypress="return isNumber(event)">
                                    <select class="form-control" ng-model="unitt">
                                        <!-- <option>Case</option>
                                        <option>Dojon</option-->
                                        <option>PC</option> 
                                        <option>Nos</option>
                                        <!-- <option>Ltr</option> -->
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Rack No</label>
                                <div class="input-group">
                                    <input type="text" ng-model="rack" id="nop" class='form-control'>
                                    <!-- <input type="text" ng-model="unit1" value="PC" class='form-control' readonly>
                                    <input type="hidden" ng-model="qty" value="PC" class='form-control' readonly> -->
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Discount</label>
                                <input type="text" ng-model="disc" class='form-control' onkeypress="return isNumber(event)">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Purchase Rate</label>
                                <input type="text" ng-model="rate" class='form-control' onkeypress="return isNumber(event)" ng-blur="totalpc()">

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sales Rate</label>
                                <input type="text" ng-model="srate" class='form-control' onkeypress="return isNumber(event)" ng-blur="prate()">

                                <input type="hidden" ng-model="rate1" class='form-control' onkeypress="return isNumber(event)">
                                <input type="hidden" ng-model="rate2" class='form-control' onkeypress="return isNumber(event)">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Taxable Value</label>
                                <input type="text" ng-model="tax" class='form-control' readonly>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">GST %</label>
                                <select ng-model="gstper" class='form-control' ng-blur="gstsec()">
                                    <option></option>
                                    <option>0</option>
                                    <option>3</option>
                                    <option>5</option>
                                    <option>12</option>
                                    <option>18</option>
                                    <option>28</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">GST Amount</label>
                                <input type="text" ng-model="gstamt" class='form-control' readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Total</label>
                                <input type="text" ng-model="total" class='form-control' readonly>
                                <input type="hidden" ng-model="cgst" class='form-control'>
                                <input type="hidden" ng-model="cgstp" class='form-control'>
                                <input type="hidden" ng-model="sgst" class='form-control'>
                                <input type="hidden" ng-model="sgstp" class='form-control'>
                                <input type="hidden" ng-model="igst" class='form-control'>
                                <input type="hidden" ng-model="igstp" class='form-control'>
                            </div>
                        </div>

                    </div>

                    <div class="text-center">
                        <button class="btn btn-info" id="myBtn" ng-click="purchase_entry()"> Add Item</button>&nbsp; &nbsp;

                        <button class="btn btn-danger" data-dismiss="modal"> Close</button>&nbsp; &nbsp;
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>