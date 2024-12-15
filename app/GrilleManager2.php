<?php
namespace app;
require_once "../app/table/Grilles.php";
require_once "../app/table/Cases.php";
use app\table\Grilles;
use app\table\Cases;

class GrilleManager2 {
    private static $idGrille;
    private static $gridName;
    private static $rows;
    private static $cols;
    private static $publicDate;
    private static $blackCells=[];

    private static function setDimension($rows,$cols){
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

    // Fonction pour vérifier si une cellule est noire
    private static function isBlackCell($row, $col) {
        
        foreach (self::$blackCells as $cell) {
            if ($cell[0]-1 === $row && $cell[1]-1 === $col) {
                return true;
            }
        }
        return false;
    }

    public static function createGridHTML($withInput = true){
        
        $html='';
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
                $html .= '<td>' . $row . '</td>'; // Numéro de ligne
    
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

        }
        return $html;
    }

    
}

?>