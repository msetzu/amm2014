<?php

	class Settings{
            
            private static $user="root";
            private static $password="b71fE#";
            private static $database="setzuMattia";

            private static $BASE_DIRECTORY="/Amm/amm2014/";

            public function getUser(){
                    return self::$user;
            }

            public function getPassword(){
                    return self::$password;
            }

            public function getDatabase(){
                    return self::$database;
            }

            public function baseDirectory(){
                    return self::$BASE_DIRECTORY;
            }

	}
?> 
