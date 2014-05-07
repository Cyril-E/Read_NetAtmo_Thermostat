Read_NetAtmo_Thermostat
=======================
Cyril E      http://www.ituilerie.com


Lecture des données du thermostat NetAtmo

Ce script permet la lecture des données du thermostat NetAtmo

Le script est prevu pour 3 thermostats

Il retourne la temprature actuelle au thermostat et l'etat de la chaudiere (marche ou arret) et la consigne appliqué au thermostat (temperature) sous forme d'un XML

Pour l'etat de la chaudiere, la valeur retourné est soit 0 soit 100, 
0 => Chaudiere a l'arret      
100=> Chaudiere en marche

Pour la consigne, si la valeur retourné est 0 cela signifie que le thermostat est sur OFF, parfois la consigne met plusieur minute avant de retourner la bonne valeur



Configuration :
sur les premieres lignes remplacer les xxx par vos données
pour le app_id et app_secret vous les obtiendrer en vous enregistrant sur la page http://dev.netatmo.com/   puis en creant une application

$password='xxxxxxx';
$username='xxxxxxx';

$app_id = 'xxxxxxx';
$app_secret = 'xxxxxxx';