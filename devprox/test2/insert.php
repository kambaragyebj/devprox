<?php 
include('../test2/Config/config.php');
// Insert the data into the server. 
class devprox_csv{

	public static function import_csv_to_db($file){

		$db = config::getInstance();
		$conn = $db->getConnection(); 
		$table ="Csv_import";
		//Create table Csv_import if not exist
		$db->createRecordTable();
	    $sql = 'LOAD DATA LOCAL INFILE  "'.$file.'"
			        INTO TABLE '.$table.' 
			        FIELDS TERMINATED by \',\'
			        LINES TERMINATED BY \'\n\'
			        IGNORE 1 LINES
			        (first_name ,last_name,initial_name,age,date_birth)';

		mysqli_query($conn, $sql)or die(mysqli_error());
	  $count = (int) (mysqli_affected_rows($conn)); 
		echo  $count.' record inserted successfully.';

	 }

}
?>
