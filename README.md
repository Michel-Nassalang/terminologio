# Termonologio
    On entre dans le dossier du projet et on lance ces commandes
## Installation des packages utilisées avec symfony 
php composer.phar install
## Migration des tables dans la base de donnée
php bin/console doctrine:migrations:migrate
## Lancement du projet 
php -S localhost:8000 -t public/
#### php -S 192.168.76.76:8000 -t public/
