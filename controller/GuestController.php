<?php

	require_once dirname(__FILE__).'/../model/factories/userFactory.php';
	require_once dirname(__FILE__).'/../model/entities/doctor.php';
	require_once dirname(__FILE__).'/../model/entities/student.php';


	class GuestController {
	
		public static function dispatch ($what) {
		
			switch ($what) {
			
				case "signup":
				
					/* Create new user */
					try {
					
						if ($_REQUEST["role"] = "student") {
						
							$user = new Student ($_REQUEST["name"],
												 $_REQUEST["surname"],
												 $_REQUEST["birthday"],
												 $_REQUEST["ward"],
												 $_REQUEST["email"],
												 $_REQUEST["password"],
												 0);
							
						} else {
						
							$user = new Doctor ($_REQUEST["name"],
												 $_REQUEST["surname"],
												 $_REQUEST["birthday"],
												 $_REQUEST["ward"],
												 $_REQUEST["email"],
												 $_REQUEST["password"],
												 0);
							
						}
					
					} catch (Exception $e) {
						
						return false;
						
					}
					
					UserFactory::storeNewUser($user);
				
					$_SESSION["user_name"] = $_REQUEST["name"];
					$_SESSION["user_surname"] = $_REQUEST["surname"];
					$_SESSION["user_birthday"] = $_REQUEST["birthday"];
					$_SESSION["user_ward"] = $_REQUEST["ward"];
					$_SESSION["user_email"] = $_REQUEST["email"];
					$_SESSION["user_password"] = $_REQUEST["password"];
				
					$content = "profile";

					require dirname(__FILE__).'/../view/html5/user/static/user.php';
				
				break;
			
			
				case "login":
					
					if (UserFactory::isAuthenticable($_REQUEST["email"], $_REQUEST["password"])) {

						// Populate session
						$user = UserFactory::getUsersGeneric('%', '%', '%', '%', '%', $_REQUEST["email"])[0];
						
						$_SESSION['user_name'] = $user->getName();
						$_SESSION['user_surname'] = $user->getSurname();
						$_SESSION['user_birthday'] = $user->getBirthday();
						$_SESSION['user_ward'] = $user->getWard();
						$_SESSION['user_email'] = $user->getEmail();
						$_SESSION['user_password'] = $user->getPassword();		

						$content = "profile";
						require dirname(__FILE__)."/../view/html5/user/static/user.php";
					
					}
					else {
					
						require dirname(__FILE__)."/../view/html5/user/login.php";
						
					}
					
				break;
			}
			
		}
		
	}

?>
