<div style="padding:20px;">
  <div class="card" ng-show="var" ng-init="req_view()">
    <div class="card-header">
      Requistion Section
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered" style="font-size:11.5px">
            <thead>
              <tr>
                <th scope="col" width="5%" class="text-center">Sl</th>
                <th scope="col" width="20%" class="text-center">Requistion No</th>
                <th scope="col" width="20%" class="text-center">Outlet Name</th>
                <th scope="col" width="10%" class="text-center">No of Produt</th>
                <th scope="col" width="10%" class="text-center">Date of Submission</th>
                <th scope="col" width="10%" class="text-center">Product List</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="x in req_data">
                <td>{{$index+1}}</td>
                <td>{{x.reqno}}</td>
                <td>{{x.outlet}}</td>
                <td class="text-center">{{x.item_count}}</td>
                <td class="text-center">{{x.reqdate}}</td>
                <!-- <td></td> -->
                <td class="text-center">
                  <button class="btn-danger" title="View List" ng-click="req_item(x.reqno)">
                    <i class="fas fa-list"></i>
                  </button>

                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="card" ng-show="var1">
    <div class="card-header">
      Product List
    </div>
    <div class="card-body">
      <table class="table table-bordered" style="font-size:11.5px">
        <thead>
          <tr>
            <th scope="col" width="10%" class="text-center">Sl</th>
            <th scope="col" width="40%" class="text-center">Description of Goods</th>
            <th scope="col" width="10%" class="text-center">Qty Required</th>
            <th scope="col" width="10%" class="text-center">Unit</th>

            <th scope="col" width="10%" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="x in req_data">
            <td class="text-center">{{$index+1}}</td>
            <td>{{x.item}}</td>
            <td class="text-center">{{x.qty}}</td>
            <td class="text-center">{{x.unit}}</td>
            <!-- <td></td> -->
            <td class="text-center">
              <button class="btn-success" title="Accept" ng-click="req_accept(x.reqno,x.item,x.qty)">
                <i class="fas fa-check"></i>
              </button>
              <button class="btn-danger" title="Cancel" ng-click="req_cancel(x.reqno,x.item)">
                <i class="fas fa-times"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>