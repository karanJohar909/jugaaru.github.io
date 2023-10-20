<?php 
session_start();

if (!isset($_SESSION['name'])) {
    header('location: ./index.php');
    exit;
}

$Check_In_Time = isset($_POST['Check_In_Time']) ? $_POST['Check_In_Time'] : "";
$Check_In_Date = isset($_POST['Check_In_Date']) ? $_POST['Check_In_Date'] : "";
$Check_Out_Time = isset($_POST['Check_Out_Time']) ? $_POST['Check_Out_Time'] : "";
$Check_Out_Date = isset($_POST['Check_Out_Date']) ? $_POST['Check_Out_Date'] : "";
$access_token = isset($_POST['access_token']) ? $_POST['access_token'] : "";


if($access_token == "" ){
	$_SESSION['error3'] = true;
	header('location: ./home.php');
	exit;
}


$checkInTime = $Check_In_Time; 
$checkInDate = $Check_In_Date; 
$checkOutTime = $Check_Out_Time;
$checkOutDate = $Check_Out_Date;


// Define a regular expression pattern to match the time format with uppercase AM/PM
$timePattern = "/^(0[1-9]|1[0-2]):[0-5][0-9] (AM|PM)$/";

// Define a regular expression pattern to match the date format
$datePattern = "/^(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])\/\d{4}$/";

// Convert the date strings to timestamps
$checkInTimestamp = strtotime($checkInDate);
$checkOutTimestamp = strtotime($checkOutDate);

if (!preg_match($timePattern, $checkInTime)) {
    
    $_SESSION['error1'] = true;
    header('location: ./home.php');
    exit;
} 
elseif (!preg_match($datePattern, $checkInDate)) {
    $_SESSION['error2'] = true;
    header('location: ./home.php');
    exit;
}
elseif (!preg_match($timePattern, $checkOutTime)) {
    $_SESSION['error1'] = true;
    header('location: ./home.php');
    exit;
}
elseif (!preg_match($datePattern, $checkOutDate)){
	$_SESSION['error2'] = true;
    header('location: ./home.php');
    exit;
}
elseif ($checkInTimestamp > $checkOutTimestamp) {
    $_SESSION['error4'] = true;
    header('location: ./home.php');
    exit;
} else {
    if($_SESSION['name'] == "hell@saMYeah$23"){

		$url = "https://globalportal.mtbc.com/api/timeandabsence/updateCheckInOut";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$headers = array(
			"Accept: application/json",
			"Content-Type: application/json",
			"Authorization: Bearer $access_token",
		);

		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		// First attempt data
		$data1 = '{
			"checkChangedFlag": false,
			"checkType": "0",
			"checkInDate": "' . $Check_In_Date . '",
			"checkInTime": "' . $Check_In_Time . '",
			"checkOutDate": "",
			"checkOutTime": "",
			"reason": ".",
			"flag": "add",
			"empID": "15011",
			"officeName": "MTBC-ISB"
		}';

		// Second attempt data
		$data2 = '{
			"checkChangedFlag": false,
			"checkType": "1",
			"checkInDate": "",
			"checkInTime": "",
			"checkOutDate": "' . $Check_Out_Date . '",
			"checkOutTime": "' . $Check_Out_Time . '",
			"reason": ".",
			"flag": "add",
			"empID": "15011",
			"officeName": "MTBC-ISB"
		}';

		// First attempt
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data1);
		$resp1 = curl_exec($curl);

		// Second attempt
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data2);
		$resp2 = curl_exec($curl);

		curl_close($curl);
		
		$result1 = trim($resp1, '"');
		$result2 = trim($resp2, '"');
		
		if($result1 == "add entry succeeded" && $result2 == "add entry succeeded" ){
				
				$_SESSION['success'] = true;
				header('location: ./home.php');
				exit;
		}
		else{
				$_SESSION['error5'] = true;
				$_SESSION['error6'] = true;
				$_SESSION['error7'] = true;
				header('location: ./home.php');
				exit;
		}
		
		
	}
	
	    if($_SESSION['name'] == "so&Cool#reHduDe@45"){

		$url = "https://globalportal.mtbc.com/api/timeandabsence/updateCheckInOut";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$headers = array(
			"Accept: application/json",
			"Content-Type: application/json",
			"Authorization: Bearer $access_token",
		);

		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		// First attempt data
		$data1 = '{
			"checkChangedFlag": false,
			"checkType": "0",
			"checkInDate": "' . $Check_In_Date . '",
			"checkInTime": "' . $Check_In_Time . '",
			"checkOutDate": "",
			"checkOutTime": "",
			"reason": ".",
			"flag": "add",
			"empID": "13817",
			"officeName": "MTBC-ISB"
		}';

		// Second attempt data
		$data2 = '{
			"checkChangedFlag": false,
			"checkType": "1",
			"checkInDate": "",
			"checkInTime": "",
			"checkOutDate": "' . $Check_Out_Date . '",
			"checkOutTime": "' . $Check_Out_Time . '",
			"reason": ".",
			"flag": "add",
			"empID": "13817",
			"officeName": "MTBC-ISB"
		}';

		// First attempt
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data1);
		$resp1 = curl_exec($curl);
		
		// Second attempt
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data2);
		$resp2 = curl_exec($curl);

		curl_close($curl);

		$result1 = trim($resp1, '"');
		$result2 = trim($resp2, '"');
		
		if($result1 == "add entry succeeded" && $result2 == "add entry succeeded" ){
				
				$_SESSION['success'] = true;
				header('location: ./home.php');
				exit;
		}
		else{
				$_SESSION['error5'] = true;
				$_SESSION['error6'] = true;
				$_SESSION['error7'] = true;
				header('location: ./home.php');
				exit;
		}
		
		
	}
} 
 

?>