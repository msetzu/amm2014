<?php

    class Person{

        private $name;
        private $surname;
        private $birthday;
        private $ward;
        private $id;

        /**
         * @param String    $name      The person's name.
         * @param String    $surname   The person's surname.
         * @param DateTime  $birthday  The person's birthday.
         * @param String    $ward      The person's current ward (where he/she works or is hospitalized).
         * @param int       $id        The person's id.
         */
        public function __construct($name, $surname, $birthday, $ward, $id){                

            $this->name=$name;
            $this->surname=$surname;
            $this->birthday=$birthday;
            $this->ward=$ward;
            $this->id=$id;

        }
        
        /**
         * Get a person's name.
         * 
         * @return String   The person's name.
         */
        public function getName(){

            return $this->name;

        }
        
        
        /**
         * Get a person's surname.
         * 
         * @return String   The person's surname.
         */
        public function getSurname(){

            return $this->surname;

        }
        
        /**
         * Get a person's birthday.
         * 
         * @return DateTime     The person's birthday.
         */
        public function getBirthday(){

            return $this->birthday;

        }

        
        /**
         * Get a person's birthday.
         * 
         * @return String    The person's ward.
         */
        public function getWard(){

            return $this->ward;

        }
        
        
        /**
         * Get a person's role.
         * 
         * @return String The person's role.
         */
        public function getRole(){

            return get_class($this);

        }

        
        /**
         * Set a person's name.
         * 
         * @param String $name  The person's name.
         */
        public function setName($name){

            $this->name=$name;

        }
        
        
        /**
         * Set a person's surname.
         * 
         * @param String $surname  The person's surname.
         */
        public function setSurname($surname){

            $this->surname=$surname;

        }

        
        /**
         * Set a person's birthday.
         * 
         * @param Date $birthday  The person's birthday.
         */
        public function setBirthday($birthday){

            $this->birthday=$birthday;

        }

        
    }
?>
