<?php
 include('../../test2/Config/config.php');
 $db = config::getInstance();
 $conn = $db->getConnection(); 
//Create table Customer if not exist
 $db->createCustomerTable();
 
 $date = array();
 
 if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['id_number']) && isset($_POST['date_of_birth']) ){

	 	if(iscorrectDate($_POST['date_of_birth'])){

		 	  $dob  = explode('/',$_POST['date_of_birth']);
		 	 
		 	  $newdob = count($dob);
	          $count =0;
		 	  for($i=$newdob-1; $i>=0; $i--){
	               
		 	 	  $date[$count] = $dob[$i]; 
		 	 	  $count++; 
		 	  }
		 	  $newid   = substr($_POST['id_number'], 0,6);
         
              $test = implode('', $date);

              $newdate = substr($test, 2);     
		      // validating date of birth with the ID number
              if($newdate===$newid){

			      $firstName     = mysqli_real_escape_string($conn,$_POST['first_name']);
			      $lastName      = mysqli_real_escape_string($conn,$_POST['last_name']);
			      $idNumber      = mysqli_real_escape_string($conn,$_POST['id_number']);
			      $dateOfBirth   = mysqli_real_escape_string($conn,$_POST['date_of_birth']);    

			      $sql           = "INSERT INTO customer (first_name,last_name,id_number,date_of_birth) VALUES('".$firstName."','".$lastName."','".$idNumber."','".$dateOfBirth."')";
			      $result    = mysqli_query($conn,$sql);

			      if($result){

			      	 echo " Your Information has been captured successfully";

			       } else {
			            
			             //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			    	   echo "Please you are already a member, the ID you entered is already in our system !";
			       }

               }else{


                   echo "Incorrect ID number:"."[".$_POST['id_number']."]"." "."Please enter valid id number !";

               }


	     }else{

            
             echo "Please enter correct date birth in this format dd/mm/yyyy";

	     }  

   }

// function to check formal validity of DD/MM/YYYY,
function iscorrectDate($string) {

  $matches = array();

  $pattern = '/^([0-9]{1,2})\\/([0-9]{1,2})\\/([0-9]{4})$/';

  if (!preg_match($pattern, $string, $matches)) return false;

  if (!checkdate($matches[2], $matches[1], $matches[3])) return false;
      return true;
}


?>