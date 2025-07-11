<?php
class sales {
  private $host="localhost";
  private $user="root";
  private $pass="";
  private $dbname="backery";
  private $result=array();
  private $mysqli="";
  private $con=false;

//   private $host="localhost";
//  private $user="fortheye_admin";
//  private $pass="Soft@2017";
//  private $dbname="fortheye_backery";
//  private $result=array();
//  private $mysqli="";
//  private $con=false;


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
 
 public function addsales($inv,$data1,$data2)
 {
  $this->mysqli->begin_transaction();
  try 
  {
   // Check if the pinvice_no already exists in the purchase master table
   $fields = array_keys($data1);
   $values = array_values($data1);

   $fields1=array_keys($data2);
   $values1 = array_values($data2);
   $check_query = "SELECT COUNT(*) as count FROM sales_master WHERE sinv = '$inv'";
   $check_result = mysqli_query($this->mysqli, $check_query);
   $check_row = mysqli_fetch_assoc($check_result);
   if ($check_row['count'] == 0) 
   {
    // Insert data into purchase master table
    $insert_master_query = "INSERT INTO sales_master (" . implode(',', $fields) . ") VALUES ('" . implode("','", $values) . "')";
    $this->mysqli->query($insert_master_query);
   }
   // Insert data into purchase table
   $insert_query = "INSERT INTO sales (" . implode(',', $fields1) . ") VALUES ('" . implode("','", $values1) . "')";
   $this->mysqli->query($insert_query);   
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
  $sql="select * from $table where sinv= '$inv'";
  $res=$this->mysqli->query($sql); 
  $output=array();
  while($row=$res->fetch_assoc())
  {
   $output[]=$row;
  }
  echo json_encode($output);
}

public function gtotal1($invs,$state,$vname,$gstno){
  $sql="SELECT sum(tax) tax,sum(`gstamt`) gstamt,sum(`total`) total FROM sales WHERE sinv= '$invs'";
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
  $month=date("F").'-'.date("Y");
  $sql="update sales_master set tax='".$tax."',cgsta='".$cgsta."',sgsta='".$cgsta."',igsta='".$igsta."',total='".$total."' WHERE sinv= '$invs'";
  $res=$this->mysqli->query($sql);
  echo json_encode($output);
}

public function client($ph){
  $output=array();
  $check_query = "SELECT COUNT(*) as count FROM client where ph= '$ph'";
  $check_result = mysqli_query($this->mysqli, $check_query);
  $check_row = mysqli_fetch_assoc($check_result);
  if ($check_row['count'] > 0) 
  {
   $sql="select * from client where ph= '$ph'";
   $res=$this->mysqli->query($sql); 
   while($row=$res->fetch_assoc())
   {
    $output[]=$row;
   }
  }
  echo json_encode($output); 
}

public function delete_db($id){
  $check_query = "delete from sales where id='".$id."'";
  $check_result = mysqli_query($this->mysqli, $check_query);
   
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