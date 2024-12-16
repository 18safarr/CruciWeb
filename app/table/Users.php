<?php
    namespace app\table;
    // require_once '../app/App.php';
    require_once (__DIR__ . '/../App.php');
    use app\App;

    class Users
    {
        public static function getAllUsers() 
        {
            // Exécuter la requête pour récupérer tous les utilisateurs
            $data = App::getDb()->query('SELECT * FROM Users', __CLASS__);
    
            return $data;
        }

        public static function insertUser($identifiant, $motDePasse, $isPlayer = true)
        {
            // Hachage du mot de passe pour plus de sécurité
            $hashedPassword = password_hash($motDePasse, PASSWORD_DEFAULT);
            
            // Exécuter la requête d'insertion
            $query = 'INSERT INTO Users (identifiant, motDePasse, isPlayer) VALUES (?, ?, ?)';
            
            return App::getDb()->prepare($query, [$identifiant, $hashedPassword, $isPlayer],__CLASS__);
        }

        public static function getId($identifiant)
        {
            // Requête pour récupérer l'ID de l'utilisateur à partir de l'identifiant
            $query = 'SELECT idUser FROM Users WHERE identifiant = ?';
            
            // Préparer et exécuter la requête
            $db = App::getDb();
            $stmt = $db->prepare($query, [$identifiant], __CLASS__);
            
            // Vérifier si un utilisateur a été trouvé
            if ($stmt) {
                // Récupérer l'ID de l'utilisateur
                $result = $stmt[0];
                return $result->idUser;
            } else {
                // Si aucun utilisateur n'est trouvé, retourner null ou une autre valeur par défaut
                return null;
            }
        }


        public static function deleteUser($idUser)
        {
            // Exécuter la requête de suppression d'un utilisateur par idUser
            $query = 'DELETE FROM Users WHERE idUser = ?';
            
            return App::getDb()->prepare($query, [$idUser]);
        }

        public static function deleteAllUsers()
        {
            // Exécuter la requête de suppression de tous les utilisateurs
            $query = 'DELETE FROM Users';
            
            return App::getDb()->execute($query);
        }

        public static function userExists($identifiant)
        {
            // Vérifier si un utilisateur avec l'identifiant donné existe dans la base de données
            $query = 'SELECT COUNT(*) FROM Users WHERE identifiant = ?';
            
            $result = App::getDb()->prepare($query, [$identifiant],__CLASS__);
            
            return $result["COUNT(*)"] > 0;
        }

        public static function authenticateUser($identifiant, $motDePasse)
        {
            // Récupérer l'utilisateur correspondant à l'identifiant
            $query = 'SELECT * FROM Users WHERE identifiant = ?';
            $user = App::getDb()->prepare($query, [$identifiant],__CLASS__);
            if ($user&&password_verify($motDePasse, $user[0]->motDePasse)) {
                return true;
            } 
            return false; // Retourne false si l'authentification échoue
            
        }
    
    }

    
?>
