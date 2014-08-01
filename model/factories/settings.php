<?php
	class Settings{
            
            private static $user="setzuMattia";
            private static $password="cormorano72";
            private static $database="setzuMattia";

            private static $BASE_DIRECTORY="/home/amm/development/amm2014/";

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
