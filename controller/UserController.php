<?php

	require_once dirname(__FILE__).'/../model/factories/userFactory.php';
	require_once dirname(__FILE__).'/../model/entities/doctor.php';
	require_once dirname(__FILE__).'/../model/entities/student.php';


	class UserController {

		public static function dispatch($what) {
			
			switch($what) {

				case "profile":

					$content = "profile";
					require dirname(__FILE__)."/../view/html5/user/static/user.php";

				break;

				case "patients":


					$patients = UserFactory::getUsersPatients($_SESSION["user_id"]);

					$content = "patients";					
					require dirname(__FILE__)."/../view/html5/user/static/user.php";					

				break;

				case "add_patient":

					$content = "add_patient";
					require dirname(__FILE__)."/../view/html5/user/static/user.php";					

				break;

				case "edit_profile":

					$content = "edit_profile";
					require dirname(__FILE__)."/../view/html5/user/static/user.php";					

				break;

				case "update_profile":

					switch ($_SESSION['user_role']) {

						case "Doctor":
							$user = new Doctor ($_REQUEST['name'], $_REQUEST['surname'], $_REQUEST['birthday'], $_REQUEST['ward'], $_REQUEST['email'], $_REQUEST['password'], $_SESSION['user_id']);
						break;
						
						case "Student":
							$user = new Student ($_REQUEST['name'], $_REQUEST['surname'], new DateTime ($_REQUEST['birthday'], new DateTimeZone('Europe/Rome')), $_REQUEST['ward'], $_REQUEST['email'], $_REQUEST['password'], $_SESSION['user_id']);
						break;						

					}

					// Refresh session
					$_SESSION['user_name'] = $_REQUEST['name'];
					$_SESSION['user_surname'] = $_REQUEST['surname'];
					$_SESSION['user_birthday'] = new DateTime ($_REQUEST['birthday'], new DateTimeZone('Europe/Rome'));
					$_SESSION['user_ward'] = $_REQUEST['ward'];
					$_SESSION['user_email'] = $_REQUEST['email'];
					$_SESSION['user_password'] = $_REQUEST['password'];

					UserFactory::editUser($user);					

					$content = "profile";
					require dirname(__FILE__)."/../view/html5/user/static/user.php";

				break;

				default:
					echo " default case: \$_REQUEST[wants] = ";
					echo $_REQUEST['wants'];
				break;

			}

		}

	}

?>