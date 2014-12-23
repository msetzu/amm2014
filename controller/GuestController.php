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
												 new DateTime ($_REQUEST["birthday"], new DateTimeZone('Europe/Rome')),
												 $_REQUEST["ward"],
												 $_REQUEST["email"],
												 $_REQUEST["password_entry1"],
												 0);
							
						} else {
						
							$user = new Doctor ($_REQUEST["name"],
												 $_REQUEST["surname"],
												 new DateTime ($_REQUEST["birthday"], new DateTimeZone('Europe/Rome')),
												 $_REQUEST["ward"],
												 $_REQUEST["email"],
												 $_REQUEST["password_entry1"],
												 0);
							
						}
					
					} catch (Exception $e) {
						
						return false;
						
					}

					UserFactory::storeNewUser($user);

					$_SESSION['user_name'] = $user->getName();
					$_SESSION['user_surname'] = $user->getSurname();
					$_SESSION['user_birthday'] = $user->getBirthday();
					$_SESSION['user_ward'] = $user->getWard();
					$_SESSION['user_email'] = $user->getEmail();
					$_SESSION['user_password'] = $user->getPassword();
					$_SESSION['user_id'] = $user->getId();
					$_SESSION['user_role'] = $user->getRole();

					$content = "profile";
					require dirname(__FILE__)."/../view/html5/user/static/user.php";
				
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
						$_SESSION['user_id'] = $user->getId();
						$_SESSION['user_role'] = $user->getRole();

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
