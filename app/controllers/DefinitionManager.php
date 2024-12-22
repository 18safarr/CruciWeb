<?php
namespace controllers;

class DefinitionManager {
    // Simule une base de données avec des définitions verticales
    private $verticalDefinitions = [
        'a - Genre de perdrix rouge',
        'b - Plante médicinale',
        'c - Célèbre pharaon',
        'd - Outil pour creuser',
        'e - Grande étendue d’eau',
    ];

    // Simule une base de données avec des définitions horizontales
    private $horizontalDefinitions = [
        '1 - Petit fruit rouge',
        '2 - Installer une chaise',
        '3 - Objet volant',
        '4 - Type de fromage',
        '5 - Nom d’un animal marin',
    ];

    /**
     * Retourne les définitions verticales.
     *
     * @return string HTML des définitions verticales.
     */
    public function getVerticalDefinitions() {
        $html = '';
        $count = count($this->verticalDefinitions); // Nombre total de définitions

        for ($i = 0; $i < $count; $i++) {
            $html .= '<li>' . $this->verticalDefinitions[$i] . '</li>';
        }
        
        return $html;
    }

    /**
     * Retourne les définitions horizontales.
     *
     * @return string HTML des définitions horizontales.
     */
    public function getHorizontalDefinitions() {
        $html = '';
        $count = count($this->horizontalDefinitions); // Nombre total de définitions

        for ($i = 0; $i < $count; $i++) {
            $html .= '<li>' . $this->horizontalDefinitions[$i] . '</li>';
        }
        
        return $html;
    }
}
?>
