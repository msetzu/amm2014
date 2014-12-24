<?php

    require_once dirname(__FILE__).'/settings.php';
    
    require_once dirname(__FILE__).'/factory.php';
    
    require_once dirname(__FILE__).'/../exceptions/queryException.php';
    require_once dirname(__FILE__).'/../exceptions/connectionException.php';


    class PatientFactory {


        /**
         * Get the users matching the parameters.
         * '%' if @param is irrelevant.
         * 
         * @param  $name The user's name.
         * @param  $surname The user's surname.
         * @param  $birthday The user's birthday.
         * @param  $table The user's role.
         * @param  $email The user's email
         * 
         * @return null if no users are found, an array of the matching users otherwise.
         */
        public static function getPatientsGeneric($name, $surname, $birthday){

            $results=array();

            $db_interface=Factory::connect();
            $stmt=$db_interface->stmt_init();

            if($stmt){

                $db_interface->query("use ".Settings::getDatabase());

                $stmt->prepare("select
                                    name,
                                    surname,
                                    birthday,
                                    ward,
                                    bed_number,
                                    id
                                from
                                    patients
                                where
                                    name like ? and
                                    surname like ? and
                                    birthday like ?
                               ");



                if($stmt->errno==0){

                    // $birthday == '%'
                    if(is_string($birthday)){

                        $stmt->bind_param("sss",
                                            $name,
                                            $surname,
                                            $birthday
                                         );

                    } else {

                        $stmt->bind_param("sss",
                                            $name,
                                            $surname,
                                            $birthday->format("Y-m-d")
                                         );

                    }


                    if($stmt->errno==0){

                        $stmt->execute();

                        if($stmt->errno==0){

                            $stmt->bind_result($tmp_name, $tmp_surname, $tmp_birthday, $tmp_ward, $tmp_bed_number, $tmp_id);

                            while ($stmt->fetch()) {

                                $results[]=new Patient($tmp_name, $tmp_surname, $tmp_birthday, $tmp_ward, $tmp_bed_number, $tmp_id);

                            }

                            return (count($results)==0)?null:$results;

                        }else{

                            Factory::close_connection($db_interface);
                            Factory::close_connection($stmt);
                            throw new QueryException(0);

                        }

                    }else{

                        Factory::close_connection($db_interface);
                        Factory::close_connection($stmt);
                        throw new QueryException(1);

                    }

                }else{
                    Factory::close_connection($db_interface);
                    Factory::close_connection($stmt);
                    throw new QueryException(1);                    

                }

            }else{

                Factory::close_connection($db_interface);
                Factory::close_connection($stmt);
                throw new ConnectionException("Error Processing Request", 1);

            }

        }


        /**
         * Get patient by id.
         *
         * @param  $id   The patient's id.
         * 
         * @return null if no patient is found, a Patient Object otherwise.
         */
        public static function getPatientById($id){
            
            $mysqli_result=Factory::query("select
                                                name,
                                                surname,
                                                birthday,
                                                ward,
                                                bed_number
                                            from
                                                patients
                                            where
                                                id=$id");
            
            $patientObject=$mysqli_result->fetch_object();
            
            if($patientObject!=null){
            
                return new Patient($patientObject->name,
                                    $patientObject->surname,
                                    new DateTime($patientObject->birthday." 00:00:00", new DateTimeZone('Europe/Rome')),
                                    $patientObject->ward,
                                    $patientObject->bed_number,
                                    $id);

            }
            
            return null;

        }


        /**
         * Store a new patient into the database.
         *  
         * @param $patient The patient to store.
         *
         * @throws ConnectionException if connection was not available.
         * @throws QueryException if query did not succed and user was not added.
         * @throws UserNotAddedException if a user with the same email exists.
         * @throws MailLengthException if mail is not valid.
         * @throws UserNotAddedException if users could not be added.
         * 
         * @return void
         */
        public static function storeNewPatient($patient){

            $db_interface=Factory::connect();
            $stmt=$db_interface->stmt_init();

            if($stmt!=null){

                $stmt->prepare("insert into
                                    patients
                                        (id,
                                        name,
                                        surname,
                                        birthday,
                                        ward,
                                        bed_number)
                                    values
                                        (default,
                                        ?,
                                        ?,
                                        ?,
                                        ?,
                                        ?)
                                ");

                $stmt->bind_param("ssssi",
                                    $patient->getName(),
                                    $patient->getSurname(),
                                    $patient->getBirthday()->format("Y-m-d"),
				                    $patient->getWard(),
                                    $patient->getBedNumber()
                                 );
                if($stmt->errno==0){

                    $stmt->execute();

                    if($stmt->errno==0){

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
         * Update patients's info.
         * 
         * @param  $patient 	The updated patient.
         *
         * @throws ConnectionException if connection was not available.
         * @throws QueryException if query did not succed and user was not added.
         * @throws UserNotUpdatedException if a user with the same email exists.
         * 
         * @return void
         */
        public static function editPatient($patient, $bed_number){

            $db_interface=Factory::connect();
            $stmt=$db_interface->stmt_init();

            if($stmt){

                $stmt->prepare("update
                                    patients
                                set
                                    name=?,
                                    surname=?,
                                    birthday=?,
                                    ward=?,
                                    bed_number=?                                    
                                where
                                    bed_number=?
                            ");

                $stmt->bind_param("ssssii",
                                    $patient->getName(),
                                    $patient->getSurname(),
                                    $patient->getBirthday()->format("Y-m-d"),
                                    $patient->getWard(),
                                    $patient->getBedNumber(),
                                    $bed_number
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
         * Get user by id.
         * 
         * @param int   $id     The user's id.   
         * 
         * @return null if no users are found,' User otherwise.
         */
        public static function getDoctors($id){

            $doctorsIds=array();
            $doctors=array();

            $mysql_doctorsIds=Factory::query("select user_id from user_patient join users on users.id=user_patient.user_id where user_patient.patient_id=$id");


            while($currentId=$mysql_doctorsIds->fetch_object()){

                $doctorsIds[]=$currentId->user_id;

            }

            foreach ($doctorsIds as $currentUserId){

                $doctors[]=UserFactory::getUserById($currentUserId);

            }


            return $doctors;

        }


    }

?>
