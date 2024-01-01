#!/bin/bash

# Installer les packages avec Composer
php composer.phar install

# Migrer les tables dans la base de données
php bin/console doctrine:migrations:migrate

# Ajout de l'administrateur
php admin.php

# Lancer le projet
php -S 192.168.76.76:8000 -t public/
