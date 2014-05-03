Read_NetAtmo_Thermostat
=======================

Lecture des données du thermostat NetAtmo

Ce script permet la lecture des données du thermostat NetAtmo

Le script est prevu pour 3 thermostats

Il retourne la temprature actuelle au thermostat et l'etat de la chaudiere (marche ou arret) et la consigne appliqué au thermostat (temperature)


Pour l'etat de la chaudiere, la valeur retourné est soit 0 soit 100, 0 => Chaudiere a l'arret      100=> Chaudiere en marche

Pour la consigne, si la valeur retourné est 0 cela signifie que le thermostat est sur OFF, parfois la consigne met plusieur minute avant de retourner la bonne valeur