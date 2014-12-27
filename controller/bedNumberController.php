<?php

	require_once dirname(__FILE__)."/../model/factories/factory.php";

	class BedNumberController{

		public static function checkBeds() {

			$result = array();

			if ($_REQUEST['bedNumber'] == 0) {
				$result['bedTaken'] = false;
				return $result;
			}

			$beds = Factory::query("select count(*) as beds from patients where bed_number=".$_REQUEST['bedNumber'].";");
			$bedsObject = $beds->fetch_object();

			if ($bedsObject->beds != 0) {
				$result['bedTaken'] = true;
			} else {
				$result['bedTaken'] = false;
			}

			return $result;

		}

	}

	$r = BedNumberController::checkBeds();	
	echo (json_encode($r));

?>