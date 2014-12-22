<?php

	require_once dirname(__FILE__).'/settings.php';

	include_once dirname(__FILE__).'/../exceptions/queryException.php';
	include_once dirname(__FILE__).'/../exceptions/connectionException.php';
	require_once dirname(__FILE__)."/../exceptions/userNotAddedException.php";
	
        
	class Factory{

		/*
		* Create a mysqli object.
		*
		* @throws ConnectionException if connection could not be established.
		* 
		* @return A connected mysqli object if succcloseesful.
		*/
		public static function connect(){

			$db_interface=new mysqli();
			
			$db_interface->connect("localhost",Settings::getUser(),Settings::getPassword(),Settings::getDatabase());
                        
			if(self::isConnected($db_interface)){

                            return $db_interface;

			}

			throw new ConnectionException("Error Processing Request", 1);

		}

                
                /**
                 * Close a connection.
                 * 
                 * @param $mysqli   $db_interface   The mysqli Object.
                 */
		public static function close_connection($db_interface){

                    $db_interface->close();

		}


		/*
		* Executes the $query query.
		*
		* @throws QueryException if connection was established but query did not succed.
		* @throws ConnectionException if connection was not established succesfully.
		* 
		* @return mysqli_result if succesfull.
		*/
		public static function query($query){

                    try{
                        
                        $db_interface=self::connect();

                        if($db_interface){

                                $db_interface->query("use ".Settings::getDatabase());

                                if($db_interface->errno==0){

                                        $result=$db_interface->query($query);

                                        if($db_interface->errno==0){
                       
                                                Factory::close_connection($db_interface);
                                                return $result;

                                        }else{
                                            
                                            Factory::close_connection($db_interface);
                                            throw new QueryException("Error Processing Request", 1);     
                                            
                                        }

                                }else{
                                    
                                    Factory::close_connection($db_interface);
                                    throw new ConnectionException("Error Processing Request", 1);

                                }

                        }else{
                            
                            Factory::close_connection($db_interface);
                            throw new ConnectionException("Error Processing Request", 1);                	

                        }

                }catch (Exception $e){
                    
                    Factory::close_connection($db_interface);
                    throw new QueryException("Error Processing Request", 1);            	

                }


            }


		/*
		* Check $db_interface connection.
		*
		* @param $db_interface The mysqli object to check.
		*
		* @return boolean
		 */
		private function isConnected($db_interface){

                    return $db_interface!=null?true:false;	

		}
	

	}
?>
