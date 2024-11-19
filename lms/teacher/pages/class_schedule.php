<br>
<div class="container" style="background: #fff;  border: 2px solid #EAEAEC;"
    ng-init="sloat_view();">
    <div class="row">
        <div class="col-md-12"
            style="background:blueviolet; height: 60px; color: #fff !important; display: flex; align-items: center;">
            <div class="mr-auto p-3"><i class="fa-solid fa-bars"></i> Class Routine </div>
            <!-- <div class="p-2">
            <button class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg" data-whatever="@mdo">
                <i class="fa-solid fa-plus"></i> Create Batch
            </button>
        </div> -->
        </div>
    </div>
    <div class="row" style="padding-top: 10px !important;">
    </div>
    <div class="row" style="padding-top: 10px !important;">
        <div class="col-md-12">
            <table class="table table-bordered" style="font-size: 11.5px;">
                <thead class="text-center">
                    <tr>
                        <th>Days</th>
                        <th ng-repeat="x in sloat_data">{{x.sloat}}</th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                   $con=mysqli_connect("localhost","root","","lms") or die(mysqli_error($con));
                   $sql2="select * from days order by id asc";
                   $res2=mysqli_query($con,$sql2) or die(mysqli_error($con));
                   while($row=mysqli_fetch_assoc($res2))
                   {
                    echo "<tr>";
                    echo "<td><b>".$row['Days']."</b></td>";
                    $sql="select sloat from slot order by id asc";
                    $res=mysqli_query($con,$sql) or die(mysqli_error($con));
                    while($row1=mysqli_fetch_assoc($res))
                    {
                     echo "<td><span>";         
                     $sloat=$row1['sloat'];
                     $sql1="select tname,bno from routine where Days='".$row['Days']."' and Sloat='".$sloat."'";
                     $res1=mysqli_query($con,$sql1) or die(mysqli_error($con));
                     $c=mysqli_num_rows($res1);
                     $tname="";
                     $bno="";
                     if($c>0){
                      while($row2=mysqli_fetch_assoc($res1))
                      {
                       $tname=$row2['tname'];
                       $bno="<b><br>(Batch No:".$row2['bno']."</b>)";
                      }
                     }
                     echo $tname.$bno."</span>";
                    }
                    echo "</td>";
                   }
                   echo "</tr>";
                   ?>
                </tbody>
            </table>
        </div>
    </div>
</div>