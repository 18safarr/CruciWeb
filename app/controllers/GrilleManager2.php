<?php
namespace controllers;
require_once (__DIR__ . '/../model/Grilles.php');
require_once (__DIR__ . '/../model/Cases.php');
require_once (__DIR__ . '/UsersManager.php');
use model\Grilles;
use model\Cases;
use controllers\UsersManager;

class GrilleManager2 {
    private static $idGrille;
    private static $gridName;
    private static $rows;
    private static $cols;
    private static $publicDate;
    private static $blackCells=[];

    public static function setDimension($rows,$cols){
        self::$rows = $rows;
        self::$cols = $cols;
        
    }

    private  static function setGridId($idGrille){
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

    public static function initParamsGridFor($idGrille){
        self::setGridId($idGrille);
        $datas = self::getGridDatas();
      
        $grille = $datas[0];

        self::$gridName = $grille->nomGrille;
        self::setDimension($grille->dimX,$grille->dimY);

        self::$publicDate = $grille->datePublication;

        self::setBlackCells();

    }

    private static function getBlackCellsData(){
        return Cases::getCasesByIdGrille(self::$idGrille);
    }
    public static function getBlackCells(){
        return self::$blackCells;
    }

    private static function setBlackCells(){
        $datas = self::getBlackCellsData() ?? []; // Assurez-vous que $datas est au moins un tableau vide
        foreach ($datas as $case) {
            $x = (int) $case->positionX; // Convertir en entier au cas où ce soit une chaîne
            $y = (int) $case->positionY; // Convertir en entier
            self::$blackCells[] = [$x, $y]; // Ajouter la position (x, y) au tableau
        }
    }

    private static function isBlackCell($row, $col) {
        
        foreach (self::$blackCells as $cell) {
            if ($cell[0]-1 === $row && $cell[1]-1 === $col) {
                return true;
            }
        }
        return false;
    }

    public static function createTablePublicGridHTML(){
        $datas = self::getDataPublicGrid();
        $html = '';
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
        return $html;
    }

    public static function createTablePrivateGridHTML($idUser){
        $datas = self::getDataPrivateGrid($idUser);
        
        $html ='';
        foreach($datas as $grille){
            $html .= '
                <tr>
                    <td>' . htmlspecialchars($grille->idGrille) .'</td>
                    <td>' . htmlspecialchars($grille->nomGrille) .'</td>
                    <td>' . htmlspecialchars($grille->dimX.'X'.$grille->dimY).'</td>
                    <td>' . htmlspecialchars($grille->difficulte) .'</td>
                    <td>' . htmlspecialchars($grille->datePublication).'</td>
                   <td><a href="#" class="edit-link">Modifier</a> | <a href="#" class="del-link">X</a></td>
                </tr>
            ';
        }
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
                        $name = 'cell_' . $row . '_' . $col;
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
        
                    // Par défaut, toutes les cellules sont blanches
                    $html .= '<td id="' . $id . '" class="white-cell"></td>';
                }
        
                $html .= '</tr>';
            }
        
            $html .= '</table>';
        
        }
        return $html;
    }

    private static function createSelectorHTML($type, $count) {
        // Identifier si le type est "y" (colonnes) ou "x" (lignes)
        $html = '<select class="def-num" id="pos-' . $type . '">';
        for ($i = 1; $i <= $count; $i++) {
            $value = ($type === 'y') ? chr(96 + $i) : $i; // Génère 'a', 'b', 'c'... pour les colonnes et 1, 2, 3... pour les lignes
            $html .= '<option value="' . $value . '">' . $value . '</option>';
        }

        $html .= '</select>';
        return $html;
    }

    public static function getSelectorDefVerticalHTML() {
        $html = self::createSelectorHTML('y', self::$cols); // Sélecteur des colonnes (a, b, c, ...)
        $html .= self::createSelectorHTML('x', self::$rows); // Sélecteur des lignes (1, 2, 3, ...)
        return $html;
    }

    public static function getSelectorDefHorizontalHTML() {
        $html = self::createSelectorHTML('x', self::$rows); // Sélecteur des lignes (1, 2, 3, ...)
        $html .= self::createSelectorHTML('y', self::$cols); // Sélecteur des colonnes (a, b, c, ...)
        return $html;
    }
    
}

?>