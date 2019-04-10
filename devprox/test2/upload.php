<?php
include "insert.php";

if (isset($_FILES['fileName']['name'])) {
  
    if (0 < $_FILES['fileName']['error']) {
        echo 'Error during file upload' . $_FILES['fileName']['error'];
    }else {

          $allowed  = array("csv" => "text/csv");
          //$fileName = time().'_'.$_FILES['fileName']['name'];
          $filename = $_FILES["fileName"]["name"];
          $filetype = $_FILES["fileName"]["type"];
          $filesize = $_FILES["fileName"]["size"];

          // check file extension
          $extenstion = pathinfo($filename, PATHINFO_EXTENSION);
          if(!array_key_exists($extenstion, $allowed)) die("Error: Please upload only csv files.");

          // check file size - 5MB maximum
          $maxsize = 50 * 1024 * 1024;
          if($filesize > $maxsize) die("Error: File size is larger than $maxsize.");        

        if (file_exists('../test2/src/uploads/' . $_FILES['fileName']['name'])) {
            echo 'File already exists : ../test2/src/uploads/' . $_FILES['fileName']['name'];
        } else {
            move_uploaded_file($_FILES['fileName']['tmp_name'], '../test2/src/uploads/' . $_FILES['fileName']['name']);
            echo 'File successfully uploaded : ../test2/src/uploads/' . $_FILES['fileName']['name'];
            //import record to database
            $csv = new devprox_csv();
            $filePath = "../test2/src/uploads/$filename";
            $csv->import_csv_to_db($filePath);
        }
    }
} else {
    echo 'Please choose a file';
}
    
/* 
 * End of script
 */