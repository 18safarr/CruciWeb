<?php
namespace controllers;
require_once (__DIR__ . '/../model/Definitions.php');
use model\Definitions;

class DefinitionManager2 {

   private static function getDefinitionDatas($idGrille,$orientation){
    return Definitions::getDefinitionDatas($idGrille,$orientation);
   }

   public function getDefinitionsHTML($idGrille,$orientation) {
    $datas = self::getDefinitionDatas($idGrille,$orientation);
    $html = '';
    foreach($datas as $def){

    }
    // $count = count($this->verticalDefinitions); // Nombre total de définitions

    // for ($i = 0; $i < $count; $i++) {
    //     $html .= '<li>' . $this->verticalDefinitions[$i] . '</li>';
    // }
    
    return $html;
}
}

?>