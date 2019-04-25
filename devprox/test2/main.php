<?php
ini_set('memory_limit', '1048M');
ini_set('max_execution_time', 300);  
require_once("../test2/src/randomdata.php");
include_once("../test2/src/option.php");
if(isset($_POST['record_no'])){
   $record_no  = $_POST["record_no"];
} 

function getMemoryUsage(){

  return memory_get_peak_usage(true) / 1024 / 1024; // MiB
}

$fullName = array();
$data = array();
$count = 0;
while($count < $record_no){

    $count++;
    $firstname 			= RandomData::getFirstName();
    $initials  			= RandomData::getInitial($firstname);
    $lastname 	 		= RandomData::getLastName();   
    $dob   				  = RandomData::getRandomDate(4,50, 'm/d/Y');
    $age 				    = RandomData::getAge($dob);

    $fullName[$count]   = $firstname.",".$lastname.",".$initials.",".$age.",".$dob;
    $data[]             = explode(',',$fullName[$count]);

}
// call array to csv 
RandomData::arrayToCsv($data);

?>

