<div style="padding:20px;" ng-init="vendorview();product_data();">

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


                        <table class="table table-bordered" style="font-size: 11.5px; width:130% !important;">
                            <!--table class="table table-bordered table-responsive" style="font-size:11.5px; width:200% !importnat;"-->
                            <thead>
                                <tr>
                                    <th class="text-center" width="2%">Sl</th>
                                    <th class="text-center" width="20%">Description of Goods</th>
                                    <th class="text-center">HSN No</th>
                                    <th class="text-center">Batch No</th>
                                    <th class="text-center">Exp Date</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Unit</th>

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
                                <tr>
                                    <td class="text-center" height="40">#</td>
                                   
                                    <td>
                                        <input type="text" list="pro" ng-model="product"
                                            style="border: transparent; outline:none; width: 100%; height: 30px;" ng-blur="hsn_data()">
                                            <datalist id="pro">
                                               <option ng-repeat="x in prodata">{{x.product}}</option>
                                            </datalist>
                                    </td>
                                    <td>
                                        <input type="text" ng-model="hsn"
                                            style="border: transparent; outline:none; width: 100%; height: 30px;">
                                    </td>
                                    <td>
                                        <input type="text" ng-model="bno"
                                            style="border: transparent; outline:none; width: 100%; height: 30px;">
                                    </td>
                                    <td>
                                        <input type="date" ng-model="expdate"
                                            style="border: transparent; outline:none; width: 100%; height: 30px;"
                                            ng-model-options="{timezone: 'utc'}">
                                    </td>
                                    <td>
                                        <input type="text" ng-model="qty"
                                            style="border: transparent; outline:none; width: 100%; height: 30px;">
                                    </td>
                                    <td>
                                        <select ng-model="unit"
                                            style="border: transparent; outline:none; width: 100%; height: 30px;">
                                       
                                            <option>KG</option>
                                            <option>Grm</option>
                                            <option>Ltr</option>
                                            <option>ML</option>
                                            <option>Nos</option>
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" ng-model="rate"
                                            style="border: transparent; outline:none; width: 100%; height: 30px;"
                                            ng-blur="ratecalc()">
                                    </td>
                                    <td>
                                        <input type="text" ng-model="srate"
                                            style="border: transparent; outline:none; width: 100%; height: 30px;"
                                            >
                                    </td>
                                    <td>
                                        <input type="text" ng-model="tax"
                                            style="border: transparent; outline:none; width: 100%; height: 30px;"
                                            readonly>
                                    </td>

                                    <td>
                                        <select ng-model="gstper"
                                            style="border: transparent; outline:none; width: 100%; height: 30px;"
                                            ng-blur="gstsec()">
                                            <option></option>
                                            <option>0</option>
                                            <option>3</option>
                                            <option>5</option>
                                            <option>12</option>
                                            <option>18</option>
                                            <option>28</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" ng-model="gstamt"
                                            style="border: transparent; outline:none; width: 100%; height: 30px;"
                                            readonly>
                                    </td>
                                    <td>
                                        <input type="text" ng-model="total"
                                            style="border: transparent; outline:none; width: 100%; height: 30px;"
                                            readonly>
                                        <input type="hidden" ng-model="cgst"
                                            style="border: transparent; outline:none; width: 100%; height: 30px;">
                                        <input type="hidden" ng-model="cgstp"
                                            style="border: transparent; outline:none; width: 100%; height: 30px;">
                                        <input type="hidden" ng-model="sgst"
                                            style="border: transparent; outline:none; width: 100%; height: 30px;">
                                        <input type="hidden" ng-model="sgstp"
                                            style="border: transparent; outline:none; width: 100%; height: 30px;">
                                        <input type="hidden" ng-model="igst"
                                            style="border: transparent; outline:none; width: 100%; height: 30px;">
                                        <input type="hidden" ng-model="igstp"
                                            style="border: transparent; outline:none; width: 100%; height: 30px;">
                                    </td>
                                    <td>
                                        <button class="btn-success" title="Add" ng-click="purchase_entry()">
                                            <i class="fas fa-plus"></i></button>
                                    </td>
                                </tr>

                                <tr ng-repeat="x in pdata">
                                    <td class="text-center" height="50">{{$index+1}}</td>
                                    <td>{{x.product}}</td>
                                    <td>{{x.hsn}}</td>
                                    <td>{{x.bno}}</td>
                                    <td>{{x.expdate}}</td>
                                    <td>{{x.qty}}</td>
                                    <td>{{x.unit}}</td>
                                    <td>{{x.rate}}</td>
                                    <td>{{x.srate}}</td>
                                    <td>{{x.tax}}</td>
                                    <td>{{x.gstper}}%</td>
                                    <td>{{x.gstamt}}</td>
                                    <td>{{x.total}}</td>
                                    <td>
                                        <button class="btn-danger" title="Delete" ng-click="bill_delete(x.id)">
                                            <i class="fas fa-trash-alt"></i></button>
                                    </td>

                                </tr>

                                <tr>
                                    <td colspan="9" class="text-right"><b>Grand Total:</b></td>

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