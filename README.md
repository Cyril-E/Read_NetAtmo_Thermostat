Read_NetAtmo_Thermostat
=======================
Cyril E      http://www.ituilerie.com


Lecture des données du thermostat NetAtmo

Ce script permet la lecture des données du thermostat NetAtmo

Le script est prévu pour 3 thermostats

Il retourne la température actuelle au thermostat et l'état de la chaudière (marche ou arrêt) et la consigne appliqué au thermostat (température) sous forme d'un XML

Pour l'état de la chaudière, la valeur retourné est soit 0 soit 100,
0 => Chaudière a l'arrêt
100=> Chaudière en marche

Pour la consigne, si la valeur retourné est 0 cela signifie que le thermostat est sur OFF, parfois la consigne met plusieurs minute avant de retourner la bonne valeur

Configuration : sur les premières lignes remplacer les xxx par vos données pour le app_id et app_secret vous les obtiendrez en vous enregistrant sur la page http://dev.netatmo.com/ puis en créant une application
$password='xxxxxxx'; $username='xxxxxxx';
$app_id = 'xxxxxxx'; $app_secret = 'xxxxxxx';