<?php
namespace app;
require_once "../app/ExempleData.php";
use app\ExempleData;


class GrilleManager {
    private $rows;
    private $cols;
    private $blackCells;
    private $ex;

    public function __construct(){
        $this->ex = new ExempleData();
         list($this->rows,$this->cols,$this->blackCells) = $this->ex->getExempleParamGrille();
    }

    // Fonction pour vérifier si une cellule est noire
    private function isBlackCell($row, $col) {
        foreach ($this->blackCells as $cell) {
            if ($cell[0] === $row && $cell[1] === $col) {
                return true;
            }
        }
        return false;
    }

    // Fonction pour générer la grille HTML
    public function createGrille() {
        $html = '';
        $html .= '<table>';

        // Créer la ligne des lettres des colonnes
        $html .= '<tr><th></th>';
        for ($col = 1; $col <= $this->cols; $col++) {
            $html .= '<th>' . chr(96 + $col) . '</th>'; // Lettres de 'a' à 'k'
        }
        $html .= '</tr>';

        // Générer les lignes de la grille
        for ($row = 1; $row <= $this->rows; $row++) {
            $html .= '<tr>';
            $html .= '<td>' . $row . '</td>'; // Numéro de ligne

            for ($col = 1; $col <= $this->cols; $col++) {
                if ($this->isBlackCell($row, $col)) {
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

        return $html;
    }


    public function createGrille2($rs, $cs) {
        $html = '';
        $html .= '<table>';
    
        // Créer la ligne des lettres des colonnes
        $html .= '<tr><th></th>';
        for ($col = 1; $col <= $cs; $col++) {
            $html .= '<th>' . chr(96 + $col) . '</th>'; // Lettres de 'a' à 'k'
        }
        $html .= '</tr>';
    
        // Générer les lignes de la grille
        for ($row = 1; $row <= $rs; $row++) {
            $html .= '<tr>';
            $html .= '<td>' . $row . '</td>'; // Numéro de ligne
    
            for ($col = 1; $col <= $cs; $col++) {
                $id = 'cell_' . $row . '_' . $col; // ID unique pour chaque cellule
    
                // Par défaut, toutes les cellules sont blanches
                $html .= '<td id="' . $id . '" class="white-cell"></td>';
            }
    
            $html .= '</tr>';
        }
    
        $html .= '</table>';
    
        return $html;
    }
    



    public function getAllShareGrilles() {
        $data = $this->ex->getExemplelisteGrille();
        $html = '';
        foreach ($data as $row) {
            $html .= '
                <tr>
                    <td>' . htmlspecialchars($row['id']) . '</td>
                    <td>' . htmlspecialchars($row['name']) . '</td>
                    <td>' . htmlspecialchars($row['score']) . '</td>
                    <td>' . htmlspecialchars($row['level']) . '</td>
                    <td>' . htmlspecialchars($row['date']) . '</td>
                    <td>' . htmlspecialchars($row['username']) . '</td>
                    <td><a href="#" class="play-link">Jouer</a></td>
                </tr>
            ';
            
        }
        return $html;
    }

    public function getAllShareGrilles2() {
        $data = $this->ex->getExemplelisteGrille();
        $html = '';
        foreach ($data as $row) {
            $html .= '
                <tr>
                    <td>' . htmlspecialchars($row['id']) . '</td>
                    <td>' . htmlspecialchars($row['name']) . '</td>
                    <td>' . htmlspecialchars($row['score']) . '</td>
                    <td>' . htmlspecialchars($row['level']) . '</td>
                    <td>' . htmlspecialchars($row['date']) . '</td>
                    <td>' . htmlspecialchars($row['username']) . '</td>
                    <td><a href="#" class="edit-link">Modifier</a> | <a href="#" class="del-link">X</a></td>
                </tr>
            ';
            
        }
        return $html;
    }

    // Fonction pour traiter la soumission de la grille
    public function saveGrid() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
            $gridData = [];

            // Récupérer toutes les cellules de la grille
            for ($row = 1; $row <= $this->rows; $row++) {
                for ($col = 1; $col <= $this->cols; $col++) {
                    $name = 'cell_' . $row . '_' . $col;
                    if (!empty($_POST[$name])) {
                        $gridData[$name] = $_POST[$name];
                    }
                }
            }

            // Afficher les données pour vérification
            echo '<pre>';
            print_r($gridData);
            echo '</pre>';

            // Vous pouvez maintenant enregistrer $gridData dans une base de données ou dans un fichier
        }
    }
}
?>
