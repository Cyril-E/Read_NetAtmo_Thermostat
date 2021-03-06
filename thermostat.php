<?php

// Cyril E      http://www.ituilerie.com
// Script inspiré du script de la station meteo par Cédric Locqueneux. http://maison-et-domotique.com


$password='xxxxxxx';
$username='xxxxxxx';

$app_id = 'xxxxxxx';
$app_secret = 'xxxxxxx';

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

$url_thermostat1="http://api.netatmo.net/api/getthermstate?access_token=" .  $params['access_token']."&device_id=".$device1."&module_id=".$module1;
$value_thermostat1= file_get_contents($url_thermostat1);
$json_mesures_thermostat1 = json_decode($value_thermostat1, true);
$temperature_thermostat1 = $json_mesures_thermostat1["body"]["measured"]["temperature"];
$run_thermostat1 = $json_mesures_thermostat1["body"]["therm_relay_cmd"];
$setpoint_thermostat1=$json_mesures_thermostat1["body"]["measured"]["setpoint_temp"];

$url_thermostat2="http://api.netatmo.net/api/getthermstate?access_token=" .  $params['access_token']."&device_id=".$device2."&module_id=".$module2;
$value_thermostat2= file_get_contents($url_thermostat2);
$json_mesures_thermostat2 = json_decode($value_thermostat2, true);
$temperature_thermostat2 = $json_mesures_thermostat2["body"]["measured"]["temperature"];
$run_thermostat2 = $json_mesures_thermostat2["body"]["therm_relay_cmd"];
$setpoint_thermostat2=$json_mesures_thermostat2["body"]["measured"]["setpoint_temp"];

$url_thermostat3="http://api.netatmo.net/api/getthermstate?access_token=" .  $params['access_token']."&device_id=".$device3."&module_id=".$module3;
$value_thermostat3= file_get_contents($url_thermostat3);
$json_mesures_thermostat3 = json_decode($value_thermostat3, true);
$temperature_thermostat3 = $json_mesures_thermostat3["body"]["measured"]["temperature"];
$run_thermostat3 = $json_mesures_thermostat3["body"]["therm_relay_cmd"];
$setpoint_thermostat3=$json_mesures_thermostat3["body"]["measured"]["setpoint_temp"];

echo '<?xml version="1.0" encoding="utf8" ?>';
echo "<netatmo>";
echo "<Temp_Thermo_1>" . $temperature_thermostat1   . "</Temp_Thermo_1>";
echo "<Etat_Thermo_1>" . $run_thermostat1   . "</Etat_Thermo_1>";             // Etat du thermostat, 0 chaudiere a l'arret, 100 chaudiere en marche
echo "<Consigne_Thermo_1>" . $setpoint_thermostat1   . "</Consigne_Thermo_1>";
echo "<Temp_Thermo_2>" . $temperature_thermostat2   . "</Temp_Thermo_2>";
echo "<Etat_Thermo_2>" . $run_thermostat2   . "</Etat_Thermo_2>";
echo "<Consigne_Thermo_2>" . $setpoint_thermostat2   . "</Consigne_Thermo_2>";
echo "<Temp_Thermo_3>" . $temperature_thermostat3   . "</Temp_Thermo_3>";
echo "<Etat_Thermo_3>" . $run_thermostat3   . "</Etat_Thermo_3>";
echo "<Consigne_Thermo_3>" . $setpoint_thermostat3   . "</Consigne_Thermo_3>";
echo "</netatmo>";

?>