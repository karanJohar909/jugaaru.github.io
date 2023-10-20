<?php
session_start();

if (!isset($_SESSION['name'])) {
    header('location: ./index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jugaar</title>

    <link rel="stylesheet" href="./style.css" />
</head>


<?php
$desiredValue = "";

$url = "https://globalportal.mtbc.com/token";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Accept: application/json",
    "Content-Type: application/x-www-form-urlencoded",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "username=WtD5s%2FhSR9TiiEuM9pRs2g%3D%3D&password=password&grant_type=password";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

$resp = curl_exec($curl);
curl_close($curl);

// Parse the JSON response
$responseData = json_decode($resp, true);

	if($resp == "" || $resp == '"error":"unsupported_grant_type"'){
echo "		
			    <div class='alert'>
                    Check your internet conneection!
                </div>	
				<div class='alert'>
                    Wait for sometime then do as instructed below!
                </div>
				<div class='alert'>
                    Refresh the page OR Logout and then login again!
				</div>
				<div class='information'>
					<a href='./logout.php' class='information__button'>Logout</a>
				</div>
		";
		exit;
	}


// Check if the response was successfully parsed and the desired parameter exists
if (isset($responseData['access_token'])) {
    $desiredValue = $responseData['access_token'];
	
	if($desiredValue == "" || $resp == '"error":"unsupported_grant_type"'){
echo "		
				<div class='alert'>	
					Authenticated Failed!
				</div>
			    <div class='alert'>
                    Check your internet conneection!
                </div>	
				<div class='alert'>
                    Wait for sometime then do as instructed below!
                </div>
				<div class='alert'>
                    Refresh the page OR Logout and then login again!
				</div>
				<div class='information'>
					<a href='./logout.php' class='information__button'>Logout</a>
				</div>
		";
		exit;
	}else{
		echo "
			<div class='alert'>
                You Are Authenticated Successfully!
            </div>
		";
	}
	
} else {
echo "			
				<div class='alert'>	
					Authenticated Failed!
				</div>
			    <div class='alert'>
                    Check your internet conneection!
                </div>	
				<div class='alert'>
                    Wait for sometime then do as instructed below!
                </div>
				<div class='alert'>
                    Refresh the page OR Logout and then login again!
				</div>
				<div class='information'>
					<a href='./logout.php' class='information__button'>Logout</a>
				</div>
		";
		exit;
}



?>

<body>
    <div>
        <div class="information">
            <h1 class="information__title">You are logged in as <?= $_SESSION['name'] ?></h1>
            <a href="./logout.php" class="information__button">Logout</a>
        </div>
    </div>
	
	
	    <div class="container" style="padding-top: 50px">
        <div class="homebox">
            <h1 class="box__title">Manage Check In/Out</h1>
            <p class="box__subtitle"></p>			
			
            <?php if (isset($_SESSION["error1"])): ?>
                <div class="alert">
                    Error: Invalid Check In time format. Please use a valid format like 'hh:mm AM' or 'hh:mm PM' (e.g., '09:10 AM').
                </div>
            <?php unset($_SESSION["error1"]);endif; ?>
			
			<?php if (isset($_SESSION["error2"])): ?>
                <div class="alert">
                    Error: Invalid Check In date format. Please use a valid format like 'mm/dd/yyyy' (e.g., '09/16/2023').
                </div>
            <?php unset($_SESSION["error2"]);endif; ?>

			<?php if (isset($_SESSION["error3"])): ?>
                <div class="alert">
                    Authentication Failed. Logout and try again.
                </div>
            <?php unset($_SESSION["error3"]);endif; ?>

			<?php if (isset($_SESSION["error4"])): ?>
                <div class="alert">
                    Error: Check-In Date must be the same as or earlier than Check-Out Date.
                </div>
            <?php unset($_SESSION["error4"]);endif; ?>
			
			<?php if (isset($_SESSION["error5"])): ?>
                <div class="alert">
                    Error: Check-In Time/Date and Check-Out Time/Date got a problem.
                </div>
            <?php unset($_SESSION["error5"]);endif; ?>
			
			<?php if (isset($_SESSION["error6"])): ?>
                <div class="alert">
                    Error: Check your attendance record for any error.
                </div>
            <?php unset($_SESSION["error6"]);endif; ?>
			
			<?php if (isset($_SESSION["error7"])): ?>
                <div class="alert">
                    Error: Contact the Real Jugaari for solution.
                </div>
            <?php unset($_SESSION["error7"]);endif; ?>			

			<?php if (isset($_SESSION["success"])): ?>
                <div class="successAlert">
                    Success: Check-In Time/Date and Check-Out Time/Date added successfully.
                </div>
            <?php unset($_SESSION["success"]);endif; ?>	
			
<form action="./manage.php" method="post" class="form">
    <label for="checkInTime" class="form__label">Check-In Time</label>
    <input type="text" id="checkInTime" class="form__input" placeholder="hh:mm AM or hh:mm PM e.g; 09:10 AM" name="Check_In_Time" required />
    
    <label for="checkInDate" class="form__label">Check-In Date</label>
    <input type="text" id="checkInDate" class="form__input" placeholder="mm/dd/yyyy e.g; 09/16/2023 " name="Check_In_Date" required />
    
    <label for="checkOutTime" class="form__label">Check-Out Time</label>
    <input type="text" id="checkOutTime" class="form__input" placeholder="hh:mm AM or hh:mm PM e.g; 03:10 PM" name="Check_Out_Time" required />
    
    <label for="checkOutDate" class="form__label">Check-Out Date</label>
    <input type="text" id="checkOutDate" class="form__input" placeholder="mm/dd/yyyy e.g; 09/16/2023" name="Check_Out_Date" required />
    <input type="hidden" value="<?php echo $desiredValue; ?>" name="access_token">
    <button class="form__button" type="submit" name="submit">Submit</button>
</form>

			
			
			
        </div>
	
	
	
</body>

</html>