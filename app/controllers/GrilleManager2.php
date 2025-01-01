<?php
namespace controllers;
require_once (__DIR__ . '/../model/Grilles.php');
require_once (__DIR__ . '/../model/Parties.php');
require_once (__DIR__ . '/../model/Cases.php');
require_once (__DIR__ . '/UsersManager.php');
use model\Grilles;
use model\Parties;
use model\Cases;
use controllers\UsersManager;
use model\Definitions;
use PDOException;
use Exception;

class GrilleManager2 {
    private static $idGrille;
    private static $gridName;
    private static $rows;
    private static $cols;
    private static $difficulte;
    private static $publicDate;
    private static $blackCells=[];
    private static $idPartie;
    public static function setDimension($rows,$cols){
        self::$rows = $rows;
        self::$cols = $cols;
        
    }

    public  static function setGridId($idGrille){
        self::$idGrille = $idGrille;
    }

    public static function getGridId(){
        return self::$idGrille;
    }

    public static function getDimension(){
        return [self::$rows, self::$cols]; 
    }

    private static function getDataPublicGrid(){
        return Grilles::getPublicGrids();
    }

    private static function getDataPrivateGrid($idUser){
        return Grilles::getPrivateGridsFor($idUser);
    }

    private static function getGridDatas(){
        return Grilles::getGrilleById(self::getGridId());
    }

    public static function getAllData($idGrille){

        return [self::$gridName,self::$difficulte,self::$publicDate,self::$rows,self::$cols];

    }

    

    public static function initParamsGridFor($idGrille){
        try{
            self::setGridId($idGrille);
            
            $datas = self::getGridDatas();
            if(isset( $datas[0])){
                $grille = $datas[0];

                self::$gridName = $grille->nomGrille;
                self::setDimension($grille->dimX,$grille->dimY);
                self::$difficulte = $grille->difficulte;

                self::$publicDate = $grille->datePublication;

                self::setBlackCells();

                
            }else{
                return false;
            }

        }catch(PDOException $e){
            return false;
        }

    }

    public static function setIdPartie($idPartie){
        self::$idPartie = $idPartie;
    }

    public static function addGrille($nomGrille,$dimX,$dimY,$idUser,$difficulte,$publiee){
        $rc = Grilles::addGrille(
            $nomGrille, 
            $dimX, 
            $dimY, 
            $idUser,   
            $difficulte,
            $publiee
        );
        return Grilles::getLastId();
    }

    public static function addCase($x,$y,$idGrille){
        $rc = Cases::addCase($x,$y,$idGrille);
    }
    public static function updateGrille($idGrille, $nomGrille, $dimX, $dimY, $difficulte, $public) {
        $rc = Grilles::updateGrille(
            $idGrille,
            $nomGrille, 
            $dimX, 
            $dimY,   
            $difficulte,
            $public
        );
    }

    public static function deleteGrid($idGrille){
        return Grilles::deleteGrille($idGrille);
    }

    public static function deleteBlackCases($idGrille){
        $rc=Cases::deleteBlackCases($idGrille);
    }

    private static function getBlackCellsData(){
        return Cases::getBlackCases(self::$idGrille);
    }
    public static function getBlackCells(){
        return self::$blackCells;
    }

    private static function setBlackCells(){
        $datas = self::getBlackCellsData() ?? []; // Assurez-vous que $datas est au moins un tableau vide
        foreach ($datas as $case) {
            $id = $case->idCase;
            $x = (int) $case->positionX; // Convertir en entier au cas où ce soit une chaîne
            $y = (int) $case->positionY; // Convertir en entier
            self::$blackCells[] = [$x, $y,$id];
        }
    }

    private static function isBlackCell($row, $col) {
        
        foreach (self::$blackCells as $cell) {
            if ($cell[0] === $row && $cell[1] === $col) {
                return true;
            }
        }
        return false;
    }

    public static function createTablePublicGridHTML(){
        $datas = self::getDataPublicGrid();
        $html =  '<thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom grille</th>
                        <th>Dimension</th>
                        <th onclick="sortTableByLevel()"><span id="levelSortIcon">&#x25B2;&#x25BC;</span>Niveau</th>
                        <th onclick="sortTableByDate()"><span id="dateSortIcon">&#x25B2;&#x25BC;</span>Date de publication</th>
                        <th>Action</th>
                    </tr>
                </thead>';
        $html .= '<tbody>';
        foreach($datas as $grille){
         
            $html .= '
                <tr>
                    <td>' . htmlspecialchars($grille->idGrille) .'</td>
                    <td>' . htmlspecialchars($grille->nomGrille) .'</td>
                    <td>' . htmlspecialchars($grille->dimX.'X'.$grille->dimY).'</td>
                    <td>' . htmlspecialchars($grille->difficulte) .'</td>
                    <td>' . htmlspecialchars($grille->datePublication).'</td>
                    <td><a href="?p=play&idGrille='.htmlspecialchars($grille->idGrille).'" class="play-link">Jouer</a></td>
                </tr>
            ';
        }
        $html .= '</tbody>';
        return $html;
    }

    public static function createTablePrivateGridHTML($idUser){
        $datas = self::getDataPrivateGrid($idUser);
        
        $html = '<thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom grille</th>
                        <th>Dimension</th>
                        <th onclick="sortTableByLevel()"><span id="levelSortIcon">&#x25B2;&#x25BC;</span>Niveau</th>
                        <th onclick="sortTableByDate()"><span id="dateSortIcon">&#x25B2;&#x25BC;</span>Date de publication</th>
                        <th>Action</th>
                    </tr>
                </thead>';
        $html .= '<tbody>';
        foreach($datas as $grille){
           $droitModif =  (!isset($grille->datePublication))? "?p=edite_grille&idGrille=".htmlspecialchars($grille->idGrille)."" : "#";
            $html .= '
                <tr>
                    <td>' . htmlspecialchars($grille->idGrille) .'</td>
                    <td>' . htmlspecialchars($grille->nomGrille) .'</td>
                    <td>' . htmlspecialchars($grille->dimX.'X'.$grille->dimY).'</td>
                    <td>' . htmlspecialchars($grille->difficulte) .'</td>
                    <td>' . htmlspecialchars($grille->datePublication).'</td>
                   <td><a href="'.$droitModif.'" class="edit-link">Modifier</a> | <a href="#" class="del-link"  onclick="deleteGrid(' . htmlspecialchars($grille->idGrille) . ')">X</a></td>
                </tr>
            ';
        }
        $html .= '</tbody>';
        return $html;
    }


    public static function createTableAllGridHTML(){
        $datas = Grilles::getAllGridData();
        $html = '<table id="grilleTable">';
        $html .= '<thead>
            <tr>
                <th>N°</th>
                <th>Nom grille</th>
                <th>Dimension</th>
                <th onclick="sortTableByLevel()"><span id="levelSortIcon">&#x25B2;&#x25BC;</span>Niveau</th>
                <th onclick="sortTableByDate()"><span id="dateSortIcon">&#x25B2;&#x25BC;</span>Date de publication</th>
                <th>Action</th>
            </tr>
        </thead>';
        $html .='<tbody>';
        foreach($datas as $grille){
            $html .= '
                <tr>
                    <td>' . htmlspecialchars($grille->idGrille) .'</td>
                    <td>' . htmlspecialchars($grille->nomGrille) .'</td>
                    <td>' . htmlspecialchars($grille->dimX.'X'.$grille->dimY).'</td>
                    <td>' . htmlspecialchars($grille->difficulte) .'</td>
                    <td>' . htmlspecialchars($grille->datePublication).'</td>
                   <td><a href="#" class="del-link"  onclick="deleteGrid(' . htmlspecialchars($grille->idGrille) . ')">supprimer</a></td>
                </tr>
            ';
        }
        $html .='</tbody>';
        $html .='</table>';
        return $html;


    }

    public static function getIdGrilleBy($idPartie){
        try{
            $data = Parties::getPartie($idPartie);
            if(isset($data[0]))
                return $data[0]->idGrille;
            else
                return false;
        }catch(Exception $e){
            return false;
        }
    }
    
    public static function createTablePartieHTML($idUser){
        $datasPart = Parties::getPartiesFor($idUser);
        $html =  '<thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom grille</th>
                        <th>Dimension</th>
                        <th onclick="sortTableByLevel()"><span id="levelSortIcon">&#x25B2;&#x25BC;</span>Niveau</th>
                        <th onclick="sortTableByDate()"><span id="dateSortIcon">&#x25B2;&#x25BC;</span>Date Enrégistrement</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>';
        $html .= '<tbody>';
        foreach($datasPart as $partie){
            $dataGrille = Grilles::getGrilleById($partie->idGrille);
            foreach($dataGrille as $grille){
            $html .= '
                <tr>
                    <td>' . htmlspecialchars($grille->idGrille) .'</td>
                    <td>' . htmlspecialchars($grille->nomGrille) .'</td>
                    <td>' . htmlspecialchars($grille->dimX.'X'.$grille->dimY).'</td>
                    <td>' . htmlspecialchars($grille->difficulte) .'</td>
                    <td>' . htmlspecialchars($partie->dateEnregistrement).'</td>
                    <td>' . htmlspecialchars($partie->statut).'</td>
                    <td><a href="?p=play&idPartie='.htmlspecialchars($partie->idPartie).'" class="play-link">Reprendre</a></td>
                </tr>
            ';
            }
        }
        $html .= '</tbody>';
        return $html;
    }

    public static function createGridHTML($withInput = true){
        
        if($withInput){
            $html = '';
            $html .= '<table>';
    
            // Créer la ligne des lettres des colonnes
            $html .= '<tr><th></th>';
            for ($col = 1; $col <= self::$cols; $col++) {
                $html .= '<th>' . chr(96 + $col) . '</th>'; // Lettres de 'a' à 'k'
            }
            $html .= '</tr>';
    
            // Générer les lignes de la grille
            for ($row = 1; $row <= self::$rows; $row++) {
                $html .= '<tr>';
                $html .= '<th>' . $row . '</th>'; // Numéro de ligne
    
                for ($col = 1; $col <= self::$cols; $col++) {
                    
                    if (self::isBlackCell($row, $col)) {
                        $html .= '<td class="black-cell"></td>';
                    } else {
                        // Le nom de l'input est basé sur la position (row_col) pour l'identifier facilement
                        $name =   $row . '_' . $col;
                        $html .= '<td><input type="text" name="' . $name . '" maxlength="1" value="' . 
                            (isset($_POST[$name]) ? htmlspecialchars($_POST[$name]) : '') . 
                            '"></td>';
                    }
                }
    
                $html .= '</tr>';
            }
    
            $html .= '</table>';
        }else{
            $html = '<table>';
             // Créer la ligne des lettres des colonnes
            $html .= '<tr><th></th>';
            for ($col = 1; $col <= self::$cols; $col++) {
                $html .= '<th>' . chr(96 + $col) . '</th>'; // Lettres de 'a' à 'k'
            }
            $html .= '</tr>';
        
            // Générer les lignes de la grille
            for ($row = 1; $row <= self::$rows; $row++) {
                $html .= '<tr>';
                $html .= '<th>' . $row . '</th>'; // Numéro de ligne
        
                for ($col = 1; $col <= self::$cols; $col++) {
                    $id = 'cell_' . $row . '_' . $col; // ID unique pour chaque cellule
                     if (!self::isBlackCell($row, $col)) 
                        $html .= '<td id="' . $id . '" class="white-cell"></td>';
                    else
                      
                        $html .= '<td class="black-cell"></td>';
                    
                }
        
                $html .= '</tr>';
            }
        
            $html .= '</table>';
        
        }
        return $html;
    }

    public static function createGridPartieHTML(){
        $dataPartie = Parties::getPartie(self::$idPartie);
        $contenu= json_decode($dataPartie[0]->contenu, true);;

        $html = '';
            $html .= '<table>';
    
            // Créer la ligne des lettres des colonnes
            $html .= '<tr><th></th>';
            for ($col = 1; $col <= self::$cols; $col++) {
                $html .= '<th>' . chr(96 + $col) . '</th>'; // Lettres de 'a' à 'k'
            }
            $html .= '</tr>';
    
            // Générer les lignes de la grille
            for ($row = 1; $row <= self::$rows; $row++) {
                $html .= '<tr>';
                $html .= '<th>' . $row . '</th>'; // Numéro de ligne
    
                for ($col = 1; $col <= self::$cols; $col++) {
                    
                    if (self::isBlackCell($row, $col)) {
                        $html .= '<td class="black-cell"></td>';
                    } else {
                        // Le nom de l'input est basé sur la position (row_col) pour l'identifier facilement
                        $name =   $row . '_' . $col;
                        $html .= '<td><input type="text" name="' . $name . '" maxlength="1" value="' . 
                            (isset($contenu[$name]) ? htmlspecialchars($contenu[$name]) : '') . 
                            '"></td>';
                    }
                }
    
                $html .= '</tr>';
            }
    
            $html .= '</table>';

            return $html;

    }



    public static function verifierGrille($inputData) {
        $grille = [];
        $casesNoires = $inputData['blackCells'];
        $definitions = [
            'VERTICAL' => $inputData['verticalDefs'],
            'HORIZONTAL' => $inputData['horizontalDefs']
        ];
    
        // Marquer les cases noires
        foreach ($casesNoires as $case) {
            $grille["{$case['x']},{$case['y']}"] = 'NOIRE';
        }
    
        // Vérifier les définitions
        foreach ($definitions as $orientation => $defs) {
            foreach ($defs as $def) {
                $x = $def['posX'];
                $y = ord($def['posY']) - 96; // Convertir 'a', 'b', etc. en numéros
                $solution = $def['solution'];
    
                for ($i = 0; $i < strlen($solution); $i++) {
                    $case = "$x,$y";
    
                    // Vérifier si la case est une case noire
                    if (isset($grille[$case]) && $grille[$case] === 'NOIRE') {
                        throw new Exception("Erreur : La définition traverse une case noire en $case.");
                    }
    
                    // Vérifier les intersections
                    if (isset($grille[$case]) && $grille[$case] !== $solution[$i]) {
                        throw new Exception("Erreur : Conflit de lettres en $case (\"{$grille[$case]}\" vs \"{$solution[$i]}\").");
                    }
    
                    // Marquer la case avec la lettre
                    $grille[$case] = $solution[$i];
    
                    // Passer à la case suivante
                    if ($orientation === 'HORIZONTAL') {
                        $y++;
                    } else { // VERTICAL
                        $x++;
                    }
                }
            }
        }
    }
    

    public static function savePartie($contenu,$statut,$idGrille,$idAuteur){
       return Parties::savePartie($contenu,$statut,$idGrille,$idAuteur);
    }
    
}

?>