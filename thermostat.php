<?php

// Cyril E      http://www.ituilerie.com
// Script inspiré de celui de Cédric Locqueneux. http://maison-et-domotique.com

$password='xxxxxx';
$username='xxxxxxx';

if (isset($_GET['box']))
{
    $box=$_GET['box'];
}

$app_id = 'xxxxxxxxxx';
$app_secret = 'xxxxxxxxxxxx';

$token_url = "https://api.netatmo.net/oauth2/token";
$postdata = http_build_query(
        array(
            'grant_type' => "password",
            'client_id' => $app_id,
            'client_secret' => $app_secret,
            'username' => $username,
            'password' => $password,
            'scope' => 'read_station read_thermostat write_thermostat'
    )
);

$opts = array('http' =>
	array(
		'method'  => 'POST',
		'header'  => 'Content-type: application/x-www-form-urlencoded',
		'content' => $postdata
	)
);

$context  = stream_context_create($opts);
$response = file_get_contents($token_url, false, $context);

$params = null;
$params = json_decode($response, true);
$api_url = "https://api.netatmo.net/api/getuser?access_token=" . $params['access_token']."&app_type=app_thermostat";
$requete = @file_get_contents($api_url);

$url_devices = "https://api.netatmo.net/api/devicelist?access_token=" .  $params['access_token']."&app_type=app_thermostat";
$resulat_device = @file_get_contents($url_devices);	

$json_devices = json_decode($resulat_device,true);

$device1 = $json_devices["body"]["devices"][0]["_id"];
$module1 = $json_devices["body"]["modules"][0]["_id"];
$device2 = $json_devices["body"]["devices"][1]["_id"];
$module2 = $json_devices["body"]["modules"][1]["_id"];
$device3 = $json_devices["body"]["devices"][2]["_id"];
$module3 = $json_devices["body"]["modules"][2]["_id"];

echo "<br /> Data : " . $device1   . "<br />";
echo "<br /> Data : " . $module1   . "<br />";
echo "<br /> Data : " . $device2   . "<br />";
echo "<br /> Data : " . $module2   . "<br />";
echo "<br /> Data : " . $device3   . "<br />";
echo "<br /> Data : " . $module3   . "<br />";


$url_thermostat1="http://api.netatmo.net/api/getthermstate?access_token=" .  $params['access_token']."&device_id=".$device1."&module_id=".$module1;
$value_thermostat1= file_get_contents($url_thermostat1);

	$json_mesures_thermostat1 = json_decode($value_thermostat1, true);
	$temperature_additionnel1 = $json_mesures_thermostat1[3]["measured"][2]["temperature"][0];
	$co2_additionnel1 = $json_mesures_thermostat1["measured"][0]["temperature"][0][1];
	$humidite_additionnel1 = $json_mesures_thermostat1["therm_relay_cmd"];

echo "<br />";
echo "<br />";


var_dump(json_decode($value_thermostat1));
echo "<br />";
echo "<br />";
var_dump(json_decode($value_thermostat1, true));

echo "<br />";
echo "<br /> Data2 : " . $value_thermostat1   . "<br />";
echo "<br /> Data2 : " . $json_mesures_thermostat1   . "<br />";

echo "<br /> Data2 : " . $temperature_additionnel1   . "<br />";
echo "<br /> Data2 : " . $co2_additionnel1   . "<br />";
echo "<br /> Data2 : " . $humidite_additionnel1   . "<br />";


?>
