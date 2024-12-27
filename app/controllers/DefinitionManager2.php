<?php
namespace controllers;
require_once (__DIR__ . '/../model/Definitions.php');
use model\Definitions;

class DefinitionManager2 {
    

   private static function getDefinitionDatas($idGrille,$orientation){
        return Definitions::getDefinitionDatas($idGrille,$orientation);
   }

   public static function getAllDefinitionData($idGrille){
    	$dataDefVerti = Definitions::getDefinitionDatas($idGrille,"VERTICAL");
    	$dataDefHori = Definitions::getDefinitionDatas($idGrille,"HORIZONTAL");

    	return [$dataDefHori,$dataDefVerti];
   }


   public static function getlistDefinitionsHTML($idGrille, $orientation) {
        $datas = self::getDefinitionDatas($idGrille, $orientation);
        $html = '';

        foreach ($datas as $index => $definition) {
            // Génère une ligne avec la description formatée en lettre (a, b, c, etc.)
            if($orientation == "VERTICAL")
                $html .= '<li>' . chr(96+$definition->posDepY) . ' - ' . htmlspecialchars($definition->description) . '</li>';
            else
                $html .= '<li>' .$definition->posDepX . ' - ' . htmlspecialchars($definition->description) . '</li>';
        }

        return $html;
   }
}

?>