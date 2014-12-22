<?php

    require_once dirname(__FILE__).'/../factories/settings.php';

    require_once dirname(__FILE__).'/person.php';


    class Patient extends Person{

        private $bedNumber;        
        
        /**
         * @param String    $name       The patient's name.
         * @param String    $surname    The patient's surname.
         * @param DateTime  $birthday   The patient's birthday.
         * @param String    $ward       The patient's ward.
         * @param int       $bedNumber  The patient's bed number.
         * @param int       $id         The patient's id.
         */
        public function __construct($name, $surname, $birthday, $ward, $bedNumber, $id){
            
            parent::__construct($name, $surname, $birthday, $ward, $id);
            $this->bedNumber=$bedNumber;
            
        }

        public function getBedNumber(){

            return $this->bedNumber;

        }
        

        public function setBedNumber($bedNumber){

            $this->bedNumber=$bedNumber;

        }
        
        
    }

?>
