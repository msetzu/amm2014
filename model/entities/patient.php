<?php

    require_once("/home/amm/development/amm2014/model/factories/settings.php");

    require_once(Settings::baseDirectory()."model/entities/person.php");


    class Patient extends Person{

        private $bedNumber;        
        
        /**
         * @param String    $name       The patient's name.
         * @param String    $surname    The patient's surname.
         * @param DateTime  $birthday   The patient's birthday.
         * @param String    $ward       The patient's ward.
         * @param String    $email      The patient's email.
         * @param String    $password   The patient's password.
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