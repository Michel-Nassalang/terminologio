# Termonologio
    On entre dans le dossier du projet et on lance ces commandes
## Installation des packages utilisées avec symfony 
php composer.phar install
## Migration des tables dans la base de donnée
php bin/console doctrine:migrations:migrate
## Lancement du projet 
php -S localhost:8000 -t public/
#### php -S 192.168.76.76:8000 -t public/

### Vous pouvez installer et démarrer le projet en même temps en executant le script start.sh
chmod +x start.sh
./start.sh
###### Avec ce script j'ai créé l'administrateur avec comme identifiant admin.termin@gmail.com avec le mot de passe admin2023 que vous pouvez utiliser pour vous connecter
