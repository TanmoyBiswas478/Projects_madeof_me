<?php 
class database
{
 private $host="localhost";
 private $user="root";
 private $pass="";
 private $dbname="vha";
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

public function __construct() {
  $this->conn = new mysqli('localhost', 'root', '', 'vha');
  
  if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
  }
}
 //  *** function to insert the databse ***
 public function insert_db($table, $data)
 {
  $fields = array_keys($data);
  $values = array_values($data);
  $sql = "INSERT INTO $table (" . implode(',', $fields) . ") VALUES ('" . implode("','", $values) . "')";
  if ($this->conn->query($sql) === TRUE) 
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
     $id = $data['id'];  // Use 'id', not 'idd'
     $sql = "DELETE FROM $table WHERE id='$id'";
     if ($this->conn->query($sql)) {  // Use $this->conn instead of $this->mysqli
         echo json_encode(["message" => "Data deleted successfully"]);
     } else {
         echo json_encode(["error" => "Deletion failed: " . $this->conn->error]);
     }
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
public function select_db($table, $data, $where)
{
    if ($table == 'outlet_stock') {
        $sql = "UPDATE $table SET status='Expired' WHERE expdate < CURDATE() AND MONTH(expdate) = MONTH(CURDATE())";
        $res = $this->conn->query($sql);  // Use $this->conn instead of $this->mysqli
    }
    
    // Ensure that the `where` condition is not empty
    if (empty($where)) {
        die("Error: Missing WHERE condition.");
    }

    $sql = "SELECT * FROM $table WHERE $where";
    $res = $this->conn->query($sql);  // Use $this->conn instead of $this->mysqli

    if (!$res) {
        die("Error in SQL query: " . $this->conn->error);
    }

    $output = array();
    while ($row = $res->fetch_assoc()) {
        $output[] = $row;
    }
    echo json_encode($output);
}

 
 public function select_query($sql) {
  $result = $this->conn->query($sql);  // assuming $this->conn is your database connection
  
  if (!$result) {
      // Log the SQL error
      die("Error in SQL query: " . $this->conn->error . "<br>Query: " . $sql);
  }

  $data = [];
  while ($row = $result->fetch_assoc()) {
      $data[] = $row;
  }
  return $data;
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