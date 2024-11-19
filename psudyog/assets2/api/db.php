<?php 
class database
{
  
 private $host="localhost";
 private $user="root";
 private $pass="";
 private $dbname="psudyog";
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
 public function view_db($table,$sname)
 {
  $sql="select * from $table where sname='$sname'";
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
  $sql="select * from $table where $where";
  $res=$this->mysqli->query($sql); 
  $output=array();
  while($row=$res->fetch_assoc())
  {
   $output[]=$row;
  }
  echo json_encode($output);
 }

 public function ledger($table,$data,$where)
 {
  $sql="SELECT `vname`,gstno,sum(`debit`) debit,sum(`credit`) credit FROM $table WHERE 1 GROUP by `vname`;";
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

 public function purchase_total($table,$sname)
 {
  $sql="select sum(tax) gtax,sum(cgsta) gcgsta,sum(sgsta) gsgsta,sum(igsta) gigsta,sum(total) gtotal from $table where sname='".$sname."'";
  $res=$this->mysqli->query($sql); 
  $output=array();
  while($row=$res->fetch_assoc())
  {
   $output[]=$row;
  }
  echo json_encode($output);
 }

 public function purchase_view($table,$inv)
 {
  $sql="select * from $table where pinv='".$inv."'";
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