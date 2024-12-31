<?php


// Données des cases noires
$casesNoires = [
    "2,5", "3,2", "3,5", "4,8", "5,5", "5,10", "6,4", "6,5", 
    "7,3", "9,6", "9,7", "9,9", "10,2"
];

// Données des définitions
$definitions = [
    ["orientation" => "HORIZONTAL", "posDepX" => 1, "posDepY" => 1, "solution" => "TELESCOPES"],
    ["orientation" => "HORIZONTAL", "posDepX" => 2, "posDepY" => 1, "solution" => "ETAT"],
    ["orientation" => "HORIZONTAL", "posDepX" => 2, "posDepY" => 6, "solution" => "ORION"],
    ["orientation" => "HORIZONTAL", "posDepX" => 3, "posDepY" => 3, "solution" => "RA"],
    ["orientation" => "HORIZONTAL", "posDepX" => 3, "posDepY" => 6, "solution" => "UNCLE"],
    ["orientation" => "HORIZONTAL", "posDepX" => 4, "posDepY" => 1, "solution" => "LUMIERE"],
    ["orientation" => "HORIZONTAL", "posDepX" => 4, "posDepY" => 9, "solution" => "IO"],
    ["orientation" => "HORIZONTAL", "posDepX" => 5, "posDepY" => 1, "solution" => "URES"],
    ["orientation" => "HORIZONTAL", "posDepX" => 5, "posDepY" => 6, "solution" => "OREE"],
    ["orientation" => "HORIZONTAL", "posDepX" => 6, "posDepY" => 1, "solution" => "RAS"],
    ["orientation" => "HORIZONTAL", "posDepX" => 6, "posDepY" => 6, "solution" => "NONNE"],
    ["orientation" => "HORIZONTAL", "posDepX" => 7, "posDepY" => 1, "solution" => "IN"],
    ["orientation" => "HORIZONTAL", "posDepX" => 7, "posDepY" => 4, "solution" => "BINNING"],
    ["orientation" => "HORIZONTAL", "posDepX" => 8, "posDepY" => 1, "solution" => "QUARTETTES"],
    ["orientation" => "HORIZONTAL", "posDepX" => 9, "posDepY" => 1, "solution" => "USINE"],
    ["orientation" => "HORIZONTAL", "posDepX" => 10, "posDepY" => 3, "solution" => "LOMBARDS"],

    ["orientation" => "VERTICAL", "posDepX" => 1, "posDepY" => 1, "solution" => "TELLURIQUE"],
    ["orientation" => "VERTICAL", "posDepX" => 1, "posDepY" => 2, "solution" => "ET"],
    ["orientation" => "VERTICAL", "posDepX" => 4, "posDepY" => 2, "solution" => "URANUS"],
    ["orientation" => "VERTICAL", "posDepX" => 1, "posDepY" => 3, "solution" => "LARMES"],
    ["orientation" => "VERTICAL", "posDepX" => 8, "posDepY" => 3, "solution" => "AIL"],
    ["orientation" => "VERTICAL", "posDepX" => 1, "posDepY" => 4, "solution" => "ETAIS"],
    ["orientation" => "VERTICAL", "posDepX" => 7, "posDepY" => 4, "solution" => "BRNO"],
    ["orientation" => "VERTICAL", "posDepX" => 7, "posDepY" => 5, "solution" => "ITEM"],
    ["orientation" => "VERTICAL", "posDepX" => 1, "posDepY" => 6, "solution" => "COURONNE"],
    ["orientation" => "VERTICAL", "posDepX" => 1, "posDepY" => 7, "solution" => "ORNERONT"],
    ["orientation" => "VERTICAL", "posDepX" => 1, "posDepY" => 8, "solution" => "PIC"],
    ["orientation" => "VERTICAL", "posDepX" => 5, "posDepY" => 8, "solution" => "ENITER"],
    ["orientation" => "VERTICAL", "posDepX" => 1, "posDepY" => 9, "solution" => "EOLIENNE"],
    ["orientation" => "VERTICAL", "posDepX" => 1, "posDepY" => 10, "solution" => "SNEO"],
    // ["orientation" => "VERTICAL", "posDepX" => 6, "posDepY" => 10, "solution" => "EGSOS"],
];

function validerGrille($casesNoires, $definitions) {
    $grille = [];

    foreach ($definitions as $definition) {
        $x = $definition['posDepX'];
        $y = $definition['posDepY'];
        $solution = $definition['solution'];
        $orientation = $definition['orientation'];

        for ($i = 0; $i < strlen($solution); $i++) {
            $case = "$x,$y";

            // Vérification des cases noires
            if (in_array($case, $casesNoires)) {
                return "Erreur : La définition passe par une case noire en position $case.";
            }

            // Vérification des intersections
            if (isset($grille[$case])) {
                if ($grille[$case] !== $solution[$i]) {
                    return "Erreur : Conflit de lettres en position $case (\"{$grille[$case]}\" vs \"{$solution[$i]}\").";
                }
            } else {
                $grille[$case] = $solution[$i];
            }

            // Avancer à la case suivante
            if ($orientation === "HORIZONTAL") {
                $y++;
            } else if ($orientation === "VERTICAL") {
                $x++;
            }
        }
    }

    return "Succès : Toutes les définitions sont valides.";
}

// Exécution et affichage du résultat
$resultat = validerGrille($casesNoires, $definitions);
echo $resultat;



?>