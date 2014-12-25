<?php

require_once dirname(__FILE__).'/settings.php';

require_once dirname(__FILE__).'/factory.php';

require_once dirname(__FILE__).'/../exceptions/queryException.php';
require_once dirname(__FILE__).'/../exceptions/connectionException.php';

class caseEntriesFactory{    

	/**
	 * @param   int     $id                   The patient id.
	 * 
	 * @return  CaseEntry   
	 * 
	 * @throws  QueryException.
	 * @throws  ConnectionException.
	 */
	public static function getEntriesByPatientId($id){

		$results=array(); 

		$caseEntries=Factory::query("select
			id,
			start,
			end,
			description
			from
			case_entries
			where
			patient_id=".$id);

		while($currentCaseEntry=$caseEntries->fetch_object()){

			$results[]=new CaseEntry(new DateTime($currentCaseEntry->start, new DateTimeZone('Europe/Rome')),
				new DateTime($currentCaseEntry->end, new DateTimeZone('Europe/Rome')),
				$currentCaseEntry->description,
				$currentCaseEntry->id,
				$id
				);

		}

		return $results;


	}


	/**
	 * Store a new caseentry for patient identified by id $id.
	 * 
	 * @param CaseEntry     $caseEntry  The caseEntry to store.
	 * @param int           $id         The patient's id.
	 */
	public static function addEntryForPatient($caseEntry, $id){

		$db_interface=Factory::connect();
		$stmt=$db_interface->stmt_init();

		if($stmt!=null){

			$stmt->prepare("insert into
				case_entries
				(id,
					start,
					end,
					description,
					patient_id)
			values
			(default,
				?,
				?,
				?,
				?)
			");

			$stmt->bind_param("sssi",
				$caseEntry->getStart()->format("Y-m-d H:s:i"),
				$caseEntry->getEnd()->format("Y-m-d H:s:i"),
				$caseEntry->getDescription(),
				$id
				);

			if($stmt->errno==0){

				$stmt->execute();

				if($stmt->errno==0){

					Factory::close_connection($db_interface);
					return;

				}else{

					Factory::close_connection($db_interface);
					throw new UserNotAddedException("Error Processing Request", 1);

				}

			}else{

				Factory::close_connection($db_interface);
				throw new QueryException("Error Processing Request", 1);

			}

		}else{

			Factory::close_connection($db_interface);
			throw new QueryException("Error Processing Request", 1);

		}


	}


	/**
	 * 
	 * @param   CaseEntry       $entry  The entry to be updated.
	 * 
	 * @throws  QueryException          If entry could not be updated.
	 */
	public static function updateEntry($entry){		

		$db_interface=Factory::connect();
		$stmt=$db_interface->stmt_init();

		if($stmt){

			$stmt->prepare("update
								case_entries
							set
								start=?,
								end=?,
								description=?
							where
								id=?
				");

			$stmt->bind_param("sssi",
				$entry->getStart()->format("Y-m-m H:i:s"),
				$entry->getEnd()->format("Y-m-m H:i:s"),
				$entry->getDescription(),
				$entry->getId()
				);

			if($stmt->errno==0){

				$stmt->execute();

				if($stmt->errno==0){

					Factory::close_connection($db_interface);
					return;

				}else{

					Factory::close_connection($db_interface);
					throw new Exception("Error Processing Request", 1);

				}

			}else{

				Factory::close_connection($db_interface);
				throw new QueryException("Error Processing Request", 1);

			}

		}else{

			Factory::close_connection($db_interface);
			throw new QueryException("Error Processing Request", 1);

		}

	}


	/**
	* Delete entry.
	* @param   CaseEntry   $entry      The CaseEntry to delete.
	* 
	* @throws  QueryException          If $entry could not be deleted.
	* @throws  ConnectionException     If $entry could not be deleted.
	*/
	public static function deleteEntry($id){            

		Factory::query("delete from
		case_entries
		where
		id=".$id);

	}


	 /**
     * Get entry by id.
     *
     * @param  $id   The entry's id.
     * 
     * @return null if no entry is found, a CaseEntry Object otherwise.
     */
    public static function getEntryById($id){
        
        $mysqli_result=Factory::query("select
                                            id,
                                            start,
                                            end,
                                            description,
                                            patient_id
                                        from
                                            case_entries
                                        where
                                            id=".$id);
        
        $entryObject=$mysqli_result->fetch_object();
        
        if($entryObject!=null){
        	return new CaseEntry(new DateTime($entryObject->start, new DateTimeZone('Europe/Rome')), new DateTime($entryObject->end, new DateTimeZone('Europe/Rome')), $entryObject->description, $entryObject->id, $entryObject->patient_id);
        }
        
        return null;

    }


}

?>
