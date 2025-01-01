<?php
    namespace model;
    // require_once '../app/App.php';
    require_once (__DIR__ . '/../config/App.php');
    use config\App;

    class Users
    {
        public static function getAllUsers() 
        {
            // Exécuter la requête pour récupérer tous les utilisateurs
            $data = App::getDb()->query('SELECT * FROM Users', __CLASS__);
    
            return $data;
        }

        public static function insertUser($email, $motDePasse, $isPlayer = true)
        {
            // Hachage du mot de passe pour plus de sécurité
            $hashedPassword = password_hash($motDePasse, PASSWORD_DEFAULT);
            
            // Exécuter la requête d'insertion
            $query = 'INSERT INTO Users (email, motDePasse, isPlayer) VALUES (?, ?, ?)';
            
            return App::getDb()->prepare($query, [$email, $hashedPassword, $isPlayer],__CLASS__);
        }

        public static function getId($email)
        {
            // Requête pour récupérer l'ID de l'utilisateur à partir de l'email
            $query = 'SELECT idUser FROM Users WHERE email = ?';
            
            // Préparer et exécuter la requête
            $db = App::getDb();
            $stmt = $db->prepare($query, [$email], __CLASS__);
            
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

        public static function userExists($email)
        {
            // Vérifier si un utilisateur avec l'email donné existe dans la base de données
            $query = 'SELECT COUNT(*) AS nbUser FROM Users WHERE email = ?';
            
            $result = App::getDb()->prepare($query, [$email],__CLASS__);
            
            return $result[0]->nbUser > 0;
        }

        public static function authenticateUser($email, $motDePasse,$role)
        {
            if ($role!="admin")
                $query = 'SELECT * FROM Users WHERE email = ? and isPlayer="1"';
            else
                $query = 'SELECT * FROM Users WHERE email = ? and isPlayer="0"';
            $user = App::getDb()->prepare($query, [$email],__CLASS__);
            if ($user&&password_verify($motDePasse, $user[0]->motDePasse)) {
                return true;
            } 
            return false; // Retourne false si l'authentification échoue
            
        }
    
    }

    
?>
