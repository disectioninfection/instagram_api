<!-- CLIENT ID	e08ce2df8ef543ff9225ec4a797dd8b9
CLIENT SECRET	95aefc70205c446ab28d5623342313f1
WEBSITE URL	http://localhost/appacademyapi/index.php
REDIRECT URI	http://localhost/appacademyapi/index.php
 -->

<?php  
//Configuraton for our php Server
set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();

//Make constants using define
define('clientID','e08ce2df8ef543ff9225ec4a797dd8b9');
define('clientSecret','95aefc70205c446ab28d5623342313f1');
define('redirectURI', 'http://localhost/appacademyapi/index.php');
define('ImageDirectory', 'pics/');

//function that is going ot connect ot instagram
function connecttToInsagram($url){
	$ch = curl_init();

	curl_setopt_array($ch, array(
		CURLOPT_URL => $url;
		CURLOPT_RETURNTRANSFER => true;
		CURLOPT_SSL_VERIFYPEER => false;
		CURLOPT_SSL_VERIFYHOST =>2;
	));
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}


//isset function//
if (isset($_GET['code'])){
	$code = $_GET['code'];
	$url = 'https://api.instagram.com/oauth/access_token';
	$access_token_settings = array('client_id' => clientID,
									'client_secret' => clientSecret,
									'grant_type' => 'authorization_code',
									'redirect_uri' => redirectURI,
									'code' => $code
									);
//cURL is what  we se in php, it's a library calls to the other API's.
$curl = curl_init($url); //setting a cURL session and we put in $url because that's where we are getting the data from 
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_settings);//setting the POSTFIELDS to the array setup that we created
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//setting it equal to 1 because we are gettting strongs back
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//but in live workd-prodution we want to set this to true

// $user = 'clientID';

$result = curl_exec($curl);
curl_close($curl);

$results = json_decode($result, true);
echo $results['user']['username'];
}
else{
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MY INSTAGRAMMY THING</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="author" href="humans.txt">
<!-- 	<link rel="stylesheet" type="text/css" href="css/main.css"> -->
</head>
<body class="body-class">
<!-- Creating a login for people to go and give approval for our web app to access their Instagram account 
	After getting approval we are now going to have the information so that we can play with it
-->
<div align="center">
<div class="login-button-div">
<div class="login-button-other-div">
<a href="https:api.instagram.com/oauth/authorize/?client_id=<?php echo clientID;?>&redirect_uri=<?php echo redirectURI;?>&response_type=code"class="login-button">Login!</a>
</div>
</div>
</div>

<script type="js/main.js"></script>
</body>
</html>
<?php 
}
 ?>