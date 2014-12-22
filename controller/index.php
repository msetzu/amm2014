<?php

    session_start();

	require_once dirname(__FILE__)."/GuestController.php";
	
    class Dispatcher {
        
        public static function dispatch () {

            switch ($_REQUEST["user"]) {
                
                case "guest":

                    GuestController::dispatch($_REQUEST["wants"]);
                    
                break;
                
                case "user":
                    
                    //UserController::dispatch($_REQUEST["wants"]);
                    
                break;
                
                case "patient":
                    
                    //PatientController::dispatch($_REQUEST["wants"]);
                    
                break;
                
            }
            
        }
        
    }

    
	Dispatcher::dispatch();

?>
