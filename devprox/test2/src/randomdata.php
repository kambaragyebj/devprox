<?php


class RandomData {

	static $customer = array(); 

	static $config = array('birthdate'=>array('min'=>1,'max'=>60));

	public static function configName($options) {

		if (is_array($options)) {
			self::$customer= $options;
	
		}
	}
  
	public static function getLastName() {

		if(count(self::$customer)==0) 

			return '';

		if(!isset(self::$customer['lastnames']) or !is_array(self::$customer['lastnames'])) return '';

		$countR = mt_rand(0, count(self::$customer['lastnames'])-1);
		
		$result = self::$customer['lastnames'][$countR];

		if(!empty(self::$customer) && is_callable(self::$customer))
		  $result = call_user_func(self::$customer, $result);
		return $result;
	}

	public static function getFirstName() {
		
		if(count(self::$customer)==0) return '';
	  
		if(!isset(self::$customer['firstnames']) or !is_array(self::$customer['firstnames'])) return '';
		$countR = mt_rand(0, count(self::$customer['firstnames'])-1);
		$result = self::$customer['firstnames'][$countR];

		return $result;

	}

	public static function getInitial($firstname) {

		$firstnames = explode(' ',$firstname);
		$initials = '';
		for($i=0;$i<count($firstnames);$i++){
		   $initials .= substr(trim($firstnames[$i]),0,1);

		}

		return $initials;

	}
	public static function getAge($dob) {

		$date = new DateTime($dob);
		$now = new DateTime();
		$interval = $now->diff($date);
		
		return $interval->y;

	}


	public static function getRandomDate($min_years=NULL, $max_years=NULL, $datefmt=false, $fromdate = null) {

		if (!$datefmt) $datefmt = 'Y-m-d';
		if (!$fromdate) $fromdate = date('Y-m-d');

		list($year, $mon, $day) = preg_split("/[\s,-\/\.\:]+/",$fromdate);
		if ($datefmt === 'd.m.Y') {$tmp = $year; $year = $day; $day = $year; }

		if ($min_years === NULL) $min_years = self::$config['birtdate']['min'];
		if ($max_years === NULL) $max_years = self::$config['birtdate']['max'];
		$max_years = max($min_years+0.01,$max_years);

		$outyr = $year - rand($min_years, $max_years);
		$outmo = rand(1,12);

		if ($outmo == 2) $outdy = rand(1,28);
		elseif (in_array($outmo, array(2,4,6,9,11))) $outdy = rand(1,30);
		else $outdy = rand(1,31);
		if ($outyr == $year) {
			$outmo = min($outmo, $mon);
			if ($outmo == $mon) $outdy = rand(1,$day);
		}
		$outmo = sprintf('%1$02d',$outmo);
		$outdy = sprintf('%1$02d',$outdy);
		$result = str_replace(array('Y','m','d'), array($outyr,$outmo,$outdy), $datefmt);
		return $result;
	}
	public static function arrayToCsv($data, $delimiter = ',', $enclosure = '')
	{  
		$csv_filename = __DIR__.'/output/output'.".csv";
        $header=['Name','Surname','Initial','Age','DateOfBirth'];
		// Open a memory "file" for read/write
		$createFile = fopen($csv_filename, 'w');

		if ($createFile != false)  
        {
        	foreach ($data as $line) {

			if ($header)
			{   
				fputcsv($createFile,$header);
				$header=FALSE;
			}

		   //Write the array to the target file using fputcsv()
			 fputcsv($createFile, $line);
		    }
 
			rewind($createFile);
		   
			$data = fread($createFile, 1048576);
			fclose($createFile);
			// Ad line break and return the data
			return rtrim($data, "\n");

        }else{

            echo "File failed to open Error";

        }

		
	}


}