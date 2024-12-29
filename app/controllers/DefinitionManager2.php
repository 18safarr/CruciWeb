<?php
namespace controllers;
require_once (__DIR__ . '/../model/Definitions.php');
use model\Definitions;


class DefinitionManager2 {
    
    private static $rows;
    private static $cols;
    private static $idGrille;
    public static $dataDefinitions;
    
    public function __construct($idGrille,$rows,$cols)
    {
        self::$idGrille = $idGrille;
        self::$rows = $rows;
        self::$cols = $cols;

        self::$dataDefinitions = self::getAllDefinitionData();
    }


   private static function getDefinitionDatas($idGrille,$orientation){
        return Definitions::getDefinitionDatas($idGrille,$orientation);
   }

   public static function getAllDefinitionData(){
    	$datas = Definitions::getDefinitionDatas(self::$idGrille)?? [];

    	return $datas;
   }

   public static function setIdGrille($idGrille){
    self::$idGrille  = $idGrille;
    self::$dataDefinitions = self::getAllDefinitionData();
   }
   public static function setDimension($rows,$cols){
    self::$rows = $rows;
    self::$cols = $cols;
   }

   public static function addDefinition($orientation,$x,$y,$desc,$sol,$idGrille){
        Definitions::addDefinition($orientation,$x ,$y, $desc, $sol,$idGrille);
   }
   
   public static function updateDefinition($idDefinition, $posX, $posY, $description, $solution) {
        Definitions::updateDefinition($idDefinition,$posX ,$posY, $description, $solution);
   }


    public static function getlistDefinitionsHTML($orientation) {
        //self::$dataDefinitions = self::getDefinitionDatas($idGrille, $orientation);
       
        if ( $orientation == "HORIZONTAL" ){
            $html = '';
            foreach(self::$dataDefinitions as $def ){
                if ($def->orientation==$orientation)
                    $html .= '<li>' .$def->posDepX . ' - ' . htmlspecialchars($def->description) . '</li>';
            }
            return $html;
        }else{
            $html = '';
            foreach(self::$dataDefinitions as $def ){
                if ($def->orientation==$orientation)
                    $html .= '<li>' . chr(96+$def->posDepY) . ' - ' . htmlspecialchars($def->description) . '</li>'; 
            }
            return $html;
        }

   }

   private static function createSelectorHTML($type, $count,$selectVal=null) {
    // Identifier si le type est "y" (colonnes) ou "x" (lignes)
    $html = '<select class="def-num" id="pos-' . $type . '">';
    for ($i = 1; $i <= $count; $i++) {
        //$value = ($type === 'y') ? chr(96 + $i) : $i; // Génère 'a', 'b', 'c'... pour les colonnes et 1, 2, 3... pour les lignes

        if ($type === 'y'){ // Génère 'a', 'b', 'c'... pour les colonnes 
            $value = chr(96 + $i);
            if ($selectVal!=null&&chr(96+$selectVal) == chr(96 + $i)){
                $html .= '<option value="' . $value . '" selected>' . $value . '</option>';
            }else{
                $html .= '<option value="' . $value . '">' . $value . '</option>';
            }
        }else{ //1, 2, 3... pour les lignes
            $value = $i;
            if ($selectVal!=null&&$selectVal == $i){
                $html .= '<option value="' . $value . '" selected>' . $value . '</option>';
            }else{
                $html .= '<option value="' . $value . '">' . $value . '</option>';
            }
        }
        //$html .= '<option value="' . $value . '">' . $value . '</option>';
    }

    $html .= '</select>';
    return $html;
    }




    public static function getSelectorDefVerticalHTML($posValue=[null,null]) {
        $html = self::createSelectorHTML('y', self::$cols,$posValue[1]); // Sélecteur des colonnes (a, b, c, ...)
        $html .= self::createSelectorHTML('x', self::$rows,$posValue[0]); // Sélecteur des lignes (1, 2, 3, ...)
        return $html;
    }

    public static function getSelectorDefHorizontalHTML($posValue=[null,null]) {
        $html = self::createSelectorHTML('x', self::$rows,$posValue[0]); // Sélecteur des lignes (1, 2, 3, ...)
        $html .= self::createSelectorHTML('y', self::$cols,$posValue[1]); // Sélecteur des colonnes (a, b, c, ...)
        return $html;
    }

    public static function getDefintionFormHTML($orientation, $withData=false){
        $html='';
        if(!$withData){
           
            if ($orientation=="HORIZONTAL"){
                $selectorHTML = self::getSelectorDefHorizontalHTML();
                $html.= self::buildDefinitionBlock("horizontal-template", $selectorHTML);
                
            }else{
                $selectorHTML = self::getSelectorDefVerticalHTML();
                $html.= self::buildDefinitionBlock("vertical-template", $selectorHTML);
            }

            return $html;
        }else{
            if($orientation=="HORIZONTAL"){
                foreach(self::$dataDefinitions as $def ){

                    if ($def->orientation==$orientation){
                        $defId = $def->idDefinition;
                        $description = $def->description;
                        $solution = $def->solution;
                        $pos = [$def->posDepX,$def->posDepY];
                        $selectorHTML = self::getSelectorDefHorizontalHTML($pos);
                        $html.=self::buildDefinitionBlock("horizontal-template", $selectorHTML,$defId, $description, $solution);

                    }
                }
                return $html;
            }else{
                foreach(self::$dataDefinitions as $def ){
                    if ($def->orientation==$orientation){
                        $defId = $def->idDefinition;
                        $description = $def->description;
                        $solution = $def->solution;
                        $pos = [$def->posDepX,$def->posDepY];
                        $selectorHTML = self::getSelectorDefVerticalHTML($pos);
                        $html.=self::buildDefinitionBlock("vertical-template",$selectorHTML,$defId, $description, $solution);
                      
                    }
                }
                return $html;
            }

            
            
        }
    }

    private static function buildDefinitionBlock($templateId,$selectorHTML,$defId='', $description = '', $solution = '') {
        $html = '<div class="definition" id="' . $templateId . '" data-id="' . $defId . '">';
        $html .= '<label >N°</label>' . $selectorHTML;
        $html .= '<label>Description</label>';
        $html .= '<input type="text" class="def-desc" value="' . htmlspecialchars($description) . '" placeholder="Définition">';
        $html .= '<label>Solution</label>';
        $html .= '<input type="text" class="def-sol" value="' . htmlspecialchars($solution) . '" placeholder="Solution">';
        $html .= '<button class="supp-def">X</button>';
        $html .= '<button class="valider-def">&#x2713;</button>';
        $html .= '</div>';
        return $html;
    }




}

?>