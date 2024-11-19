<?php 
include '../../assets/api/connect.php';
                              $doe=Date('Y-m-d');
                              $sql="SELECT sum(`total`) total FROM `sales_master` where invdate='".$doe."'";
                              $res=mysqli_query($con,$sql) or die(mysqli_error($con));
                              while($row=mysqli_fetch_assoc($res)){
                                 echo $row['total'];
                              }
                              mysqli_close($con);?>