<?php

    require_once("/home/amm/development/amm2014/model/factories/settings.php");

    require_once(Settings::baseDirectory()."/model/entities/user.php");


    class Doctor extends User{        
        
        
        /**
         * @param String    $name       The doctor's name.
         * @param String    $surname    The doctor's surname.
         * @param DateTime  $birthday   The doctor's birthday.
         * @param String    $ward       The doctor's ward.
         * @param String    $email      The doctor's email.
         * @param String    $password   The doctor's password.
         * @param int       $id         The doctor's id.
         */
        public function __construct($name, $surname, $birthday, $ward, $email, $password, $id){

            parent::__construct($name, $surname, $birthday, $ward, $email, $password, $id);

        }

        
    }
        
?>
