<?php

	require_once dirname(__FILE__).'/../model/factories/userFactory.php';
	require_once dirname(__FILE__).'/../model/factories/patientFactory.php';
	require_once dirname(__FILE__).'/../model/factories/caseEntriesFactory.php';
	require_once dirname(__FILE__).'/../model/entities/patient.php';
	require_once dirname(__FILE__).'/../model/entities/case_entry.php';
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
				
				case "clinic_folder":
										
					$entries = CaseEntriesFactory::getEntriesByPatientId($_REQUEST['id']);
					$patient = PatientFactory::getPatientById($_REQUEST['id']);
					$content= "patient";
					require dirname(__FILE__)."/../view/html5/patient/static/patient.php";

				break;

				case "add_entry":
					
					$syntomStart = new DateTime(($_REQUEST['start_date']).($_REQUEST['start_time']), new DateTimeZone('Europe/Rome'));

					// Occuring event
					if (isset($_REQUEST['occurrent'])){
						$syntomEnd = new DateTime(($_REQUEST['end_date']).($_REQUEST['end_time']), new DateTimeZone('Europe/Rome'));
					} else {
						$syntomEnd = new DateTime("1011-11-11 11:11:11", new DateTimeZone('Europe/Rome'));
					}

					// Add entry
					$entry = new CaseEntry($syntomStart, $syntomEnd, $_REQUEST['description'], 0, $_REQUEST['id']);
					CaseEntriesFactory::addEntryForPatient($entry, $_REQUEST['id']);

					// Retrieve patient and syntomps
					$entries = CaseEntriesFactory::getEntriesByPatientId($_REQUEST['id']);
					$patient = PatientFactory::getPatientById($_REQUEST['id']);
						
					$content= "patient";
					require dirname(__FILE__)."/../view/html5/patient/static/patient.php";					


				break;

				case "delete":
					
					CaseEntriesFactory::deleteEntry($_REQUEST['entry_id']);
					
					// Retrieve patient and syntomps
					$entries = CaseEntriesFactory::getEntriesByPatientId($_REQUEST['patient_id']);
					$patient = PatientFactory::getPatientById($_REQUEST['patient_id']);
						
					$content= "patient";
					require dirname(__FILE__)."/../view/html5/patient/static/patient.php";					

				break;

				case "edit":
					echo " getting entry... ";
					var_dump($_REQUEST['entry_id']);
					$entry = CaseEntriesFactory::getEntryById($_REQUEST['entry_id']);
					echo "entry retrieved ";
					$patient = PatientFactory::getPatientById($entry->getPatientId());
					echo " patient retrieved ";

					$start_date = new DateTime($entry->getStart()->format("Y-m-d H:i:s"), new DateTimeZone('Europe/Rome'));
					$end_date = new DateTime($entry->getEnd()->format("Y-m-d H:i:s"), new DateTimeZone('Europe/Rome'));

					$content = "edit_entry";
					require dirname(__FILE__)."/../view/html5/patient/static/patient.php";	

				break;

			}

		}

	}

?>