<?php 
class database
{
 private $host="localhost";
 private $user="root";
 private $pass="";
 private $dbname="backery";
 private $result=array();
 private $mysqli="";
 private $con=false;

// private $host="localhost";
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
 //  *** function to insert the databse ***
 public function insert_db($table, $data)
 {
  $fields = array_keys($data);
  $values = array_values($data);
  $sql = "INSERT INTO $table (" . implode(',', $fields) . ") VALUES ('" . implode("','", $values) . "')";
  if ($this->mysqli->query($sql) === TRUE) 
  {
    echo "Data insertion successfully complete...";
    //return true;
  } 
  else 
  {
   echo "Error: " . $sql . "<br>" . $this->mysqli->error;
   //return false;
  }
 } 

 // *** function to update row in a database ***
 public function update_db($table, $data,$where)
 {
  $sql = "UPDATE $table SET ";
  foreach ($data as $key => $value) {
    $sql .= "$key = '$value',";
  }
  $sql = rtrim($sql, ',');
  $sql .= " WHERE $where";
  if ($this->mysqli->query($sql) === TRUE) {
     echo "Data update Successfully....";
     //return true;
  } else {
     //return false;
   }
 }

 // *** function to Delete row in a databse *** 
 public function delete_db($table, $data)
 {
  $idd=$data['idd'];
  $sql="delete from $table where id='".$idd."'";
  $res=$this->mysqli->query($sql); 
  echo "Data deleted successfully...";
  //return true;
 }

 // *** Function to view the database  */
 public function view_db($table)
 {
  $sql="select * from $table";
  $res=$this->mysqli->query($sql); 
  $output=array();
  while($row=$res->fetch_assoc())
  {
   $output[]=$row;
  }
  echo json_encode($output);
 }

//  *** Condition Statement ***
public function select_db($table,$data,$where)
 {
  if($table=='outlet_stock'){
    $sql="update $table set status='Expair' WHERE expdate < CURDATE() AND MONTH(expdate) = MONTH(CURDATE())";
    $res=$this->mysqli->query($sql);
  }
  $sql="select * from $table where $where";
  $res=$this->mysqli->query($sql); 
  $output=array();
  while($row=$res->fetch_assoc())
  {
   $output[]=$row;
  }
  echo json_encode($output);
 }

 public function total_db($table,$data,$where)
 {
  $sql="select sum(total) total from $table where $where";
  $res=$this->mysqli->query($sql); 
  $output=array();
  while($row=$res->fetch_assoc())
  {
   $output[]=$row;
  }
  echo json_encode($output);
 }

 public function purchase_total($table)
 {
  $sql="select sum(tax) gtax,sum(cgsta) gcgsta,sum(sgsta) gsgsta,sum(igsta) gigsta,sum(total) gtotal from $table";
  $res=$this->mysqli->query($sql); 
  $output=array();
  while($row=$res->fetch_assoc())
  {
   $output[]=$row;
  }
  echo json_encode($output);
 }
 
 public function select_query($query)
 {
  //echo $sql= $query;
  $res=$this->mysqli->query($query); 
  $output=array();
  while($row=$res->fetch_assoc())
  {
   $output[]=$row;
  }
  echo json_encode($output);
 }

 public function purchase_view($table,$inv)
 {
  $sql="select * from $table $inv";
  $res=$this->mysqli->query($sql); 
  $output=array();
  while($row=$res->fetch_assoc())
  {
   $output[]=$row;
  }
  echo json_encode($output);
 }

 public function view_stock($table)
 {
  $sql="update $table set status='Expair' WHERE expdate < CURDATE() AND MONTH(expdate) = MONTH(CURDATE())";
  $res=$this->mysqli->query($sql); 
  $sql="select * from $table";
  $res=$this->mysqli->query($sql); 
  $output=array();
  while($row=$res->fetch_assoc())
  {
   $output[]=$row;
  }
  echo json_encode($output);
 }

 public function group_view($table,$type)
 {
   if($table=='sales_master'){
    $sql="SELECT `name`,`ph`,`gstno`,`state`,sum(`tax`) tax,sum(`cgsta`) cgsta,sum(`sgsta`) sgsta,sum(`igsta`) igsta,sum(`total`) total FROM $table GROUP by $type";
   }
   else{
   $sql="SELECT `vendore`,`gstno`,`state`,sum(`tax`) tax,sum(`cgsta`) cgsta,sum(`sgsta`) sgsta,sum(`igsta`) igsta,sum(`total`) total FROM $table GROUP by $type";
   }
  $res=$this->mysqli->query($sql); 
  $output=array();
  while($row=$res->fetch_assoc())
  {
   $output[]=$row;
  }
  echo json_encode($output);
 }

 // close the connection 
 public function __destruct()
 {
  if($this->con){
    if($this->mysqli->close()){
      $this->con=false;
      //return true;
    }
  }
  else{
    //return false;
  }
 }


}
?>