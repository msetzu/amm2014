<?php
	
    require_once dirname(__FILE__).'/settings.php';
		
    require_once dirname(__FILE__).'/factory.php';
    require_once dirname(__FILE__).'/patientFactory.php';
    
    require_once dirname(__FILE__).'/../exceptions/mailLengthException.php';
    require_once dirname(__FILE__).'/../exceptions/mailDuplicateException.php';
    require_once dirname(__FILE__).'/../exceptions/passwordLengthException.php';
    require_once dirname(__FILE__).'/../exceptions/queryException.php';
    require_once dirname(__FILE__).'/../exceptions/userNotAddedException.php';
    require_once dirname(__FILE__).'/../exceptions/userNotValidException.php';
    

    class UserFactory{

        
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
        public static function getUsersGeneric($name, $surname, $birthday, $ward, $role, $email){

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
                                    role,
                                    email,
                                    password,
                                    id
                                from
                                    users
                                where
                                    name like ? and
                                    surname like ? and
                                    birthday like ? and
                                    ward like ? and
                                    role like ? and
                                    email like ?");                

                if($stmt->errno==0){

                    // $birthday == '%'
                    if(is_string($birthday)){

                        $stmt->bind_param("ssssss",
                                            $name,
                                            $surname,
                                            $birthday,
                                            $ward, 
                                            $role,
                                            $email);

                    } else {

                        $stmt->bind_param("sssssss",
                                            $name,
                                            $surname,
                                            $birthday->format("Y-m-d"),
                                            $ward, 
                                            $role,
                                            $email);

                    }


                    if($stmt->errno==0){

                        $stmt->execute();

                        if($stmt->errno===0){

                            $stmt->bind_result($res_name, $res_surname, $res_birthday, $res_ward, $res_role, $res_email, $res_password, $res_id);

                            while ($stmt->fetch()) {

                                switch ($res_role){
									
                                    case "Doctor":
                                        $results[]=new Doctor($res_name, $res_surname, new DateTime($res_birthday, new DateTimeZone('Europe/Rome')), $res_ward, $res_email, $res_password, $res_id);
                                    break;

                                    case "Student":
                                        $results[]=new Student($res_name, $res_surname, new DateTime($res_birthday, new DateTimeZone('Europe/Rome')), $res_ward, $res_email, $res_password, $res_id);
                                    break;

                                }

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
        * Get user by id.
        *
        * @param    int     $id     The user's id.
        * 
        * @return null if no user is found, a User Object otherwise.
        */
        public static function getUserById($id){

           $mysqli_result=Factory::query("select
                                               name,
                                               surname,
                                               birthday,
                                               ward,
                                               email,
                                               password
                                           from
                                               users
                                           where
                                               id=$id");

           $userObject=$mysqli_result->fetch_object();

           if($userObject!=null){

               return new User($userObject->name,
                                $userObject->surname,
                                new DateTime($userObject->birthday." 00:00:00", new DateTimeZone('Europe/Rome')),
                                $userObject->ward,
                                $userObject->email,
                                $userObject->password,
                                $id);

           }

           return null;

        }


        /**
        * Store a new patient into the database.
        *  
        * @param    $user The patient to store.
        *
        * @throws   ConnectionException if connection was not available.
        * @throws   QueryException if query did not succed and user was not added.
        * @throws   UserNotValidException if users could not be added.
        * 
        * @return void
        */
        public static function storeNewUser($user){
           
           if(self::getUsersGeneric("%", "%", "%", "%", "%", $user->getEmail())!=null){
               
               throw new UserNotValidException();
               
           }
            
           $db_interface=Factory::connect();
           $stmt=$db_interface->stmt_init();

           if($stmt!=null){

               $stmt->prepare("insert into
                                   users
                                       (id,
                                       name,
                                       surname,
                                       birthday,
                                       ward,
                                       email,
                                       password,
                                       role)
                                   values
                                       (default,
                                       ?,
                                       ?,
                                       ?,
                                       ?,
                                       ?,                                        
                                       ?,
                                       ?)
                               ");

               $stmt->bind_param("sssssss",
                                   $user->getName(),
                                   $user->getSurname(),
                                   $user->getBirthday()->format("Y-m-d"),
                                   $user->getWard(),
                                   $user->getEmail(),
                                   $user->getPassword(),
                                   $user->getRole()
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


        /*
        * Check if a user identified by pair email-password exists.
        *
        * @param    String   $email     The user's email.
        * @param    String   $password  The user's password.
        *
        * @throws QueryException if database could not be queried. 
        * 
        * @return true if succesful, false otherwise.
        */
        public static function isAuthenticable($email, $password){

            $user=self::getUsersGeneric("%", "%", "%", "%", "%", $email);

            if($user!=null){

                if($user[0]->getPassword()===$password){
                    
                    return true;

                }

            }

            return false;

        }

        
        /**
        * Delete a user, provided it exists.
        * 
        * @param  $email       The user's email.
        * @param  $password    The user's password.
        *                          
        * @throws UserNotValidException    If user could not be found or deleted.
        * @throws QueryException           If query didn't work.
        *
        * @return void 
        */
        public static function deleteUser($email, $password){

            if(!(self::isAuthenticable($email, $password))){

                throw new UserNotValidException("Error Processing Request", 1);                

            }

            /* Actually delete user from the database. */
            $db_interface=Factory::connect();
            $stmt=$db_interface->stmt_init();

            if($stmt){

                $stmt->prepare("delete from
                                    users
                                where
                                    email=? and
                                    password=?
                               ");

                $stmt->bind_param("ss",
                                    $email,
                                    $password);

                if($stmt->errno==0){

                        $stmt->execute();

                        if($stmt->errno==0){
                            
                            Factory::close_connection($db_interface);
                            return;

                        }else{
                            
                            Factory::close_connection($db_interface);
                            throw new QueryException("Error Processing Request", 1);

                        }

                }

            }

        }

        
        /**
        * Update user's info.
        * 
        * @param  $user        The updated user.
        * @param  $table       The user's table.
        * @param  $oldEmail    The user email.
        *
        * @throws ConnectionException if connection was not available.
        * @throws QueryException if query did not succed and user was not added.
        * @throws UserNotUpdatedException if a user with the same email exists.
        * 
        * @return void
        */
        public static function editUser($user){
            
            $db_interface=Factory::connect();
            $stmt=$db_interface->stmt_init();
            
            if($stmt){

                $stmt->prepare("update
                                    users
                                set
                                    name=?,
                                    surname=?,
                                    birthday=?,
                                    ward=?,
                                    email=?,
                                    password=?
                                where
                                    id=?
                            ");
                $stmt->bind_param("sssssss",
                                    $user->getName(),
                                    $user->getSurname(),
                                    $user->getBirthday(),
                                    $user->getWard(),
                                    $user->getEmail(),
                                    $user->getPassword(),
                                    $_SESSION['user_id']
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
        * Get the patients of the $user user.
        * 
        * @param int   $id     The user's id.
        */
        public static function getUsersPatients($id){
            
            $patientsIds=array();
            $patients=array();

            $mysql_patientsIds=Factory::query("select patient_id from user_patient where user_id = ".$id);
            
            while($currentId=$mysql_patientsIds->fetch_object()){

                $patientsIds[]=$currentId->patient_id;

            }
            
            foreach ($patientsIds as $currentPatientId){
                    $patients[]=PatientFactory::getPatientById($currentPatientId);
            }

            return $patients;

        }
    
        
        /**
         * Discharge a patient from a user's care.
         * 
         * @param int   $doctorId   The user's id.
         * @param int   $patientId  The patient's id.
         */
        public static function discharge($doctorId, $patientId){
            
            try{
                
                Factory::query("delete from
                                        user_patient
                                where
                                    user_id=$doctorId
                                    and
                                    patient_id=$patientId
                               ");
                
            }catch(Exception $e){}
            
        }
        
        
        /**
         * Let a user put a patient in his patients list.
         * 
         * @param int       $userId     The user's id.
         * @param String    $userRole   The user's role.
         * @param int       $patientId  The patient's id.
         */
        public static function addPatient($userId, $userRole, $patientId){

            try{
                
                Factory::query("insert into
                                        user_patient
                                        (id,
                                        user_id,
                                        patient_id,
                                        user_role)
                                values
                                        (default,
                                        $userId,
                                        $patientId,
                                        \"$userRole\")
                               ");
                
            }catch(Exception $e){}
            
        }
        
        
}
?>
