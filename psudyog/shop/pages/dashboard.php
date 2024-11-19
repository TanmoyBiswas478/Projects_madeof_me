<?php 
session_start();
include '../../assets2/api/connect.php';
$doe=date('Y-m-d');
$sql="SELECT SUM(qty * rate) AS svalue FROM stock WHERE sname = '".$_SESSION['sname']."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($res);
$svalue = $row['svalue'];

$sql="SELECT COALESCE(SUM(total), 0.00) AS tsvalue FROM sales_master WHERE sname = '".$_SESSION['sname']."' AND invdate = '".$doe."'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($res);
$tsvalue = $row['tsvalue'];

$sql="SELECT COALESCE(SUM(total), 0.00) AS tsvalue1 FROM sales_master WHERE sname = '".$_SESSION['sname']."' and fy='23-24'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($res);
$tsvalue1 = $row['tsvalue1'];

$sql="SELECT COALESCE(SUM(total), 0.00) AS psvalue1 FROM purchase_master WHERE sname = '".$_SESSION['sname']."' and fy='23-24'";
$res=mysqli_query($con,$sql) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($res);
$psvalue1 = $row['psvalue1'];

?>
<!-- card section  -->
<div style="text-align: justify !important;" style="padding: 20px !important;">
        <div class="card" style="background: #FAFAFA !important;">
            

            <div class="card-body">
                <h2 class="text-center">
                    <!-- Heading -->
                </h2>

                 <!-- Counter section  -->
                 <div class="row" style="padding-top: 20px !important;">
                <div class="col-md-3 d-flex justify-content-center" style="text-align: justify !important;">
                        <div class="card" style="border-radius: 15px !important; box-shadow: 0 0 0.25em rgba(67,71,85,.27), 0 0.25em 1em rgba(90,125,188,.05) !important;  padding: 3%;  width: 100%; ">
                            <div class="card-body" style="height: 170px !important;">
                                <h5 class="card-title text-primary">Total Stock Value</h5>
                                <p class="float-left text-primary" style="font-size:50px !important;">
                                <i class="fa-solid fa-arrows-down-to-people"></i>
                                </p>
                                <h1 class="float-right text-primary" style="font-size:50px !important;">&#8377;<?php echo $svalue; ?></h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card" style="border-radius: 15px !important; box-shadow: 0 0 0.25em rgba(67,71,85,.27), 0 0.25em 1em rgba(90,125,188,.05) !important;  padding: 3%;  width: 100%; ">
                            <div class="card-body" style="height: 170px !important;">
                                <h5 class="card-title text-success">Todays Sales</h5>
                                <p class="float-left text-success" style="font-size:50px !important;"><i
                                        class="fas fa-users"></i></p>
                                <h1 class="float-right text-success" style="font-size:50px !important;">
                                &#8377;<?php echo $tsvalue; ?>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="border-radius: 15px !important; box-shadow: 0 0 0.25em rgba(67,71,85,.27), 0 0.25em 1em rgba(90,125,188,.05) !important;  padding: 3%;  width: 100%; ">
                            <div class="card-body" style="height: 170px !important;">
                                <h5 class="card-title text-warning">Total Sales</h5>
                                <p class="float-left text-warning" style="font-size:50px !important;"><i
                                        class="fas fa-landmark"></i></p>
                                <h1 class="float-right text-warning" style="font-size:50px !important;">
                                &#8377;<?php echo $tsvalue1; ?>
                               </h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card" style="border-radius: 15px !important; box-shadow: 0 0 0.25em rgba(67,71,85,.27), 0 0.25em 1em rgba(90,125,188,.05) !important;  padding: 3%;  width: 100%; ">
                            <div class="card-body" style="height: 170px !important;">
                                <h5 class="card-title text-danger">Total Purchase</h5>
                                <p class="float-left text-danger" style="font-size:50px !important;"><i
                                        class="fas fa-user-graduate"></i></p>
                                <h1 class="float-right text-danger" style="font-size:50px !important;">
                                &#8377;<?php echo $psvalue1; ?>
                            </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of counting section  -->




                <!-- chart section  -->
                <div class="row" style="padding-top: 20px !important;">
                    <div class="col-md-6">
                        <div class="card" style="height: 500px !important; border-radius: 15px !important; box-shadow: 0 0 0.25em rgba(67,71,85,.27), 0 0.25em 1em rgba(90,125,188,.05) !important;  padding: 3%;  width: 100%;">
                            <div class="card-body">
                            <iframe class="embed-responsive-item" src="pages/bar.php"
                        allowfullscreen frameBorder="0" scrolling="no" height="500" width="100%">
</iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" style="height: 500px !important; border-radius: 15px !important; box-shadow: 0 0 0.25em rgba(67,71,85,.27), 0 0.25em 1em rgba(90,125,188,.05) !important;  padding: 3%;  width: 100%;">
                            <div class="card-body text-center"><br>
                            <iframe class="embed-responsive-item" src="pages/pie1.php"
                        allowfullscreen frameBorder="0" scrolling="no" height="500" width="100%">
</iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End chart section -->

               
                <!-- Table section  -->
                <div class="row" style="padding-top: 20px !important; padding-bottom: 50px !important;">
    <div class="col-md-12">
        <button onclick="exportToExcel()">Download Excel</button>
        <div class="table-responsive">
            <!-- <table class="table table-bordered table-hover" style="font-size: 11.5px !important;">
                <thead>
                    <tr>
                        <th class="text-center" rowspan="2" valign="middle">#</th>
                        <th class="text-center" colspan="2">April-23</th>
                        <th class="text-center" colspan="2">May-23</th>
                        <th class="text-center" colspan="2">June-23</th>
                        <th class="text-center" colspan="2">July-23</th>
                        <th class="text-center" colspan="2">Aug-23</th>
                        <th class="text-center" colspan="2">Sep-23</th>
                        <th class="text-center" colspan="2">Oct-23</th>
                        <th class="text-center" colspan="2">Nov-23</th>
                        <th class="text-center" colspan="2">Dec-23</th>
                        <th class="text-center" colspan="2">Jan-24</th>
                        <th class="text-center" colspan="2">Feb-24</th>
                        <th class="text-center" colspan="2">Mar-24</th>
                    </tr>
                    <tr>
                        <th scope="col" class="text-center">Purchase</th>
                        <th scope="col" class="text-center">Sales</th>
                        <th scope="col" class="text-center">Purchase</th>
                        <th scope="col" class="text-center">Sales</th>
                        <th scope="col" class="text-center">Purchase</th>
                        <th scope="col" class="text-center">Sales</th>
                        <th scope="col" class="text-center">Purchase</th>
                        <th scope="col" class="text-center">Sales</th>
                        <th scope="col" class="text-center">Purchase</th>
                        <th scope="col" class="text-center">Sales</th>
                        <th scope="col" class="text-center">Purchase</th>
                        <th scope="col" class="text-center">Sales</th>
                        <th scope="col" class="text-center">Purchase</th>
                        <th scope="col" class="text-center">Sales</th>
                        <th scope="col" class="text-center">Purchase</th>
                        <th scope="col" class="text-center">Sales</th>
                        <th scope="col" class="text-center">Purchase</th>
                        <th scope="col" class="text-center">Sales</th>
                        <th scope="col" class="text-center">Purchase</th>
                        <th scope="col" class="text-center">Sales</th>
                        <th scope="col" class="text-center">Purchase</th>
                        <th scope="col" class="text-center">Sales</th>
                        <th scope="col" class="text-center">Purchase</th>
                        <th scope="col" class="text-center">Sales</th>
                    </tr>
                </thead>
            </table> -->

            
        </div>
    </div>
</div>



            </div>
        </div>
    </div>