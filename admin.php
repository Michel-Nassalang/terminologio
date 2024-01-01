<?php

// Paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'projet';
$user = 'projet';
$password = 'tejorp';

// Informations de l'utilisateur à ajouter
$email = 'admin.termin@gmail.com';
$roles = '["ROLE_ADMIN"]';
$passwordHash = '$2y$13$1TtE.PgmNXa28sZX2kob5essBWD/yWzufXzjrQ3EdQedWsjgCZBEW';
$nom = 'admin';
$pseudo = 'admin';

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour ajouter l'utilisateur
    $sql = "INSERT INTO membre (email, roles, password, nom, pseudo) 
            VALUES (:email, :roles, :password, :nom, :pseudo)";

    // Préparation de la requête
    $stmt = $pdo->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':roles', $roles);
    $stmt->bindParam(':password', $passwordHash);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':pseudo', $pseudo);

    // Exécution de la requête
    $stmt->execute();

    echo "Utilisateur ajouté avec succès.";

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

?>
