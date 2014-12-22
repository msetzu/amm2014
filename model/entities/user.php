<?php

    require_once dirname(__FILE__).'/../factories/settings.php';

    require_once dirname(__FILE__).'/person.php';


    class User extends Person {		

        private $email;
        private $password;

        /**
         * 
         * @param String    $name       The user's name.
         * @param String    $surname    The user's surname.
         * @param DateTime  $birthday   The user's birthday.
         * @param String    $ward       The user's ward.
         * @param String    $email      The user's email.
         * @param String    $password   The user's password.
         * @param int       $id         The user's id.
         */
        public function __construct($name, $surname, $birthday, $ward, $email, $password, $id) {

            parent::__construct($name, $surname, $birthday, $ward, $id);
            $this->email=$email;
            $this->password=$password;
            
        }


        public function getEmail(){

            return $this->email;

        }


        public function getPassword(){

            return $this->password;

        }


        public function setWard($ward){

            $this->ward=$ward;

        }


        public function setEmail($email){

                $this->email=$email;

        }


        public function setPassword($password){

            $this->password=$password;

        }
        

    }

?>
