<?php
namespace app;

class ExempleData {
    public  $rows = 13;
    public  $cols = 13;
    public  $blackCells = [
        [1, 3], [1, 7], 
        [2, 3], [2, 8],
        [3, 2], [3, 10],
        [4, 5],
        [5, 1], [5, 8],
        [6, 6],
        [7, 3], [7, 9],
        [8, 5], [8, 11],
        [9, 8],
        [10, 3], [10, 8]
    ];
    public function getExempleParamGrille(){
        return [$this->rows, $this->cols, $this->blackCells];
    }
    public function getExemplelisteGrille() {
        return [
            [
                'id' => 1,
                'name' => 'Nom_1',
                'score' => '10 X 11',
                'level' => 'Expert',
                'date' => '2024-12-12',
                'username' => 'User_1',
            ],
            [
                'id' => 2,
                'name' => 'Nom_2',
                'score' => '5 X 6',
                'level' => 'Débutant',
                'date' => '2024-11-25',
                'username' => 'User_2',
            ],
            [
                'id' => 3,
                'name' => 'Nom_3',
                'score' => '8 X 7',
                'level' => 'Intermédiaire',
                'date' => '2024-12-01',
                'username' => 'User_3',
            ],
        ];
    }
}
?>
