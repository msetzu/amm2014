<?php
	
	require_once dirname(__FILE__).'/../factories/settings.php';


	class CaseEntry	{
		
            private $id;
            private $start;
            private $end;
            private $description;
            private $patientId;

            /**
             * @param DateTime $start           Start of the syndrome/symptom.
             * @param DateTime $end             End of the syndrome/symptom, set to 1000-11-11 11:11:11 for occurring events.
             * @param String   $description     Entry description.
             * @param int      $patientId       Patient id (==-1 if not stored).
             * @param int      $id              Id (==-1 if not stored).
             */
            public function __construct($start, $end, $description, $id, $patientId){

                    $this->start=$start;
                    $this->end=$end;
                    $this->description=$description;
                    $this->patientId=$patientId;
                    $this->id=$id;

            }


            public function getStart(){

                return $this->start;

            }


            public function getEnd(){

                return $this->end;

            }


            public function getDescription(){

                return $this->description;

            }


            public function getPatientId(){

                return $this->patientId;

            }

            
            public function getId(){
                
                return $this->id;
                
            }
            

            public function setStart($start){

                $this->start=$start;

            }


            public function setEnd($end){

                $this->end=$end;

            }


            public function setDescription($description){

                $this->description=$description;

            }


            public function setPatientId($patientId){

                $this->patientId=$patientId;

            }
            
            
            public function setId($id){
                
                $this->id=$id;
                
            }

	}

?>
