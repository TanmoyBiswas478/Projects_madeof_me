<?php
include 'connect.php';
// $sql_drop_table = "DROP TABLE IF EXISTS `blood_donor`";

// if ($con->query($sql_drop_table) === TRUE) {
//     echo "Table 'blood_donor' dropped successfully\n";
// } else {
//     echo "Error dropping table 'blood_donor': " . $con->error;
// }
echo "connection off";
// $sql = "CREATE TABLE `blood_donor` (
//     `id` int(11) NOT NULL AUTO_INCREMENT,
//     `donor_name` varchar(200) NOT NULL,
//     `b_gr` varchar(100) NOT NULL,
//     `dob` varchar(100) NOT NULL,
//     `gender` varchar(100) NOT NULL,
//     `ph` varchar(100) NOT NULL,
//     `g_name` varchar(100) NOT NULL,
//     `address` varchar(100) NOT NULL,
//     `report` varchar(100) NOT NULL,
//     `user` varchar(100) NOT NULL,
//     `doe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
//     PRIMARY KEY (`id`)
//   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
  
//   if ($con->query($sql) === TRUE) {
//       echo "Table blood_donor created successfully";
//   } else {
//       echo "Error creating table: " . $con->error;
//   }
  
//   // Set AUTO_INCREMENT value
//   $sql_auto_increment = "ALTER TABLE `blood_donor` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3";
  
//   if ($con->query($sql_auto_increment) === TRUE) {
//       echo "Auto_increment set successfully";
//   } else {
//       echo "Error setting auto_increment: " . $con->error;
//   }
  
//   $con->close();

?>