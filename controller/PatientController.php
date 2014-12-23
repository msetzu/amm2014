<?php

	require_once dirname(__FILE__).'/../model/factories/userFactory.php';
	require_once dirname(__FILE__).'/../model/factories/patientFactory.php';
	require_once dirname(__FILE__).'/../model/entities/patient.php';
	require_once dirname(__FILE__).'/../model/entities/doctor.php';
	require_once dirname(__FILE__).'/../model/entities/student.php';


	class PatientController {

		public static function dispatch ($what) {

			switch ($what) {

				case "add_patient":
					$patient = new Patient ($_REQUEST['name'], $_REQUEST['surname'], new DateTime ($_REQUEST['birthday'], new DateTimeZone('Europe/Rome')), $_REQUEST['ward'], $_REQUEST['bed_number'], 0);
					
					PatientFactory::storeNewPatient($patient);
						
					$patients = PatientFactory::getPatientsGeneric($_REQUEST['name'], $_REQUEST['surname'], $_REQUEST['birthday']);
					$patient = $patients[(count($patients))-1];
					$id = $patient->getId();						
					$user = UserFactory::getUserById($_SESSION['user_id']);						
					UserFactory::addPatient($user->getId(),$user->getRole(), $id);
					$patients = UserFactory::getUsersPatients($_SESSION['user_id']);

					$content = "patients";
					require dirname(__FILE__)."/../view/html5/user/static/user.php";

				break;
				
				default:
					
				break;
			}

		}

	}

?>