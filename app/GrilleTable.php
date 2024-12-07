<?php
namespace app;
class GrilleTable {
    // Simulation des données récupérées depuis une base de données
    private $data = [
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

    // Fonction qui simule la récupération des données
    public function getRows() {
        $html = '';
        foreach ($this->data as $row) {
            $html .= '
                <tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['score'] . '</td>
                    <td>' . $row['level'] . '</td>
                    <td>' . $row['date'] . '</td>
                    <td>' . $row['username'] . '</td>
                    <td><a href="#" class="play-link">Jouer</a></td>
                </tr>
            ';
        }
        return $html;
    }
}

?>