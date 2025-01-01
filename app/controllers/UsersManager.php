<?php
namespace controllers;
require_once (__DIR__ . '/../model/Users.php');
use model\Users;
use PDO;
use PDOException;

class UsersManager{
    private static $idUser;

    public static function setIdUSer($idUser){
        self::$idUser=$idUser;
    }
    public static function getIdUser(){
        return self::$idUser;
    }

    public static function isUserExist($email){
    
        return Users::userExists($email);
    }

    public static function getIdByEmail($email){
        return Users::getId($email);
    }

    public static function isUserParamCorrect($email,$password,$role="player"){
        return Users::authenticateUser($email, $password,$role);
    }

    public static function createUser($email,$password){
        try{
            Users::insertUser($email,$password);
        }catch(PDOException $e){
            return false;
        }
        return true;
    }

    public static function deleteUser($idUser){
        return Users::deleteUser($idUser);
    }

    public static function createTableAllUsersHTML(){
        $datas = Users::getAllUsers();
        $html = '<table id="grilleTable">';
        $html .= '<thead>
            <tr>
                <th>N°</th>
                <th>E-mail</th>
                <th>Action</th>
            </tr>
        </thead>';
        $html .='<tbody>';
        foreach($datas as $user){
            $html .= '
                <tr>
                    <td>' . htmlspecialchars($user->idUser) .'</td>
                    <td>' . htmlspecialchars($user->email) .'</td>
                   <td><a href="#" class="del-link"  onclick="deleteUser(' . htmlspecialchars($user->idUser) . ')">supprimer</a></td>
                </tr>
            ';
        }
        $html .='</tbody>';
        $html .= '</table>';
        return $html;
    }

    public static function createRegisterUserHTML(){
     $html = '<div class="form-container" style="width: 50%; margin: 0 auto;">
                <div class="logo">
                    <img src="public/images/sign_in.png" alt="Logo Crucigrille">
                </div>
                <h1>Créer un nouveau compte</h1>
                <form id="inscription-form" >
                    <div class="form-group">
                        <label for="email">Adresse e-mail</label>
                        <input type="email" id="email" name="email" placeholder="Entrez votre adresse e-mail" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" placeholder="Créez un mot de passe" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirmer le mot de passe</label>
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmez votre mot de passe" required>
                    </div>
                    <div id="error-message" class="error hidden">
                        <p>Les mots de passe ne correspondent pas.</p>
                    </div>
                    <button type="submit" id="submit-inscription" class="btn">Ajouter</button>
                </form>
            </div>';
        return $html;
    }
}

?>