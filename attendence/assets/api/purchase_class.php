<?php
class Purchase {
    private $host="localhost";
    private $user="root";
    private $pass="";
    private $dbname="backery";
    private $result=array();
    private $mysqli="";
    private $con=false;

   public function __construct()
   {
    if(!$this->con){
    $this->mysqli=new mysqli($this->host,$this->user,$this->pass,$this->dbname);
    $this->con=true;
    if($this->mysqli->connect_error)
    {
     array_push($this->result,$this->mysqli->connect_error);
    }
  }
 } 
 
 public function addPurchase($inv,$data1,$data2)
 {
  $this->mysqli->begin_transaction();
  try 
  {
   // Check if the pinvice_no already exists in the purchase master table
   $fields = array_keys($data1);
   $values = array_values($data1);

   $fields1=array_keys($data2);
   $values1 = array_values($data2);
   $check_query = "SELECT COUNT(*) as count FROM purchase_master WHERE pinv = '$inv'";
   $check_result = mysqli_query($this->mysqli, $check_query);
   $check_row = mysqli_fetch_assoc($check_result);
   if ($check_row['count'] == 0) 
   {
    // Insert data into purchase master table
    $insert_master_query = "INSERT INTO purchase_master (" . implode(',', $fields) . ") VALUES ('" . implode("','", $values) . "')";
    $this->mysqli->query($insert_master_query);
   }
   // Insert data into purchase table
   $insert_query = "INSERT INTO purchase (" . implode(',', $fields1) . ") VALUES ('" . implode("','", $values1) . "')";
   $this->mysqli->query($insert_query);
   // Commit transaction
   //echo "Data Inserted Successfully...";
   $this->mysqli->commit();
  }
  catch (Exception $e) 
  {
   // Rollback transaction
   $this->mysqli->rollback();
   throw $e;
  }
}

public function view_db($table,$inv){
  $sql="select * from $table where pinv= '$inv'";
  $res=$this->mysqli->query($sql); 
  $output=array();
  while($row=$res->fetch_assoc())
  {
   $output[]=$row;
  }
  echo json_encode($output);
}

public function gtotal1($invs,$state){
  $sql="SELECT sum(tax) tax,sum(`gstamt`) gstamt,sum(`total`) total FROM purchase WHERE pinv= '$invs'";
  $res=$this->mysqli->query($sql); 
  $output=array();
  while($row=$res->fetch_assoc())
  {
   $tax=$row['tax'];
   $gstamt=$row['gstamt'];
   $state=trim($state);
   if($state=='Tripura')
   {
    $cgsta=$gstamt/2;
    $igsta=0;
   }
   else{
    $cgsta=0;
    $igsta=$gstamt;
   }
   $total=$row['total'];
   $output[]=$row;
  }
  $sql="update purchase_master set tax='".$tax."',cgsta='".$cgsta."',sgsta='".$cgsta."',igsta='".$igsta."',total='".$total."' WHERE pinv= '$invs'";
  $res=$this->mysqli->query($sql); 
  echo json_encode($output);
}

// close the connection 
public function __destruct()
{
 if($this->con){
   if($this->mysqli->close()){
     $this->con=false;
   }
 }
}
}
?>