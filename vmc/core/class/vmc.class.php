<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

/******************************* Includes *******************************/ 
require_once dirname(__FILE__) . '/../../../../core/php/core.inc.php';

class vmc extends eqLogic {


    /******************************* Attributs *******************************/ 
    /* Ajouter ici toutes vos variables propre à votre classe */

    /***************************** Methode static ****************************/ 

    /*
    // Fonction exécutée automatiquement toutes les minutes par Jeedom
    public static function cron() {

    }
    */

    /*
    // Fonction exécutée automatiquement toutes les heures par Jeedom
    public static function cronHourly() {

    }
    */

    /*
    // Fonction exécutée automatiquement tous les jours par Jeedom
    public static function cronDayly() {

    }
    */
 
    /*************************** Methode d'instance **************************/ 
 

    /************************** Pile de mise à jour **************************/ 
    
    /* fonction permettant d'initialiser la pile 
     * plugin: le nom de votre plugin
     * action: l'action qui sera utilisé dans le fichier ajax du pulgin 
     * callback: fonction appelé coté client(JS) pour mettre à jour l'affichage 
     */ 
    public function initStackData() {
        nodejs::pushUpdate('vmc::initStackDataEqLogic', array('plugin' => 'vmc', 'action' => 'saveStack', 'callback' => 'displayEqLogic'));
    }
    
    /* fonnction permettant d'envoyer un nouvel équipement pour sauvegarde et affichage, 
     * les données sont envoyé au client(JS) pour être traité de manière asynchrone
     * Entrée: 
     *      - $params: variable contenant les paramètres eqLogic
     */
    public function stackData($params) {
        if(is_object($params)) {
            $paramsArray = utils::o2a($params);
        }
        nodejs::pushUpdate('vmc::stackDataEqLogic', $paramsArray);
    }
    
    /* fonction appelé pour la sauvegarde asynchrone
     * Entrée: 
     *      - $params: variable contenant les paramètres eqLogic
     */
    public function saveStack($params) {
        // inserer ici le traitement pour sauvegarde de vos données en asynchrone
        
    }

    /* fonction appelé avant le début de la séquence de sauvegarde */
    public function preSave() {
        
    }

    /* fonction appelé pendant la séquence de sauvegarde avant l'insertion 
     * dans la base de données pour une mise à jour d'une entrée */
    public function preUpdate() {
        
    }

    /* fonction appelé pendant la séquence de sauvegarde après l'insertion 
     * dans la base de données pour une mise à jour d'une entrée */
    public function postUpdate() {
        
    }

    /* fonction appelé pendant la séquence de sauvegarde avant l'insertion 
     * dans la base de données pour une nouvelle entrée */
    public function preInsert() {

    }

    /* fonction appelé pendant la séquence de sauvegarde après l'insertion 
     * dans la base de données pour une nouvelle entrée */
    public function postInsert() {
        
    }

    /* fonction appelé après la fin de la séquence de sauvegarde */
    public function postSave() {
        
    }

    /* fonction appelé avant l'effacement d'une entrée */
    public function preRemove() {
        
    }

    /* fonnction appelé après l'effacement d'une entrée */
    public function postRemove() {
        
    }

    public function toHtml($_version = 'dashboard') {
        if ($this->getIsEnable() != 1) {
          return '';
        }
        if (!$this->hasRight('r')) {
          return '';
        }

        $_version = jeedom::versionAlias($_version);
        
        $background=$this->getBackgroundColor($_version);
        
        $replace = array(
          '#name#' => $this->getName(),
          '#id#' => $this->getId(),
          '#background_color#' => $background,
          '#eqLink#' => $this->getLinkToConfiguration(),
          '#height#' => $this->getDisplay('height', 'auto'),
          '#width#' => $this->getDisplay('width', '330px'),
          '#temperature_airneufexterieur#' => jeedom::evaluateExpression($this->getConfiguration('temperature_airneufexterieur')),
          '#temperature_airneufinsuflé#' => jeedom::evaluateExpression($this->getConfiguration('temperature_airneufinsuflé')),
          '#temperature_airvicie#' => jeedom::evaluateExpression($this->getConfiguration('temperature_airvicie')),
          '#temperature_airvicierejete#' => jeedom::evaluateExpression($this->getConfiguration('temperature_airvicierejete'))
        );

        $parameters = $this->getDisplay('parameters');
        if (is_array($parameters)) {
          foreach ($parameters as $key => $value) {
            $replace['#' . $key . '#'] = $value;
          }
        }

        $html = template_replace($replace, getTemplate('core', $_version, 'eqLogic', 'vmc'));
        return $html;
    }

    /*     * **********************Getteur Setteur*************************** */
}

class vmcCmd extends cmd {
    /******************************* Attributs *******************************/ 
    /* Ajouter ici toutes vos variables propre à votre classe */

    /***************************** Methode static ****************************/ 

    /*************************** Methode d'instance **************************/ 

    /* Non obligatoire permet de demander de ne pas supprimer les commandes même si elles ne sont pas dans la nouvelle configuration de l'équipement envoyé en JS
    public function dontRemoveCmd() {
        return true;
    }
    */

    public function execute($_options = array()) {
        
    }

    /***************************** Getteur/Setteur ***************************/ 

    
}

?>
