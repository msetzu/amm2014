<?php
    
    require_once("/home/amm/development/amm2014/model/factories/settings.php");
    
    require_once(Settings::baseDirectory()."/model/factories/factory.php");
    
    require_once(Settings::baseDirectory()."/model/exceptions/queryException.php");
    require_once(Settings::baseDirectory()."/model/exceptions/connectionException.php");

    class caseEntriesFactory{    
        
        /**
         * @param   int     $id                   The patient id.
         * 
         * @return  CaseEntry   
         * 
         * @throws  QueryException.
         * @throws  ConnectionException.
         */
        public static function getEntriesById($id){
            
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

                $results[]=new CaseEntry(new DateTime($currentCaseEntry->start),
                                         new DateTime($currentCaseEntry->end),
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
                                       patient_id,
                                       patient_fk)
                                   values
                                       (default,
                                       ?,
                                       ?,
                                       ?,
                                       ?,
                                       null)
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
        
        
    }

?>
